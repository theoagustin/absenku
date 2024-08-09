@include('../template/headersite')

<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')

    <div class="app-main p-t-1 m-0">
        @include('../template/part/nav-menu')

        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Data Lembur
                            <div style="float:right;">
                                <a href="{{ route('lembur.create') }}" class="btn-shadow btn btn-md btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-plus fa-w-20"></i>
                                    </span>
                                    Tambah Lembur
                                </a>
                                <a href="{{ route('lembur.export') }}" class="btn-shadow btn btn-md btn-success">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-file-excel fa-w-20"></i>
                                    </span>
                                    Export Excel
                                </a>
                            </div>
                        </h5>
                        <hr>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <th>Tgl. Lembur</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Keterangan Lembur</th>
                                    <th>Upah Tambahan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lemburs as $lembur)
                                    <tr>
                                        <td>{{ $lembur->karyawan->nama }}</td>
                                        <td>{{ $lembur->tgl_lembur }}</td>
                                        <td>{{ $lembur->jam_mulai ? substr($lembur->jam_mulai, 0, 5) : '' }}</td>
                                        <td>{{ $lembur->jam_selesai ? substr($lembur->jam_selesai, 0, 5) : ''}}</td>
                                        <td>{{ $lembur->keterangan_lembur }}</td>
                                        <td>{{ number_format($lembur->upah_tambahan, 2) }}</td>
                                        <td>
                                            <a href="{{ route('lembur.edit', $lembur->lembur_id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('lembur.destroy', $lembur->lembur_id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
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
