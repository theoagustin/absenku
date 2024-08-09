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
foreach($conn->get_results("select *from users ")as $rus){
	$usern[$rus['idusers']]=$rus['username'];
	$userp[$rus['idusers']]=$rus['pass_text'];
}

?>
<div class="main-card mb-3 card" >
<div class="card-body">
<h5 class="card-title">Data Akun Karyawan
<div style="float:right;"><button type="button" id="addnew" data-toggle="modal" data-target=".bd-example-modal-lg"   class="btn-shadow  btn btn-info"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus fa-w-20"></i></span> Buat Akun </button></div>
</h5>
<div class="divider"></div>
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="2%">No</th>
                      <th width="23%">Nama</th>
                      <th width="2%">L/P</th>
                      <th width="14%">Perusahaan</th>
                      <th width="13%">Bagian</th>
                      <th width="10%">Posisi</th>
                      <th width="14%">Username</th>
                      <th width="14%">Password</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $no=1;
				  foreach($conn->get_results("select *from $tbname $filter ORDER BY id ASC")as $row){
					  $id=$row['id'];
					  ?>
                    <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $row['nama'];?></td>
                      <td><?php echo $row['jekel'];?></td>
                      <td><?php echo $perusahaan[$row['id_perusahaan']];?></td>
                      <td><?php echo $bagian[$row['id_bagian']];?></td>
                      <td><?php echo $posisi[$row['id_posisi']];?></td>
                      <td><?php echo $usern[$row['idakun']];?></td>
                      <td><?php echo $userp[$row['idakun']];?></td>
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
	 
   $('#loadform').load('./base/akun_karyawan/form.php'); 
});
function OpenFEdit(x) {
 var url ="<?php echo './base/akun_karyawan/form.php?act=edit&id=';?>"+x; 
 
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
 var url ="<?php echo './base/akun_karyawan/act.php?act=del&id=';?>"+x; 
 
				$.ajax({
							type:'POST',
							url:url,
							data:'',
							success: function(response){
								$('#loadfile').load('./base/akun_karyawan/data.php');
								
								$('.preloader3').hide();
							}
						});
}
</script>
