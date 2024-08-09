@include('../template/headersite')

<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('../template/part/nav-header')

    <div class="app-main p-t-1 m-0">
        @include('../template/part/nav-menu')

        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Lembur</h5>
                        <hr>

                        <form action="{{ route('lembur.update', $lembur->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="id_karyawan">Nama Karyawan</label>
                                <select name="id_karyawan" id="id_karyawan" class="form-control">
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" {{ $karyawan->id == $lembur->id_karyawan ? 'selected' : '' }}>
                                            {{ $karyawan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_karyawan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tgl_lembur">Tgl. Pelaksanaan Lembur</label>
                                <input type="date" name="tgl_lembur" id="tgl_lembur" class="form-control" value="{{ old('tgl_lembur', $lembur->tgl_lembur) }}">
                                @error('tgl_lembur')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ old('jam_mulai', $lembur->jam_mulai) }}">
                                @error('jam_mulai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ old('jam_selesai', $lembur->jam_selesai) }}">
                                @error('jam_selesai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan_lembur">Keterangan Lembur</label>
                                <textarea name="keterangan_lembur" id="keterangan_lembur" class="form-control">{{ old('keterangan_lembur', $lembur->keterangan_lembur) }}</textarea>
                                @error('keterangan_lembur')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="upah_tambahan">Upah Tambahan</label>
                                <input type="number" name="upah_tambahan" id="upah_tambahan" class="form-control" value="{{ old('upah_tambahan', $lembur->upah_tambahan) }}">
                                @error('upah_tambahan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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

    @include('../template/part/nav-right')
    @include('../template/footersite')
</div>
