<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('admin.pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit_kerjas = UnitKerja::all();
        return view('admin.pegawai.create', compact('unit_kerjas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'telp' => 'required',
            'unit_kerja_id' => 'required'
        ]);

        Pegawai::create(
            [
                'nama' => $request->input('nama'),
                'nip' => $request->input('nip'),
                'telp' => $request->input('telp'),
                'unit_kerja_id' => $request->input('unit_kerja_id')
            ]
        );

        Alert::success('success', 'Data Pegawai Berhasil disimpan');
        return redirect()->route('pegawai');
    }

    /**
     * Display the specified resource.
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pegawai $pegawai, $id)
    {
        $pegawai = Pegawai::find($id);
        $unit_kerjas = UnitKerja::all();
        return view('admin.pegawai.edit', compact('pegawai', 'unit_kerjas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'telp' => 'required',
            'unit_kerja_id' => 'required'
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->nama = $request->input('nama');
        $pegawai->nip = $request->input('nip');
        $pegawai->telp = $request->input('telp');
        $pegawai->unit_kerja_id = $request->input('unit_kerja_id');
        $pegawai->save();

        Alert::success('success', 'Data Pegawai Berhasil di Perbaharui');
        return redirect()->route('pegawai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        Alert::success('success', 'Data Berhasil dihapus');
        return redirect()->route('pegawai');
    }
}
