<?php include'../index.php';
$tbname='gaji_karyawan';
$script="tanggal='".$_POST['tanggal']."',id_karyawan='".$_POST['id_karyawan']."',id_perusahaan='".id_perusahaan."',id_bagian='".$_POST['id_bagian']."',id_posisi='".$_POST['id_posisi']."',gaji_pokok='".$_POST['gaji_pokok']."',tunjangan='".$_POST['tunjangan']."',bonus='".$_POST['bonus']."',jam_lembur='".$_POST['lembur']."',gaji_lembur='".$_POST['gaji_lembur']."',idusers='".idusers."'";
foreach($conn->get_results("select *from $tbname where id_karyawan='".$_POST['id_karyawan']."' and tanggal='".$_POST['tanggal']."'")as $cGK);

if($cGK['id']==''){
	$conn->get_results("insert into $tbname set $script ");
	$msg="Simpan data sukses";
}else{
	$conn->get_results("update $tbname set $script where id='$_GET[id]'");
	$msg="Update data sukses";
}
echo $msg;
?>