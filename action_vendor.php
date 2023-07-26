<?php
session_start();
include 'vendor.php';
$vendor = new Vendor();
if($_POST['action'] == 'delete_purchase' && $_POST['id']) {
	$qout->deletePurchase($_POST['id']);	
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

