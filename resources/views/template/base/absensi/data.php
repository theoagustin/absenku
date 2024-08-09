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
<h5 class="card-title">Data Absensi Karyawan
</h5>
<div class="divider"></div>
                <table width="100%" id="example" class="table table-hover table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th width="3%">No</th>
                      <th width="14%">Nik</th>
                      <th width="20%">Nama</th>
                      <th width="4%">L/P</th>
                      <th width="23%">Perusahaan</th>
                      <th width="12%">Bagian</th>
                      <th width="14%">Posisi</th>
                      <th width="10%">Action</th>
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
                      <td><?php echo $row['nik'];?></td>
                      <td><?php echo $row['nama'];?></td>
                      <td><?php echo $row['jekel'];?></td>
                      <td><?php echo $perusahaan[$row['id_perusahaan']];?></td>
                      <td><?php echo $bagian[$row['id_bagian']];?></td>
                      <td><?php echo $posisi[$row['id_posisi']];?></td>
                      <td><button type="button" onclick="OpenFEdit('<?php echo $id;?>');" data-toggle="modal" data-target=".bd-example-modal-lg"   class="btn-shadow  btn btn-info">Absen </button>
</td>
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
	 
   $('#loadform').load('./base/absensi/form.php'); 
});
function OpenFEdit(x) {
 var url ="<?php echo './base/absensi/form.php?act=edit&id=';?>"+x; 
 
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
 var url ="<?php echo './base/absensi/act.php?act=del&id=';?>"+x; 
 
				$.ajax({
							type:'POST',
							url:url,
							data:'',
							success: function(response){
								$('#loadfile').load('./base/absensi/data.php');
								
								$('.preloader3').hide();
							}
						});
}
</script>
