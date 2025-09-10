<?php

namespace App\Http\Controllers;

use App\Models\SetJuara;
use App\Models\User;
use Illuminate\Http\Request;

class SetJuaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peserta = User::where('role', 'user')->orderBy('name', 'asc')->get();
        $juara = SetJuara::with('peserta')->orderBy('urutan_juara', 'asc')->get();
        return view('set_juara.index', compact('peserta', 'juara'));
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
           'urutan_juara' => 'required|unique:set_juaras',
           'user_id' => 'required|unique:set_juaras',
        ], [
            'urutan_juara.unique' => 'Urutan juara tidak boleh sama.',
            'user_id.unique' => 'Peserta ini sudah ada dalam list juara.'
        ]);
        SetJuara::create($validateData);
        return back()->with('success', 'Data juara berhasil disimpan.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SetJuara::findOrFail($id)->delete();
        return back()->with('success', 'Data juara berhasil dihapus.');
    }
}
