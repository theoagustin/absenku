<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Data Karyawan
<div style="float:right;"><button type="button" id="addnew" data-toggle="modal" data-target=".bd-example-modal-lg"   class="btn-shadow  btn btn-info"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus fa-w-20"></i></span> Data baru </button></div>
</h5>
<div class="divider"></div>
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="7%"></th>
                      <th width="4%">No</th>
                      <th width="26%">Nama Perusahaan</th>
                      <th width="23%">Bidang</th>
                      <th width="14%">Owner</th>
                      <th width="13%">Telp</th>
                      <th width="13%"> Karyawan</th>
                     
                      <th width="13%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1;?>
                  @forelse ($posts as $data)
                    <tr>
                      <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="OpenFEdit('<?php //echo $id;?>');"><i class="fa fa-edit fa-w-20"></i></a> || <a href="#" onclick="DeleteData('<?php //echo $id;?>');"><i class="fa fa-times fa-w-20 text-danger"></i></a></td>
                      <td><?php echo $no;?></td>
                      <td>{{ $data->title }}</td>
                      <td>{{ $data->content }}</td>
                      <td><?php //echo $row['owner'];?></td>
                      <td><?php //echo $row['telp'];?></td>
                      <td><?php //echo $jml_karyawan[$row['id']];?></td>
                     
                    </tr>
                    <?php $no++;?>
                    @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                  </tbody>
                 
                </table>
     
<div class="divider"></div>
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
