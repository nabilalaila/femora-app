<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index(){
        $programs = Program::get();
        return view('Admin.KelolaProgram', compact('programs'), ['noNavbar'=> true]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi_program' => 'required|string',
            'tanggal_buka' => ['required', 'date'],
            'tanggal_tutup' => ['required', 'date', 'after:tanggal_buka'],
            'tanggal_pelaksanaan' => ['required', 'date', 'after:tanggal_tutup'],
            'is_online' => 'required|boolean',
            'harga_program' => 'nullable|numeric|min:0',
            'foto_header' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'max_peserta' => 'required|numeric'
        ],[
            'tanggal_tutup.after' => 'Tanggal tutup harus lebih besar dari tanggal buka.',
            'tanggal_pelaksanaan.after' => 'Tanggal pelaksanaan harus setelah tanggal tutup.',
        ]);

        if ($request->hasFile('foto_header')) {
            $file = $request->file('foto_header');
            $path = $file->store('program_foto', 'public');
            $validated['foto_header'] = '/storage/' . $path;
        }

        $validated['is_delete'] = 0;
        $validated['created_by'] = auth()->id();

try {
    Program::create($validated);
} catch (\Exception $e) {
    dd('Gagal simpan:', $e->getMessage());
}
        return redirect()->back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program,id',
            'nama_program' => 'required|string|max:255',
            'deskripsi_program' => 'required|string',
            'tanggal_buka' => ['required', 'date'],
            'tanggal_tutup' => ['required', 'date', 'after:tanggal_buka'],
            'tanggal_pelaksanaan' => ['required', 'date', 'after:tanggal_tutup'],
            'is_online' => 'required|boolean',
            'harga_program' => 'nullable|numeric',
            'foto_header' => 'nullable|image|max:2048',
            'max_peserta' => 'required|numeric'
        ], [
            'tanggal_tutup.after' => 'Tanggal tutup harus lebih besar dari tanggal buka.',
            'tanggal_pelaksanaan.after' => 'Tanggal pelaksanaan harus setelah tanggal tutup.',
        ]);

        $program = Program::findOrFail($request->program_id);
        $program->nama_program = $request->nama_program;
        $program->deskripsi_program = $request->deskripsi_program;
        $program->tanggal_buka = $request->tanggal_buka;
        $program->tanggal_tutup = $request->tanggal_tutup;
        $program->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
        $program->is_online = $request->is_online;
        $program->harga_program = $request->harga_program;

        if ($request->hasFile('foto_header')) {
            $filename = $request->file('foto_header')->store('program', 'public');
            $program->foto_header = '/storage/' . $filename;
        }
        
        try {
            $program->save();
        } catch (\Exception $e) {
            dd('Gagal simpan:', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->back()->with('success', 'Program berhasil dihapus.');
    }
}
