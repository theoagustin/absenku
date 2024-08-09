@include('../template/headersite')

<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')

    <div class="app-main p-t-1 m-0">
        @include('../template/part/nav-menu')

        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Absensi Karyawan - {{ $tanggal }}</h5>
                        <form method="GET" action="{{ route('absensi.index_rekap') }}">
                            <div class="form-group">
                                <label for="tanggal">Pilih Tanggal:</label>
                                <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}" class="form-control">
                                <button type="submit" class="btn btn-primary mt-2">Lihat</button>
                            </div>
                        </form>
                        <hr>

                        <h6>Karyawan yang Sudah Hadir</h6>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <th>Nama Shift</th>
                                    <th>Shift Jam Masuk</th>
                                    <th>Shift Jam Keluar</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Status Kehadiran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawanHadir as $karyawan)
                                    <tr>
                                    <td>{{ $karyawan->nama }}</td>
                                    <td>{{ $karyawan->nama_shift }}</td>
                                    <td>{{ $karyawan->shift_jam_masuk }}</td>
                                    <td>{{ $karyawan->shift_jam_keluar }}</td>
                                        
                                        <td>{{ $karyawan->absensi_jam_masuk }}</td>
                                        <td>{{ $karyawan->absensi_jam_keluar }}</td>
                                        <td><?php if($karyawan->status_kehadiran == 's'){?>
                                          {{"Sakit"}}
                                        <?php
                                          }else if($karyawan->status_kehadiran == 'h'){?>
                                            {{"Hadir"}}
                                          <?php
                                            }else if($karyawan->status_kehadiran == 't'){?>
                                            {{"Terlambat"}}
                                          <?php
                                            }else if($karyawan->status_kehadiran == 'i'){
                                          ?>  
                                        {{"Izin"}}
                                        <?php
                                            }else if($karyawan->status_kehadiran == 'a'){
                                        ?>
                                        {{"Alpha"}}
                                        <?php
                                            }
                                        ?>
                                        </td>
                                        <td>
                                            <select class="form-control status-kehadiran-2" data-id="{{ $karyawan->id_karyawan }}" data-tanggal="{{ $tanggal }}">
                                                <option value="">Pilih Status</option>
                                                <option value="h">Hadir</option>
                                                <option value="s">Sakit</option>
                                                <option value="i">Izin</option>
                                                <option value="t">Terlambat</option>
                                                <option value="a">Alpha</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h6 class="mt-4">Karyawan yang Belum Hadir</h6>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawanBelumHadir as $karyawan)
                                    <tr>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>
                                            <select class="form-control status-kehadiran" data-id="{{ $karyawan->id }}" data-tanggal="{{ $tanggal }}">
                                                <option value="">Pilih Status</option>
                                                <option value="h">Hadir</option>
                                                <option value="s">Sakit</option>
                                                <option value="i">Izin</option>
                                                <option value="t">Terlambat</option>
                                                <option value="a">Alpha</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="app-wrapper-footer">
                @include('../template/part/nav-bottom')
            </div>
        </div>
    </div>

    @include('../template/part/nav-right')
    @include('../template/footersite')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.status-kehadiran').forEach(function (select) {
            select.addEventListener('change', function () {
                var idKaryawan = this.getAttribute('data-id');
                var tanggal = this.getAttribute('data-tanggal');
                var statusKehadiran = this.value;

                fetch('{{ route('absensi.update_rekap') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_karyawan: idKaryawan,
                        tanggal: tanggal,
                        status_kehadiran: statusKehadiran
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert('Gagal memperbarui status kehadiran.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.status-kehadiran-2').forEach(function (select) {
            select.addEventListener('change', function () {
                var idKaryawan = this.getAttribute('data-id');
                var tanggal = this.getAttribute('data-tanggal');
                var statusKehadiran = this.value;
                console.log(idKaryawan);
                console.log(tanggal);
                console.log(statusKehadiran);
                fetch('{{ route('absensi.updateRekap') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_karyawan: idKaryawan,
                        tanggal: tanggal,
                        status_kehadiran: statusKehadiran
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert('Gagal memperbarui status kehadiran.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
