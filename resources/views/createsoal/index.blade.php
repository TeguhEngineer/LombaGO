@extends('layouts.app')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Buat Soal</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Buat Soal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <div class="row">
                            <div class="col-6">
                                <h5>Tabel Data Soal</h5>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#btnSoal"><i
                                        class="feather icon-plus"></i> Buat Soal</button>
                                <button class="btn btn-warning" type="button" data-toggle="modal"
                                    data-target="#btnTanggal"><i class="feather icon-calendar"></i> Set Tanggal
                                    Mulai</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Urutan Soal</th>
                                        <th>Tgl Mulai</th>
                                        <th>Judul Soal</th>
                                        <th>File Soal</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($datasoal as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->urutan_soal }}</td>
                                            <td>{{ $datatgl->tgl_mulai ?? 'Belum ada tanggal.' }}</td>
                                            <td>{{ $item->judul_soal }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $item->file_soal) }}" target="_blank">
                                                    <h4 class="text-danger"><i class="feather icon-file"></i></h4>
                                                </a>
                                            </td>
                                            <td>{{ substr($item->waktu_mulai, 0, 5) }}</td>
                                            <td>{{ substr($item->waktu_selesai, 0, 5) }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                                                    data-target="#btnEdit{{ $item->id }}"><i
                                                        class="feather icon-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                    data-target="#btnHapus{{ $item->id }}"><i
                                                        class="feather icon-trash-2"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        {{ $datasoal->links('paginator.paginator') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->

        {{-- Modal setting tanggal mulai --}}
        <div id="btnTanggal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Setting Tanggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('tgl.updateorcreate', $datatgl->id ?? '') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tgl">Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" value="{{ $datatgl->tgl_mulai ?? '' }}"
                                    class="form-control" id="tgl">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="status_mulai" value="0">
                                    <input type="checkbox" class="custom-control-input" value="1" name="status_mulai"
                                        id="customswitch1"
                                        @if ($datatgl == !null) value="{{ $datatgl->status_mulai ? 0 : 1 }}"
                                        {{ $datatgl->status_mulai ? 'checked' : '' }}
                                        {{-- @elseif ($datatgl == null)
                                        value="1" --}} @endif>
                                    <label class="custom-control-label" for="customswitch1">Mulai</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn  btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal create soal --}}
        <div id="btnSoal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Buat Soal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="/create-soal" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="urutan">Urutan Soal</label>
                                        <input type="number" name="urutan_soal" value="{{ old('urutan_soal') }}"
                                            class="form-control @error('urutan_soal') is-invalid @enderror"
                                            id="urutan">
                                        @error('urutan_soal')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="floating-label" for="judul">Judul Soal</label>
                                        <input type="text" name="judul_soal" class="form-control" value="{{ old('judul_soal') }}" id="judul">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <small for="file">File Soal <span class="text-danger font-italic">(max.
                                        3mb)</span></small>
                                <input type="file" name="file_soal" accept="*" value="{{ old('file_soal') }}" class="form-control @error('file_soal') is-invalid @enderror"
                                    id="file">
                                <div id="errorFile" class="invalid-feedback" style="display: none; font-style: italic;">
                                </div>
                                @error('file_soal')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <small for="keterangan">Keterangan Soal</small>
                                <textarea class="form-control" name="keterangan_soal" id="keterangan" rows="3">{{ old('keterangan_soal') }}</textarea>
                            </div>
                            <div class="form-group">
                                <small for="waktu_mulai">Waktu Mulai</small>
                                <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}" id="waktu_mulai">
                            </div>
                            <div class="form-group">
                                <small for="waktu_selesai">Waktu Selesai</small>
                                <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') }}" id="waktu_selesai">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn  btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Hapus soal --}}
        @foreach ($datasoal as $delete)
            <div id="btnHapus{{ $delete->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="/create-soal/{{ $delete->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body text-center">
                                <h5>Apakah anda yakin ingin menghapus soal ini?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn  btn-primary">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Modal Edit soal --}}
        @foreach ($datasoal as $edit)
            <div id="btnEdit{{ $edit->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Soal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="/create-soal/{{ $edit->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="floating-label" for="urutan">Urutan Soal</label>
                                            <input type="number" name="urutan_soal"
                                                class="form-control @error('urutan_soal') is-invalid @enderror"
                                                value="{{ $edit->urutan_soal }}" id="urutan">
                                            @error('urutan_soal')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="floating-label" for="judul">Judul Soal</label>
                                            <input type="text" name="judul_soal" class="form-control"
                                                value="{{ $edit->judul_soal }}" id="judul">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <a href="{{ asset('storage/' . $edit->file_soal) }}" target="_blank"><i
                                                class="feather icon-file h1"></i> <br> Lihat File</a>
                                    </div>
                                    <div class="col-auto">

                                        <div class="form-group">
                                            <small for="file">Ubah File Soal <span
                                                    class="text-danger font-italic">(max.
                                                    3mb)</span></small>
                                            <input type="file" name="file_soal" accept="*" class="form-control"
                                                id="file">
                                            <div id="errorFile" class="invalid-feedback"
                                                style="display: none; font-style: italic;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <small for="keterangan">Keterangan Soal</small>
                                    <textarea class="form-control" name="keterangan_soal" id="keterangan" rows="3">{{ $edit->keterangan_soal }}</textarea>
                                </div>
                                <div class="form-group">
                                    <small for="waktu_mulai">Waktu Mulai</small>
                                    <input type="time" name="waktu_mulai" class="form-control" id="waktu_mulai"
                                        value="{{ $edit->waktu_mulai }}">
                                </div>
                                <div class="form-group">
                                    <small for="waktu_selesai">Waktu Selesai</small>
                                    <input type="time" name="waktu_selesai" class="form-control" id="waktu_selesai"
                                        value="{{ $edit->waktu_selesai }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn  btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('script')
    {{-- @error('urutan_soal')
        <script>
            $(document).ready(function() {
                $('#btnEdit{{ $edit->id }}').modal('show');
            });
        </script>
    @enderror --}}
    {{-- @error('urutan_soal')
        <script>
            $(document).ready(function() {
                $('#btnSoal').modal('show');
            });
        </script>
    @enderror --}}
    @error('file_soal')
        <script>
            $(document).ready(function() {
                $('#btnSoal').modal('show');
            });
        </script>
    @enderror
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen input file dan elemen untuk menampilkan pesan error
            const filePas = document.querySelector('input[type="file"][name="file_soal"]');
            // const fileLabel = document.querySelector('label[for="validatedCustomFile"]');
            const errorFile = document.getElementById('errorFile');
            // const saveButton = document.getElementById('fileSimpan');

            // Set tombol simpan disabled secara default
            // saveButton.setAttribute('disabled', 'true');

            // Event listener saat file dipilih
            filePas.addEventListener('change', function(event) {
                const file = event.target.files[0];

                // Reset pesan error setiap kali file diubah
                errorFile.style.display = 'none';
                errorFile.textContent = '';
                // saveButton.setAttribute('disabled', 'true');

                // Cek apakah file ada
                if (file) {
                    // Validasi ukuran file (maksimal 3MB = 3072KB)
                    if (file.size > 3072 * 1024) { // 3072 * 1024 = 3MB dalam bytes
                        // Tampilkan pesan error
                        errorFile.style.display = 'block';
                        errorFile.textContent = 'File soal melebihi batas maksimum 3MB.';

                        // Reset input file jika ukuran file melebihi batas
                        filePas.value = '';
                        // fileLabel.textContent = 'Cari file..';

                        // Pastikan tombol simpan tetap disabled
                        // saveButton.setAttribute('disabled', 'true');
                    }
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Konfirmasi",
                    text: "{{ session('success') }}",
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            });
        </script>
    @endif
@endpush
