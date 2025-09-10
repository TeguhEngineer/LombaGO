<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">


    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="/assets/images/logo_lp3i.png" width="130" alt="" class="logo">
            <img src="/assets/images/logo-icon.png" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler" id="dropdown-toggle">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        {{-- <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
        </ul> --}}
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="dropdown-info"><span
                            class="badge badge-light-info">{{ $info->count() }}</span><i
                            class="icon feather icon-bell"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0"><i class="feather icon-info"></i> Informasi</h6>
                            {{-- <div class="float-right">
                                <a href="#!" class="m-r-10">mark as read</a>
                                <a href="#!">clear all</a>
                            </div> --}}
                        </div>
                        <ul class="noti-body">
                            @foreach ($info as $infor)
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="/assets/images/logo_lcc.png" width="100"
                                            style="border-radius: 50%; width: 40px; height: 40px; object-fit: cover !important;"
                                            alt="Logo LCC">
                                        <div class="media-body">
                                            <p><strong>Admin</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>{{ $infor->created_at->diffForHumans() }}</span>
                                            </p>
                                            <p>{{ $infor->pesan }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            @if (is_null(Auth::user()->pas_foto))
                                @if (Auth::user()->jk == 'Laki-laki')
                                    <img src="/assets/images/user/laki-laki.png" width="100"
                                        style="border-radius: 50%; width: 65px; height: 65px; object-fit: cover !important;"
                                        alt="">
                                @else
                                    <img src="/assets/images/user/perempuan.png" width="100"
                                        style="border-radius: 50%; width: 65px; height: 65px; object-fit: cover !important;"
                                        alt="">
                                @endif
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->pas_foto) }}" width="100"
                                    style="border-radius: 50%; width: 65px; height: 65px; object-fit: cover !important;"
                                    alt="">
                            @endif
                            <span>{{ Auth::user()->name }}</span>
                            {{-- <a class="dud-logout" title="Logout" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="feather icon-log-out"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> --}}
                        </div>
                        <ul class="pro-body">
                            <li><a href="/profile" class="dropdown-item"><i class="feather icon-user"></i>
                                    Profile</a></li>
                            <li><a href="#" class="dropdown-item" type="button" class="btn  btn-primary"
                                    data-toggle="modal" data-target="#modalResetPassword{{ Auth::user()->id }}"><i
                                        class="feather icon-lock"></i> Ubah
                                    Password</a></li>
                            <li><a href="https://api.whatsapp.com/send?phone=6285353235600&text=saya+butuh+bantuan..."
                                    class="dropdown-item" target="_blank"><i class="feather icon-help-circle"></i>
                                    Bantuan CS!</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();" class="dropdown-item"><i class="feather icon-log-out ml-1"></i>Logout</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>


</header>
<!-- [ Header ] end -->

<div id="modalResetPassword{{ Auth::user()->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('reset.password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="floating-label" for="password">Password lama</label>
                        <input type="text" name="old_password"
                            class="form-control @error('old_password') is-invalid @enderror" id="password">
                        @error('old_password')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="password">Password baru</label>
                        <input type="text" name="password"
                            class="form-control  @error('password') is-invalid @enderror" id="password">
                        @error('password')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="password">Konfirmasi password baru</label>
                        <input type="text" name="password_confirmation"
                            class="form-control  @error('password.confirmation') is-invalid @enderror" id="password">
                        @error('password.confirmation')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn  btn-warning">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

    <!-- Script untuk Membuka Modal -->
    @error('password')
        <script>
            $(document).ready(function() {
                $('#modalResetPassword{{ Auth::user()->id }}').modal('show');
            });
        </script>
    @enderror
    @error('old_password')
        <script>
            $(document).ready(function() {
                $('#modalResetPassword{{ Auth::user()->id }}').modal('show');
            });
        </script>
    @enderror
@endpush
