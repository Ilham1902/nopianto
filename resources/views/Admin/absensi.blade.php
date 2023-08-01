@extends('layouts.main')

@section('main')
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
                                    <button class="btn btn-primary btn-sm rounded-pill" id="tombol_{{ $data['nidn'] }}"
                                        onclick="simpan('{{ $data['nidn'] }}')">Simpan</button>
                                    <span id="teks_{{ $data['nidn'] }}" style="display: none">Tersimpan</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
