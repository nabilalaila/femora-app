<?php

namespace App\Http\Controllers\Pengguna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\DetailProgram;
use Carbon\Carbon;

class DaftarProgramController extends Controller
{
    public function index(Request $request)
    {
        $programs = Program::where('is_delete', 0)
            ->where('tanggal_tutup', '>=', Carbon::now())
            ->get();

        foreach ($programs as $program) {
            if ($program->harga_program == 0) {
                $program->harga_display = 'Gratis';
            } else {
                $program->harga_display = 'Rp ' . number_format($program->harga_program, 0, ',', '.');
            }
        }

        return view('User.Program', compact('programs'), ['noNavbar'=> true]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program,id',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        DetailProgram::create([
            'program_id' => $request->program_id,
            'role' => auth()->id(),
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->back()->with('success', 'Berhasil daftar program!');
    }

}
