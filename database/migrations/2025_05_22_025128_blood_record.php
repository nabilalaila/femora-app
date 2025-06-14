<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blood_record', function (Blueprint $table) {
            $table->id();
            $table->datetime('waktu_keluar');
            $table->enum('warna', ['merah tua', 'coklat', 'hitam', 'merah terang', 'pink', 'oranye', 'abu-abu']);
            $table->boolean('is_fullday');
            $table->enum('jenis', ['haid', 'istihadhah','suci']);
            $table->timestamps();
            $table->foreignId('period_id')->constrained('period')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
