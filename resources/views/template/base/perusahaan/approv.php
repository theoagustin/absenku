<?php include'../index.php';
$data=explode(":",$_GET['data']);
$tbname='perusahaan';


	$conn->get_results("update $tbname set approv='".$data[1]."' where id='".$data[0]."'");
	$msg="Update data sukses";


echo $msg;
?>