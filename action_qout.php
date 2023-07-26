<?php
session_start();
include 'qout.php';
$qout = new Qout();
if($_POST['action'] == 'delete_qout' && $_POST['id']) {
	$qout->deleteQout($_POST['id']);	
	$jsonResponse = array(
		"status" => 1	
	);
	echo json_encode($jsonResponse);	
}
if($_GET['action'] == 'logout') {
session_unset();
session_destroy();
header("Location:index.php");
}

