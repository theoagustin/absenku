<?php include'../index.php';?>
<div class="main-card mb-3 card">
<div class="card-body">
<h5 class="card-title">Data Role Access
<div style="float:right;"><button type="button" id="addnew" data-toggle="modal" data-target=".bd-example-modal-lg"   class="btn-shadow  btn btn-info"><span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus fa-w-20"></i></span> Data baru </button></div>
</h5>
<div class="divider"></div>
                <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="8%"></th>
                      <th width="4%">No</th>
                      <th width="77%">Role Access</th>
                      <th width="11%">Level</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  $no=1;
				  foreach($conn->get_results("select *from role ORDER BY role_level ASC")as $row){
					  $id=$row['id'];
					  ?>
                    <tr>
                      <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="OpenFEdit('<?php echo $id;?>');"><i class="fa fa-edit fa-w-20"></i></a> || <a href="#" onclick="DeleteData('<?php echo $id;?>');"><i class="fa fa-times fa-w-20 text-danger"></i></a></td>
                      <td><?php echo $no;?></td>
                      <td><?php echo $row['role_name'];?></td>
                      <td><?php echo $row['role_level'];?></td>
                    </tr>
                    <?php $no++;
					}?>
                  </tbody>
                 
                </table>
</div>
</div>




<script>
$('#addnew').click(function(e) {
	 
   $('#loadform').load('./base/role/form.php'); 
});
function OpenFEdit(x) {
 var url ="<?php echo './base/role/form.php?act=edit&id=';?>"+x; 
 
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
 var url ="<?php echo './base/role/act.php?act=del&id=';?>"+x; 
 
				$.ajax({
							type:'POST',
							url:url,
							data:'',
							success: function(response){
								$('#loadfile').load('./base/role/data.php');
								
								$('.preloader3').hide();
							}
						});
}
</script>