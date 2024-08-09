<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Laporan Absensi
<div style="float:right;"></div>
</h5>
<div class="divider"></div>
<div style="overflow:auto">
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="3%">No</th>
                      <th width="17%">Tanggal</th>
                      <th width="21%">Nama</th>
                      <th width="5%">L/P</th>
                      <th width="13%">Bidang</th>
                      <th width="16%">Posisi/Jab</th>
                      <th width="16%">Status</th>
                      <th width="11%"> Masuk</th>
                      <th width="14%">Keluar</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1;
				  ?>
                  @forelse ($datakaryawan as $data)
                  
                  <?php 
				  $id="$data->id";
				  if($data->status_kehadiran=='h')$data->status_kehadiran="Hadir";
				  if($data->status_kehadiran=='i')$data->status_kehadiran="Izin";
				  if($data->status_kehadiran=='s')$data->status_kehadiran="Sakit";
				  ?>
                    <tr>
                      <td><?php echo $no;?></td>
                      <td>{{date('d-m-Y',strtotime($data->tanggal))}}</td>
                      <td>{{$data->nama}}</td>
                      <td>{{$data->jekel}}</td>
                      <td>{{$data->nama_bagian}}</td>
                      <td>{{$data->nama_posisi}}</td>
                      <td>{{$data->status_kehadiran}}</td>
                      <td>{{$data->jam_masuk}}</td>
                      <td>{{ $data->jam_keluar }}</td>
                     
                    </tr>
                    <?php $no++;?>
                    @empty
                                  <div class="alert alert-danger">
                                      Data Bagian belum Tersedia.
                                  </div>
                              @endforelse
                  </tbody>
                 
                </table>
     </div>
<div class="divider"></div>
</div>
</div>
<script>
function OpenFEdit(x) {
var url ="<?php echo url('resources/views/template/base/perusahaan/form');?>"; 
$('#containner').load(url);

}

</script>
    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>
