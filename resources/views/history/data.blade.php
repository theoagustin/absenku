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
<a href="" class="btn btn-sm btn-warning"><i class="lnr-list" style="font-size:32px; text-align:center;"></i>
<div style="font-size:11px;">Hist</div></a>
<a href="{{ route('idcard.index') }}" class="btn btn-sm btn-success"><i class="lnr-license" style="font-size:30px; text-align:center;"></i>
<div>Card</div></a>
<a href="{{ route('profile.index') }}" class="btn btn-sm btn-danger"><i class="lnr-user" style="font-size:30px; text-align:center;"></i>
<div style="font-size:11px;">Profile</div></a>
</div>
<hr>
<div class="row">
<h6 class="card-title ml-2">History</h6>
<div class="col-sm-12  mt-1 p-2">
    <div class="card alert-warning">
        <div class="card-body">
 
                  <?php $no=1;
				  ?>
                  <table width="100%" id="absensi" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr align="center">
                      <th width="2%" align="center">No</th>
                      <th width="14%" align="center">Tanggal</th>
                      <th width="49%" align="center">Status</th>
                      <th width="15%" align="center">Jam Masuk</th>
                      <th width="20%" align="center">Jam Pulang</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1;
				  ?>
                  @forelse ($absensi_mingguan as $data)
                  <?php 
				  $id="$data->id";
				  if("$data->status_kehadiran"=="h")$status_hadir="Hadir";
				  if("$data->status_kehadiran"=="i")$status_hadir="Izin";
				  if("$data->status_kehadiran"=="s")$status_hadir="Sakit";
				  ?>
                    <tr>
                      <td class="p-1" align="center"><?php echo $no;?></td>
                      <td class="p-1" align="center">{{ date('d-m-Y',strtotime($data->tanggal)) }}</td>
                      <td class="p-1" align="center">{{ $status_hadir }}</td>
                      <td class="p-1" align="center">{{ $data->jam_masuk }}</td>
                      <td class="p-1" align="center">{{ $data->jam_keluar }}</td>
                    </tr>
                    <?php $no++;?>
                    @empty
                                  <div class="alert alert-danger">
                                      Data history belum tersedia.
                                  </div>
                              @endforelse
                  </tbody>
                 
                </table>
                 
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
    
