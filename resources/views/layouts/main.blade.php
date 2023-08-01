@include('components.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('components.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('components.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                        @if ($title == 'Absensi')
                            <p>{{ date('d-M-Y') }}</p>
                        @endif
                    </div>

                    @yield('main')


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('components.script')

    <script>
        function simpan(nidn) {
            // Ambil nilai kehadiran dari elemen <select>
            const kehadiran = $(`tr[data-key="${nidn}"] select[name="kehadiran"]`).val();

            console.log(nidn);
            // Lakukan permintaan AJAX untuk menyimpan data kehadiran beserta NIDN
            $.ajax({
                type: 'POST',
                url: '/api/simpanAbsensi',
                data: {
                    nidn: nidn,
                    kehadiran: kehadiran,
                },
                success: function(response) {
                    // Tambahkan logika yang sesuai untuk menangani respons sukses
                    if (response.message == "success") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Data Berhasil Di simpan'
                        })
                    }

                    $('#tombol_' + nidn).hide();
                    $('#teks_' + nidn).show();
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
