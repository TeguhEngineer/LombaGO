@extends('layouts.app')

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Informasi</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Informasi</a></li>
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
                                <h5>Tabel Data Informasi</h5>
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
                                        <th>Tanggal</th>
                                        <th>Informasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($informasi as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                            <td>{{ $item->pesan }}</td>
                                            <td>


                                                <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse"
                                                    data-target="#editInformasi{{ $item->id }}" aria-expanded="false"
                                                    aria-controls="editInformasi"><i class="feather icon-edit"></i></button>

                                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                    data-target="#modalDelete{{ $item->id }}"><i
                                                        class="feather icon-trash-2"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        {{ $informasi->links('paginator.paginator') }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                @foreach ($informasi as $edit)
                    <div class="collapse" id="editInformasi{{ $edit->id }}">
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h5><i class="feather icon-info"></i> Edit Informasi</h5>
                            </div>
                            <form action="/informasi/{{ $edit->id }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                                <div class="card-body">
                                    <textarea name="pesan" class="form-control" id="" cols="30" rows="5">{{ $edit->pesan }}</textarea>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                @endforeach

                <div class="card">
                    <div class="card-header justify-content-between">
                        <h5><i class="feather icon-info"></i> Tambah Informasi</h5>
                    </div>
                    <form action="/informasi" method="post">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                        <div class="card-body">
                            <textarea name="pesan" class="form-control" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>


        </div>
        <!-- [ Main Content ] end -->

        {{-- Modal Hapus Juara --}}
        @foreach ($informasi as $delete)
            <div id="modalDelete{{ $delete->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="/informasi/{{ $delete->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body text-center">
                                <h5>Apakah anda yakin ingin menghapus informasi ini?</h5>
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
@endpush
