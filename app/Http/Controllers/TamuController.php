<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Tamu;
use App\Models\Keperluan;
use App\Models\Pegawai;
use App\Models\Pertanyaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keperluans = Keperluan::all();
        $pegawais = Pegawai::all();
        return view('home', compact('keperluans', 'pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'telp' => 'required|max:18',
            'instansi' => 'required|max:255',
            'alamat' => 'required|max:255',
            'jekel' => 'required',
            'foto' => 'required',

            // 'keperluan_id' => 'required',
            // 'keperluan_lainnya' => 'required_if:keperluan_id,lainnya',
            // 'pegawai_id' => 'required|exists:pegawais,id',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // dd($request->all());

        $imageData = $request->input(('foto'));
        $imageName = null;
        if ($imageData) {
            // Konversi file gambar ke data 'base64'
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageName = 'image_' . time() . '.png';
            file_put_contents(public_path('upload/' . $imageName), base64_decode(str_replace('data:image/png;base64,', '', $imageData)));
        }

        $tamu = new Tamu;
        $tamu->nama = $request->nama;
        $tamu->telp = $request->telp;
        $tamu->instansi = $request->instansi;
        $tamu->alamat = $request->alamat;
        $tamu->jekel = $request->jekel;
        if ($request->keperluan_id === 'lainnya') {
            $tamu->keperluan_id = null;
            $tamu->keperluan_lainnya = $request->keperluan_lainnya;
        } else {
            $tamu->keperluan_id = Keperluan::findOrFail($request->keperluan_id)->id;
            $tamu->keperluan_lainnya = null;
        }
        $tamu->pegawai_id = Pegawai::findOrFail($request->pegawai_id)->id;
        $tamu->foto = $imageName;
        $tamu->status = '';

        // dd($tamu);

        if ($tamu->save()) {
            Alert::success('success', 'Data Tamu Berhasil disimpan');
            return redirect()->route('home');
        } else {
            Alert::error('error', 'Gagal Menyimpan Data Tamu');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $tamus = Tamu::all();
        return view('admin.tamu.index', ['tamus' => $tamus]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tamu = Tamu::findOrFail($id);
        $keperluans = Keperluan::all();
        $pegawais = Pegawai::all();
        return view('admin.tamu.edit', compact('tamu', 'keperluans', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->nama = $request->nama;
        $tamu->telp = $request->telp;
        $tamu->instansi = $request->instansi;
        $tamu->alamat = $request->alamat;
        $tamu->jekel = $request->jekel;
        if ($request->keperluan_id === 'lainnya') {
            $tamu->keperluan_id = null;
            $tamu->keperluan_lainnya = $request->keperluan_lainnya;
        } else {
            $tamu->keperluan_id = $request->keperluan_id;
            $tamu->keperluan_lainnya = null;
        }
        $tamu->pegawai_id = Keperluan::findOrFail($request->pegawai_id)->id;

        if ($tamu->save()) {
            Alert::success('success', 'Data Tamu Berhasil diperbaharui');
            return redirect()->route('daftar_tamu');
        } else {
            Alert::error('error', 'Gagal Menyimpan Data Tamu');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tamu = Tamu::findOrFail($id);

        if ($tamu->foto) {
            $imagePath = public_path('upload/' . $tamu->foto);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $tamu->delete();

        Alert::success('success', 'Data Berhasil dihapus');
        return redirect()->route('daftar_tamu');
    }

    public function checkout($id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->keluar = now();
        $tamu->save();

        return response()->json(['status' => 'success', 'checkout_time' => $tamu->keluar->format('H:i:s d-m-y')]);
    }

    public function survey()
    {
        $tamus = Tamu::where('status', '')->get();
        return view('survey', ['tamus' => $tamus]);
    }

    public function showsurvey($id)
    {
        $tamu = Tamu::findOrFail($id);
        $pertanyaans = Pertanyaan::all();
        return view('isiSurvey', compact('tamu', 'pertanyaans'));
    }

    public function storesurvey(Request $request, $id)
    {
        $tamu = Tamu::findOrFail($id);
        $pertanyaans = Pertanyaan::all();

        $validateData = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required'
        ]);

        foreach ($validateData['answers'] as $pertanyaan_id => $jawaban_value) {
            $jawaban = new Jawaban();
            $jawaban->tamu_id = $tamu->id;
            $jawaban->pertanyaan_id = $pertanyaan_id;
            $jawaban->daftar_jawaban = $jawaban_value;
            $jawaban->save();
        }

        // Update status tamu setelah mengisi survei
        $tamu->status = 'sudah';
        $tamu->save();

        // Checkout otomatis
        $this->checkout($id);

        return response()->json(['success' => true]);
    }
}
