<?php
extract($_POST);
include("connection.php");
$first_name = $_POST["first_name"]; 
$last_name = $_POST["last_name"]; 
$email = $_POST["email"];
$password = $_POST["password"];
$address = $_POST["address"];
$mobile = $_POST["mobile"];
$sql=mysqli_query($con,"SELECT * FROM invoice_user where email='$email'");
if(mysqli_num_rows($sql)>0)
{
    echo "Email Id Already Exists"; 
	exit;
}else{
    // $query="INSERT INTO register(First_Name, Last_Name, Email, Password, File ) VALUES ('$first_name', '$last_name', '$email', '$final_file')";
    //     $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
    //     header ("Location: login.php?status=success");
    $query="insert into invoice_user(first_name, last_name, email, password, address,mobile)VALUES ('$first_name', '$last_name', '$email', '$password', '$address','$mobile')";
    $sql=mysqli_query($con,$query)or die("Could Not Perform the Query");
    header ("Location: home.php?status=success");
      
    
}

?>