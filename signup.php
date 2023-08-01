<?php 
session_start();


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
		<h4>Registration Form</h4>		
		<form action="registr.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
			
			</div>
			<div class="form-group">
				<input name="first_name" id="input" type="text" class="form-control" placeholder="First Name" autofocus="" required>
			</div>
			<div class="form-group">
				<input type="text" id="input" class="form-control" name="last_name" placeholder="Last Name" required>
			</div>  
			<div class="form-group">
				<input name="email" id="input" type="email" class="form-control" placeholder="Email address" autofocus="" required>
			</div>
			<div class="form-group">
				<input type="password" id="input" class="form-control" name="password" placeholder="Password" required>
			</div>  
			<div class="form-group">
				<input type="text" id="input" class="form-control" name="address" placeholder="Address" required>
			</div>  
			<div class="form-group">
				<input type="text" id="input" class="form-control" name="mobile" placeholder="Mobile" required>
			</div>  
			<div class="form-group">
				<button type="submit" id="input" name="save" class="btn btn-info">Sign Up</button>
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