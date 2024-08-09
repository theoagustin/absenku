@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header')
      
      <div class="app-main p-t-1 m-0 ">
 @include('../template/part/nav-menu')
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
   <div class="main-card mb-3 card" >
<div class="card-body">
   <h5 class="card-title">Form Update Posisi Bagian
   <div style="float:right;"><button type="button" onClick="window.history.back();" class="btn-shadow btn btn-md btn-success"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-arrow-left fa-w-20"></i></span> Back </button></div></h5>
   <hr>
                        <form action="{{ route('posisi.update', $posisi->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">Nama Perusahaan</label>
                                <select id="id_perusahaan" name="id_perusahaan" class="form-control">
                           		 @foreach($perusahaan AS $rp)
                                  <option value="{{ $rp->id }}"  <?php if("$rp->id"=="$posisi->id_perusahaan"){echo "selected";}?>>{{ $rp->nama_perusahaan }}</option>
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
                                <select class="form-control" id="id_bagian" name="id_bagian">
                                  @foreach($bagian AS $lbagian)
                                  <option value="{{ $lbagian->id }}" <?php if("$lbagian->id"=="$posisi->id_bagian"){echo "selected";}?>>{{ $lbagian->nama_bagian }}</option>
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
                                <input type="text" class="form-control @error('jenis_gaji') is-invalid @enderror" name="jenis_gaji" value="{{ old('jenis_gaji',$posisi->jenis_gaji) }}" placeholder="Masukkan Nama Bagian">
                            
                                <!-- error message untuk title -->
                                @error('jenis_gaji')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Gaji Pokok</label>
                                <input type="text" class="form-control @error('gaji_pokok') is-invalid @enderror" name="gaji_pokok" value="{{ old('gaji_pokok',$posisi->gaji_pokok) }}" placeholder="Masukkan Nama Bagian">
                            
                                <!-- error message untuk title -->
                                @error('gaji_pokok')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Gaji Lembur perjam</label>
                                <input type="text" class="form-control @error('gaji_lembur_perjam') is-invalid @enderror" name="gaji_lembur_perjam" value="{{ old('gaji_lembur_perjam',$posisi->gaji_lembur_perjam) }}" placeholder="Masukkan Nama Bagian">
                            
                                <!-- error message untuk title -->
                                @error('gaji_lembur_perjam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
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
    <?php //include "part/nav-right.php";?>
    
 @include('../template/part/nav-right')
@include('../template/footersite') 
 