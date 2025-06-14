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
        Schema::create('program', function (Blueprint $table) {
        $table->id();
        $table->string('nama_program');
        $table->datetime('tanggal_pelaksanaan');
        $table->boolean('is_online');
        $table->text('deskripsi_program');
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        $table->string('foto_header')->nullable();
        $table->bigInteger('max_peserta')->default(null);
        $table->bigInteger('harga_program')->default(0);
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
