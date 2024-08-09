<?php include'../index.php';
$tbname='karyawan';
if(role>=2){
$filter=" WHERE idusers='".idusers."' ";
}
foreach($conn->get_results("select *from perusahaan $filter")as $rpr){
	$perusahaan[$rpr['id']]=$rpr['nama_perusahaan'];
}
foreach($conn->get_results("select *from bagian $filter")as $rbg){
	$bagian[$rbg['id']]=$rbg['nama_bagian'];
}
foreach($conn->get_results("select *from posisi $filter")as $rps){
	$posisi[$rps['id']]=$rps['nama_posisi'];
}

?>
<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Data Karyawan
<div style="float:right;"><button type="button" id="addnew" data-toggle="modal" data-target=".bd-example-modal-lg"   class="btn-shadow  btn btn-info"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus fa-w-20"></i></span> Data baru </button></div>
</h5>
<div class="divider"></div>
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="11%"></th>
                      <th width="2%">No</th>
                      <th width="14%">Nama</th>
                      <th width="3%">L/P</th>
                      <th width="16%">Nik</th>
                      <th width="7%">Telp</th>
                      <th width="7%">Email</th>
                      <th width="7%">NPWP</th>
                      <th width="7%">Alamat</th>
                      <th width="7%">Perusahaan</th>
                      <th width="7%">Bagian</th>
                      <th width="12%">Posisi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $no=1;
				  foreach($conn->get_results("select *from $tbname $filter ORDER BY id ASC")as $row){
					  $id=$row['id'];
					  ?>
                    <tr>
                      <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="OpenFEdit('<?php echo $id;?>');"><i class="fa fa-edit fa-w-20"></i></a> || <a href="#" onclick="DeleteData('<?php echo $id;?>');"><i class="fa fa-times fa-w-20 text-danger"></i></a></td>
                      <td><?php echo $no;?></td>
                      <td><?php echo $row['nama'];?></td>
                      <td><?php echo $row['jekel'];?></td>
                      <td><?php echo $row['nik'];?></td>
                      <td><?php echo $row['telp'];?></td>
                      <td><?php echo $row['email'];?></td>
                      <td><?php echo $row['npwp'];?></td>
                      <td><?php echo $row['alamat'];?></td>
                      <td><?php echo $perusahaan[$row['id_perusahaan']];?></td>
                      <td><?php echo $bagian[$row['id_bagian']];?></td>
                      <td><?php echo $posisi[$row['id_posisi']];?></td>
                    </tr>
                    <?php $no++;
					}?>
                  </tbody>
                 
                </table>
     
<div class="divider"></div>
</div>
</div>




<script>
$('#addnew').click(function(e) {
	 
   $('#loadform').load('./base/karyawan/form.php'); 
});
function OpenFEdit(x) {
 var url ="<?php echo './base/karyawan/form.php?act=edit&id=';?>"+x; 
 
				$.ajax({
							type:'POST',
							url:url,
							data:'',
							success: function(response){
								$('#loadform').load(url);
								
								$('.preloader3').hide();
							}
						});
}

function DeleteData(x) {
 var url ="<?php echo './base/karyawan/act.php?act=del&id=';?>"+x; 
 
				$.ajax({
							type:'POST',
							url:url,
							data:'',
							success: function(response){
								$('#loadfile').load('./base/karyawan/data.php');
								
								$('.preloader3').hide();
							}
						});
}
</script>
