<?php include'../index.php';
$tbname='karyawan';
$tanggal=date('Y-m-d');
if($_GET['act']=='edit'){
	foreach($conn->get_results("select *from $tbname where id='$_GET[id]'")as $data);
	foreach($conn->get_results("select *from absensi_karyawan where id_karyawan='$_GET[id]' and tanggal='".$tanggal."'")as $dataAK);
}
foreach($conn->get_results("select *from perusahaan where idusers='".idusers."'")as $rpr){
	$perusahaan[$rpr['id']]=$rpr['nama_perusahaan'];
}
foreach($conn->get_results("select *from bagian where idusers='".idusers."'")as $rbg){
	$bagian[$rbg['id']]=$rbg['nama_bagian'];
}
foreach($conn->get_results("select *from posisi where idusers='".idusers."'")as $rbg){
	$posisi[$rbg['id']]=$rbg['nama_posisi'];
}
if($dataAK['jam_masuk']==''){
	$jam_masuk=date('H:i');
	$jam_keluar="";
}else{
	$jam_masuk=$dataAK['jam_masuk'];
	$jam_keluar=date('H:i');
}

?>
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Form Absensi Karyawan</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form class="" id="FormData">
    <div class="position-relative row form-group">
        <label for="role_name" class="col-sm-3 col-form-label">Nama Karyawan</label>
        <div class="col-sm-9">
            <?php echo $data['nama'];?>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Bagian/ Bidang</label>
        <div class="col-sm-9">
            
            <?php echo $bagian[$data['id_bagian']];?>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Posisi/ Jabatan</label>
        <div class="col-sm-9">
            <?php echo $posisi[$data['id_posisi']];?>
        </div>
    </div>
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Tanggal</label>
        <div class="col-sm-3">
            <input name="tanggal" id="tanggal" type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
        </div>
    </div>
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Jam Masuk</label>
        <div class="col-sm-2">
            <input name="jam_masuk" id="jam_masuk" type="time" class="form-control" value="<?php echo $jam_masuk;?>">
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Jam Keluar</label>
        <div class="col-sm-2">
            <input name="jam_keluar" id="jam_keluar" type="time" class="form-control" value="<?php echo $jam_keluar;?>">
        </div>
    </div>
 
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" onclick="EditData();" class="btn btn-primary">Save Absen</button>

    </div>
</form>
<script>

function EditData(){
	 var url ="<?php echo './base/absensi/act.php?act=edit&id='.$_GET['id'];?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data+'&id_karyawan=<?php echo $_GET['id'];?>',
							success: function(response){
							alert(response);
								$('.preloader3').hide();
							}
						});	
}
</script>

