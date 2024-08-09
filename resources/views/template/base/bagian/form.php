<?php include'../index.php';
$tbname='bagian';
if($_GET['act']=='edit'){

	foreach($conn->get_results("select *from $tbname where id='$_GET[id]'")as $data);
	//foreach($conn->get_results("select *from perusahaan where id='".id_perusahaan."'")as $data);
}
?>
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Form Data Bagian</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form class="" id="FormData">

    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-2 col-form-label">Nama Bagian</label>
        <div class="col-sm-10">
            <input name="nama_bagian" id="nama_bagian"  type="text" class="form-control" value="<?php echo $data['nama_bagian'];?>">
        </div>
    </div>
    
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <?php if($_GET['act']=='edit'){?>
        <button type="button" onclick="EditData();" class="btn btn-primary">Update data</button>
        <?php }else{?>
        <button type="button" onclick="SaveData();" class="btn btn-primary">Save data</button>
        <?php }?>
    </div>
</form>
<script>
function SaveData(){
	 var url ="<?php echo './base/bagian/act.php?act=new';?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data,
							success: function(response){
								$('#loadfile').load('./base/bagian/data.php');
								
								$('.preloader3').hide();
							}
						});	
}

function EditData(){
	 var url ="<?php echo './base/bagian/act.php?act=edit&id='.$_GET['id'];?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data,
							success: function(response){
							$('#loadfile').load('./base/bagian/data.php');
								$('.preloader3').hide();
							}
						});	
}
</script>

