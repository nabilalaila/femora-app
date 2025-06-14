<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = 'period';

    protected $fillable = [
        'jenis',
        'tanggal_mulai',
        'tanggal_berakhir',
        'batas_akhir',
        'is_haid',
        'source',
        'user_id',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'is_haid' => 'boolean',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bloodRecords()
    {
        return $this->hasMany(BloodRecord::class);
    }
}
