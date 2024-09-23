<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit_kerjas = UnitKerja::all();
        return view('admin.unit_kerja.index', ['unit_kerjas' => $unit_kerjas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unit_kerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_unit_kerja' => 'required',
        ]);

        UnitKerja::create(
            [
                'nm_unit_kerja' => $request->input('nm_unit_kerja'),
            ]
        );

        Alert::success('success', 'Data Unit Kerja Berhasil di Simpan');
        return redirect()->route('nitKerja');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit_kerja = UnitKerja::find($id);
        return view('admin.unit_kerja.edit', compact('unit_kerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nm_unit_kerja' => 'required',
        ]);

        $unit_kerja = UnitKerja::findOrFail($id);
        $unit_kerja->nm_unit_kerja = $request->input('nm_unit_kerja');
        $unit_kerja->save();

        Alert::success('success', 'Data Unit Kerja Berhasil di Perbaharui');
        return redirect()->route('nitKerja');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit_kerja = UnitKerja::findOrFail($id);
        $countRelatedRows = $unit_kerja->pegawai()->count();

        if ($countRelatedRows > 0) {
            Alert::error('Gagal', 'Penghapusan tidak dapat dilakukan karena terdapat data terkait dalam tabel lain.');
        } else {
            $unit_kerja->delete();
            Alert::success('Sukses', 'Data berhasil dihapus.');
        }

        return redirect()->route('nitKerja');
    }
}
