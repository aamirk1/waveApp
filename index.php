<?php 
session_start();
$loginError = '';
if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
	include 'Invoice.php';
	$invoice = new Invoice();
	$user = $invoice->loginUsers($_POST['email'], $_POST['pwd']); 
	if(!empty($user)) {
		$_SESSION['user'] = $user[0]['first_name']."".$user[0]['last_name'];
		$_SESSION['userid'] = $user[0]['id'];
		$_SESSION['email'] = $user[0]['email'];		
		$_SESSION['address'] = $user[0]['address'];
		$_SESSION['mobile'] = $user[0]['mobile'];
		header("Location:home.php");
	} else {
		$loginError = "Invalid email or password!";
	}
}
?>

<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<body class="">
	
	<div class="container" style="min-height:500px;">
	<div class=''>
	</div>
<div class="row">	
	<div class="login-form" id="form">		
		<h4>Invoice User Login:</h4>		
		<form method="post" action="">
			<div class="form-group">
			<?php if ($loginError ) { ?>
				<div class="alert alert-warning"><?php echo $loginError; ?></div>
			<?php } ?>
			</div>
			<div class="form-group">
				<input name="email" id="input" type="email" class="form-control" placeholder="Email address" autofocus="" required>
			</div>
			<div class="form-group">
				<input type="password" id="input" class="form-control" name="pwd" placeholder="Password" required>
			</div>  
			<div class="form-group">
				<button type="submit" id="input" name="login" class="btn btn-info">Login</button>
			</div>
		</form>
				
	</div>		
</div>		
</div>








      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>