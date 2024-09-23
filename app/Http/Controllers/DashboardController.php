<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pegawai;
use App\Models\Pertanyaan;
use App\Models\Tamu;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalTamu = Tamu::count();
        $tamuHariIni = Tamu::whereDate('created_at', Carbon::today())->count();
        $totalPegawai = Pegawai::count();
        $totalUnitKerja = UnitKerja::count();

        $pertanyaans = Pertanyaan::all();
        $jawabanData = [];

        foreach ($pertanyaans as $pertanyaan) {
            $jawabanCounts = Jawaban::where('pertanyaan_id', $pertanyaan->id)
                ->select('daftar_jawaban', DB::raw('count(*) as total'))
                ->groupBy('daftar_jawaban')
                ->get();

            $totalJawaban = $jawabanCounts->sum('total');
            $jawabanPercentages = $jawabanCounts->mapWithKeys(function ($item) use ($totalJawaban) {
                return [$item->daftar_jawaban => ($totalJawaban > 0) ? round(($item->total / $totalJawaban) * 100, 2) : 0];
            });

            $jawabanData[$pertanyaan->daftar_pertanyaan] = $jawabanPercentages;
        }

        // Set Waktu Local Indonesia
        setlocale(LC_TIME, 'id_ID.UTF-8');
        Carbon::setLocale('id');

        $tamuPerBulan = Tamu::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $item->month_year = Carbon::create($item->year, $item->month, 1)->translatedFormat('F Y');
                return $item;
            });

        return view('admin.dashboard', compact('totalTamu', 'tamuHariIni', 'totalPegawai', 'totalUnitKerja', 'jawabanData', 'tamuPerBulan'));
    }
}
