<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\Models\User;

class DetailProgram extends Model
{
    use HasFactory;

    protected $table = 'detail_program';

    protected $fillable = [
        'role',
        'bukti_pembayaran',
        'status_pembayaran',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
