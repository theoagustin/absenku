@include('../template/headersite')
<style>
    .modal-backdrop {
        display: none;
        z-index: 1040 !important;
    }

    .modal-content {
        margin: 100px auto;
        z-index: 1100 !important;
    }
</style>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')
    <div class="app-main p-t-1 m-0">
        @include('../template/part/nav-menu')
        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Absensi</h5>

                        <form action="{{ route('absensi.report') }}" method="GET">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="start_date">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="end_date">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="department_id">Bagian</label>
                                    <select id="department_id" name="department_id" class="form-control">
                                        <option value="">Semua Bagian</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $departmentId == $department->id ? 'selected' : '' }}>
                                                {{ $department->nama_bagian }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="filter">Cari</label>
                                    <button type="submit" class="btn btn-primary form-control">Tampilkan</button>
                                    <a href="{{ route('absensi.export', ['start_date' => $startDate, 'end_date' => $endDate, 'department_id' => $departmentId]) }}" class="btn btn-success">Export Excel</a>
                                </div>
                            </div>
                        </form>

                        <div class="divider"></div>

                        @if ($karyawans->isEmpty())
                            <div class="alert alert-warning">
                                Tidak ada data absensi untuk rentang tanggal ini.
                            </div>
                        @else
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Karyawan</th>
                                        <th>Kehadiran</th>
                                        <th>Sakit</th>
                                        <th>Ijin</th>
                                        <th>Alpa</th>
                                        <th>Telat</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $karyawan)
                                        @php
                                            $kehadiran = $karyawan->absensis->where('status_kehadiran', 'h')->count() ?? '0';
                                            $sakit = $karyawan->absensis->where('status_kehadiran', 's')->count() ?? '0';
                                            $ijin = $karyawan->absensis->where('status_kehadiran', 'i')->count() ?? '0';
                                            $alpa = $karyawan->absensis->where('status_kehadiran', 'a')->count() ?? '0';
                                            $telat = $karyawan->absensis->where('status_kehadiran', 't')->count() ?? '0';
                                        @endphp
                                        <tr>
                                            <td>{{ $karyawan->nama }}</td>
                                            <td>{{ $kehadiran }}</td>
                                            <td>{{ $sakit }}</td>
                                            <td>{{ $ijin }}</td>
                                            <td>{{ $alpa }}</td>
                                            <td>{{ $telat }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal{{ $karyawan->id }}">Detail</button>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail untuk Karyawan -->
                                        <div class="modal fade" id="detailModal{{ $karyawan->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $karyawan->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel{{ $karyawan->id }}">Detail Karyawan</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Nama:</strong> {{ $karyawan->nama }}</p>
                                                        <p><strong>Bagian:</strong> {{ $karyawan->bagian->nama_bagian ?? 'Tidak ada data' }}</p>
                                                        <p><strong>Posisi:</strong> {{ $karyawan->posisi->nama_posisi ?? 'Tidak ada data' }}</p>
                                                        <p><strong>Kehadiran:</strong> {{ $karyawan->absensis->where('status_kehadiran', 'h')->count() }}</p>
                                                        <p><strong>Sakit:</strong> {{ $karyawan->absensis->where('status_kehadiran', 's')->count() }}</p>
                                                        <p><strong>Ijin:</strong> {{ $karyawan->absensis->where('status_kehadiran', 'i')->count() }}</p>
                                                        <p><strong>Alpa:</strong> {{ $karyawan->absensis->where('status_kehadiran', 'a')->count() }}</p>
                                                        <p><strong>Telat:</strong> {{ $karyawan->absensis->where('status_kehadiran', 't')->count() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('../template/footersite')
