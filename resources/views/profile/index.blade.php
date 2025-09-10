@extends('layouts.app')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div style="position: relative;">
                            @if (is_null(Auth::user()->pas_foto))
                                @if (Auth::user()->jk == 'Laki-laki')
                                    <img src="/assets/images/user/laki-laki.png" width="100" class="img-radius"
                                        alt="">
                                @else
                                    <img src="/assets/images/user/perempuan.png" width="100" class="img-radius"
                                        alt="">
                                @endif
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->pas_foto) }}" width="100"
                                    class="img-radius" alt="">
                            @endif

                            @if (!is_null(Auth::user()->pas_foto))
                                <a href="" class="text-danger" style="position:absolute; top: 0; font-size: 12px;"
                                    data-toggle="modal" data-target="#deleteProfil"><i class="feather icon-trash-2"></i></a>
                            @endif

                            <a href="" class="text-warning" style="position:absolute; bottom: 0; font-size: 9px;"
                                data-toggle="modal" data-target="#editProfil"><i class="feather icon-edit"></i> ubah
                                foto</a>
                        </div>
                        <h5 class="mt-3">
                            @if (Auth::user()->role == 'user')
                                Peserta
                            @elseif (Auth::user()->role == 'superadmin')
                                Super Admin
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-9 col-sm-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h5>Biodata</h5>
                    </div> --}}
                    <form id="formUpload" action="{{ route('upload.identitas') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            {{-- Tampilan default --}}
                            <div id="default" style="display: block;">
                                @can('user')
                                    <div class="form-group">
                                        <label class="floating-label" for="nisn">NISN</label>
                                        <input type="text" class="form-control" id="nisn"
                                            value="{{ Auth::user()->nisn ?? 'NISN perlu dilengkapi.' }}" readonly>
                                    </div>
                                @endcan
                                <div class="form-group">
                                    <label class="floating-label" for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap"
                                        value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="jk">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jk" value="{{ Auth::user()->jk }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="no_tlp">Nomor Telepon</label>
                                    <input type="text" name="no_tlp" class="form-control"
                                        value="{{ Auth::user()->no_tlp }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="asal_sekolah">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" class="form-control"
                                        value="{{ Auth::user()->asal_sekolah }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="floating-label" for="Email">Email</label>
                                    <input type="email" class="form-control" id="teguh@gmail.com"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>

                            {{-- tampilan jika edit --}}
                            <div id="edit" style="display: none;">
                                @can('user')
                                    <div class="form-group">
                                        <label class="floating-label" for="nisn">NISN</label>
                                        <input type="text" name="nisn" class="form-control" id="nisn"
                                            value="{{ Auth::user()->nisn }}">
                                        @error('nisn')
                                            <small style="color: red"><i>{{ $message }}</i></small>
                                        @enderror
                                    </div>
                                @endcan

                                <div class="form-group">
                                    <label class="floating-label" for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" id="nama_lengkap"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="jk">Jenis Kelamin</label>
                                    <select name="jk" id="jk" class="form-control">
                                        <option value="{{ Auth::user()->jk }}">{{ Auth::user()->jk }}</option>
                                        @if (Auth::user()->jk == 'Laki-laki')
                                            <option value="Perempuan">Prempuan</option>
                                        @else
                                            <option value="Laki-laki">Laki -laki</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="no_tlp">Nomor Telepon</label>
                                    <input type="text" name="no_tlp" class="form-control"
                                        value="{{ Auth::user()->no_tlp }}">
                                    @error('no_tlp')
                                        <small style="color: red"><i>{{ $message }}</i></small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="asal_sekolah">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" class="form-control"
                                        value="{{ Auth::user()->asal_sekolah }}">
                                </div>

                                <div class="form-group">
                                    <label class="floating-label" for="Email">Email</label>
                                    <input type="email" name="email" class="form-control" id="Email"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <small style="color: red"><i>{{ $message }}</i></small>
                                    @enderror
                                </div>

                                @can('user')
                                    @if (is_null(Auth::user()->identitas))
                                        <div class="form-group">
                                            <small class="label-input100" for="Identitas" style="color: #A50000;">Kartu
                                                Identitas <span class="text-danger">(*pastikan kartu identitas benar.)</small>
                                            <input type="file" name="identitas" class="form-control" id="Identitas"
                                                accept="image/*">
                                        </div>
                                        @error('identitas')
                                            <small style="color: red"><i>{{ $message }}</i></small>
                                        @enderror
                                    @endif
                                @endcan

                            </div>

                            @can('user')
                                @if (is_null(Auth::user()->identitas))
                                    <div class="mt-2">
                                        <button id="noIdentitas" type="button" class="btn btn-danger font-bold"
                                            style="width: 100%; display: block;" disabled><i class="feather icon-x"></i>
                                            <b>Belum ada kartu identitas</b></button>
                                    </div>
                                @endif

                                @if (!is_null(Auth::user()->identitas))
                                    <div class="mt-2 border">
                                        <button type="button" class="btn btn-success font-bold" style="width: 100%;"
                                            data-toggle="modal" data-target="#showIdentitas"><i class="feather icon-eye"></i>
                                            <b>Lihat Kartu Identitas</b></button>
                                    </div>
                                @endif
                            @endcan
                        </div>
                    </form>
                    <div class="card-footer d-flex">
                        @can('user')
                            @if (is_null(Auth::user()->nisn) || is_null(Auth::user()->identitas))
                                <button class="btn btn-info ml-auto" id="editButton"><i class="feather icon-user"></i>
                                    Lengkapi
                                    Identitas</button>
                            @endif
                            @if (!is_null(Auth::user()->nisn) && !is_null(Auth::user()->identitas))
                                <button class="btn btn-warning ml-auto" id="editButton" style="display: block"><i
                                        class="feather icon-edit"></i>
                                    Edit</button>
                            @endif
                        @endcan

                        @can('superadmin')
                            @if (is_null(Auth::user()->nisn) && is_null(Auth::user()->identitas))
                                <button class="btn btn-warning ml-auto" id="editButton" style="display: block"><i
                                        class="feather icon-edit"></i>
                                    Edit</button>
                            @endif
                        @endcan
                        <button id="btnBatal" class="btn btn-secondary ml-auto" style="display: none">
                            Batal</button>
                        <button type="submit" id="btnSimpan" class="btn btn-primary ml-1" style="display: none"><i
                                class="feather icon-save"></i> Simpan</button>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const submitButton = document.getElementById('btnSimpan');
                                const form = document.getElementById('formUpload');

                                submitButton.addEventListener('click', function() {
                                    form.submit();
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit profil --}}
    <div id="editProfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Foto Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                @if (is_null(Auth::user()->pas_foto))
                    <form action="{{ route('upload.profile') }}" method="POST" enctype="multipart/form-data">
                    @elseif (!is_null(Auth::user()->pas_foto))
                        <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="modal-body">
                    <div class="custom-file">
                        <input type="file" name="pas_foto" class="custom-file-input" id="validatedCustomFile"
                            accept="image/*">
                        <label class="custom-file-label" for="validatedCustomFile">Cari file..</label>
                        <div id="errorFile" class="invalid-feedback" style="display: none;"><i>File tidak boleh lebih
                                dari 3MB.</i></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="fileSimpan" class="btn  btn-primary" disabled>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal delete profil --}}
    <div id="deleteProfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('delete.profile') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <h5>Apakah kamu ingin menghapus foto profil?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn  btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal show identitas --}}
    <div id="showIdentitas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Kartu Identitas </span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @if (Auth::user()->identitas)
                        <img src="{{ asset('storage/' . Auth::user()->identitas) }}"
                            class="img-fluid d-block w-100 border mx-auto" alt="Foto Identitas">
                    @endif
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
                    {{-- <button type="button" class="btn  btn-primary">Ubah</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen input file dan elemen untuk menampilkan pesan error
            const filePas = document.querySelector('input[type="file"][name="pas_foto"]');
            const fileLabel = document.querySelector('label[for="validatedCustomFile"]');
            const errorFile = document.getElementById('errorFile');
            const saveButton = document.getElementById('fileSimpan');

            // Set tombol simpan disabled secara default
            saveButton.setAttribute('disabled', 'true');

            // Event listener saat file dipilih
            filePas.addEventListener('change', function(event) {
                const file = event.target.files[0];

                // Reset pesan error setiap kali file diubah
                errorFile.style.display = 'none';
                errorFile.textContent = '';
                saveButton.setAttribute('disabled', 'true');

                // Cek apakah file ada
                if (file) {
                    // Validasi ukuran file (maksimal 3MB = 3072KB)
                    if (file.size > 3072 * 1024) { // 3072 * 1024 = 3MB dalam bytes
                        // Tampilkan pesan error
                        errorFile.style.display = 'block';
                        errorFile.textContent = 'File foto profil melebihi batas maksimum 3MB.';

                        // Reset input file jika ukuran file melebihi batas
                        fileInput.value = '';
                        fileLabel.textContent = 'Cari file..';

                        // Pastikan tombol simpan tetap disabled
                        saveButton.setAttribute('disabled', 'true');
                    } else {
                        // Update teks label dengan nama file
                        fileLabel.textContent = file.name;

                        // Aktifkan tombol simpan karena file valid
                        saveButton.removeAttribute('disabled');
                    }
                } else {
                    // Reset teks label jika file dihapus
                    fileLabel.textContent = 'Cari file..';

                    // Pastikan tombol simpan tetap disabled
                    saveButton.setAttribute('disabled', 'true');
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen input file
            const fileIdentitas = document.querySelector('input[type="file"][name="identitas"]');

            // Event listener saat file dipilih
            fileIdentitas.addEventListener('change', function(event) {
                const file = event.target.files[0];

                // Cek apakah file ada
                if (file) {
                    // Validasi ukuran file (maksimal 3MB = 3072KB)
                    if (file.size > 3072 * 1024) { // 3072 * 1024 = 3MB dalam bytes
                        Swal.fire({
                            icon: "error",
                            title: "Error...",
                            text: "File identitas melebihi batas maksimum 3MB.",
                        });

                        // Reset input file jika ukuran file melebihi batas
                        fileIdentitas.value = '';
                    }
                }
            });

        });
    </script>

    <script>
        document.getElementById('editButton').addEventListener('click', function() {
            // Ambil elemen default dan edit
            const defaultDiv = document.getElementById('default');
            const editDiv = document.getElementById('edit');
            const btnBatal = document.getElementById('btnBatal');
            const btnSimpan = document.getElementById('btnSimpan');
            const btnEdit = document.getElementById('editButton');

            // Toggle tampilkan/hide
            if (defaultDiv.style.display === 'block') {
                defaultDiv.style.display = 'none';
                editDiv.style.display = 'block';

                btnBatal.style.display = 'block';
                btnSimpan.style.display = 'block';
                btnEdit.style.display = 'none';


            } else {
                defaultDiv.style.display = 'block';
                editDiv.style.display = 'none';

                btnBatal.style.display = 'none';
                btnSimpan.style.display = 'none';
                btnEdit.style.display = 'block';


            }

            // Ambil tombol upload
            const noIdentitas = document.getElementById('noIdentitas');

            noIdentitas.style.display = 'none'
        });

        document.getElementById('btnBatal').addEventListener('click', function() {
            const btnBatal = document.getElementById('btnBatal');
            const btnSimpan = document.getElementById('btnSimpan');
            const btnEdit = document.getElementById('editButton');
            const defaultDiv = document.getElementById('default');
            const editDiv = document.getElementById('edit');
            const noIdentitas = document.getElementById('noIdentitas');

            defaultDiv.style.display = 'block';
            editDiv.style.display = 'none';
            btnEdit.style.display = 'block';
            btnBatal.style.display = 'none';
            btnSimpan.style.display = 'none';
            noIdentitas.style.display = 'block'
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
