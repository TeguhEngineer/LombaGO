@extends('layouts.app')
@section('content')
    {{-- Style Podium --}}
    <style>
        .juara-content {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            height: 500px;

            /* Hilangkan overflow hidden */
            overflow-x: auto;
            /* Scroll hanya horizontal */
            overflow-y: hidden;
            /* Nonaktifkan scroll vertikal */

            background: linear-gradient(45deg, #3498db, #2ecc71);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            /* Agar konten tidak keluar */
            /* white-space: nowrap; */
        }

        .podium {
            display: flex;
            justify-content: center;

            align-items: flex-end;
            position: relative;
            paddding-left: 0px;
        }

        /* Tambahkan padding-left hanya untuk tampilan HP */
        @media (max-width: 768px) {
            .podium {
                padding-left: 190px;
                /* Tambahkan padding untuk tampilan kecil */
            }
        }

        .podium-item {
            width: 150px;
            height: 200px;
            margin: 0 10px;
            background-color: #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
        }

        .podium-1 {
            height: 250px;
            /* lebih tinggi untuk juara 1 */
            background-color: gold;
        }

        .podium-2 {
            height: 210px;
            /* sedikit lebih tinggi untuk juara 2 */
            background-color: silver;
        }

        .podium-3 {
            height: 180px;
            /* untuk juara 3 */
            background-color: #cd7f32;
            /* perunggu */
        }

        .circle {
            width: 70px;
            height: 70px;
            background-color: red;
            /* Ganti dengan gambar menggunakan background-image jika diinginkan */
            border-radius: 50%;
            position: absolute;
            top: -50px;
            /* posisikan lingkaran di atas podium dengan margin */
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            /* Menyembunyikan bagian gambar yang keluar dari lingkaran */
        }

        .circle img {
            width: 100%;
            /* Gambar akan menyesuaikan lebar lingkaran */
            height: auto;
            /* Tinggi gambar akan disesuaikan secara otomatis */
        }

        h4 {
            margin: 10px 0 0 0;
            color: white;
        }

        .st {
            /* filter: 0 4px 10px rgba(0, 0, 0, 0.3); */
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.3));
        }
    </style>

    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            @can('user')
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body p-1">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="img-fluid d-block " src="/assets/images/banner_1.png"
                                            style="width: 100%; height: auto; object-fit: cover;" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid d-block " src="/assets/images/banner_2.png"
                                            style="width: 100%; height: auto; object-fit: cover;" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid d-block " src="/assets/images/banner_3.png"
                                            style="width: 100%; height: auto; object-fit: cover;" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid d-block " src="/assets/images/banner_4.png"
                                            style="width: 100%; height: auto; object-fit: cover;" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid d-block " src="/assets/images/banner_5.png"
                                            style="width: 100%; height: auto; object-fit: cover;" alt="Second slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span
                                        class="sr-only">Previous</span></a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span
                                        class="sr-only">Next</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($juara1 == !null && $juara2 == !null && $juara3 == !null)
                    <div class="col-lg-12 col-12">
                        {{-- Juara --}}
                        <div class="card latest-update-card">
                            <div class="card-header">
                                <h5 class="d-flex justify-content-center"> Juara Lomba Office Application Skill <i
                                        class="feather icon-award"></i></h5>
                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item full-card"><a href="#!"><span><i
                                                            class="feather icon-maximize"></i> maximize</span><span
                                                        style="display:none"><i class="feather icon-minimize"></i>
                                                        Restore</span></a></li>
                                            <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                            class="feather icon-minus"></i> collapse</span><span
                                                        style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                            </li>
                                            <li class="dropdown-item reload-card"><a href="#!"><i
                                                        class="feather icon-refresh-cw"></i> reload</a></li>
                                            <li class="dropdown-item close-card"><a href="#!"><i
                                                        class="feather icon-trash"></i> remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body juara-content">
                                <div class="podium">
                                    <div class="podium-item podium-2">
                                        <div class="circle">
                                            <img src="{{ asset('storage/' . $juara2->peserta->pas_foto) }}" alt="Juara 2" />
                                        </div>
                                        <h4 class="text-center">{{ $juara2->peserta->name }}</h4>
                                        <small class="text-white"><b>({{ $juara2->peserta->asal_sekolah }})</b></small>
                                        <img src="/assets/images/2st.png" class="st" width="100" alt="">
                                    </div>
                                    <div class="podium-item podium-1">
                                        <div class="circle">
                                            <img src="{{ asset('storage/' . $juara1->peserta->pas_foto) }}" alt="Juara 1" />
                                            
                                        </div>
                                        <h4 class="text-center">{{ $juara1->peserta->name }}</h4>
                                        <small class="text-white"><b>({{ $juara1->peserta->asal_sekolah }})</b></small>
                                        <img src="/assets/images/1st.png" class="st" width="100" alt="">
                                    </div>
                                    <div class="podium-item podium-3">
                                        <div class="circle">
                                            <img src="{{ asset('storage/' . $juara3->peserta->pas_foto) }}" alt="Juara 3" />
                                        </div>
                                        <h4 class="text-center">{{ $juara3->peserta->name }}</h4>
                                        <small class="text-white"><b>({{ $juara3->peserta->asal_sekolah }})</b></small>
                                        <img src="/assets/images/3st.png" class="st" width="100" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-12 col-12">
                    {{-- Informasi --}}
                    <div class="card latest-update-card">
                        <div class="card-header">
                            <h5>Informasi Terbaru</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i
                                                        class="feather icon-maximize"></i> maximize</span><span
                                                    style="display:none"><i class="feather icon-minimize"></i>
                                                    Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                        class="feather icon-minus"></i> collapse</span><span
                                                    style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i
                                                    class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i
                                                    class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (is_null(Auth::user()->nisn) || is_null(Auth::user()->identitas))
                                <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
                                    <a href="/profile" class="alert-link"><i class="feather icon-user"></i> Lengkapi data
                                        identitas</a> anda terlebih dahulu.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                            @endif


                            {{-- <div class="latest-update-box"> --}}
                            {{-- <div class="review-block"> --}}
                            @forelse ($informasi as $info)
                                {{-- <div class="row">
                                            <div class="col-2 p-r-0">
                                                <img src="/assets/images/logo_lcc.png" width="60" alt="user image"
                                                    class="img-radius profile-img cust-img m-b-15">
                                            </div>
                                            <div class="col-auto justify-content-right">
                                                <h6 class="m-b-15">Admin <span
                                                        class="float-right f-13 text-muted">{{ $info->created_at->diffForHumans() }}</span>
                                                </h6>
                                                <p class="m-t-15 m-b-15 text-muted">{{ $info->pesan }}</p>
                                            </div>
                                        </div> --}}
                                {{-- <div class="card"> --}}
                                <div class="card-body pt-4">
                                    <div class="d-flex ">

                                        <div>
                                            <i class="feather icon-info h1 text-info" style="font-size: 50px;"></i>
                                        </div>
                                        <div class="pl-3 w-100">
                                            <div class="d-flex ">
                                                <h5 class="card-title">Admin</h5>
                                                <small
                                                    class="text-muted ml-auto">{{ $info->created_at->diffForHumans() }}.</small>
                                            </div>
                                            <p class="card-text">{{ $info->pesan }}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- </div> --}}
                            @empty
                                <div class="row">
                                    <div class="col-12 text-center py-5">
                                        <h5>Belum ada informasi.</h5>
                                    </div>
                                </div>
                            @endforelse
                            {{-- </div> --}}
                            {{-- </div> --}}
                            <div class="text-center">
                                {{-- @if (is_null($informasi)) --}}
                                    <a class="text-info" href="#" id="shortcut-link">Lihat semua informasi di atas.</a>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('superadmin')
                <div class="col-lg-3 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">{{ $countPeserta }}</h4>
                                    <h6 class="text-muted m-b-0">Jml. Peserta</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-users f-28"></i>
                                </div>
                            </div>
                        </div>
                        <a href="/peserta">
                            <div class="card-footer bg-c-green">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <p class="text-white m-b-0">Selengkapnya</p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="feather icon-trending-up text-white f-16"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">{{ $countMale }}</h4>
                                    <h6 class="text-muted m-b-0">Laki-laki</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-users f-28"></i>
                                </div>
                            </div>
                        </div>
                        <a href="/peserta?jk=Laki-laki&search=">
                            <div class="card-footer bg-c-green">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <p class="text-white m-b-0">Selengkapnya</p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="feather icon-trending-up text-white f-16"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">{{ $countFemale }}</h4>
                                    <h6 class="text-muted m-b-0">Perempuan</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-users f-28"></i>
                                </div>
                            </div>
                        </div>
                        <a href="/peserta?jk=Perempuan&search=">
                            <div class="card-footer bg-c-green">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <p class="text-white m-b-0">Selengkapnya</p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="feather icon-trending-up text-white f-16"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
        </div>
        <!-- [ Main Content ] end -->
    </div>

@endsection

@push('script')
    {{-- @if (session('daftar'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "{{ session('daftar') }}",
                    showConfirmButton: false,
                    timer: 1500
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            });
        </script>
    @endif --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shortcutLink = document.getElementById('shortcut-link');
            const dropdownToggle = document.getElementById('dropdown-toggle');

            if (shortcutLink) {
                shortcutLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdownToggle.click();
                });
            }
        });
    </script>
@endpush
