@extends('layouts.app')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Soal</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Soal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-12">
                @if ($cekjawaban == null)
                    <div class="card">
                        <div class="card-body text-center">
                            <form action="/kerjakan" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" class="btn btn-primary" {{ $isDisabled ? 'disabled' : '' }}>
                                    @if ($daysLeft > 0)
                                        {{ $daysLeft }} hari lagi...
                                    @elseif ($daysLeft <= 0 && !$countdown->status_mulai)
                                        Akan segera dimulai!
                                    @else
                                        Ayo Mulai!
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Juknis Lomba --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h4>JUKNIS</h4>
                                <H4>“COMPUTER OFFICE APPLICATION SKILL COMPETITION (COASC)”</H4>
                                <h4>POLITEKNIK LP3I KAMPUS TASIKMALAYA</h4>
                            </div>
                            <br>
                            <h5>TUJUAN KOMPETISI</h5>
                            <p>Kompetisi ini bertujuan untuk menguji keterampilan peserta dalam menggunakan aplikasi
                                Microsoft Office, meliputi Word, Excel, dan PowerPoint, dengan penilaian berdasarkan
                                kecepatan, ketepatan, dan kreativitas.</p>
                            <br>
                            <h5><b>SYARAT DAN KETENTUAN</b></h5>
                            <ol>
                                <li>Siswa aktif SMA, SMK, dan MA Sederajat se Priangan Timur (Kota Tasikmalaya,
                                    Kab. Tasikmalaya, Kab. Ciamis, Kota Banjar).</li>
                                <li>Peserta wajib menyerahkan fotocopy Kartu Tanda Siswa (KTS) sebagai bukti
                                    keabsahan.
                                </li>
                                <li>
                                    Peserta wajib follow Instagram @lp3i.tasik dan Tiktok @lp3i.tasik
                                </li>
                                <li>
                                    Peserta membayar uang pendaftaran sebesar Rp 75.000,-
                                </li>
                                <li>
                                    Pendaftaran dibuka pada tanggal 20 November – 07 Desember 2024.
                                </li>
                                <li>
                                    Sekolah diperbolehkan untuk mengirimkan Peserta lebih dari 1 orang.
                                </li>
                            </ol>
                            <br>
                            <h5><b>PETUNJUK PELAKSANAAN</b></h5>
                            <ol>
                                <li>Waktu dan tempat pelaksanaan :
                                    <ul>
                                        <li>Hari/Tanggal : Rabu, 18 Desember 2024</li>
                                        <li>Waktu : 08.30 – 12.00 WIB</li>
                                        <li>Tempat : Lab. Komputer 3</li>
                                    </ul>
                                </li>
                                <li>Peserta melakukan pendaftaran dan pengisian data pada google form yang sudah
                                    di share oleh panitia pendaftaran.
                                </li>
                                <li>
                                    Peserta log in ke <b>Aplikasi Lomba Office Application Skill Competition</b>
                                    menggunakan user dan password yang sudah diberikan oleh panitia.
                                </li>
                                <li>Peserta datang ke tempat lomba (Politeknik LP3I Kampus Tasikmalaya) dan
                                    memasuki Ruang Lomba (Lab. Komputer 3) di lantai 3.</li>
                                <li>Peserta mendownload soal-soal lomba di aplikasi.</li>
                                <li>
                                    Peserta mengerjakan soal-soal lomba secara berurutan, mulai dari Ms. Word,
                                    Excel, dan Power Point.
                                </li>
                                <li>
                                    Setiap peserta yang sudah menyelesaikan soal lomba per-materi harus mengupload hasil
                                    jawaban untuk membuka akses soal ke materi berikutnya.

                                </li>
                            </ol>
                            <br>
                            <h5><b>PETUNJUK TEKNIS</b></h5>
                            <ul>
                                <li><b>Microsoft Office</b>
                                    <ol>
                                        <li>Peserta wajib mematuhi peraturan umum.
                                        </li>
                                        <li>Software yang digunakan adalah <b>Microsoft Word 2021.</b></li>
                                        <li>Waktu pengerjaan 60 menit.</li>
                                        <li>Membuat surat.</li>
                                        <li>Kerapihan dan kesesuaian.</li>
                                        <li>Tempat save file : <b>D:\ COASC\LombaWord</b> dan upload hasil pengerjaan
                                            pada aplikasi.</li>
                                        <li>Format penyimpanan file : <b>Word_Nama_Asal Sekolah</b></li>
                                        <li><b>Kriteria materi :</b>
                                            <ul>
                                                <li>Format Dokumen</li>
                                                <li>Pengolahan Teks
                                                </li>
                                                <li>Pengelolaan Table</li>
                                                <li>Header dan Footer</li>
                                            </ul>
                                        </li>
                                        <li><b>Kriteria penilaian :</b>
                                            <ul>
                                                <li>Kesesuaian isi dari setiap bagian pada soal (40%)
                                                </li>
                                                <li>Kerapihan tampilan pengerjaan sesuai dengan soal yang disajikan (40%)
                                                </li>
                                                <li>Kecepatan dalam waktu pengerjaan soal (20%)</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </li>
                                <br>
                                <li><b>Microsoft Exce</b>
                                    <ol>
                                        <li>Peserta wajib mematuhi peraturan umum.
                                        </li>
                                        <li>Software yang digunakan adalah <b>Microsoft Excel 2021.</b></li>
                                        <li>Waktu pengerjaan 75 menit.</li>
                                        <li>Peserta mengetik ulang tabel dan melengkapi bagian yang kosong dengan
                                            rumus/fungsi yang sesuai dengan perintah pada soal.</li>
                                        <li>Kerapihan dan kesesuaian.</li>
                                        <li>Tempat save file : <b>D:\ COASC\LombaExcel</b> dan upload hasil pengerjaan
                                            pada aplikasi.</li>
                                        <li>Format penyimpanan file : <b>Excel_Nama_Asal Sekolah</b></li>
                                        <li><b>Kriteria materi : </b>
                                            <ul>
                                                <li>Format Table</li>
                                                <li>Fungsi Rumus IF</li>
                                                <li>Fungsi Rumus Statisti</li>
                                            </ul>
                                        </li>
                                        <li><b>Kriteria penilaian :</b>
                                            <ul>
                                                <li>Ketepatan fungsi/rumus yang digunakan (45%)
                                                </li>
                                                <li>Kerapihan dalam memformat tabel (35%)</li>
                                                <li>Kecepatan dalam waktu pengerjaan soal (20%)
                                                </li>
                                            </ul>
                                        </li>
                                    </ol>
                                </li>
                                <br>
                                <li><b>Microsoft Power Point</b>
                                    <ol>
                                        <li>Peserta wajib mematuhi peraturan umum.
                                        </li>
                                        <li>Software yang digunakan adalah <b>Microsoft Power Point 2021.</b></li>
                                        <li>Waktu pengerjaan 50 menit.</li>
                                        <li>Membuat presentasi tentang Politeknik LP3I Kampus Tasikmalaya.</li>
                                        <li>Kerapihan dan kesesuaian.</li>
                                        <li>Tempat save file : <b>D:\ COASC\LombaPowerPoint</b> dan upload hasil
                                            pengerjaan pada aplikasi.</li>
                                        <li>Format penyimpanan file : <b>Microsoft PowerPoint _Nama_Asal Sekolah</b></li>
                                        <li><b>Kriteria materi :</b>
                                            <ul>
                                                <li>Content (minimal 7 slide) :</li>
                                                <li>- Cover</li>
                                                <li>- Menu</li>
                                                <li>- Sejarah Singkat Politeknik LP3I Kampus Tasikmalaya</li>
                                                <li>- Fasilitas Kampus</li>
                                                <li>- Prodi dan Prospek Karir</li>
                                                <li>- Penutup</li>

                                                <li>Animation</li>
                                                <li>Transition</li>
                                                <li>Hyperlink</li>
                                            </ul>
                                        </li>
                                        <li><b>Kriteria penilaian :</b>
                                            <ul>
                                                <li>Tampilan presentasi yang menarik (30%)
                                                </li>
                                                <li>Kesesuaian pengerjaan pada presentasi yang disajikan (40%)</li>
                                                <li>Effect/Animasi pada presentasi (10%)</li>
                                                <li>Kecepatan dalam waktu pengerjaan soal (20%)</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </li>
                            </ul>

                        </div>
                    </div>
                @elseif ($cekjawaban == !null)
                    @foreach ($jawaban as $item)
                        @php
                            $jamMulai = \Carbon\Carbon::parse($item->soal->waktu_mulai)->format('H:i');
                            $jamSelesai = \Carbon\Carbon::parse($item->soal->waktu_selesai)->format('H:i');
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 d-flex mb-3">
                                        <p class="my-auto"><b>{{ $loop->iteration }}.</b> {{ $item->soal->judul_soal }}
                                            <button type="button" class="btn" data-toggle="popover"
                                                data-placement="bottom" title="Keterangan Soal"
                                                data-content="{{ $item->soal->keterangan_soal }}"><i
                                                    class="feather icon-info text-info"></i></button>
                                        </p>
                                        <small class="my-auto ml-auto text-danger"
                                            id="countdown-{{ $item->id }}"></small>
                                    </div>
                                    <div class="col-auto mr-auto">
                                        <small
                                            class="text-danger">({{ \Carbon\Carbon::parse($item->soal->waktu_mulai)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->soal->waktu_selesai)->format('H:i') }})</small>
                                    </div>
                                    <div class="col-auto ml-auto">
                                        <a href="{{ asset('storage/' . $item->soal->file_soal) }}" download=""> <button
                                                class="btn btn-outline-primary rounded-pill btn-sm"
                                                id="btnDownloadSoal{{ $item->id }}" disabled><i
                                                    class="feather icon-download"></i> Download Soal</button> </a>

                                        <button id="upload-{{ $item->id }}" type="button" data-toggle="modal"
                                            data-target="#uploadJawaban{{ $item->id }}"
                                            class="btn btn-outline-warning rounded-pill btn-sm" disabled
                                            @if ($item->status_jawaban == 'sudah') style="display: none;" @endif>
                                            <i class="feather icon-upload"></i> Upload Jawaban
                                        </button>

                                        @if ($item->status_jawaban == 'sudah')
                                            <a href="{{ asset('storage/' . $item->file_jawaban) }}"
                                                class="btn btn-outline-info btn-sm rounded-pill" target="_blank"><i
                                                    class="feather icon-eye"></i> Lihat Jawaban</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- [ Main Content ] end -->

        {{-- Modal Upload JAwaban --}}
        @foreach ($jawaban as $jwb)
            <div id="uploadJawaban{{ $jwb->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalPopoversLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalPopoversLabel">Upload Jawaban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        @if ($jwb->status_jawaban == 'sudah')
                            <div class="modal-body text-center">
                                <h4>Jawaban soal {{ $jwb->soal->judul_soal }} sudah kamu upload. <br> Goodluck :)</h4>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        @else
                            <form action="{{ route('upload.jawaban', ['jawabanId' => $jwb->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="custom-file">
                                        <input type="file" name="file_jawaban" class="custom-file-input"
                                            id="validatedCustomFile" accept="*">
                                        <label class="custom-file-label" for="validatedCustomFile">Cari file..</label>
                                        <div id="errorFile" class="invalid-feedback"
                                            style="display: none; font-style: italic;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn  btn-primary">Simpan</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('script')
    {{-- Validasi inputan file jawaban --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Selektor untuk menangani semua input file
            const fileInputs = document.querySelectorAll('input[type="file"][name="file_jawaban"]');

            // Loop untuk setiap input file
            fileInputs.forEach(fileInput => {
                const fileLabel = fileInput.nextElementSibling; // Label setelah input file
                const errorFile = fileInput.closest('.custom-file').querySelector(
                    '#errorFile'); // Feedback error

                // Event listener saat file dipilih
                fileInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];

                    // Reset pesan error setiap kali file diubah
                    errorFile.style.display = 'none';
                    errorFile.textContent = '';

                    // Cek apakah file ada
                    if (file) {
                        if (file.size > 5120 * 1024) {
                            // Tampilkan pesan error jika ukuran file lebih dari 5MB
                            errorFile.style.display = 'block';
                            errorFile.textContent =
                                'File jawaban kamu melebihi batas maksimum 5MB.';

                            // Reset input file jika ukuran file melebihi batas
                            fileInput.value = '';
                            fileLabel.textContent = 'Cari file..';
                        } else {
                            // Ganti label dengan nama file yang dipilih
                            fileLabel.textContent = file.name;
                        }
                    } else {
                        fileLabel.textContent = 'Cari file..';
                    }
                });
            });
        });
    </script>

    {{-- Notif Selamat mengerjakan --}}
    @if (session('kerjakan'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "{{ session('kerjakan') }}",
                    showConfirmButton: false,
                    timer: 3000
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            });
        </script>
    @endif

    {{-- Countdwon --}}
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($jawaban as $item)
                (function() {
                    let jamMulai = "{{ $item->soal->waktu_mulai }}";
                    let jamSelesai = "{{ $item->soal->waktu_selesai }}";

                    let sekarang = new Date();
                    let jamMulaiDate = new Date();
                    let jamSelesaiDate = new Date();

                    let mulaiParts = jamMulai.split(':');
                    let selesaiParts = jamSelesai.split(':');

                    jamMulaiDate.setHours(mulaiParts[0], mulaiParts[1], 0);
                    jamSelesaiDate.setHours(selesaiParts[0], selesaiParts[1], 0);

                    function updateCountdown{{ $item->id }}() {
                        let now = new Date();

                        if (now < jamMulaiDate) {
                            document.getElementById("countdown-{{ $item->id }}").innerText =
                                "Belum waktunya mulai.";
                            document.getElementById("upload-{{ $item->id }}").disabled = true;
                            document.getElementById("btnDownloadSoal{{ $item->id }}").disabled = true;
                        } else if (now >= jamMulaiDate && now <= jamSelesaiDate) {
                            let diff = jamSelesaiDate - now;

                            let hours = Math.floor((diff % 86400000) / 3600000);
                            let minutes = Math.floor((diff % 3600000) / 60000);
                            let seconds = Math.floor((diff % 60000) / 1000);

                            document.getElementById("countdown-{{ $item->id }}").innerText =
                                `Sisa waktu: ${hours} jam ${minutes} menit ${seconds} detik`;

                            document.getElementById("upload-{{ $item->id }}").disabled = false;
                            document.getElementById("btnDownloadSoal{{ $item->id }}").disabled = false;
                        } else if (now >= jamSelesaiDate) {
                            document.getElementById("countdown-{{ $item->id }}").innerText =
                                "Waktu habis!";
                            document.getElementById("upload-{{ $item->id }}").disabled = false;
                            document.getElementById("btnDownloadSoal{{ $item->id }}").disabled = false;
                        }
                    }

                    setInterval(updateCountdown{{ $item->id }}, 1000);
                })();
            @endforeach
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($jawaban as $item)
                (function() {
                    // Ambil ID dan status jawaban
                    let currentId = "{{ $item->id }}";
                    let previousStatus =
                        "{{ $loop->iteration > 1 ? $jawaban[$loop->iteration - 2]->status_jawaban : 'sudah' }}"; // Ambil status soal sebelumnya (default 'sudah' untuk soal pertama)

                    // Update tombol download dan upload
                    function updateButtonStatus() {
                        if (previousStatus === "sudah") {
                            document.getElementById("upload-{{ $item->id }}").disabled = false;
                            document.getElementById("btnDownloadSoal{{ $item->id }}").disabled = false;
                        }
                    }

                    // Countdown hanya sebagai informasi
                    let jamMulai = "{{ $item->soal->waktu_mulai }}";
                    let jamSelesai = "{{ $item->soal->waktu_selesai }}";
                    let countdownElement = document.getElementById("countdown-" + currentId);

                    let jamMulaiDate = new Date();
                    let jamSelesaiDate = new Date();
                    let mulaiParts = jamMulai.split(':');
                    let selesaiParts = jamSelesai.split(':');

                    jamMulaiDate.setHours(mulaiParts[0], mulaiParts[1], 0);
                    jamSelesaiDate.setHours(selesaiParts[0], selesaiParts[1], 0);

                    function updateCountdown() {
                        let now = new Date();

                        if (now < jamMulaiDate) {
                            countdownElement.innerText = "Belum waktunya mulai.";
                        } else if (now >= jamMulaiDate && now <= jamSelesaiDate) {
                            let diff = jamSelesaiDate - now;
                            let hours = Math.floor((diff % 86400000) / 3600000);
                            let minutes = Math.floor((diff % 3600000) / 60000);
                            let seconds = Math.floor((diff % 60000) / 1000);
                            countdownElement.innerText =
                                `Sisa waktu: ${hours} jam ${minutes} menit ${seconds} detik`;
                        } else {
                            countdownElement.innerText = "Waktu habis!";
                        }
                    }

                    setInterval(updateCountdown, 1000);
                    updateCountdown();
                    updateButtonStatus();
                })();
            @endforeach
        });
    </script>






@endpush
