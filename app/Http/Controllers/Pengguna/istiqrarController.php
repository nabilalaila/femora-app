<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PolaKebiasaan;
use Carbon\Carbon;

class istiqrarController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($request->input('tidak')) {
            $user->update([
                'is_mustaqirrah' => 'tidak',
            ]);
            return redirect()->route('dashboard.index')->with('info', 'Kamu memilih untuk tidak mengisi data haid.');
        }

        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'durasi' => 'required|integer|min:1',
            'siklus' => 'required|integer|min:1',
        ]);

        PolaKebiasaan::create([
            'durasi'            => $validated['durasi'],
            'panjang_siklus'    => $validated['siklus'],
            'is_active'         => 1,
            'user_id'           => $user->id,
        ]);

        $user->update([
            'is_mustaqirrah' => 'ya',
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Data haid berhasil disimpan.');
    }
}
