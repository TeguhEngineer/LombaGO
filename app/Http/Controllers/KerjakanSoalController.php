<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Soal;
use App\Models\TglMulai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerjakanSoalController extends Controller
{
    public function index()
    {
        //cek jawaban
        $cekjawaban = Jawaban::with('soal')
            ->where('user_id', Auth::user()->id)
            ->first();
        $jawaban = Jawaban::with('soal')
            ->where('user_id', Auth::user()->id)
            ->get();

        $countdown = TglMulai::latest()->first(); // Ambil data yang belum selesai

        if (!$countdown) {
            return view('soal.index', ['daysLeft' => null, 'isDisabled' => true]); // Jika tidak ada data
        }

        $now = now()->startOfDay(); // Ambil tanggal hari ini
        $tglMulai = $countdown->tgl_mulai;

        $daysLeft = $now->diffInDays($tglMulai, false); // Hitung sisa hari

        // Tombol dinonaktifkan jika:
        // 1. Sekarang < tgl_mulai
        // 2. Status belum `true`
        $isDisabled = $now->lt($tglMulai) || !$countdown->status_mulai;

        return view('soal.index', [
            'daysLeft' => $daysLeft > 0 ? $daysLeft : 0,
            'isDisabled' => $isDisabled,
            'countdown' => $countdown,

            'cekjawaban' => $cekjawaban,
            'jawaban' => $jawaban,
        ]);
    }

    public function mengerjakan(Request $request)
    {
        // Ambil semua soal yang ingin dikerjakan oleh user dan urutkan berdasarkan 'urutan'
        $soals = Soal::orderBy('urutan_soal', 'asc')->get();

        // Iterasi setiap soal dan buat data jawaban kosong sesuai urutan soal
        foreach ($soals as $soal) {
            Jawaban::create([
                'soal_id' => $soal->id,
                'user_id' => $request->user_id,
                'file_jawaban' => null,
                'urutan_jawaban' => $soal->urutan_soal, // Menyimpan urutan soal ke dalam tabel jawaban
                'status_jawaban' => 'belum',
                'status_waktu' => null,
            ]);
        }
        return back()->with('kerjakan', 'Selamat mengerjakan soal... Goodluck :)');
    }

    public function uploadJawaban(Request $request, $jawabanId)
    {
        $request->validate([
            'file_jawaban' => 'required|max:5120', // Validasi file jawaban
        ]);

        // Ambil jawaban dan soal terkait
        $jawaban = Jawaban::findOrFail($jawabanId);
        $soal = $jawaban->soal;

        // Ambil nama pengguna yang sedang login
        $userName = strtolower(str_replace(' ', '_', Auth::user()->name));

        // Ambil judul soal dan ubah spasi menjadi underscore
        $judulSoal = strtolower(str_replace(' ', '_', $soal->judul_soal));

        // Buat nama file baru dengan format "nama_lengkap_judulsoal"
        $fileName = "{$userName}_{$judulSoal}." . $request->file('file_jawaban')->getClientOriginalExtension();

        // Simpan file dengan nama yang sudah diubah
        $path = $request->file('file_jawaban')->storeAs('jawaban', $fileName, 'public');

        // Ambil waktu selesai dari soal (dalam format H:i)
        $waktuSelesai = Carbon::createFromFormat('H:i:s', $soal->waktu_selesai);

        // Ambil waktu upload jawaban (waktu saat ini)
        $waktuJawaban = Carbon::now();

        // Hitung selisih waktu dalam menit dan bulatkan ke menit terdekat
        $selisihWaktu = round($waktuJawaban->diffInMinutes($waktuSelesai, false)); // Bulatkan ke menit terdekat

        // Tentukan status waktu berdasarkan selisih waktu
        if ($selisihWaktu > 0) {
            // Jika terlambat
            $statusWaktu = "$selisihWaktu menit lebih cepat";
        } elseif ($selisihWaktu < 0) {
            // Jika lebih cepat
            $statusWaktu = abs($selisihWaktu) . ' menit terlambat';
        } else {
            // Jika tepat waktu
            $statusWaktu = 'Tepat waktu';
        }

        // Update data jawaban
        $jawaban->file_jawaban = $path;
        $jawaban->status_waktu = $statusWaktu;
        $jawaban->status_jawaban = 'sudah'; // Update status jawaban
        $jawaban->save(); // Simpan perubahan

        // Kembalikan response atau view sesuai kebutuhan
        return back()->with('kerjakan', 'Jawaban berhasil diupload');
    }
}
