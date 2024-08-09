@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header');
      
      <div class="app-main p-t-1 m-0 ">
 @include('../template/part/nav-menu');
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
   <div class="main-card mb-3 card" >
<div class="card-body">
   <h5 class="card-title">Form Entry Bagian
   <div style="float:right;"><button type="button" onClick="window.history.back();" class="btn-shadow btn btn-md btn-success"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-arrow-left fa-w-20"></i></span> Back </button></div></h5>
   <hr>
                        <form action="{{ route('bagian.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label class="font-weight-bold">Nama Perusahaan</label>
                                <input type="text" class="form-control @error('id_perusahaan') is-invalid @enderror" name="id_perusahaan" value="{{ old('id_perusahaan') }}" placeholder="Masukkan Nama Perusahaan">
                            
                                <!-- error message untuk title -->
                                @error('id_perusahaan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Bagian</label>
                                <input type="text" class="form-control @error('nama_bagian') is-invalid @enderror" name="nama_bagian" value="{{ old('nama_bagian') }}" placeholder="Masukkan Nama Bagian">
                            
                                <!-- error message untuk title -->
                                @error('bidang')
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
    
 @include('../template/part/nav-right');
@include('../template/footersite') 
 