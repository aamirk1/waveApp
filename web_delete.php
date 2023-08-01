<?php
// session_start();
include 'connection.php';
include 'functions.php';
if($_POST['action'] == 'webdelete' && $_POST['id']) {
	$id=$_POST['id'];
	$delete_sql="delete from website where id='$id'";
	mysqli_query($con,$delete_sql);
	$jsonResponse = array(
		"status" => 1	
	);
	echo json_encode($jsonResponse);	
	redirect('all_website.php');
}
redirect('websites.php');
