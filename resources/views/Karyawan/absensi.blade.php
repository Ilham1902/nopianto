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
                        @if (!empty($data))
                            <tr data-key="{{ $data['nidn'] }}">
                                <td>1</td>
                                <td>
                                    {{ $data['nidn'] }}
                                </td>
                                <td>{{ $data['nama'] }}</td>
                                <td>
                                    <select class="custom-select" name="kehadiran">
                                        <option selected>Belum Absen</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Alpha">Alpha</option>
                                    </select>
                                </td>
                                <td>
                                    @if ($tanggal == $data['tanggal'])
                                        <span id="teks_{{ $data['nidn'] }}">Kehadiran sudah disimpan</span>
                                    @else
                                        <button class="btn btn-primary btn-sm rounded-pill" id="tombol_{{ $data['nidn'] }}"
                                            onclick="simpan('{{ $data['nidn'] }}')">Simpan</button>
                                        <span id="teks_{{ $data['nidn'] }}" style="display: none">Tersimpan</span>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <div class="alert alert-danger" role="alert">
                                Tidak ada data absensi
                            </div>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function simpan(nidn) {
            // Ambil nilai kehadiran dari elemen <select>
            const kehadiran = $(`tr[data-key="${nidn}"] select[name="kehadiran"]`).val();

            // console.log(nidn);
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
@endsection
