<?php include'../index.php';
$tbname='bagian';
$script="id_perusahaan='".id_perusahaan."',nama_bagian='".$_POST['nama_bagian']."',idusers='".idusers."'";

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