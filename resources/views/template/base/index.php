<?php
error_reporting(1);
@session_start();
date_default_timezone_set('Asia/Jakarta');
require_once('../../config.php');
require_once('../../class-config.php');
$conn= new dbload();
$conn->ConnectDB();
global $conn;
require_once('../../define.php');

require_once('../init-data.php');

