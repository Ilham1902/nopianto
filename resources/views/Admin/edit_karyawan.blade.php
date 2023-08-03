@extends('layouts.main')

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.13.6/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/datatables.min.css"
        rel="stylesheet">
@endsection

@section('main')
    <div class="row mb-5">
        <div class="col-sm-12">
            <div class="card">
                <form action="{{ route('UpdateKaryawan') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $dataKaryawan['id'] }}">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Karyawan" value="{{ $dataKaryawan['name'] }}">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control" id="nidn" name="nidn" placeholder="NIDN"
                                    value="{{ $dataKaryawan['nidn'] }}">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ $dataKaryawan['email'] }}">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="col-sm-12 mb-3">

                                <label for="barcode">Barcode</label> <br>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn mb-3" data-toggle="modal" data-target="#lihat">
                                    <img src="{{ asset('/barcode/' . $dataKaryawan['barcode']) }}" width="200px">
                                </button> <br>

                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#ubah">
                                    Ubah Barcode
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary rounded-pill float-right mb-3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Ubah-->
        <div class="modal fade" id="ubah" tabindex="-1" role="dialog" aria-labelledby="ubahLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahLabel">Ubah Barcode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('edit_barcode') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $dataKaryawan['id'] }}">
                            <input type="file" class="form-control-file" name="barcode" id="barcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Lihat-->
        <div class="modal fade" id="lihat" tabindex="-1" role="dialog" aria-labelledby="lihatLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lihatLabel">Lihat Barcode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('/barcode/' . $dataKaryawan['barcode']) }}" class="text-center w-100">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.13.6/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/datatables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    @if (session()->has('success'))
        <script>
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
                title: 'Data berhasil diubah'
            })
        </script>
    @endif

    @if (session()->has('failed'))
        <script>
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
                icon: 'error',
                title: 'Data gagal diubah'
            })
        </script>
    @endif
@endsection
