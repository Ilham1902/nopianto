@extends('layouts.main')

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.13.6/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/datatables.min.css"
        rel="stylesheet">
@endsection

@section('main')
    <form action="{{ route('search') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-sm-4">
                <label for="karyawan">Karyawan</label>
                <select class="form-control" id="karyawan" name="karyawan">
                    <option value="">Semua</option>
                    @foreach ($dataKaryawan as $karyawan)
                        <option value="{{ $karyawan['nidn'] }}">{{ $karyawan['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="bulan">Bulan</label>
                <select class="form-control" id="bulan" name="bulan">
                    <option value="">Semua</option>
                    @foreach ($dataBulan as $key => $bulan)
                        <option value="{{ $key }}">{{ $bulan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="tahun">Tahun</label>
                <select class="form-control" id="tahun" name="tahun">
                    @foreach ($dataTahun as $tahun)
                        <option value="{{ $tahun }}" @selected($tahunSekarang == $tahun)>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary rounded-pill float-right">Search</button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Absensi Karyawan</div>
                <div class="card-body table-responsive">
                    <table class="table w-100" id="dataAbsensi">
                        <thead>
                            <th>#</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Kehadiran</th>
                            <th>Keterangan</th>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($dataAbsensi as $data)
                                <tr data-key="{{ $data['nidn'] }}">
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        {{ $data['nidn'] }}
                                    </td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['tanggal'] }}</td>
                                    <td>{{ $data['jam'] }}</td>
                                    <td>{{ $data['kehadiran'] }}</td>
                                    <td>{{ $data['status'] }}</td>
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

    <script>
        $('#dataAbsensi').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'print']
        });
    </script>
@endsection
