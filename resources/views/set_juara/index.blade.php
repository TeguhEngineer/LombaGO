@extends('layouts.app')

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Setting Juara</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Setting Juara</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <div class="row">
                            <div class="col-6">
                                <h5>Tabel Data Juara</h5>
                            </div>
                            <div class="col-6 text-right">
                                {{-- <button class="btn btn-info" type="button" data-toggle="modal" data-target="#btnSoal"><i
                                        class="feather icon-plus"></i> Set Juara</button> --}}
                                {{-- <button class="btn btn-warning" type="button" data-toggle="modal"
                                    data-target="#btnTanggal"><i class="feather icon-calendar"></i> Set Tanggal
                                    Mulai</button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Juara</th>
                                        <th>Nama Peserta</th>
                                        <th>Sekolah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @forelse ($juara as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->urutan_juara }}</td>
                                            <td>{{ $item->peserta->name }}</td>
                                            <td>{{ $item->peserta->asal_sekolah }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                    data-target="#modalDelete{{ $item->id }}"><i
                                                        class="feather icon-trash-2"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="4">Belum ada juara.</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h5><i class="feather icon-bar-chart-2"></i> Set Juara</h5>
                    </div>
                    <form action="/set_juara" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-4">
                                <select id="mySelect" name="urutan_juara" class="form-control" style="width: 100%;"
                                    required @if ($juara->count() >= 3) @disabled(true) @endif>
                                    <option value="">Pilih Juara</option>
                                    <option value="1" {{ old('urutan_juara') == 1 ? 'selected' : '' }}>Juara 1</option>
                                    <option value="2" {{ old('urutan_juara') == 2 ? 'selected' : '' }}>Juara 2</option>
                                    <option value="3" {{ old('urutan_juara') == 3 ? 'selected' : '' }}>Juara 3</option>
                                </select>
                                @error('urutan_juara')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                            <select id="mySelect" name="user_id" class="form-control" style="width: 100%;" required
                                @if ($juara->count() >= 3) @disabled(true) @endif>
                                <option>Pilih nama peserta</option>
                                @foreach ($peserta as $pesertas)
                                    <option value="{{ $pesertas->id }}" {{ old('user_id') == $pesertas->id ? 'selected' : '' }}>{{ $pesertas->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="text-danger font-italic">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"
                                @if ($juara->count() >= 3) @disabled(true) @endif>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->


        {{-- Modal Hapus Juara --}}
        @foreach ($juara as $delete)
            <div id="modalDelete{{ $delete->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="/set_juara/{{ $delete->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body text-center">
                                <h5>Apakah anda yakin ingin menghapus data juara {{ $delete->urutan_juara }} ini?</h5>
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
@endpush
