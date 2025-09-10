<!DOCTYPE html>
<html lang="en">

<head>
    <title>Masuk | O.A.S</title>
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
                        Masuk
                    </span>
                </div>

                <form action="{{ route('login') }}" class="login100-form validate-form" method="POST">
                    @csrf
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email tidak boleh kosong.">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" value="{{ old('email') }}"
                            placeholder="Masukan email anda">
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

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            <b>Masuk</b>
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
                            <a href="{{ route('register') }}" class="txt1">
                                Belum punya akun? daftar disini.
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

    {{-- Alert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('login-error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Login error",
                    text: "{{ session('login-error') }}",
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            });
        </script>
    @endif

</body>

</html>
