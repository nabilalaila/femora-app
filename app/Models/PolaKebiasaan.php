<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolaKebiasaan extends Model
{
    use HasFactory;

    protected $table = 'pola_kebiasaan';

    protected $fillable = [
        'durasi',
        'panjang_siklus',
        'is_active',
        'user_id',
    ];
}
