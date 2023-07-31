<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Absensi</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('login') }}">
                <div class="sidebar-brand-text mx-3">Absesnsi Karyawan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fas fa-tasks"></i>
                    <span>Absensi</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('index.html') }}">
                    <i class="fas fa-tasks"></i>
                    <span>Data Absensi</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('index.html') }}">
                    <i class="fas fa-users"></i>
                    <span>Data Karyawan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('index.html') }}">
                    <i class="fas fa-users"></i>
                    <span>Data Admin</span></a>
            </li>

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
                    <button id="sidebarToggle" class="btn btn-link text-center d-none d-md-inline rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="{{ url('#') }}" id="userDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 text-gray-600 small"><i class="fas fa-user"></i>
                                    &emsp13; {{ auth()->user()->name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('#') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ url('#') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="{{ url('#') }}">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Absensi</h1>
                        <p>{{ date('d-M-Y') }}</p>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">Absensi Karyawan</div>
                                <div class="card-body table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>#</th>
                                            <th>NIDN</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($dataAbsensi as $data)
                                            <tr data-key="{{ $data['nidn'] }}">
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    {{ $data['nidn'] }}
                                                </td>
                                                <td>{{ $data['nama'] }}</td>
                                                <td>
                                                    <select class="custom-select" name="kehadiran">
                                                        <option selected>Belum Absen</option>
                                                        <option value="Hadir">Hadir</option>
                                                        <option value="Izin">Izin</option>
                                                        <option value="Sakit">Sakit</option>
                                                        <option value="Alpha">Alpha</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm rounded-pill"
                                                        onclick="simpan('{{ $data['nidn'] }}')">Simpan</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ url('#page-top') }}">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/admin/js/sb-admin-2.min.js') }}"></script>

    <script>
        function simpan(nidn) {
            // Ambil nilai kehadiran dari elemen <select>
            const kehadiran = $(`tr[data-key="${nidn}"] select[name="kehadiran"]`).val();

            console.log(nidn);
            // Lakukan permintaan AJAX untuk menyimpan data kehadiran beserta NIDN
            $.ajax({
                type: 'POST',
                url: '/admin/simpanAbsensi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    nidn: nidn,
                    kehadiran: kehadiran,
                },
                success: function(response) {
                    // Tambahkan logika yang sesuai untuk menangani respons sukses
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Tambahkan logika yang sesuai untuk menangani kesalahan
                    console.error('Terjadi kesalahan:', error);
                }
            });
        }
    </script>
</body>

</html>
