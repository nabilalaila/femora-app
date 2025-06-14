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
        Schema::create('period', function (Blueprint $table) {
            $table->id();
            $table->datetime('tanggal_mulai');
            $table->datetime('tanggal_berakhir');
            $table->date('batas_akhir')->nullable();
            $table->enum('jenis', ['haid', 'istihadhah','suci']);
            $table->enum('source', ['manual', 'auto','prediksi']);
            $table->timestamps();
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
