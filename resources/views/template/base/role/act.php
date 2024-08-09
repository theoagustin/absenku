<?php include'../index.php';

$script="role_name='".$_POST['role_name']."',role_level='".$_POST['role_level']."'";

if($_GET['act']=='new'){
	$conn->get_results("insert into role set $script ");
	$msg="Simpan data sukses";
}elseif($_GET['act']=='edit'){
	$conn->get_results("update role set $script where id='$_GET[id]'");
	$msg="Update data sukses";
}elseif($_GET['act']=='del'){
	$conn->get_results("delete from role where id='$_GET[id]'");
	$msg="Update data sukses";
}

echo $msg;
?>