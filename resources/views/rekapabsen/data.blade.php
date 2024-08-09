<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Laporan Rekap Absen
  <div style="float:right;"></div>
</h5>
<div class="divider"></div>

<div style="overflow:auto">
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="4%">No</th>
                      <th width="9%">Bulan</th>
                      <th width="23%">Nama</th>
                      <th width="10%">L/P</th>
                      <th width="18%">Bidang</th>
                      <th width="14%">Posisi/Jab</th>
                      <th width="6%">Hadir</th>
                      <th width="6%"> Sakit</th>
                      <th width="10%">Izin</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1;
				  ?>
                  @forelse ($datakaryawan as $data)
                  
                  <?php 
				  $id="$data->id";
				  ?>
                 
                  <tr>
                      <td><?php echo $no;?></td>
                      <td>{{$data->nama}}</td>
                      <td align="center">{{$data->jekel}}</td>
                      <td>{{$data->nama_bagian}}</td>
                      <td>{{$data->nama_posisi}}</td>
                      <td align="center"><?php echo $jhadir;?> </td>
                      <td align="center"><?php echo $jsakit;?> </td>
                      <td align="center"><?php echo $jizin;?> </td>
                     
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
