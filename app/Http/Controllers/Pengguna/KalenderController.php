<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\BloodRecord;
use App\Models\Period;
use App\Models\PolaKebiasaan;

class KalenderController extends Controller
{

   public function index()
    {
    $user = auth()->user();
    $pola_kebiasaan = PolaKebiasaan::where('user_id', $user->id)->first();

    $periods = Period::with('bloodRecords')
    ->where('user_id', auth()->id())
    ->get()
    ->flatMap(function ($period) {
        $start = Carbon::parse($period->tanggal_mulai)->startOfDay();
        $end = Carbon::parse($period->tanggal_berakhir)->endOfDay();
        $dates = [];

        while ($start->lte($end)) {
            $matchingBlood = $period->bloodRecords->firstWhere(function ($record) use ($start) {
                return Carbon::parse($record->waktu_keluar)->toDateString() === $start->toDateString();
            });

            $dates[] = [
                'id' => $period->id,
                'date' => $start->toDateString(),
                'jenis' => $period->jenis,
                'waktu_keluar' => optional($matchingBlood)->waktu_keluar,
                'warna' => optional($matchingBlood)->warna,
                'is_fullday' => optional($matchingBlood)->is_fullday,
            ];

            $start->addDay();
        }

        return $dates;
    });


    return view('User.kalenderHaid', [
        'noNavbar' => true,
        'periodDates' => $periods,
        'isEdit' => false,
    ]);
    dd($periods->pluck('waktu_keluar'));

}



    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'waktu_keluar' => 'required|date_format:H:i',
            'warna' => 'required|in:merah tua,coklat,hitam,merah terang,pink,oranye,abu-abu',
            'is_fullday' => 'required|in:0,1',
        ]);

        $user = auth()->user();
        $userId = $user->id;
        $tanggal = Carbon::parse($request->date)->toDateString();
        $tanggalCarbon = Carbon::parse($request->date);
        $combinedDateTime = Carbon::parse($tanggal . ' ' . $request->waktu_keluar);
        $yesterday = Carbon::parse($tanggal)->subDay()->toDateString();
        $pola_kebiasaan = PolaKebiasaan::where('user_id', $user->id)->where('is_active', 1)->first();
        $isMustaqirrah = $user->is_mustaqirrah === 'ya';

        if($isMustaqirrah){
            $adatHaid = $pola_kebiasaan->durasi;
            $adatSuci = $pola_kebiasaan->siklus - $adatHaid;
        }

        $existing = BloodRecord::where('user_id', $userId)
            ->whereDate('waktu_keluar', $tanggal)
            ->first();

        if ($existing) {
            return back()->with('error', 'Data darah untuk tanggal ini sudah ada.');
        }

        $isOver = $tanggal > Carbon::now();

        if ($isOver) {
            return back()->with('error', 'Anda belum melalui tanggal ini');
        }

        $darahs = BloodRecord::where('user_id', $userId)
            ->orderBy('waktu_keluar')
            ->get()
            ->groupBy(fn($r) => Carbon::parse($r->waktu_keluar)->toDateString());

        if (!isset($darahs[$tanggal])) {
            $darahs[$tanggal] = collect();
        }

        $darahs[$tanggal]->push((object)['waktu_keluar' => $combinedDateTime]);

        $maxHaidDuration = 14;
        $group = collect();
        $start = Carbon::parse($tanggal)->copy()->subDays(14);
        $end = Carbon::parse($tanggal)->copy()->addDays(14);
        $current = $start->copy();

        while ($current->lte($end)) {
            $dateStr = $current->toDateString();
            if ($darahs->has($dateStr)) {
                $group->push($dateStr);
            }
            if ($group->unique()->count() >= $maxHaidDuration) {
                break;
            }
            $current->addDay();
        }

        $group = $group->unique()->sort()->values();

        $startDate = Carbon::parse($group->first());
        $endDate = Carbon::parse($group->last());
        $durasi = $startDate->diffInDays($endDate) + 1;
        $hariKe = $group->search($tanggal) + 1;
        $hasAnyPeriod = Period::where('user_id', $userId)->exists();

        $lastHaid = Period::where('user_id', $userId)
            ->where('jenis', 'haid')
            ->orderByDesc('tanggal_berakhir')
            ->first();

        if (!$hasAnyPeriod || ($tanggalCarbon > $lastHaid->batas_akhir)) {
            $tanggalAwalGroup = $tanggalCarbon;
        } else {
            $lastHaid = Period::where('user_id', $userId)
                ->where('jenis', 'haid')
                ->orderByDesc('tanggal_berakhir')
                ->first();

            $tanggalAwalGroup = $lastHaid->tanggal_mulai;
        }

        if($isMustaqirrah){
            $tanggalBatas = Carbon::parse($tanggalAwalGroup)->copy()->addDays($adatHaid);
            $tanggalTidakLayakBerakhir = Carbon::parse($tanggalBatas)->copy()->addDays($adatSuci);
        }
        else{
            $tanggalBatas = Carbon::parse($tanggalAwalGroup)->copy()->addDays(14);
            $tanggalTidakLayakBerakhir = Carbon::parse($tanggalBatas)->copy()->addDays(14);
        }

        $isLayakHaid = true;

        if ($tanggalCarbon->greaterThan($tanggalBatas) && $tanggalCarbon->lessThan($tanggalTidakLayakBerakhir)) {
            $isLayakHaid = false;
        }

        $durasiHaid = $adatHaid ?? 6;

        if ($isLayakHaid) {
            $jenis = 'haid';
        } else {
            $jenis = 'istihadhah';
        }

        $existingPeriod = Period::where('user_id', $userId)
            ->where('jenis', $jenis)
            ->orderByDesc('tanggal_berakhir')
            ->first();

        if ($existingPeriod) {
            if ($isMustaqirrah){
                if($jenis == 'haid'){
                    $selisihHari = Carbon::parse($existingPeriod->tanggal_mulai)->addDays($adatHaid)->diffInDays($tanggalCarbon, false);
                }
                else{
                    $selisihHari = Carbon::parse($existingPeriod->tanggal_mulai)->addDays($adatSuci)->diffInDays($tanggalCarbon, false);
                }
            }
            else{
                $selisihHari = Carbon::parse($existingPeriod->tanggal_mulai)->addDays(14)->diffInDays($tanggalCarbon, false);
            }

            if ($selisihHari < 0) {
                $existingPeriod->update([
                    'tanggal_berakhir' => $tanggalCarbon->copy()->endOfDay(),
                ]);
                $status = 'update';
            } else {
                if($jenis == 'haid'){
                    $existingPeriod = Period::create([
                        'user_id' => $userId,
                        'tanggal_mulai' => $combinedDateTime,
                        'tanggal_berakhir' => $tanggalCarbon->copy()->endOfDay(),
                        'batas_akhir' => $tanggalBatas,
                        'jenis' => $jenis,
                        'source' => 'auto',
                    ]);
                }
                else{
                    $existingHaid = Period::where('user_id', $userId)
                        ->where('jenis', 'haid')
                        ->orderByDesc('tanggal_berakhir')
                        ->first();

                    if ($existingHaid && $existingHaid->batas_akhir) {
                        $existingHaid->update([
                            'tanggal_berakhir' => $existingHaid->batas_akhir,
                        ]);
                    }

                    $existingPeriod = Period::create([
                        'user_id' => $userId,
                        'tanggal_mulai' => $combinedDateTime,
                        'tanggal_berakhir' => $tanggalCarbon->copy()->endOfDay(),
                        'jenis' => $jenis,
                        'source' => 'auto',
                    ]);
                }
            }
        } else {
            if($jenis == 'haid'){
                $existingPeriod = Period::create([
                    'user_id' => $userId,
                    'tanggal_mulai' => $combinedDateTime,
                    'tanggal_berakhir' => $tanggalCarbon->copy()->endOfDay(),
                    'batas_akhir' => $tanggalBatas,
                    'jenis' => $jenis,
                    'source' => 'auto',
                ]);
            }
            else{
                $existingHaid = Period::where('user_id', $userId)
                    ->where('jenis', 'haid')
                    ->orderByDesc('tanggal_berakhir')
                    ->first();

                if ($existingHaid && $existingHaid->batas_akhir) {
                    $existingHaid->update([
                        'tanggal_berakhir' => $existingHaid->batas_akhir,
                    ]);
                }

                $existingPeriod = Period::create([
                    'user_id' => $userId,
                    'tanggal_mulai' => $combinedDateTime,
                    'tanggal_berakhir' => $tanggalCarbon->copy()->endOfDay(),
                    'jenis' => $jenis,
                    'source' => 'auto',
                ]);
            }
        }

        $existingBlood = BloodRecord::where('user_id', $userId)
        ->whereDate('waktu_keluar', $tanggalCarbon)
        ->first();
        if (!$existingBlood) {
            BloodRecord::create([
                'user_id' => $userId,
                'waktu_keluar' => $combinedDateTime,
                'warna' => $request->warna,
                'is_fullday' => $request->boolean('is_fullday'),
                'jenis_darah' => $jenis,
                'period_id' => $existingPeriod->id,
            ]);
        }

        return redirect()->back()->with('success', 'Data darah berhasil disimpan sebagai ' . $jenis);
    }

    public function edit(){
        return view ('User.dashboardPengguna');
    }
}
