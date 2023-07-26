<?php 
include('header.php');
include('sidebar.php');
?>

<?php
$c_name='';
$c_address='';
$c_email='';
$gst='';
$phone='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from company where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$c_name=$row['c_name'];
		$c_address=$row['c_address'];
		$c_email=$row['c_email'];
		$gst=$row['gst'];
		$phone=$row['phone'];
	}else{
		redirect('company.php');
		
	}
}

if(isset($_POST['submit'])){
	$c_name=get_safe_value($con,$_POST['c_name']);
	$c_address=get_safe_value($con,$_POST['c_address']);
	$c_email = get_safe_value($con,$_POST['c_email']);
	$gst=get_safe_value($con,$_POST['gst']);
	$phone=get_safe_value($con,$_POST['phone']);	

	$res=mysqli_query($con,"select * from company where gst='$gst'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){

			}else{
				$msg="GST Number already exist";
			}
		}else{
			$msg="GST Number already exist";
		}
	}

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){		
			$update_sql="update company set c_name='$c_name', c_address='$c_address',c_email='$c_email',gst='$gst',phone='$phone' where id='$id'";
			
			mysqli_query($con,$update_sql);
		}else{
			
			mysqli_query($con,"insert into company(c_name,c_address,c_email,gst,phone) values('$c_name','$c_address','$c_email','$gst','$phone')");
		}
		redirect('company.php');
	}


	if(isset($_GET['type']) && $_GET['type']!=''){
		$type=get_safe_value($con,$_GET['type']);
		}
		if($type=='delete'){
			$id=get_safe_value($con,$_GET['id']);
			$delete_sql="delete from banking where id='$id'";
			mysqli_query($con,$delete_sql);
		}
	
}
?>


<div class="content-wrapper">
    


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
          <form role="form"  method="post">
            <div class="card-body">
              <div class="row">
                  <div class="col">
                    <label>Company Name</label>
                    <input type="text" class="form-control" name="c_name" required/>
                  </div>
                  <div class="col">
                    <label>Company Address</label>
                    <input type="text" class="form-control" name="c_address" required/>
                  </div>
				          <div class="col">
                    <label>Company Email</label>
                    <input type="text" class="form-control" name="gst" required/>
                  </div>
                  <div class="col">
                    <label>GST Number</label>
                    <input type="text" class="form-control" name="c_email" required/>
                  </div>
                  <div class="col">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" required/>
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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Comapny Details &nbsp;&nbsp;<span><a href="all_company.php">View All</a> </span></h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placec="Search"
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
            <table class="table table-white text-nowrap">
              <thead>
                <tr>
                  <th>Sr. No</th>
                  <th>Company Name</th>
                  <th>Company Address</th>
                  <th>Company Email</th>
                  <th>GST Number</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $type='';
                if(isset($_GET['type']) && $_GET['type']!=''){
                  $type=get_safe_value($con,$_GET['type']);
                  }
                  if($type=='delete'){
                    $id=get_safe_value($con,$_GET['id']);
                    $delete_sql="delete from company where id='$id'";
                    mysqli_query($con,$delete_sql);
                  }
                  

                $ress=mysqli_query($con,"SELECT * FROM company ORDER BY id DESC LIMIT 8");
                $i=1;
                while($row=mysqli_fetch_assoc($ress)){?>
                <tr>
                  <td><?php echo $i++?></td>
                  <td><?php echo $row['c_name']?></td>
                  <td><?php echo $row['c_address']?></td>
                  <td><?php echo $row['c_email']?></td>
                  <td><?php echo $row['gst']?></td>
                  <td><?php echo $row['phone']?></td>
                  <td>
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
        </div>  
        <!-- /.card -->
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
  </section>

</div>
<?php include('footer.php')?>