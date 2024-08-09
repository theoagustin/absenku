@include('../template/headersite') 
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')
    
    <div class="app-main p-t-1 m-0 ">
        @include('../template/part/nav-menu')
        
        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Shift</h5>
                        <form action="{{ route('shifts.update', $shift->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_shift">Shift Name</label>
                                <input type="text" class="form-control" id="nama_shift" name="nama_shift" value="{{ $shift->nama_shift }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jam_masuk">Start Time</label>
                                <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="{{ $shift->jam_masuk }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jam_keluar">End Time</label>
                                <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="{{ $shift->jam_keluar }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
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