<?php

namespace App\Http\Controllers\Pengguna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\DetailProgram;
use Carbon\Carbon;

class RiwayatProgramController extends Controller
{
    public function index(){
        $riwayat = DetailProgram::with('program')
            ->where('role', auth()->id())
            ->latest()
            ->get();

         return view('User.RiwayatProgram', ['noNavbar' => true, 'riwayat' => $riwayat]);
    }
}
