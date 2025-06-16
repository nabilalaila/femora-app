<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailProgram;

class PendaftaranController extends Controller
{
    public function index()
    {
         $belumDikonfirmasi = DetailProgram::with('program')
            ->where('status_pembayaran', 'belum dikonfirmasi')
            ->latest()
            ->get();

        $riwayat = DetailProgram::with('program')
            ->where('status_pembayaran', '!=', 'belum dikonfirmasi')
            ->latest()
            ->get();

        return view('Admin.PendaftaranProgram', [
            'noNavbar' => true,
            'belumDikonfirmasi' => $belumDikonfirmasi,
            'riwayat' => $riwayat
        ]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $pendaftaran = DetailProgram::find($id);

        if ($request->input('action') === 'setujui') {
            $pendaftaran->status_pembayaran = 'sudah dikonfirmasi';
        } elseif ($request->input('action') === 'tolak') {
            $pendaftaran->status_pembayaran = 'ditolak';
        }

        $pendaftaran->save();

        return redirect()->route('pendaftaran.index')->with('success', 'Status berhasil diperbarui.');
    }
}
