<?php
// session_start();
require('connection.php');
require('functions.php');
$msg='';
if(isset($_POST['submit'])){
   $username=get_safe_value($con,$_POST['username']);
   $password=get_safe_value($con,$_POST['password']);

   $sql="select * from users where username='$username' and password='$password'";
   $res=mysqli_query($con,$sql);
   $count=mysqli_num_rows($res);
   if($count>0){
      $row=mysqli_fetch_assoc($res);
      if($row['password'] === $password){
          $_SESSION['username'] = $row['username'];
          redirect('home.php');
          die();
      }
   }
   else{
      $msg="Please enter correct login details";
   }
}
?>
<!doctype html>
<html class="no-js" lang="">
    
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Wave App</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
     
      <link rel="stylesheet" href="style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150"id="form">
                  <form method="post">
                     <div class="form-group">
                        <label>Username</label>
                        <input id="input" type="text" name="username" class="form-control" placeholder="Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input id="input" style="margin-left: 15px;" type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" id="btn">Sign in</button>
					</form>
               <div class="field_error"><?php echo $msg?></div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>