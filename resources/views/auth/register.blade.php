<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar | O.A.S</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" href="/assets/images/logo_lcc.png" type="image/x-icon">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/loginregister/css/util.css">
    <link rel="stylesheet" type="text/css" href="/loginregister/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/assets/images/cover_ori.jpg);">
                    <span class="login100-form-title-1">
                        Daftar
                    </span>
                </div>

                <form action="{{ route('register') }}" class="login100-form validate-form" method="POST">
                    @csrf
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nama tidak boleh kosong.">
                        <span class="label-input100">Nama</span>
                        <input class="input100" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Masukan nama">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="validate-input m-b-26">
                        <span class="label-input100">Jenis Kelamin</span>
                        <div class="flex-sb-m w-full" style="padding-top: 25px;">
                            <div class="contact100-form-checkbox">
                                <input class="input-checkbox100" id="ckb1" type="radio" name="jk"
                                    value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'checked' : '' }}>
                                <label class="label-checkbox100" for="ckb1">
                                    Laki - laki
                                </label>
                            </div>

                            <div class="contact100-form-checkbox" style="margin-left: 20px;">
                                <input class="input-checkbox100" id="ckb2" type="radio" name="jk"
                                    value="Perempuan" {{ old('jk') == 'Perempuan' ? 'checked' : '' }}>
                                <label class="label-checkbox100" for="ckb2">
                                    Perempuan
                                </label>
                            </div>

                        </div>
                        @error('jk')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nomor telepon tidak boleh kosong.">
                        <span class="label-input100">Nomor Telepon</span>
                        <input class="input100" type="number" name="no_tlp" placeholder="Masukan nomor telepon"
                            value="{{ old('no_tlp') }}">
                        <span class="focus-input100"></span>
                        @error('no_tlp')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Asal sekolah tidak boleh kosong.">
                        <span class="label-input100">Asal Sekolah</span>
                        <input id="upercase" class="input100" type="text" name="asal_sekolah"
                            oninput="convertToUpperCase()" placeholder="Asal sekolah anda"
                            value="{{ old('asal_sekolah') }}">
                        <span class="focus-input100"></span>
                    </div>
                    <script>
                        function convertToUpperCase() {
                            var input = document.getElementById('upercase');
                            input.value = input.value.toUpperCase();
                        }
                    </script>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email tidak boleh kosong.">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Masukan email anda"
                            value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                        @error('email')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password tidak boleh kosong">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Masukan password">
                        <span class="focus-input100"></span>
                        @error('password')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password tidak boleh kosong">
                        <span class="label-input100">Konfirmasi Password</span>
                        <input class="input100" type="password" name="password_confirmation"
                            placeholder="Konfirmasi password">
                        <span class="focus-input100"></span>
                        @error('password')
                            <small style="color: red;"><i>{{ $message }}</i></small>
                        @enderror
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            <b>Daftar Sekarang</b>
                        </button>
                    </div>

                    <div class="flex-sb-m w-full p-b-30" style="margin-top: 20px;">
                        <div class="contact100-form-checkbox">
                            {{-- <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label> --}}
                            <a href="javascript:history.back()" class="txt1">
                                < Kembali
                            </a>
                        </div>

                        <div>
                            <a href="{{ route('login') }}" class="txt1">
                                Sudah punya akun? Masuk disini.
                            </a>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="/loginregister/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="/loginregister/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="/loginregister/vendor/bootstrap/js/popper.js"></script>
    <script src="/loginregister/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="/loginregister/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="/loginregister/vendor/daterangepicker/moment.min.js"></script>
    <script src="/loginregister/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="/loginregister/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="/loginregister/js/main.js"></script>

</body>

</html>
