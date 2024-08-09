@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header')
      
      <div class="app-main p-t-1 m-0 ">
 @include('../template/part/nav-menu')
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
   <div class="main-card mb-3 card" >
<div class="card-body">
   <h5 class="card-title">Form Entry Karyawan
   <div style="float:right;"><button type="button" onClick="window.history.back();" class="btn-shadow btn btn-md btn-success"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-arrow-left fa-w-20"></i></span> Back </button></div></h5>
   <hr>
                        <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                <select id="id_perusahaan" name="id_perusahaan" class="form-control @error('id_perusahaan') is-invalid @enderror">
                           		 @foreach($perusahaan AS $rp)
                                  <option value="{{ $rp->id }}" >{{ $rp->nama_perusahaan }}</option>
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
                                <select class="form-control @error('id_bagian') is-invalid @enderror" id="id_bagian" name="id_bagian">
                                  @foreach($bagian AS $lbagian)
                                  <option value="{{ $lbagian->id }}" >{{ $lbagian->nama_bagian }}</option>
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
                                <select class="form-control @error('id_posisi') is-invalid @enderror" id="id_posisi" name="id_posisi">
                                  @foreach($posisi AS $lposisi)
                                  <option value="{{ $lbagian->id }}" >{{ $lbagian->nama_bagian }}</option>
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
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Karyawan">
                            
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">NIK</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK KTP">
                            
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
                                <input type="radio" class="@error('jekel') is-invalid @enderror" name="jekel" value="L"> Laki-Laki
                                <input type="radio" class=" @error('jekel') is-invalid @enderror" name="jekel" value="P" > Perempuan 
                            
                                <!-- error message untuk title -->
                                @error('gaji_pokok')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Alamat</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat Lengkap">
                            
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
                                <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" placeholder="Masukkan Nama Karyawan">
                            
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
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Karyawan">
                            
                                <!-- error message untuk title -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">NPWP</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control @error('npwp') is-invalid @enderror" name="npwp" value="{{ old('npwp') }}" placeholder="NPWP Karyawan">
                            
                                <!-- error message untuk title -->
                                @error('npwp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Tanggal Mulai Bekerja</label>
                                <div class="col-sm-10">
                                <input type="date" class="form-control @error('tgl_mulai_bekerja') is-invalid @enderror" name="tgl_mulai_bekerja" value="{{ old('tgl_mulai_bekerja') }}" placeholder="dd/mm/yyyy">
                            
                                <!-- error message untuk title -->
                                @error('tgl_mulai_bekerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>


                            <button type="submit" class="btn btn-md btn-primary">SUBMIT</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

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
    <?php //include "part/nav-right.php";?>
    <script>
document.getElementById('id_perusahaan').addEventListener('change', function () {
    var provinceId = this.value;
    fetch('/get-cities/${id_perusahaan}')
        .then(response => response.json())
        .then(data => {
            var cmbBagian = document.getElementById('id_bagian');
            cmbBagian.innerHTML = '';
            data.forEach(function (bagian) {
                var option = document.createElement('option');
                option.value = bagian.id;
                option.textContent = bagian.nama_bagian;
                cmbBagian.appendChild(option);
            });
        });
});
</script>
 @include('../template/part/nav-right')
@include('../template/footersite') 
 