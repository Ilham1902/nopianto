@extends('layouts.main')

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.13.6/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/datatables.min.css"
        rel="stylesheet">
@endsection

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data Admin</div>
                <div class="card-body table-responsive">
                    <a href="{{ route('tambahAdmin') }}" class="btn btn-primary btn-sm rounded-pill mb-3"><i
                            class="fas fa-user-plus"></i>
                        Tambah Admin</a>
                    <table class="table w-100" id="dataAbsensi">
                        <thead>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($dataAdmin as $data)
                                @if ($data['status'] == '1')
                                    @php
                                        $status = 'Aktif';
                                    @endphp
                                @else
                                    @php
                                        $status = 'Tidak Aktif';
                                    @endphp
                                @endif

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['email'] }}</td>
                                    <td class="text-center">
                                        <button
                                            class="btn btn-sm rounded-pill {{ $status == 'Aktif' ? 'btn-success' : 'btn-danger' }}"
                                            onclick="GetData({{ $data['id'] }}, {{ $data['status'] }})"
                                            data-toggle="modal" data-target="#ubahStatus">{{ $status }}</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="/ubah_admin/{{ $data['id'] }}" class="btn btn-sm btn-primary rounded"><i
                                                class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ubahStatus" tabindex="-1" role="dialog" aria-labelledby="ubahStatusLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahStatusLabel">Ubah Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('ubah_status') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div id="ajaxStatus">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
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

    @if (session()->has('success_simpan'))
        <script>
            Swal.fire(
                'Sukses!',
                'Admin berhasil diubah',
                'success'
            )
        </script>
    @endif

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

    <script>
        $('#dataAbsensi').DataTable({
            // dom: 'Bfrtip',
            // buttons: ['copy', 'csv', 'print']
        });

        function GetData(id, data) {
            var data = data;
            if (data == 1) {
                var select = "<input type='hidden' name='id' value='" + id +
                    "'> <select class='form-control' name='status'><option value='1' selected>Aktif</option><option value='2'>Tidak Aktif</option></select>";
            } else {
                var select = "<input type='hidden' name='id' value='" + id +
                    "'> <select class='form-control' name='status'><option value='2' selected>Tidak Aktif</option><option value='1'>Aktif</option></select>";
            }
            $('#ajaxStatus').html(select)
        }
    </script>
@endsection
