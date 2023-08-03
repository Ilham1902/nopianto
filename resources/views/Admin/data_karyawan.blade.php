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
                <div class="card-header">Data Karyawan</div>
                <div class="card-body table-responsive">
                    <a href="{{ route('tambahKaryawan') }}" class="btn btn-primary btn-sm rounded-pill mb-3"><i
                            class="fas fa-user-plus"></i>
                        Tambah Karyawan</a>
                    <table class="table w-100" id="dataAbsensi">
                        <thead>
                            <th>#</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($dataKaryawan as $data)
                                @if ($data['status'] == '1')
                                    @php
                                        $status = 'Aktif';
                                    @endphp
                                @else
                                    @php
                                        $status = 'Tidak Aktif';
                                    @endphp
                                @endif

                                <tr data-key="{{ $data['nidn'] }}">
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        {{ $data['nidn'] }}
                                    </td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['email'] }}</td>
                                    <td class="text-center">
                                        <button
                                            class="btn btn-sm rounded-pill {{ $status == 'Aktif' ? 'btn-success' : 'btn-danger' }}">{{ $status }}</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="/ubah_karyawan/{{ $data['id'] }}"
                                            class="btn btn-sm btn-primary rounded"><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

    @if ($message = Session::get('sukses'))
        <script>
            Swal.fire(
                'Sukses!',
                'Karyawan berhasil ditambah',
                'success'
            )
        </script>
    @endif

    @if (session()->has('success_simpan'))
        <script>
            Swal.fire(
                'Sukses!',
                'Karyawan berhasil diubah',
                'success'
            )
        </script>
    @endif

    <script>
        $('#dataAbsensi').DataTable({
            // dom: 'Bfrtip',
            // buttons: ['copy', 'csv', 'print']
        });
    </script>
@endsection
