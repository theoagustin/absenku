<?php include'../index.php';
$tbname='karyawan';
if($_GET['act']=='edit'){
	foreach($conn->get_results("select *from $tbname where id='$_GET[id]'")as $data);
	
}
?>
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Form Data Karyawan</h5>
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
				if($lbg['id']==$data['id_bagian']){
					$sel="selected";
				}else{
					$sel="";
				}
				echo '<option value="'.$lbg['id'].'" '.$sel.'>'.$lbg['nama_bagian'].'</option>';
				
				 }?>
            </select>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Posisi/ Jabatan</label>
        <div class="col-sm-9">
            <select name="nama_posisi" id="nama_posisi" class="form-control">
            <?php foreach(list_posisi() as $nlist=>$lps){
				if($lps['id']==$data['id_posisi']){
					$sel="selected";
				}else{
					$sel="";
				}
				echo '<option value="'.$lps['id'].'" '.$sel.'>'.$lps['nama_posisi'].'</option>';
				
				 }?>
            </select>
        </div>
    </div>
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">NIK</label>
        <div class="col-sm-9">
            <input name="nik" id="nik" type="number" maxlength="16" class="form-control" value="<?php echo $data['nik'];?>">
        </div>
    </div>
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Nama Lengkap</label>
        <div class="col-sm-9">
            <input name="nama" id="nama" type="text" class="form-control" value="<?php echo $data['nama'];?>">
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-9">
           <select name="jekel" id="jekel" class="form-control">
            <?php foreach(list_jekel() as $nlist=>$ljk){
				
				if($ljk['id']==$data['jekel']){
					$sel="selected";
				}else{
					$sel="";
				}
				echo '<option value="'.$ljk['id'].'" '.$sel.'>'.$ljk['jekel'].'</option>';
				
				 }?>
            </select>
        </div>
    </div>
    
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Alamat</label>
        <div class="col-sm-9">
          <textarea name="alamat" class="form-control" id="alamat"><?php echo $data['alamat'];?></textarea>
        </div>
    </div>
    
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Telp/ Hp</label>
        <div class="col-sm-9">
            <input name="telp" id="telp" type="number" class="form-control" value="<?php echo $data['telp'];?>">
        </div>
    </div>
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input name="email" id="email" type="email" class="form-control" value="<?php echo $data['email'];?>">
        </div>
    </div>
  <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">NPWP</label>
        <div class="col-sm-9">
            <input name="npwp" id="npwp" type="text" class="form-control" value="<?php echo $data['npwp'];?>">
      </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Tanggal Mulai Bekerja</label>
        <div class="col-sm-9">
            <input name="tgl_mulai_bekerja" id="tgl_mulai_bekerja" type="date" class="form-control" value="<?php echo $data['tgl_mulai_bekerja'];?>">
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
	 var url ="<?php echo './base/karyawan/act.php?act=new';?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data,
							success: function(response){
								$('#loadfile').load('./base/karyawan/data.php');
								
								$('.preloader3').hide();
							}
						});	
}

function EditData(){
	 var url ="<?php echo './base/karyawan/act.php?act=edit&id='.$_GET['id'];?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data,
							success: function(response){
							$('#loadfile').load('./base/karyawan/data.php');
								$('.preloader3').hide();
							}
						});	
}
</script>

