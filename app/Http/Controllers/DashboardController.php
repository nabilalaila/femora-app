<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Period;
use App\Models\PolaKebiasaan;
use App\Models\DetailProgram;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();

        if ($user->role === 'admin') {
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
        } elseif ($user->role === 'pengguna') {
            $user = auth()->user();
            $user = auth()->user();
        $pola_kebiasaan = PolaKebiasaan::where('user_id', $user->id)->first();

        $periods = Period::where('user_id', $user->id)
            ->get()
            ->flatMap(function ($period) use ($user, $pola_kebiasaan) {
                $start = Carbon::parse($period->tanggal_mulai)->startOfDay();
                $end = Carbon::parse($period->tanggal_berakhir)->endOfDay();
                $dates = [];

                while ($start->lte($end)) {
                    $dates[] = [
                        'date' => $start->toDateString(),
                        'jenis' => $period->jenis,
                    ];
                    $start->addDay();
                }
                return $dates;
            });
        return view('User.dashboardPengguna', ['noNavbar' => true, 'periodDates' => $periods]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}

