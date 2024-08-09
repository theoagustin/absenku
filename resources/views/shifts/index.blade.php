@include('../template/headersite') 
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')
    
    <div class="app-main p-t-1 m-0 ">
        @include('../template/part/nav-menu')
        
        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Shift List
                            <a href="{{ route('shifts.create') }}" class="btn btn-primary" style="float: right;">
                                Create Shift
                            </a>
                        </h5>
                        <div class="divider"></div>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shifts as $shift)
                                <tr>
                                    <td>{{ $shift->nama_shift }}</td>
                                    <td>{{ $shift->jam_masuk }}</td>
                                    <td>{{ $shift->jam_keluar }}</td>
                                    <td>
                                        <a href="{{ route('shifts.edit', $shift->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
</div>
@include('../template/footersite') 
