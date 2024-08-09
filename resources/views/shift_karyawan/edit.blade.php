@include('../template/headersite') 
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')
    
    <div class="app-main p-t-1 m-0 ">
        @include('../template/part/nav-menu')
        
        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Shift Assignment</h5>
                        <form action="{{ route('shift_karyawan.update', $shiftKaryawan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="id_karyawan">Employee</label>
                                <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                                    @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}" {{ $shiftKaryawan->id_karyawan == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_shift">Shift</label>
                                <select class="form-control" id="id_shift" name="id_shift" required>
                                    @foreach($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ $shiftKaryawan->id_shift == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->nama_shift }}
                                    </option>
                                    @endforeach
                                </select>
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
