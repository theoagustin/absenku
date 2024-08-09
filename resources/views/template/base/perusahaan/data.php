<?php include'../index.php';
$tbname='perusahaan';
foreach($conn->get_results("select count(id) as jkry,id_perusahaan from karyawan where idusers='".idusers."' GROUP BY id_perusahaan")as $rpr){
	$jml_karyawan[$rpr['id_perusahaan']]=$rpr['jkry'];
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
                      <th width="7%"></th>
                      <th width="4%">No</th>
                      <th width="26%">Nama Perusahaan</th>
                      <th width="23%">Bidang</th>
                      <th width="14%">Owner</th>
                      <th width="13%">Telp</th>
                      <th width="13%"> Karyawan</th>
                      <?php if(role==1){?>
                      <th width="13%">Status</th>
                      <?php }?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $no=1;
				  foreach($conn->get_results("select *from $tbname ORDER BY id ASC")as $row){
					  $id=$row['id'];
					  if($row['approv']=='Y'){
						  $sely[$row['id']]="checked";
					  }elseif ($row['approv']=='N'){
						  
						  $seln[$row['id']]="checked";
					  }else{
						   $sely[$row['id']]="";
						    $seln[$row['id']]="";
					  }
					  ?>
                    <tr>
                      <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="OpenFEdit('<?php echo $id;?>');"><i class="fa fa-edit fa-w-20"></i></a> || <a href="#" onclick="DeleteData('<?php echo $id;?>');"><i class="fa fa-times fa-w-20 text-danger"></i></a></td>
                      <td><?php echo $no;?></td>
                      <td><?php echo $row['nama_perusahaan'];?></td>
                      <td><?php echo $row['bidang'];?></td>
                      <td><?php echo $row['owner'];?></td>
                      <td><?php echo $row['telp'];?></td>
                      <td><?php echo $jml_karyawan[$row['id']];?></td>
                     <?php if(role==1){?>
                      <td><input type="radio" name="y<?php echo $row['id'];?>" id="n<?php echo $row['id'];?>" onclick="Approve('<?php echo $row['id'].":Y";?>');" <?php echo  $sely[$row['id']];?>/> Terima <input type="radio" name="y<?php echo $row['id'];?>" id="n<?php echo $row['id'];?>" onclick="Approve('<?php echo $row['id'].":N";?>');" <?php echo  $seln[$row['id']];?>/> Tolak </td>
                      <?php }?>
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
	 
   $('#loadform').load('./base/perusahaan/form.php'); 
});
function OpenFEdit(x) {
 var url ="<?php echo './base/perusahaan/form.php?act=edit&id=';?>"+x; 
 
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

function Approve(x) {
 var url ="<?php echo './base/perusahaan/approv.php?data=';?>"+x; 
 
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
 var url ="<?php echo './base/perusahaan/act.php?act=del&id=';?>"+x; 
 
				$.ajax({
							type:'POST',
							url:url,
							data:'',
							success: function(response){
								$('#loadfile').load('./base/perusahaan/data.php');
								
								$('.preloader3').hide();
							}
						});
}
</script>
