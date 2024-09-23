<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pertanyaan = Pertanyaan::all();
        return view('admin.pertanyaan.index', ['pertanyaans' => $pertanyaan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'daftar_pertanyaan' => 'required'
        ]);

        Pertanyaan::create(
            [
                'daftar_pertanyaan' => $request->input('daftar_pertanyaan')
            ]
        );

        Alert::success('success', 'Data Pertanyaan Berhasil di Simpan');
        return redirect()->route('tanya');
    }

    /**
     * Display the specified resource.
     */
    public function show(pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertanyaan $pertanyaan, $id)
    {
        $pertanyaan = Pertanyaan::find($id);
        return view('admin.pertanyaan.edit', compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'daftar_pertanyaan' => 'required',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);
        $pertanyaan->daftar_pertanyaan = $request->input('daftar_pertanyaan');
        $pertanyaan->save();

        Alert::success('success', 'Data Pertanyaan Berhasil di Perbaharui');
        return redirect()->route('tanya');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pertanyaan $pertanyaan)
    {
        $pertanyaan = Pegawai::findOrFail($id);
        $pertanyaan->delete();

        Alert::success('success', 'Data Berhasil dihapus');
        return redirect()->route('perlu');
    }

    public function jawabanIndex()
    {
        $jawabans = Jawaban::all();
        $pertanyaans = Pertanyaan::all();

        $totals = $jawabans->groupBy('pertanyaan_id')->map(function ($group) use ($jawabans) {
            return [
                'sangat_puas' => $group->where('daftar_jawaban', 'Sangat Puas')->count(),
                'puas' => $group->where('daftar_jawaban', 'Puas')->count(),
                'cukup_puas' => $group->where('daftar_jawaban', 'Cukup Puas')->count(),
                'tidak_puas' => $group->where('daftar_jawaban', 'Tidak Puas')->count(),
            ];
        });

        $grandTotals = [
            'sangat_puas' => $jawabans->where('daftar_jawaban', 'Sangat Puas')->count(),
            'puas' => $jawabans->where('daftar_jawaban', 'Puas')->count(),
            'cukup_puas' => $jawabans->where('daftar_jawaban', 'Cukup Puas')->count(),
            'tidak_puas' => $jawabans->where('daftar_jawaban', 'Tidak Puas')->count(),
        ];

        return view('admin.jawaban.index', [
            'jawabans' => $jawabans,
            'totals' => $totals,
            'grandTotals' => $grandTotals,
            'pertanyaans' => $pertanyaans
        ]);
    }
}
