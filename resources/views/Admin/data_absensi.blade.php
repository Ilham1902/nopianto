@extends('layouts.main')

@section('main')
    <div class="row mb-3">
        <div class="col-sm-4">
            <label for="karyawan">Karyawan</label>
            <select class="form-control" id="karyawan" name="karyawan">
                @foreach ($dataKaryawan as $karyawan)
                    <option value="{{ $karyawan['nidn'] }}">{{ $karyawan['nama'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <label for="bulan">Bulan</label>
            <select class="form-control" id="bulan" name="bulan">
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
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Kehadiran</th>
                            <th>Keterangan</th>
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
                                <td>{{ $data['name'] }}</td>
                                <td>{{ $data['tanggal'] }}</td>
                                <td>{{ $data['jam'] }}</td>
                                <td>{{ $data['kehadiran'] }}</td>
                                <td>{{ $data['status'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
