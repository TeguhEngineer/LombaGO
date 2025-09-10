<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = Informasi::latest()->paginate(10);
        return view('informasi.index', compact('informasi'));
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
        $validateData = $request->validate([
            'admin_id' => 'required',
            'pesan' => 'required',
        ]);
        Informasi::create($validateData);
        return back()->with('success', 'Informasi berhasil disimpan.');
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
        $validateData = $request->validate([
            'admin_id' => 'required',
            'pesan' => 'required',
        ]);
        Informasi::findOrFail($id)->update($validateData);
        return back()->with('success', 'Informasi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Informasi::findOrFail($id)->delete();
        return back()->with('success', 'Informasi berhasil dihapus.');
    }
}
