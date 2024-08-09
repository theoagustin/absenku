<?php include'../index.php';
$tbname='karyawan';
$lenght=5;
					if($_POST['ca']=='yes'){
					$awa="28312333667456132677896";
					}
					if($_POST['ch']=='yes'){
					$awh="gfopqrCDEFghgGHIJabcsdfdijklmnfgstuvhgwxyzABfKLMNOfgfghguiljPQRSdefghaTUVWXYZ";
					}
					$awd="13267283123336674567896abcdefghijkmnpqrstuvwxyz";
if(role>=2){
$filter=" WHERE idusers='".idusers."' and idakun IS NULL ";
}
foreach($conn->get_results("select *from karyawan $filter")as $rK){
	
	$id=$rK['id'];
	$user[$id]=substr( str_shuffle( $awd ), 0, $lenght );
	$pass[$id] = substr( str_shuffle( $awh.$awa ), 0, $lenght );
	$pass1[$id] = $pass[$id];
	$pasword[$id]=md5($pass[$id]);
	$script[$id]="nama='".$rK['nama']."',email='".$rK['email']."',role_level='3',username='".$user[$id]."',password='".$pasword[$id]."',pass_text='".$pass1[$id]."'";
	
	$conn->get_results("insert into users set $script[$id] ");
	
	foreach($conn->get_results("select *from users where username='".$user[$id]."' and password='".$pasword[$id]."'")as $getIU[$id]);
	if($getIU[$id]['idusers']<>''){
	$conn->get_results("update karyawan set idakun='".$getIU[$id]['idusers']."' where id='$id'");
		
	}
}

echo $msg;
?>