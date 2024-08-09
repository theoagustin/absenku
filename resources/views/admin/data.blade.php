<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Data Perusahaan
<div style="float:right;"><a href="{{ route('perusahaan.create') }}"><button type="button" id="addnew" class="btn-shadow  btn btn-info"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus fa-w-20"></i></span> Data baru </button></a></div>
</h5>
<div class="divider"></div>

                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="8%"></th>
                      <th width="3%">No</th>
                      <th width="26%">Nama Perusahaan</th>
                      <th width="20%">Bidang</th>
                      <th width="12%">Owner</th>
                      <th width="11%">Telp</th>
                      <th width="11%"> Email</th>
                      <th width="8%">Status</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1;
				  ?>
                  @forelse ($perusahaan as $data)
                  <?php 
				  $id="$data->id";?>
                    <tr>
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('perusahaan.destroy', $data->id) }}" method="POST">
                      <td><a href="{{ route('perusahaan.edit', $data->id) }}" ><i class="fa fa-edit fa-w-20"></i></a> || <a href="#" ><button type="submit" class="btn btn-xs"><i class="fa fa-times fa-w-20 text-danger"></i></button></a></td>
                      @csrf
                      @method('DELETE')
                      </form>
                      <td><?php echo $no;?></td>
                      <td>{{ $data->nama_perusahaan }}</td>
                      <td>{{ $data->bidang }}</td>
                      <td>{{ $data->owner }}</td>
                      <td>{{ $data->telp }}</td>
                      <td>{{ $data->email }}</td>
                      <td><?php if("$data->approv"==""){echo '<div class="alert alert-warning p-0 m-0"> Pending </div>';}elseif("$data->approv"=="N"){echo '<div class="alert alert-danger p-0 m-0"> Rejected </div>';}elseif("$data->approv"=="Y"){echo '<div class="alert alert-success p-0 m-0"> Approve </div>';}?></td>
                     
                    </tr>
                    <?php $no++;?>
                    @empty
                                  <div class="alert alert-danger">
                                      Data Perusahaan belum Tersedia.</br>Silahkan Klik Tombol +Data Baru untuk Registrasi Perusahaan Anda !
                                  </div>
                              @endforelse
                  </tbody>
                 
                </table>
     
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