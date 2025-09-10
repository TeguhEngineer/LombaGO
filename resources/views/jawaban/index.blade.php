@extends('layouts.app')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Jawaban</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Data Jawaban</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tabel Data Jawaban</h5>
                        <button class="btn btn-warning btn-sm float-right" type="button" data-toggle="modal"
                            data-target="#reset"><i class="feather icon-refresh-cw"></i> Reset Jawaban</button>

                        <div class="row justify-content-end mt-3">
                            {{-- <div class="col-lg-4 col-5 d-flex">
                                <div class="h3 mr-3"><i class="feather icon-filter"></i></div>
                                <div class="form-group">
                                    <select class="custom-select" required>
                                        <option>-- Status Jawaban --</option>
                                        <option value="1">Selesai</option>
                                        <option value="2">Belum Selesai</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-lg-4 col-12">
                                <form action="/jawaban" method="get">
                                    <div class="d-flex">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari peserta..." aria-label="Cari peserta..."
                                                aria-describedby="basic-addon2">
                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn  btn-primary">Cari</button>
                                            <a href="/jawaban" class="btn  btn-secondary" type="button">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Peserta</th>
                                        <th>Asal Sekolah</th>
                                        <th>Jam Selesai</th>
                                        <th>Status Jawaban</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($datajawaban as $item)
                                    @php
                                        $jawaban = $item->jawaban->firstWhere('urutan_jawaban', 3);
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->asal_sekolah }}</td>
                                            <th>
                                                @if ($jawaban && $jawaban->status_jawaban == 'sudah')
                                                    {{ \Carbon\Carbon::parse($jawaban->updated_at)->format('H:i') }}
                                                @else
                                                    -
                                                @endif
                                            </th>
                                            <td>
                                                @if ($jawaban && $jawaban->status_jawaban == 'sudah')
                                                    <span class="badge badge-success">selesai</span>
                                                @elseif ($jawaban && $jawaban->status_jawaban == 'belum')
                                                    <span class="badge badge-warning">pending</span>
                                                @else
                                                    <span class="badge badge-danger">belum</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                                                    data-target="#modalShow{{ $item->id }}"><i
                                                        class="feather icon-eye"></i></button>

                                                @if ($jawaban && $jawaban->status_jawaban == 'sudah')
                                                    <a href="{{ route('download.jawaban', $item->id) }}"
                                                        class="btn btn-danger btn-sm"><i
                                                            class="feather icon-download"></i></a>
                                                @else
                                                    <button class="btn btn-danger btn-sm" disabled><i
                                                            class="feather icon-download"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>

                        {{ $datajawaban->links('paginator.paginator') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->


        {{-- Modal Show Porgress Jawaban --}}
        @foreach ($datajawaban as $show)
            <div id="modalShow{{ $show->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Progress Pengerjaan Soal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            @if ($show->jawaban->firstWhere('status_jawaban', 'sudah'))
                                <table class="d-flex justify-content-center mb-3">
                                    <tr>
                                        <td>
                                            <div class="spinner-grow text-success" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </td>
                                        <td class="my-auto">selesai</td>
                                        <td>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </td>
                                        <td class="my-auto">pending</td>
                                    </tr>
                                </table>
                            @endif
                            <table class="table table-bordered">
                                @forelse ($show->jawaban as $j)
                                    <tr>
                                        <td>{{ $j->soal->judul_soal }}</td>
                                        <td class="text-center">
                                            @if ($j->status_jawaban == 'sudah')
                                                <div class="spinner-grow text-success" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            @elseif ($j->status_jawaban == 'belum')
                                                <div class="spinner-grow text-warning" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($j->file_jawaban != null)
                                                <a href="{{ asset('storage/' . $j->file_jawaban) }}" class="btn btn-danger"
                                                    download=""><i class="feather icon-download"></i></a>
                                            @else
                                                <button disabled class="btn btn-danger"><i
                                                        class="feather icon-download"></i></button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $j->status_waktu }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td class="h3">Belum mengerjakan.</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
                            {{-- <button type="submit" class="btn  btn-warning">Reset</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Modal Reset JAwaban --}}
        <div id="reset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Apakah anda yakin ingin mereset/menghapus semua jawaban?</h1>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{ route('jawaban.reset') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn  btn-warning">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
    @endif
@endpush
