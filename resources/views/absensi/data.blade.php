<div class="main-card mb-2 card" >
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
<?php $absenmasuk_today="Belum Absen";
$absenkeluar_today="Belum Absen";
$jsakit=0;
$jizin=0;

$jhadir=0;
?>

@forelse($absensi as $absen)
<?php 
$today=date('Y-m-d');
if($today=="$absen->tanggal" and "$absen->jam_masuk"<>''){
	$absenmasuk_today="Sudah Absen";
	
}else{
	$absenmasuk_today="Belum Absen";
}
if($today=="$absen->tanggal" and "$absen->jam_keluar"<>''){
	$absenkeluar_today="Sudah Absen";
}else{
	$absenkeluar_today="Belum Absen";
}
if("$absen->status_kehadiran"=="h"){
	$jhadir++;
}
if("$absen->status_kehadiran"=="s"){
	$jsakit++;
}
if("$absen->status_kehadiran"=="i"){
	$jizin++;
}
?>

@empty
@endforelse
<div class="divider"></div>
<div class="row">
<div class="col-sm-6  mt-1 p-2">
    <div class="card alert-danger">
        <div class="card-body">
            <h6 class="card-title mb-0">Absen Masuk</h6>
            <hr class="m-0">
            <p class="m-0"><?php echo $absenmasuk_today;?></p>
        </div>
    </div>
</div>
<div class="col-sm-6  mt-1 p-2">
    <div class="card alert-warning">
        <div class="card-body">
            <h6 class="card-title mb-0">Absen Keluar</h6>
            <hr class="m-0">
            <p class="m-0"><?php echo $absenkeluar_today;?></p>
        </div>
    </div>
</div>
</div>

<hr>
<div class="row">
<div class="col-sm-12">
<h6>Absensi Bulan <?php echo date('M Y');?></h6>
</div>
<div class="col-sm-3  mt-1">
    <div class="card alert-success">
        <div class="card-body p-2">
        
        <b>Hadir</b>
        <hr class="m-0">
            <p class="m-0"> <?php echo $jhadir;?> Hari</p>
        </div>
    </div>
</div>
<div class="col-sm-3  mt-1">
    <div class="card alert-info">
        <div class="card-body p-2">
           <b>Izin</b>
           <hr class="m-0">
            <p class="m-0">  <?php echo $jizin;?> Hari</p>
        </div>
    </div>
</div>
<div class="col-sm-3 mt-1">
    <div class="card bg-warning ">
        <div class="card-body p-2">
           <b>Sakit</b>
           <hr class="m-0">
            <p class="m-0"> <?php echo $jsakit;?> Hari</p>
        </div>
    </div>
</div>
<div class="col-sm-3 mt-1">
    <div class="card alert-danger">
        <div class="card-body p-2">
           <b>Terlambat</b>
           <hr class="m-0">
            <p class="m-0"> Hari</p>
        </div>
    </div>
</div>
</div>
<hr>
<div class="row">
<h6 class="card-title ml-2">1 Minggu Terakhir</h6>
<div class="col-sm-12  mt-1 p-2">
    <div class="card alert-warning">
        <div class="card-body">
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
                                      Laporan mingguan belum tersedia.
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


<!-- MODAL-->
<div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalMdTitle"></h4>
                  </div>
                  <div class="modal-body">
                      <div class="modalError"></div>
                      <div id="modalMdContent">
                      HALLO
                      
                      <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
@csrf
@METHOD('PUT')
<table id="tabasen" width="100%" border="0" cellspacing="0" cellpadding="0" style="display:none;">
  <tr>
    <td colspan="3"><strong>Selamat Datang</strong></td>
    </tr>
    @forelse ($datakaryawan as $row)
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td>{{$row->nama}}</td>
  </tr>
  <tr>
    <td>Bagian</td>
    <td>:</td>
    <td>{{$row->nama_bagian}}</td>
  </tr>
  <tr>
    <td>Posisi</td>
    <td>:</td>
    <td>{{$row->nama_posisi}}</td>
  </tr>
  <?php //$lat_p=number_format("$data->latitude",7);$lan_p=number_format("$data->langitude",7);
  $lat_p="$data->latitude";$lan_p="$data->langitude";
 // echo $lat_p.",".$lan_p;?>
  
  @empty
  @endforelse
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
 
  <tr>
    <td colspan="3"><strong>Jadwal Absensi</strong></td>
    </tr>
  <tr>
    <td width="20%">Hari</td>
    <td width="0%">:</td>
    <td width="80%"><?php echo date('l');?></td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td>:</td>
    <td><?php echo date('d-m-Y');?></td>
  </tr>
  <tr>
    <td>
     </td>
    <td>&nbsp;</td>
    <td><input type="hidden" class="form-control @error('lat') is-invalid @enderror" name="lat" value="{{ old('lat') }}" id="lat"/>
    <input type="hidden" class="form-control @error('lan') is-invalid @enderror" name="lan" value="{{ old('lan') }}" id="lan"/>
    <input type="hidden" class="form-control" name="id_karyawan" rows="5" value="{{$data->id}}" id="id_karyawan"/>
    
    
    <input type="hidden" class="form-control" name="jarak" rows="5" value="{{$data->max_jarak_absen}}" id="jarak"/></td>
  </tr>
  @foreach($absensi as $cek_absen)
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
   
    <?php $cek="$cek_absen->id";?>
    <?php if($cek==''){
		$act='new';?>
    <button type="submit" id="save" class="btn btn-md btn-primary">Absen Masuk</button>
    <?php }else{
		$act='edit';?>
    
    <button type="submit" id="update" class="btn btn-md btn-danger">Absen Keluar</button>
    <?php }?>
    <input type="hidden" class="form-control" name="idabsen" rows="5" value="<?php echo $cek;?>" id="idabsen"/>
    </td>
  </tr>
  
    @endforeach
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"> <div id="message"></div></td>
  </tr>
  <tr>
    <td colspan="3">Lokasi Anda Terkini</td>
  </tr>
  <tr>
    <td colspan="3">
<div id="googleMap" style="height:180px;">Maps Here</div></td>
  </tr>
</table>
</form>
                      
                      
                      </div>
                  </div>
              </div>
          </div>
        </div>
<!-- END MODAL-->
<script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>
    
<script>
$(document).on('ajaxComplete ready', function () {
    $('.modalMd').off('click').on('click', function () {
        $('#modalMdContent').load($(this).attr('value'));
        $('#modalMdTitle').html($(this).attr('title'));
    });
});
</script>