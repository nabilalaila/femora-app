<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';

    protected $fillable = [
        'id',
        'nama_program',
        'tanggal_buka',
        'tanggal_tutup',
        'tanggal_pelaksanaan',
        'is_online',
        'is_delete',
        'deskripsi_program',
        'info_peserta',
        'created_by',
        'foto_header',
        'max_peserta',
        'harga_program',
    ];
}
