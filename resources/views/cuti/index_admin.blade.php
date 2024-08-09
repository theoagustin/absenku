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
                            Data Cuti
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
                                    <th>ID</th>
                                    <th>Dari Tanggal</th>
                                    <th>Sampai Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Kategori</th>
                                    <th>Users</th>
                                    <th>Perihal</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cutis as $cuti)
                                    <tr>
                                        <td>{{ $cuti->id }}</td>
                                        <td>{{ $cuti->dari_tanggal }}</td>
                                        <td>{{ $cuti->sampai_tanggal }}</td>
                                        <td>{{ $cuti->keterangan }}</td>
                                        <td>{{ $cuti->kategori }}</td>
                                        <td>{{ $cuti->user->nama }}</td>
                                        <td>{{ $cuti->perihal }}</td>
                                        <td>{{ $cuti->created_at }}</td>
                                        <td>{{ $cuti->status }}</td>
                                        <td><a href="{{$cuti->file}}"><button class="btn btn-primary btn-sm">Show</button></a></td>
                                        <td>
                                            <?php
                                            // if($cuti->status != "Approve" && $cuti->status != "Reject"){
                                            ?>
                                            <form action="{{ route('cuti.approve', $cuti->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                
                                            </form>
                                            <form action="{{ route('cuti.reject', $cuti->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                            <?php
                                            // }
                                            ?>
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
