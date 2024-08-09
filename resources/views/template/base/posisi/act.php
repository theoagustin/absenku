<?php include'../index.php';
$tbname='posisi';
$script="id_perusahaan='".id_perusahaan."',id_bagian='".$_POST['nama_bagian']."',nama_posisi='".$_POST['nama_posisi']."',jenis_gaji='".$_POST['jenis_gaji']."',gaji_pokok='".$_POST['gaji_pokok']."',gaji_lembur_perjam='".$_POST['gaji_lembur_perjam']."',idusers='".idusers."'";

if($_GET['act']=='new'){
	$conn->get_results("insert into $tbname set $script ");
	$msg="Simpan data sukses";
}elseif($_GET['act']=='edit'){
	$conn->get_results("update $tbname set $script where id='$_GET[id]'");
	$msg="Update data sukses";
}elseif($_GET['act']=='del'){
	$conn->get_results("delete from $tbname where id='$_GET[id]'");
	$msg="Update data sukses";
}

echo $msg;
?>