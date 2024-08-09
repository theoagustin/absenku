<style>
img {
  border-radius: 50%;
}
</style><div class="main-card mb-2 card" >
<div class="card-body mt-5">
<h5 class="card-title">Selamat Datang {{Auth::user()->nama}} !
</h5>
<div class="divider"></div>
<div align="center">
<a href="{{ route('absensi.index') }}" class="btn btn-sm btn-success"><i class="lnr-home" style="font-size:30px; text-align:center;"></i>
<div align="center" style="font-size:11px;">Home</div></a>
<a href="{{ route('absensi.create') }}" class="btn btn-sm btn-primary"><i class="lnr-pencil" style="font-size:30px; text-align:center;"></i>
<div align="center" style="font-size:11px;">Absen</div></a>
<a href="{{ route('cuti.index') }}" class="btn btn-sm btn-danger"><i class="lnr-calendar-full" style="font-size:30px; text-align:center;"></i>
<div style="font-size:11px;">Cuti</div></a>
<a href="{{ route('history.index') }}" class="btn btn-sm btn-warning"><i class="lnr-list" style="font-size:32px; text-align:center;"></i>
<div style="font-size:11px;">History</div></a>
<a href="{{ route('idcard.index') }}" class="btn btn-sm btn-success"><i class="lnr-license" style="font-size:30px; text-align:center;"></i>
<div>Card</div></a>
<a href="{{ route('profile.index') }}" class="btn btn-sm btn-danger"><i class="lnr-user" style="font-size:30px; text-align:center;"></i>
<div style="font-size:11px;">Profile</div></a>
</div>
<hr>
<div class="row">
<h6 class="card-title ml-2">ID CARD</h6>
<div class="col-sm-12  mt-1 p-2">
    <div class="card alert-warning">
        <div class="card-body">
 
                  <?php $no=1;
				  ?>
                  @forelse ($card as $data)
                  <div style="">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><img src="./images/uploads/users.png" width="122" height="142" class="btn-rounded" /></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><h5><b>{{$data->nama}}</b></h5></td>
  </tr>
  <tr>
    <td align="center"><div>Bagian </div><h6><b>{{$data->nama_bagian}}</b></h6></td>
  </tr>
  <tr>
    <td align="center"><div>Posisi </div> <h6><b>{{$data->nama_posisi}}</b></h6></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

                  </div>
                    @empty
                                  <div class="alert alert-danger">
                                      ID Card belum tersedia.
                                  </div>
                              @endforelse
                 
        </div>
    </div>
</div>
</div>
</div>
</div>


<script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>
    
