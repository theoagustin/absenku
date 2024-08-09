<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Data Bagian
<div style="float:right;"><a href="{{ route('posisi.create') }}"><button type="button" id="addnew" class="btn-shadow  btn btn-info"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus fa-w-20"></i></span> Data baru </button></a></div>
</h5>
<div class="divider"></div>
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="8%"></th>
                      <th width="6%">No</th>
                      <th width="24%">Nama Perusahaan</th>
                      <th width="16%">Bagian</th>
                      <th width="17%">Posisi</th>
                      <th width="13%">Gaji Pokok</th>
                      <th width="16%">Gaji Lembur / Jam</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1;
				  ?>
                  @forelse ($posisi as $data)
                  <?php 
				  $id="$data->id";?>
                    <tr>
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posisi.destroy', $data->id) }}" method="POST">
                      <td><a href="{{ route('posisi.edit', $data->id) }}" ><i class="fa fa-edit fa-w-20"></i></a> || <a href="#" ><button type="submit" class="btn btn-xs"><i class="fa fa-times fa-w-20 text-danger"></i></button></a></td>
                      @csrf
                      @method('DELETE')
                      </form>
                      <td><?php echo $no;?></td>
                      <td>{{ $data->nama_perusahaan }}</td>
                      <td>{{ $data->nama_bagian }}</td>
                      <td>{{ $data->nama_posisi }}</td>
                      <td>{{ $data->gaji_pokok }}</td>
                      <td>{{ $data->gaji_lembur_perjam }}</td>
                     
                    </tr>
                    <?php $no++;?>
                    @empty
                                  <div class="alert alert-danger">
                                      Data Posisi belum Tersedia.
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
