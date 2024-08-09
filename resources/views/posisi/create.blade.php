@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header');
      
      <div class="app-main p-t-1 m-0 ">
 @include('../template/part/nav-menu');
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
   <div class="main-card mb-3 card" >
<div class="card-body">
   <h5 class="card-title">Form Entry Posisi Bagian
   <div style="float:right;"><button type="button" onClick="window.history.back();" class="btn-shadow btn btn-md btn-success"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-arrow-left fa-w-20"></i></span> Back </button></div></h5>
   <hr>
                        <form action="{{ route('posisi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">Nama Perusahaan</label>
                            <select id="id_perusahaan" name="id_perusahaan" class="form-control">
                            @foreach($perusahaan AS $rp)
  <option value="{{ $rp->id }}">{{ $rp->nama_perusahaan }}</option>
  @endforeach
 
</select>


                                <!-- error message untuk title -->
                                @error('id_perusahaan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Bagian</label>
                                <select class="form-control" id="id_bagian" name="course">
                                  @foreach($bagian AS $lbagian)
                                  <option value="{{ $lbagian->id }}">{{ $lbagian->nama_bagian }}</option>
                                  @endforeach
                                </select>
                                <!-- error message untuk title -->
                                @error('id_bagian')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Gaji</label>
                                <input type="text" class="form-control @error('jenis_gaji') is-invalid @enderror" name="jenis_gaji" value="{{ old('jenis_gaji') }}" placeholder="Masukkan Jenis Gaji Mis: Bulanan,Mingguan,Harian,Per Jam">
                            
                                <!-- error message untuk title -->
                                @error('jenis_gaji')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Gaji Pokok</label>
                                <input type="text" class="form-control @error('gaji_pokok') is-invalid @enderror" name="gaji_pokok" value="{{ old('gaji_pokok') }}" placeholder="Masukkan Gaji Pokok">
                            
                                <!-- error message untuk title -->
                                @error('gaji_pokok')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Gaji Lembur perjam</label>
                                <input type="text" class="form-control @error('gaji_lembur_perjam') is-invalid @enderror" name="gaji_lembur_perjam" value="{{ old('gaji_lembur_perjam') }}" placeholder="Masukkan Jumlah Gajji Lembur Perjam">
                            
                                <!-- error message untuk title -->
                                @error('gaji_lembur_perjam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-md btn-primary">SUBMIT</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
    
   
</div>
          <div class="app-wrapper-footer">
 
 @include('../template/part/nav-bottom');
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
 @include('../template/part/nav-right');
@include('../template/footersite') 
 