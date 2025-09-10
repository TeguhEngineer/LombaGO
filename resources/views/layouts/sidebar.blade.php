<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
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
                            alt="Foto profil">
                    @endif
                    <div class="user-details mt-2">
                        <div id="more-details">{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="/profile"><i class="feather icon-user m-r-5"></i>
                                Profile</a></li>
                        {{-- <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li> --}}
                        <li class="list-group-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><i
                                    class="feather icon-log-out m-r-5"></i>Logout</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar mt-2">
                {{-- <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li> --}}
                <li class="nav-item">
                    <a href="/home" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                @can('user')
                    <li class="nav-item">
                        <a href="/soal" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-file-text"></i></span><span class="pcoded-mtext">Kerjakan
                                Soal</span></a>
                    </li>
                @endcan

                @can('superadmin')
                    <li class="nav-item">
                        <a href="/peserta" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-users"></i></span><span class="pcoded-mtext">Peserta</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/create-soal" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-file-text"></i></span><span class="pcoded-mtext">Buat
                                Soal</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/jawaban" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-file-text"></i></span><span class="pcoded-mtext">Jawaban</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/set_juara" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-bar-chart-2"></i></span><span class="pcoded-mtext">Set
                                Juara</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/informasi" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-info"></i></span><span class="pcoded-mtext">Informasi</span></a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="/profile" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                </li>

            </ul>


        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
