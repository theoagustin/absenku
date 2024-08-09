<?php include'../index.php';
$tbname='absensi_karyawan';
$script="id_karyawan='".$_POST['id_karyawan']."',tanggal='".$_POST['tanggal']."',jam_masuk='".$_POST['jam_masuk']."',jam_keluar='".$_POST['jam_keluar']."',idusers='".idusers."'";

foreach($conn->get_results("select *from $tbname where id_karyawan='".$_POST['id_karyawan']."' and tanggal='".$_POST['tanggal']."'")as $cAK);
if($cAK['id']==''){
	
	$conn->get_results("insert into $tbname set $script ");
	$msg="Absen Masuk disimpan";
}else{
	$conn->get_results("update $tbname set $script where id='$_GET[id]'");
	$msg="Absen keluar disimpan";
}

	


echo $msg;
?>