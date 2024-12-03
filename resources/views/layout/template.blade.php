<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('js/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #1D3D70;">
        <!-- Navbar Brand-->
        <a class="navbar-brand" href="#"><img src="{{ asset('img/logo-rw.png') }}" alt="logo" width="200"
                height="90"></a>
        <!-- Sidebar Toggle-->
        <div class="d-flex justify-content-between w-100">
            <button class="btn btn-link btn-sm order-1 order-lg-0 ms-3 me-4 me-lg-0" id="sidebarToggle"
                href="#!"><i class="fas fa-bars text-white fs-4"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <p class="d-none d-md-block text-white my-auto fs-5">{{ Auth::user()->name }}</p>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw text-white"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #1D3D70;">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link text-white" href="{{ url('/') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-house text-white"></i></div>
                            Dashboard
                        </a>
                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <a class="nav-link collapsed text-white" href="#" data-bs-toggle="collapse"
                                data-bs-target="#warga" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user text-white"></i></div>
                                Data Warga
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-white"></i>
                                </div>
                            </a>
                            <div class="collapse" id="warga" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white" href="{{ url('data-warga') }}">Lihat Data Warga</a>
                                    <a class="nav-link text-white" href="#">Lihat Jadwal Ronda</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed text-white" href="#" data-bs-toggle="collapse"
                                data-bs-target="#koperasi" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users text-white"></i></div>
                                Data Koperasi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-white"></i>
                                </div>
                            </a>
                            <div class="collapse" id="koperasi" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white" href="{{ url('data-anggota') }}">Lihat Data
                                        Anggota</a>
                                    <a class="nav-link text-white" href="{{ url('data-anggota/transaksi') }}">Lihat
                                        Data
                                        Transaksi</a>
                                </nav>
                            </div>
                        @endif

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">@yield('header')</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">@yield('header')</li>
                    </ol>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</body>

</html>
