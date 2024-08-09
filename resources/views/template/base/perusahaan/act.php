<?php include'../index.php';
$tbname='karyawan';
$script="id_perusahaan='".id_perusahaan."',id_bagian='".$_POST['nama_bagian']."',id_posisi='".$_POST['nama_posisi']."',nama='".$_POST['nama']."',nik='".$_POST['nik']."',jekel='".$_POST['jekel']."',alamat='".$_POST['alamat']."',telp='".$_POST['telp']."',email='".$_POST['email']."',npwp='".$_POST['npwp']."',tgl_mulai_bekerja='".$_POST['tgl_mulai_bekerja']."',idusers='".idusers."'";

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