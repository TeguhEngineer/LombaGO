@extends('layouts.app')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Peserta</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Data Peserta</a></li>
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
                    <div class="card-header">
                        <h5>Tabel Data Peserta</h5>
                        <button class="btn btn-success btn-sm float-right" type="button" data-toggle="modal"
                            data-target="#tambahPeserta"><i class="feather icon-user-plus"></i> Tambah
                            Peserta</button>

                        <div class="row justify-content-between mt-3">
                            <div class="col-lg-4 col-5 d-flex">
                                <div class="h3 mr-3"><i class="feather icon-filter"></i></div>
                                <form method="GET" action="{{ url()->current() }}">

                                    <div class="form-group">
                                        <select name="jk" class="custom-select" id="jk"
                                            onchange="this.form.submit()">
                                            <option value="">Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ request('jk') == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="Perempuan" {{ request('jk') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    {{-- </form> --}}
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="d-flex">
                                    {{-- <form action="/peserta" method="get"> --}}
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari peserta..." aria-label="Cari peserta..."
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn  btn-primary" type="button">Cari</button>
                                            <a href="/peserta" class="btn  btn-secondary" type="button">Reset</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Asal Sekolah</th>
                                        <th>Email</th>
                                        <th>Identitas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($peserta as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->jk }}</td>
                                            <td>{{ $item->asal_sekolah }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->identitas == null)
                                                    <i class="feather icon-x text-danger"></i>
                                                @elseif ($item->identitas != null)
                                                    <i class="feather icon-check text-success"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                                                    data-target="#modalDetail{{ $item->id }}"><i
                                                        class="feather icon-eye"></i></button>

                                                <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                                                    data-target="#modalResetPassword{{ $item->id }}"><i
                                                        class="feather icon-lock"></i></button>

                                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                    data-target="#modalDelete{{ $item->id }}"><i
                                                        class="feather icon-trash-2"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>

                        {{ $peserta->links('paginator.paginator') }}
                    </div>

                    {{-- Modal Tambah Data Peserta --}}
                    <div id="tambahPeserta" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle"><i
                                            class="feather icon-user-plus"></i> Tambah Data Peserta</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="/peserta" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="floating-label" for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" id="nama_lengkap"
                                                value="{{ old('name') }}" required>
                                        </div>
                                        <span for="">Jenis Kelamin</span>
                                        <div class="row mb-2">
                                            <div class="col d-flex">
                                                <div class="contact100-form-checkbox">
                                                    <input class="input-checkbox100" id="ckb1" type="radio"
                                                        name="jk" value="Laki-laki"
                                                        {{ old('jk') == 'Laki-laki' ? 'checked' : '' }}>
                                                    <label class="label-checkbox100" for="ckb1">
                                                        Laki - laki
                                                    </label>
                                                </div>

                                                <div class="contact100-form-checkbox" style="margin-left: 20px;">
                                                    <input class="input-checkbox100" id="ckb2" type="radio"
                                                        name="jk" value="Perempuan"
                                                        {{ old('jk') == 'Perempuan' ? 'checked' : '' }}>
                                                    <label class="label-checkbox100" for="ckb2">
                                                        Perempuan
                                                    </label>
                                                </div>
                                                @error('jk')
                                                    <span class="text-danger ml-5 font-italic">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="floating-label" for="no_tlp">Nomor Telepon</label>
                                            <input type="number" name="no_tlp"
                                                class="form-control @error('no_tlp') is-invalid @enderror"
                                                value="{{ old('no_tlp') }}" required>
                                            @error('no_tlp')
                                                <span class="invalid-feedback font-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label" for="asal_sekolah">Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" class="form-control"
                                                id="asal_sekolah" oninput="convertToUpperCase()"
                                                value="{{ old('asal_sekolah') }}" required>
                                        </div>
                                        <script>
                                            function convertToUpperCase() {
                                                var input = document.getElementById('asal_sekolah');
                                                input.value = input.value.toUpperCase();
                                            }
                                        </script>

                                        <div class="form-group">
                                            <label class="floating-label" for="Email">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="Email"
                                                aria-describedby="emailHelp" value="{{ old('email') }}" required>
                                            @error('email')
                                                <span class="invalid-feedback font-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label" for="password">Password</label>
                                            <input type="password" name="passwords"
                                                class="form-control @error('passwords') is-invalid @enderror"
                                                id="password" required>
                                            @error('passwords')
                                                <span class="invalid-feedback font-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn  btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Show Detail Peserta --}}
                    @foreach ($peserta as $p)
                        <div id="modalDetail{{ $p->id }}" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Peserta</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($p->identitas)
                                            <div class="text-center mb-2">
                                                <img src="{{ asset('storage/' . $p->identitas) }}" width="150"
                                                    alt="">
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="floating-label" for="nisn">NISN</label>
                                            <input type="text" class="form-control" id="nisn"
                                                value="{{ $p->nisn }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label" for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap"
                                                value="{{ $p->name }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label" for="jk">Jenis Kelamin</label>
                                            <input type="text" class="form-control" id="jk"
                                                value="{{ $p->jk }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label" for="no_tlp">Nomor Telepon</label>
                                            <input type="text" name="no_tlp" class="form-control"
                                                value="{{ $p->no_tlp }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label" for="asal_sekolah">Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" class="form-control"
                                                value="{{ $p->asal_sekolah }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label class="floating-label" for="Email">Email</label>
                                            <input type="email" class="form-control" id="teguh@gmail.com"
                                                aria-describedby="emailHelp" value="{{ $p->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn  btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        {{-- <button type="button" class="btn  btn-primary">Simpan</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Modal Reset Password --}}
                    @foreach ($peserta as $e)
                        <div id="modalResetPassword{{ $e->id }}" class="modal fade" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Reset Password</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ route('password.reset', ['id' => $e->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="floating-label" for="password">Password baru</label>
                                                <input type="text" name="password" class="form-control"
                                                    id="password">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn  btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn  btn-warning">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Modal Delete Data Peserta --}}
                    @foreach ($peserta as $s)
                        <div id="modalDelete{{ $s->id }}" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="/peserta/{{ $s->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body text-center">
                                            <h5>Apakah anda yakin ingin menghapus data peserta ini?</h5>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn  btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn  btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection

@push('script')

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

    @error('jk')
        <script>
            $(document).ready(function() {
                $('#tambahPeserta').modal('show');
            });
        </script>
    @enderror
    @error('no_tlp')
        <script>
            $(document).ready(function() {
                $('#tambahPeserta').modal('show');
            });
        </script>
    @enderror
    @error('email')
        <script>
            $(document).ready(function() {
                $('#tambahPeserta').modal('show');
            });
        </script>
    @enderror
    @error('passwords')
        <script>
            $(document).ready(function() {
                $('#tambahPeserta').modal('show');
            });
        </script>
    @enderror
@endpush
