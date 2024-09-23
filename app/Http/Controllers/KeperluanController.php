<?php

namespace App\Http\Controllers;

use App\Models\Keperluan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KeperluanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keperluans = Keperluan::all();
        return view('admin.keperluan.index', ['keperluans' => $keperluans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.keperluan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
        ]);

        Keperluan::create(
            [
                'judul' => $request->input('judul'),
            ]
        );

        Alert::success('success', 'Data Keperluan Berhasil di Tambahkan');
        return redirect()->route('perlu');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $keperluan = Keperluan::find($id);
        return view('admin.keperluan.edit', compact('keperluan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
        ]);

        $keperluan = Keperluan::findOrFail($id);
        $keperluan->judul = $request->input('judul');
        $keperluan->save();

        Alert::success('success', 'Data Keperluan Berhasil di Perbaharui');
        return redirect()->route('perlu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $keperluan = Keperluan::findOrFail($id);

        $countRelatedRows = $keperluan->tamu()->count();

        if ($countRelatedRows > 0) {
            Alert::error('Gagal', 'Penghapusan tidak dapat dilakukan karena terdapat data terkait dalam tabel lain.');
        } else {
            $keperluan->delete();
            Alert::success('Sukses', 'Data Keperluan berhasil dihapus.');
        }

        return redirect()->route('perlu');
    }
}
