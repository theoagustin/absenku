@include('../template/headersite')
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">


    @include('../template/part/nav-header')

    <div class="app-main p-t-1 m-0 ">
        @include('../template/part/nav-menu')
        <div class="app-main__outer p-t-0 m-t-0">
            <div class="app-main__inner m-0 p-1">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Form Update Data Karyawan
                            <div style="float:right;"><button type="button" onClick="window.history.back();"
                                    class="btn-shadow btn btn-md btn-success"><span
                                        class="btn-icon-wrapper pr-2 opacity-7"><i
                                            class="fa fa-arrow-left fa-w-20"></i></span> Back </button></div>
                        </h5>
                        <hr>
                        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <select id="id_perusahaan" name="id_perusahaan"
                                        class="form-control @error('id_perusahaan') is-invalid @enderror">
                                        @foreach ($perusahaan as $rp)
                                            <option value="{{ $rp->id }}" <?php if ("$rp->id" == "$karyawan->id_perusahaan") {
                                                echo 'selected';
                                            } ?>>
                                                {{ $rp->nama_perusahaan }}</option>
                                        @endforeach

                                    </select>
                                    <!-- error message untuk title -->
                                    @error('id_perusahaan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Nama Bagian</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('id_bagian') is-invalid @enderror" id="id_bagian"
                                        name="id_bagian">
                                        @foreach ($bagian as $lbagian)
                                            <option value="{{ $lbagian->id }}" <?php if ("$lbagian->id" == "$karyawan->id_bagian") {
                                                echo 'selected';
                                            } ?>>
                                                {{ $lbagian->nama_bagian }}</option>
                                        @endforeach
                                    </select>

                                    <!-- error message untuk title -->
                                    @error('id_bagian')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Posisi/Jabatan</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('id_posisi') is-invalid @enderror" id="id_posisi"
                                        name="id_posisi">
                                        @foreach ($posisi as $lposisi)
                                            <option value="{{ $lposisi->id }}" <?php if ("$lposisi->id" == "$karyawan->id_posisi") {
                                                echo 'selected';
                                            } ?>>
                                                {{ $lposisi->nama_posisi }}</option>
                                        @endforeach
                                    </select>

                                    <!-- error message untuk title -->
                                    @error('id_posisi')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Nama Karyawan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ old('nama', $karyawan->nama) }}"
                                        placeholder="Masukkan Nama Karyawan">

                                    <!-- error message untuk title -->
                                    @error('nama')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label class="col-sm-2">NIK (Nomor Induk Karyawan)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        name="nik" value="{{ old('nik', $karyawan->nik) }}" inputmode="numeric"
                                        placeholder="Masukkan NIK">

                                    <!-- error message untuk title -->
                                    @error('nik')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    @php
                                        $genders = ['L' => 'Laki-Laki', 'P' => 'Perempuan'];
                                    @endphp

                                    @foreach ($genders as $value => $label)
                                        <input type="radio" class="@error('jekel') is-invalid @enderror" name="jekel" value="{{ $value }}" {{ old('jekel', $karyawan->jekel) == $value ? 'checked' : '' }}> {{ $label }}
                                    @endforeach

                                    <!-- error message untuk title -->
                                    @error('jekel')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" value="{{ old('alamat', $karyawan->alamat) }}"
                                        placeholder="Masukkan Alamat Lengkap">

                                    <!-- error message untuk title -->
                                    @error('alamat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Telp/Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                        name="telp" value="{{ old('telp', $karyawan->telp) }}"
                                        placeholder="Masukkan Nama Karyawan">

                                    <!-- error message untuk title -->
                                    @error('telp')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', $karyawan->email) }}"
                                        placeholder="Email Karyawan">

                                    <!-- error message untuk title -->
                                    @error('email')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Tanggal Mulai Bekerja</label>
                                <div class="col-sm-10">
                                    <input type="date"
                                        class="form-control @error('tgl_mulai_bekerja') is-invalid @enderror"
                                        name="tgl_mulai_bekerja"
                                        value="{{ old('tgl_mulai_bekerja', $karyawan->tgl_mulai_bekerja) }}"
                                        placeholder="dd/mm/yyyy">

                                    <!-- error message untuk title -->
                                    @error('tgl_mulai_bekerja')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>

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
<?php //include "part/nav-right.php";
?>

@include('../template/part/nav-right')
@include('../template/footersite')
