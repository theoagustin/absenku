<?php
function list_jenis_gaji(){
	$ldata=array();
	$key=array(
		array('id'=>1,'jenis_gaji'=>"Bulanan"),
		array('id'=>2,'jenis_gaji'=>"Mingguan"),
		array('id'=>3,'jenis_gaji'=>"Harian"),
		array('id'=>4,'jenis_gaji'=>"Per Jam")
	);
	for($i=0; $i<count($key);$i++){
	$ldata[]=$key[$i];
	}
	return $ldata;
}
function list_jekel(){
	$ldata=array();
	$key=array(
		array('id'=>'L','jekel'=>'Laki-Laki'),
		array('id'=>'P','jekel'=>"Perempuan")
	);
	for($i=0; $i<count($key);$i++){
	$ldata[]=$key[$i];
	}
	return $ldata;
}
function list_bagian(){
	global $conn;
	if(role>=2){
$filter=" WHERE idusers='".idusers."' ";
}
	foreach($conn->get_results("select *from bagian $filter")as $r){
	$ldata[]=$r;
	}
	return $ldata;
}
function list_posisi(){
	global $conn;
	if(role>=2){
$filter=" WHERE idusers='".idusers."' ";
}
	foreach($conn->get_results("select *from posisi $filter")as $r){
	$ldata[]=$r;
	}
	return $ldata;
}
