<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\TglMulai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreateSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datasoal = Soal::orderBy('urutan_soal', 'ASC')->paginate(10);
        $datatgl = TglMulai::latest()->first();
        return view('createsoal.index', compact('datasoal', 'datatgl'));
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
        $validateData = $request->validate(
            [
                'urutan_soal' => 'required|unique:soals',
                'judul_soal' => 'required',
                'file_soal' => 'required|file|max:3072',
                'keterangan_soal' => 'required',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required',
            ],
            [
                'file_soal.required' => 'File soal masih kosong.',
                'urutan_soal.unique' => 'Urutan soal tidak boleh sama.',
            ],
        );
        // dd($validateData);\
        $file = $request->file('file_soal');
        // Format nama file berdasarkan judul soal
        $judulSoal = str_replace(' ', '_', strtolower($validateData['judul_soal'])); // Ganti spasi dengan underscore
        $extension = $file->getClientOriginalExtension(); // Dapatkan ekstensi file
        $fileName = 'soal_' . $judulSoal . '.' . $extension; // Gabungkan nama file

        // Simpan file ke direktori 'public/soal'
        $path = $file->storeAs('soal', $fileName, 'public');
        $validateData['file_soal'] = $path;
        Soal::create($validateData);
        return back()->with('success', 'Soal berhasil dibuat.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate(
            [
                'urutan_soal' => 'required|unique:soals,urutan_soal,' . $id,
                'judul_soal' => 'required',
                'file_soal' => 'nullable|file|max:3072',
                'keterangan_soal' => 'required',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required',
            ],
            [
                'urutan_soal.unique' => 'Urutan soal tidak boleh sama.',
            ],
        );
        // dd($validateData);
        $soal = Soal::findOrFail($id);
        if ($request->hasFile('file_soal')) {
            if (Storage::disk('public')->exists($soal->file_soal)) {
                Storage::disk('public')->delete($soal->file_soal);
            }
            $path = $request->file('file_soal')->store('soal', 'public');
            $validateData['file_soal'] = $path;
        }
        $soal->update($validateData);
        return back()->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $soal = Soal::findOrFail($id);
        if ($soal->file_soal && Storage::disk('public')->exists($soal->file_soal)) {
            Storage::disk('public')->delete($soal->file_soal);
            $soal->delete();
        }

        return back()->with('success', 'Data soal berhasil dihapus.');
    }
}
