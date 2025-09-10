<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $gender = $request->input('jk');

        $peserta = User::where('role', 'user')->orderBy('name', 'asc')
            ->when($gender, function ($query) use ($gender) {
                $query->where('jk', $gender);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('asal_sekolah', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10)
            ->appends(['search' => $search, 'gender' => $gender]);

        // $peserta = User::where('role', 'user')->paginate(10);
        return view('peserta.index', compact('peserta'));
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
            'name' => 'required',
            'jk' => 'required',
            'no_tlp' => 'required|regex:/^[0-9]{11,12}$/',
            'asal_sekolah' => 'required',
            'email' => 'required|unique:users',
            'passwords' => 'required|min:8',
        ], [
            'jk.required' => 'Pilih jenis kelamin.',
            'no_tlp.regex' => 'Nomor telepon harus 11-12 digit.',
            'email.unique' => 'Email sudah terdaftar.',
            'passwords.min' => 'Password minimal :min karakter.',
        ]);
        $validateData['passwords'] = bcrypt($validateData['passwords']);
        User::create([
            'name' => $validateData['name'],
            'jk' => $validateData['jk'],
            'no_tlp' => $validateData['no_tlp'],
            'asal_sekolah' => $validateData['asal_sekolah'],
            'email' => $validateData['email'],
            'password' => $validateData['passwords'],
            'role' => 'user'
        ]);
        return back()->with('success', 'Data peserta berhasil ditambahkan.');
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

    public function reset_password(Request $request, string $id)
    {
        $validateData = $request->validate([
            'password' => 'required',
        ]);
        $validateData['password'] = bcrypt($validateData['password']);
        User::findOrFail($id)->update($validateData);
        return back()->with('success', 'Password berhasil di reset');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Data peserta berhasil dihapus.');
    }
}
