<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class JawabanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $datajawaban = User::with('jawaban')
            ->where('role', 'user')
            ->orderBy('name', 'asc')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('asal_sekolah', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10)
            ->appends(['search' => $search]);
        return view('jawaban.index', compact('datajawaban'));
    }

    public function download_jawaban_zip($userId)
    {
        // Ambil data user
        $user = User::with('jawaban')->findOrFail($userId);

        // Nama file ZIP
        $zipFileName = "Jawaban-{$user->name}.zip";

        // Lokasi sementara untuk menyimpan ZIP
        $tempZipPath = storage_path("app/temp/{$zipFileName}");

        // Buat ZIP
        $zip = new ZipArchive();
        if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($user->jawaban as $jawaban) {
                $filePath = storage_path("app/public/{$jawaban->file_jawaban}");

                // Periksa apakah file ada
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($jawaban->file_jawaban));
                } else {
                    return back()->with('error', 'File tidak ditemukan.');
                }
            }
            $zip->close();
        } else {
            return back()->with('error', 'Gagal mendownload file.');
        }

        // Unduh file ZIP dan hapus setelah selesai
        return response()->download($tempZipPath)->deleteFileAfterSend(true);
    }

    public function resetJawaban()
    {
        try {
            // Ambil semua data jawaban
            $jawaban = Jawaban::all();

            // Loop untuk menghapus file dari storage
            foreach ($jawaban as $item) {
                if ($item->file_jawaban && Storage::disk('public')->exists($item->file_jawaban)) {
                    Storage::disk('public')->delete($item->file_jawaban);
                }
            }

            // Hapus semua data dari tabel jawaban
            Jawaban::truncate();

            return back()->with('success', 'Semua data jawaban dan file berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
