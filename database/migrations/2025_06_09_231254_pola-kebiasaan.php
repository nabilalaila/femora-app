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
        Schema::create('pola_kebiasaan', function (Blueprint $table) {
            $table->id();
            $table->integer('durasi');
            $table->integer('panjang_siklus');
            $table->boolean('is_active');
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        //
    }
};
