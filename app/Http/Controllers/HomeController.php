<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\SetJuara;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countPeserta = User::where('role', 'user')->count();
        $countMale = User::where('role', 'user')->where('jk', 'Laki-laki')->count();
        $countFemale = User::where('role', 'user')->where('jk', 'Perempuan')->count();
        $informasi = Informasi::latest()->take(3)->get();
        // Juara
        $juara1 = SetJuara::where('urutan_juara', '1')->with('peserta')->first();
        $juara2 = SetJuara::where('urutan_juara', '2')->with('peserta')->first();
        $juara3 = SetJuara::where('urutan_juara', '3')->with('peserta')->first();
        return view('dashboard.index', compact('countPeserta', 'countMale', 'countFemale', 'informasi', 'juara1', 'juara2', 'juara3'));
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function upload_profile(Request $request)
    {
        $request->validate([
            'pas_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $user = Auth::user();
        $path = $request->file('pas_foto')->store('profile', 'public');

        $user->pas_foto = $path;
        $user->save();

        return back()->with('success', 'Foto profile berhasil diperbarui.');
    }

    public function update_profile(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'pas_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah ada file baru yang diupload
        if ($request->hasFile('pas_foto')) {
            // Hapus file lama jika ada
            if ($user->pas_foto && Storage::disk('public')->exists($user->pas_foto)) {
                Storage::disk('public')->delete($user->pas_foto);
            }

            // Simpan file baru ke folder 'profile' di storage
            $path = $request->file('pas_foto')->store('profile', 'public');

            // Update path file pada database
            $user->pas_foto = $path;
            $user->save(); // Simpan perubahan pada user
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function delete_profile()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user memiliki foto profil
        if ($user->pas_foto && Storage::disk('public')->exists($user->pas_foto)) {
            // Hapus file foto profil dari storage
            Storage::disk('public')->delete($user->pas_foto);

            // Set kolom pas_foto ke null
            $user->pas_foto = null;
            $user->save(); // Simpan perubahan pada user
        }

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }

    public function upload_identitas(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'nisn' => 'nullable|max:10|min:10',
                'name' => 'nullable|string',
                'jk' => 'nullable|string',
                'no_tlp' => 'nullable|min:11|max:12',
                'asal_sekolah' => 'nullable|string',
                'email' => 'nullable|email',
                'identitas' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
            ],
            [
                'nisn.min' => 'NISN tidak boleh kurang dari 10 karakter.',
                'nisn.max' => 'NISN tidak boleh lebih dari 10 karakter.',
                'no_tlp.min' => 'Nomor telepon tidak boleh kurang dari 11 karakter.',
                'no_tlp.max' => 'Nomor telepon tidak boleh lebih dari 12 karakter.',
                'email.email' => 'Format email belum lengkap.',
                'identitas.max' => 'Foto tidak boleh lebih dari 3MB.',
                'identitas.mimes' => 'Ekstensi file harus jpg, png, jpeg.',
            ],
        );

        $user = Auth::user();

        if ($request->hasFile('identitas')) {
            $path = $request->file('identitas')->store('identitas', 'public');

            $user->identitas = $path;
        }

        if ($request->filled('nisn')) {
            $user->nisn = $request->nisn;
        }

        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('jk')) {
            $user->jk = $request->jk;
        }

        if ($request->filled('no_tlp')) {
            $user->no_tlp = $request->no_tlp;
        }

        if ($request->filled('asal_sekolah')) {
            $user->asal_sekolah = $request->asal_sekolah;
        }

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        $user->save();

        return back()->with('success', 'Data berhasil diperbarui!');
    }

    public function password_reset(Request $request)
    {
        // Validasi input
        $validateData = $request->validate(
            [
                'old_password' => 'required', // Password lama
                'password' => 'required|min:8|confirmed', // Password baru
            ],
            [
                'old_password.required' => 'Password lama harus diisi.',
                'password.required' => 'Password baru harus diisi.',
                'password.min' => 'Password baru minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            ],
        );

        $user = Auth::user(); // Ambil user yang sedang login

        // Periksa apakah password lama sesuai
        if (!Hash::check($validateData['old_password'], $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
        }

        // Jika password lama sesuai, update dengan password baru
        $user->password = bcrypt($validateData['password']);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
