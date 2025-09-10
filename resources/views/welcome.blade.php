<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>O.A.S</title>
    <link rel="shortcut icon" href="/assets/images/logo_lcc.png" type="image/x-icon">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="/welcome/cover.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


</head>

<body class="d-flex h-100 text-center text-bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0"><img src="/assets/images/logo_lp3i.png" width="120" alt="">
                </h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    @if (Route::has('login'))
                        @auth
                            <a class="nav-link fw-bold py-1 px-0 text-white" href="{{ route('dashboard') }}">Dashboard</a>
                        @else
                            <a class="nav-link fw-bold py-1 px-0 text-white" href="{{ route('login') }}">Masuk</a>
                            @if (Route::has('register'))
                                <a class="nav-link fw-bold py-1 px-0 text-white" href="{{ route('register') }}">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1 class="fw-bold mb-4">Selamat datang di <br> Office Application Skill</h1>
            <p class="lead" style="font-size: 15px; text-align: justify;">
                Office Application Skill adalah sebuah kompetisi yang dirancang untuk menguji keterampilan peserta dalam
                menggunakan aplikasi perkantoran, seperti Microsoft Word, Excel, dan PowerPoint, secara efektif dan
                efisien. Lomba ini bertujuan untuk mengukur kemampuan teknis peserta dalam mengolah dokumen, mengelola
                data, serta menyusun presentasi secara profesional. Kompetisi ini tidak hanya menilai kecepatan dan
                ketepatan dalam menyelesaikan tugas, tetapi juga kreativitas serta kemampuan peserta dalam memanfaatkan
                fitur-fitur aplikasi secara optimal.
            </p>
            <!-- <p class="lead">
                <a href="#" class="btn btn-lg btn-light fw-bold border-white bg-white">Learn more</a>
            </p> -->
        </main>

        <footer class="mt-auto text-white-50">
            <p> <img src="/assets/images/logo_lcc.png" width="20" alt=""> copyright &copy; 2024</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
