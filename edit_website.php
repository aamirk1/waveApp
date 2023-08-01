<?php 
include('header.php');
include('sidebar.php');
?>

<?php
$domain_name='';
$domain_username='';
$domain_password='';
$domain_from='';
$domain_to='';
$domain_provider='';
$domain_remark='';
$hosting_provider='';
$hosting_username='';
$hosting_password='';
$hosting_from='';
$new='';
$hosting_to='';
$hosting_remark='';
$points='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from website where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$domain_name=$row['domain_name'];
		$domain_username=$row['domain_username'];
		$domain_password=$row['domain_password'];
		$domain_from=$row['domain_from'];
		$domain_to=$row['domain_to'];
		$domain_provider=$row['domain_provider'];
    $domain_remark=$row['domain_remark'];
		$hosting_provider=$row['hosting_provider'];
		$hosting_username=$row['hosting_username'];
		$hosting_password=$row['hosting_password'];
		$hosting_from=$row['hosting_from'];
		$hosting_to=$row['hosting_to'];
		$hosting_remark=$row['hosting_remark'];
		$points=$row['points'];
	}else{
		redirect('websites.php');
		
	}
}

if(isset($_POST['submit'])){
	$domain_name=get_safe_value($con,$_POST['domain_name']);
	$domain_username=get_safe_value($con,$_POST['domain_username']);
	$domain_password = get_safe_value($con,$_POST['domain_password']);
	$domain_from=get_safe_value($con,$_POST['domain_from']);
  $domain_to=get_safe_value($con,$_POST['domain_to']);
  $domain_provider=get_safe_value($con,$_POST['domain_provider']);
  $domain_remark=get_safe_value($con,$_POST['domain_remark']);
  $hosting_provider=get_safe_value($con,$_POST['hosting_provider']);
  $hosting_username=get_safe_value($con,$_POST['hosting_username']);
  $hosting_password=get_safe_value($con,$_POST['hosting_password']);
  $hosting_from=get_safe_value($con,$_POST['hosting_from']);
  $hosting_to=get_safe_value($con,$_POST['hosting_to']);
  $hosting_remark=get_safe_value($con,$_POST['hosting_remark']);
  $points=get_safe_value($con,$_POST['points']);
	$res=mysqli_query($con,"select * from website where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){

			}else{
				$msg="Domain already exist";
			}
		}else{
			$msg="Domain already exist";
		}
	}

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){		
			$update_sql="update website set domain_name='$domain_name',domain_username='$domain_username',domain_password='$domain_password',domain_from='$domain_from',domain_to='$domain_to',domain_provider='$domain_provider',domain_remark='$domain_remark',hosting_provider='$hosting_provider',hosting_username='$hosting_username',hosting_password='$hosting_password',hosting_from='$hosting_from',hosting_to='$hosting_to',hosting_remark='$hosting_remark',points='$points' where id='$id'";
			
			mysqli_query($con,$update_sql);
		}else{
			
			mysqli_query($con,"insert into website(domain_name,domain_username,domain_password,domain_from,domain_to,domain_provider,domain_remark,hosting_provider,hosting_username,hosting_password,hosting_from,hosting_to,hosting_remark,points) values('$domain_name','$domain_username','$domain_password','$domain_from','$domain_to','$domain_provider','$domain_remark','$hosting_provider','$hosting_username','$hosting_password','$hosting_from','$hosting_to','$hosting_remark','$points')");
		}
		redirect('all_website.php');
	}


	if(isset($_GET['type']) && $_GET['type']!=''){
		$type=get_safe_value($con,$_GET['type']);
		}
		if($type=='delete'){
			$id=get_safe_value($con,$_GET['id']);
			$delete_sql="delete from website where id='$id'";
			mysqli_query($con,$delete_sql);
		}
	
}
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"style="font-size: 18px;">Add Website</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-lg-6 mb-5">
                      <h3 class="text-center">Domain Details</h3>
                      <div class="row">
                          <div class="col-lg-4">
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Name:</h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Username:</h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Password:</h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Validity From: </h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Validity To: </h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Provider:</h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Remark: </h4>
                          </div>
                          <div class="col-lg-6">
                          
                          <h4 class="text-start" >
                        <input type="text" class="form-control" value="<?php echo $domain_name ?>" name="domain_name"/></h4>
                          <h4 class="text-start">
                        <input type="text" class="form-control" value="<?php echo $domain_username ?>" name="domain_username"/></h4>
                          <h4 class="text-start" >
                        <input type="text" class="form-control" value="<?php echo $domain_password ?>" name="domain_password"/></h4>
                          <h4 class="text-start">
                        <input type="date" class="form-control" value="<?php echo $domain_ ?>" name="domain_from"/></h4>
                          <h4 class="text-start">
                        <input type="date" class="form-control" value="<?php echo $domain_to ?>" name="domain_to"/></h4>
                          <h4 class="text-start">
                        <input type="text" class="form-control" value="<?php echo $domain_provider ?>" name="domain_provider"/></h4>
                          <h4 class="text-start">
                        <input type="text" class="form-control" value="<?php echo $domain_remark ?>" name="domain_remark"/></h4>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <h3 class="text-center">Hosting Details</h3>
                      <div class="row">
                        <div class="col-lg-4">
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Username:</h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Password:</h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Validity From: </h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Validity To: </h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Provider:</h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Remark: </h4>
                          <h4 class="text-center" style="border: 1px solid;border-radius: 10px;margin-bottom: 7px;padding: 6px;background-color: #3f6791;">Points:</h4>
                        </div>
                        <div class="col-lg-6">
                          <h4 class="text-start">
                            <input type="text" class="form-control" value="<?php echo $hosting_username ?>" name="hosting_username"/></h4>
                          <h4 class="text-start" >
                            <input type="text" class="form-control" value="<?php echo $hosting_password ?>" name="hosting_password" /></h4>
                          <h4 class="text-start">
                            <input type="date" class="form-control" value="<?php echo $hosting_from ?>" name="hosting_from"/></h4>
                          <h4 class="text-start">
                            <input type="date" class="form-control" value="<?php echo $hosting_to ?>" name="hosting_to" /></h4>
                          <h4 class="text-start">
                            <input type="text" class="form-control" value="<?php echo $hosting_provider ?>" name="hosting_provider"/></h4>
                          <h4 class="text-start">
                            <input type="text" class="form-control" value="<?php echo $hosting_remark ?>" name="hosting_remark"/></h4>
                          <h4 class="text-start" >
                            <input type="text" class="form-control" value="<?php echo $points ?>" name="points" /></h4>
                        </div>
                      </div>
                  </div>
              

                      
                      
                  
                </div>


                <!-- /.card-body -->
                <div class="card-footer">
                  <button id="bank-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                    <span id="bank-button-detail" name="submit">Submit</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
          

          

        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

</div>
<?php include('footer.php')?>