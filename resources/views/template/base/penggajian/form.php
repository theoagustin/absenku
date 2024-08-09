<?php include'../index.php';
$tbname='karyawan';
$tanggal=date('Y-m-d');
if($_GET['act']=='edit'){
	foreach($conn->get_results("select *from $tbname where id='$_GET[id]'")as $data);
	foreach($conn->get_results("select *from gaji_karyawan where id_karyawan='$_GET[id]'")as $dataAK);
}
foreach($conn->get_results("select *from perusahaan where idusers='".idusers."'")as $rpr){
	$perusahaan[$rpr['id']]=$rpr['nama_perusahaan'];
}
foreach($conn->get_results("select *from bagian where idusers='".idusers."'")as $rbg){
	$bagian[$rbg['id']]=$rbg['nama_bagian'];
}
foreach($conn->get_results("select *from posisi where idusers='".idusers."'")as $rbg){
	$posisi[$rbg['id']]=$rbg['nama_posisi'];
	$idposisi[$rbg['id']]=$rbg['id'];
	$jenisgaji[$rbg['id']]=$rbg['jenis_gaji'];
	$gajipokok[$rbg['id']]=$rbg['gaji_pokok'];
	$gajilembur_perjam[$rbg['id']]=$rbg['gaji_lembur_perjam'];

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
<h5 class="modal-title" id="exampleModalLongTitle">Form Penggajian Karyawan</h5>
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
    <div class="position-relative row form-group ">
      <label for="role_level" class="col-sm-3 col-form-label">Tanggal</label>      
		<div class="col-sm-3">
            <input name="tanggal" id="tanggal" type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
        </div>
    </div>
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Gaji Pokok</label>
        <div class="col-sm-5">
            <input name="gaji_pokok" id="gaji_pokok" type="number" class="form-control" value="<?php echo $gajipokok[$data['id_posisi']];?>">
        </div>
    </div>
    <?php if($jenisgaji[$data['id_posisi']]==1){?>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Tunjangan </label>
        <div class="col-sm-5">
            <input name="tunjangan" id="tunjangan" type="number" class="form-control" value="<?php echo $tunjangan;?>">
        </div>
    </div>
    
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Bonus </label>
        <div class="col-sm-2">
            <input name="bonus" id="bonus" type="number" class="form-control" value="<?php echo $bonus;?>"> 
        </div>
        <div class="col-sm-2">x <?php echo number_format($gajilembur_perjam[$data['id_posisi']]);?></div>
    </div>
    <?php }?>
    <div class="position-relative row form-group">
        <label for="role_level" class="col-sm-3 col-form-label">Jumlah Jam Lembur </label>
        <div class="col-sm-2">
            <input name="lembur" id="lembur" type="number" class="form-control" value="<?php echo $lembur;?>" onblur="CalC();" onkeydown="CalC();" onkeyup="CalC();" onkeypress="CalC();"> 
        </div>
        <div class="col-sm-7">x <?php echo number_format($gajilembur_perjam[$data['id_posisi']]);?>  <span id="hasil"></span></div>
    </div>
 
    <div class="position-relative row form-group">
      <label for="role_level" class="col-sm-3 col-form-label">Total Gaji</label>
        <div class="col-sm-5">
            <input name="tot_gaji" id="tot_gaji" type="number" class="form-control" value="<?php echo $tot_gaji;?>">
            <input name="gaji_lembur" id="gaji_lembur" type="hidden" class="form-control" value="<?php echo $tot_gaji;?>">
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" onclick="EditData();" class="btn btn-primary">Save Absen</button>

    </div>
</form>
<script>

function CalC(){

	var gp,tj,gl,bn,jl,tg;
	gp=parseInt($('#gaji_pokok').val());
	tj=parseInt($('#tunjangan').val());
	jl=parseInt($('#lembur').val());
	bn=parseInt($('#bonus').val());
	if(isNaN(tj)){tj=0;}
	if(isNaN(jl)){jl=0;}
	
	if(isNaN(bn)){bn=0;}
	
	if(isNaN(gp)){gp=0;}
	
	gl=(jl * <?php echo $gajilembur_perjam[$data['id_posisi']];?>) ;
	//bn=bn.parseInt;
	document.getElementById('hasil').innerHTML = '='+gl;

	document.getElementById('tot_gaji').value=gl + gp + tj + bn;
	document.getElementById('gaji_lembur').value=gl;
	
}
function EditData(){
	 var url ="<?php echo './base/penggajian/act.php?act=edit&id='.$_GET['id'];?>"; 
 var data = $('#FormData').serialize();
				$.ajax({
							type:'POST',
							url:url,
							data:data+'&id_karyawan=<?php echo $_GET['id'];?>&id_bagian=<?php echo $data['id_bagian'];?>&id_posisi=<?php echo $data['id_posisi'];?>' ,
							success: function(response){
							alert(response);
								$('.preloader3').hide();
							}
						});	
}
</script>

