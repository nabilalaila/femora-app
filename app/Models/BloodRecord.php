<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRecord extends Model
{
    use HasFactory;

    protected $table = 'blood_record';

    protected $fillable = [
        'waktu_keluar',
        'warna',
        'is_fullday',
        'jenis',
        'period_id',
        'user_id'
    ];

    protected $casts = [
        'waktu_keluar' => 'datetime',
        'is_fullday' => 'boolean',
    ];

    public $timestamps = false;

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
