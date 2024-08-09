<?php include'../index.php';
$tbname='posisi';
if($_GET['act']=='edit'){
	foreach($conn->get_results("select *from $tbname where id='$_GET[id]'")as $data);
	
}
?>
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Form Data Posisi/ Jabatan</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form class="" id="FormData">
    <div class="position-relative row form-group">
        <label for="role_name" class="col-sm-3 col-form-label">Nama Bagian</label>
        <div class="col-sm-9">
            <select name="nama_bagian" id="nama_bagian" class="form-control">
            <?php foreach(list_bagian() as $nlist=>$lbg){
				
				echo '<option value="'.$lbg['id'].'">'.$lbg['nama_bagian'].'</option>';
				
				 }?>
            </select>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Posisi/ Jabatan</label>
        <div class="col-sm-9">
            <input name="nama_posisi" id="nama_posisi" type="text" class="form-control" value="<?php echo $data['nama_posisi'];?>">
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Jenis Gaji</label>
        <div class="col-sm-9">
            <select name="jenis_gaji" id="jenis_gaji" class="form-control">
            <?php foreach(list_jenis_gaji() as $nlist=>$ljg){
				
				echo '<option value="'.$ljg['id'].'">'.$ljg['jenis_gaji'].'</option>';
				
				 }?>
            </select>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Gaji Pokok</label>
        <div class="col-sm-9">
            <input name="gaji_pokok" id="gaji_pokok" type="number" class="form-control" value="<?php echo $data['gaji_pokok'];?>">
        </div>
    </div>
    
    <div class="position-relative row form-group" id="bxlembur" style="display:none;">
        <label for="role_level" class="col-sm-3 col-form-label">Gaji Lembur per Jam</label>
        <div class="col-sm-9">
            <input name="gaji_lembur_perjam" id="gaji_lembur_perjam" type="number" class="form-control" value="<?php echo $data['gaji_lembur_perjam'];?>">
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
$(document).ready(function(e) {
    $('#jenis_gaji').change(function(e) {
        var jg=$(this).val();
		if(jg==3 || jg==4){
		$('#bxlembur').show();	
		}else{
			
		$('#bxlembur').hide();
		}
    });
});
function SaveData(){
	 var url ="<?php echo './base/posisi/act.php?act=new';?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data,
							success: function(response){
								$('#loadfile').load('./base/posisi/data.php');
								
								$('.preloader3').hide();
							}
						});	
}

function EditData(){
	 var url ="<?php echo './base/posisi/act.php?act=edit&id='.$_GET['id'];?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data,
							success: function(response){
							$('#loadfile').load('./base/posisi/data.php');
								$('.preloader3').hide();
							}
						});	
}
</script>

