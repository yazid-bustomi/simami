<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIMAMI</title>

    <!-- Custom fonts for this template-->
    <link href={{ asset('vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset('css/sb-admin-2.min.css') }} rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @yield('style')


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                {{-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> --}}
                <div class="sidebar-brand-text mx-3">SIMAMI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @if (Auth::user()->role == 'admin')
                <!-- Nav Item Admin - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @elseif (Auth::user()->role == 'kampus')
                <!-- Nav Item Kampus - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('kampus.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @elseif (Auth::user()->role == 'perusahaan')
                <!-- Nav Item Perusahaan - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('perusahaan.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @elseif (Auth::user()->role == 'mahasiswa')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @endif

            <hr class="sidebar-divider">

            {{-- Nav Item User --}}
            @if (Auth::user()->role == 'kampus')
                <!-- Nav Item - User - By Kampus -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Mahasiswa</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
            @elseif (Auth::user()->role == 'admin')
                <!-- Nav Item - User - By Kampus -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-user"></i>
                        <span>User</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
            @endif


            @if (Auth::user()->role == 'kampus')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jurusan.index') }}">
                        <i class="fas fa-fw fa-university"></i>
                        <span>Jurusan</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
            @endif


            @if (Auth::user()->role == 'mahasiswa')
                <!-- Nav Item - Lowongan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('magang.index') }}">
                        <i class="fas fa-fw fa-briefcase"></i>
                        <span>Lowongan</span></a>
                </li>
            @elseif (Auth::user()->role == 'kampus')
                <!-- Nav Item - Lowongan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lowongan.index') }}">
                        <i class="fas fa-fw fa-briefcase"></i>
                        <span>Lowongan</span></a>
                </li>
            @elseif (Auth::user()->role == 'perusahaan')
                <!-- Nav Item - Lowongan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lowongan.index') }}">
                        <i class="fas fa-fw fa-briefcase"></i>
                        <span>Lowongan</span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'kampus' || Auth::user()->role == 'perusahaan')
                <hr class="sidebar-divider">

                <!-- Nav Item - Pnedaftar by kampus dan perusahaan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pendaftar.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pendaftar</span></a>
                </li>
            @elseif (Auth::user()->role == 'mahasiswa')
                <hr class="sidebar-divider">

                <!-- Nav Item - Pnedaftar by kampus dan perusahaan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.status') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pendaftaran</span></a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-id-card"></i>
                        <span>Profile</span></a>
                </li>
            @elseif (Auth::user()->role == 'kampus')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kampus.profile') }}">
                        <i class="fas fa-fw fa-id-card"></i>
                        <span>Profile</span></a>
                </li>
            @elseif (Auth::user()->role == 'perusahaan')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('perusahaan.profile') }}">
                        <i class="fas fa-fw fa-id-card"></i>
                        <span>Profile</span></a>
                </li>
            @elseif (Auth::user()->role == 'mahasiswa')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.index') }}">
                        <i class="fas fa-fw fa-id-card"></i>
                        <span>Profile</span></a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama_depan }}
                                    {{ Auth::user()->nama_belakang }}</span>
                                <div class="topbar-divider d-none d-sm-block"></div>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>

            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Bustomi 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah yakin ingin keluar ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src={{ asset('vendor/jquery/jquery.min.js') }}></script>

    <script src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

    <!-- Core plugin JavaScript-->
    <script src={{ asset('vendor/jquery-easing/jquery.easing.min.js') }}></script>


    <!-- Custom scripts for all pages-->
    <script src={{ asset('js/sb-admin-2.min.js') }}></script>

    <!-- Page level plugins -->
    <script src={{ asset('vendor/chart.js/Chart.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/chart-area-demo.js') }}></script>
    <script src={{ asset('js/demo/chart-pie-demo.js') }}></script>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    @yield('script')
</body>

</html>
