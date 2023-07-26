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
		redirect('websites.php');
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

    <section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary mt-2">
          <div class="card-header">
            <h3 class="card-title">Add Website</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post">
            <div class="card-body">
              <div class="row">
                  <div class="col">
                    <label>Domain Name</label>
                    <input type="text" class="form-control" name="domain_name" />
                  </div>
                  <div class="col">
                    <label>Domain Login</label>
                    <input type="text" class="form-control" name="domain_username" required/>
                  </div>

                  <div class="col">
                    <label>Domain Password</label>
                    <input type="text" class="form-control" name="domain_password" required />
                  </div>
                  <div class="col">
                    <label>Domain Validity From</label>
                    <input type="date" class="form-control" name="domain_from" />
                  </div>
                  <div class="col">
                    <label>Domain Validity To</label>
                    <input type="date" class="form-control" name="domain_to" />
                  </div>
                </div>
                

                <div class="row mt-4">
                  <div class="col">
                    <label>Domain Service Provider</label>
                    <input type="text" class="form-control" name="domain_provider" />
                  </div>
                  <div class="col">
                    <label>Domain Remark</label>
                    <input type="text" class="form-control" name="domain_remark" />
                  
                  </div>
                  
                  <div class="col">
                    <label>Hosting Provider</label>
                    <input type="text" class="form-control" name="hosting_provider" required />
                  </div>
                  <div class="col">
                    <label>Hosting Login</label>
                    <input type="text" class="form-control" name="hosting_username" />
                  </div>
                  <div class="col">
                    <label>Hosting Password</label>
                    <input type="text" class="form-control" name="hosting_password" />
                  </div>
                  
                </div>
                <div class="row mt-4">
                  <div class="col">
                    <label>Points</label>
                    <input type="text" class="form-control" name="points" />
                  </div>
                  <div class="col">
                    <label>Hosting Validity From</label>
                    <input type="date" class="form-control" name="hosting_from" />
                  </div>
                  <div class="col">
                    <label>Hosting Validity To</label>
                    <input type="date" class="form-control" name="hosting_to" />
                  </div>
                  <div class="col">
                    <label>Hosting Remark</label>
                    <input type="text" class="form-control" name="hosting_remark" />
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
      

      <div class="col-md-12 mb-4">
        <div class="card mb-5">
          <div class="card-header">
            <h3 class="card-title">Website Details &nbsp;&nbsp;<span><a href="all_website.php">View All</a> </span></h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                />

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Sr. No</th>
                  <th>Domain Name</th>
                  <th>Doamin Username</th>
                  <th>Domain Password</th>
                  <th>Domain Valid From</th>
                  <th>Domain Valid To</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $type='';
                if(isset($_GET['type']) && $_GET['type']!=''){
                  $type=get_safe_value($con,$_GET['type']);
                  }
                  if($type=='view'){
                    $id=get_safe_value($con,$_GET['id']);
                    $view_sql="select * from website where id='$id'";
                    mysqli_query($con,$view_sql);
                  }
                  if($type=='delete'){
                    $id=get_safe_value($con,$_GET['id']);
                    $delete_sql="delete from website where id='$id'";
                    mysqli_query($con,$delete_sql);
                  }

                $ress=mysqli_query($con,"SELECT * FROM website ORDER BY id DESC LIMIT 2 ");
                $i=1;
                while($row=mysqli_fetch_assoc($ress)){?>
                <tr class="tabledata">
                  <td><?php echo $i++?></td>
                  <td><?php echo $row['domain_name']?></td>
                  <td><?php echo $row['domain_username']?></td>
                  <td><?php echo $row['domain_password']?></td>
                  <td><?php echo $row['domain_from']?></td>
                  <td><?php echo $row['domain_to']?></td>
                  <td>
                      <a href="view_all_web.php?id=<?php echo $row['id']?>" class="link-dark badge rounded-pill bg-secondary">View All</a>
                  <?php 

                  echo "<span class='badge rounded-pill bg-danger'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
                  ?>
                  </td>
                  
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>



    </div>
  </div>
  <!-- /.container-fluid -->
</section>

</div>
<?php include('footer.php')?>