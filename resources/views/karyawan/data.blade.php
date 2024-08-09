<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Data Karyawans
<div style="float:right;"><a href="{{ route('karyawan.create') }}"><button type="button" id="addnew" class="btn-shadow  btn btn-info"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus fa-w-20"></i></span> Data baru </button></a></div>
</h5>
<div class="divider"></div>
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="8%"></th>
                      <th width="2%">No</th>
                      <th width="14%">Nama</th>
                      <th width="3%">L/P</th>
                      <th width="16%" hidden>Nik</th>
                      <th width="7%" hidden>Telp</th>
                      <th width="7%" hidden>Email</th>
                      <th width="7%" hidden>NPWP</th>
                      <th width="7%" hidden>Alamat</th>
                      <th width="7%">Perusahaan</th>
                      <th width="7%">Bagian</th>
                      <th width="12%">Posisi</th>
                      <th width="12%">Mulai Bekerja</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1;
				  ?>
                  @forelse ($data as $data)
                  <?php 
				  $id="$data->id";?>
                    <tr>
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('karyawan.destroy', $data->id) }}" method="POST">
                      <td><a href="{{ route('karyawan.edit', $data->id) }}" title="Edit" ><i class="fa fa-edit fa-w-20"></i></a> || <a href="{{ route('karyawan.show', $data->id) }}"  title="Show Detail"><i class="fa fa-eye fa-w-20"></i></a> || <a href="#" title="delete"><button type="submit" class="btn btn-xs"><i class="fa fa-times fa-w-20 text-danger"></i></button></a></td>
                      @csrf
                      @method('DELETE')
                      </form>
                      <td><?php echo $no;?></td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->jekel }}</td>
                      <td hidden>{{ $data->nik }}</td>
                      <td hidden>{{ $data->telp }}</td>
                      <td hidden>{{ $data->email }}</td>
                      <td hidden>{{ $data->npwp }}</td>
                      <td hidden>{{ $data->alamat }}</td>
                      <td>{{ $data->nama_perusahaan }}</td>
                      <td>{{ $data->nama_bagian }}</td>
                      <td>{{ $data->nama_posisi }}</td>
                      <td>{{date('d-m-Y',strtotime($data->tgl_mulai_bekerja))}}</td>
                     
                    </tr>
                    <?php $no++;?>
                    @empty
                                  <div class="alert alert-danger">
                                      Data Karyawan belum Tersedia.
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
