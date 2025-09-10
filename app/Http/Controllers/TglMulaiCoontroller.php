<?php

namespace App\Http\Controllers;

use App\Models\TglMulai;
use Illuminate\Http\Request;

class TglMulaiCoontroller extends Controller
{
    public function tgl_mulai(Request $request)
    {
        $validateData = $request->validate([
            'tgl_mulai' => 'required',
            'status_mulai' => 'required|boolean',
        ]);
        // dd($validateData);

        TglMulai::create($validateData);
        return back()->with('success', 'Data tanggal berhasil disimpan.');
    }

    public function update_tgl_mulai(Request $request, $id)
    {
        $data = $request->validate([
            'tgl_mulai' => 'required',
            'status_mulai' => 'required|boolean',
        ]);
        // dd($validateData);
        $mulai = TglMulai::findOrFail($id);
        $mulai->tgl_mulai = $data['tgl_mulai'];
        $mulai->status_mulai = $data['status_mulai'];
        $mulai->save();
        return back()->with('success', 'Tanggal mulai berhasil diubah.');
    }
}
