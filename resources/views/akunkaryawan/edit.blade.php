@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header')
      
      <div class="app-main p-t-1 m-0 ">
 @include('../template/part/nav-menu')
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
   <div class="main-card mb-3 card" >
<div class="card-body">
   <h5 class="card-title">Form Update Akun Karyawan
   <div style="float:right;"><button type="button" onClick="window.history.back();" class="btn-shadow btn btn-md btn-success"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-arrow-left fa-w-20"></i></span> Back </button></div></h5>
   <hr>
   	@forelse($akunkaryawan as $rkar)
                        <form action="{{ route('akunkaryawan.update', $rkar->idusers) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Username</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username',$rkar->username) }}" >
                            
                                <!-- error message untuk title -->
                                @error('username')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="position-relative row form-group">
                                <label class="col-sm-2">Password</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('username',$rkar->pass_text) }}" >
                            
                                <!-- error message untuk title -->
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            


                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>

                        </form> 
                        @empty
                        @endforelse
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
 