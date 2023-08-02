<?php
include('header.php');
include('sidebar.php');
?>

<?php
$c_name = '';
$designation = '';
$name = '';
$email = '';
$phone = '';
$alternate_phone = '';
$msg = '';





if(isset($_GET['type']) && $_GET['type']!=''){
  $type=get_safe_value($con,$_GET['type']);
  }
  if($type=='delete'){
    $id=get_safe_value($con,$_GET['id']);
    $delete_sql="delete from c_information where id='$id'";
    mysqli_query($con,$delete_sql);
  }




?>


<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary mt-2">
            <div class="card-header">
              <h3 class="card-title">Add Client Information</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="card-body">

                <div class="col-lg-6">
                  
                </div>
                <table class="table mt-2" id="table_field">
                  <tr>
                    <th scope="col">Designation</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Alternate Mobile</th>
                    <!-- <th scope="col">Add Or Remove</th> -->
                  </tr>
                    <?php 
                    
                  include('connection.php');
                  // require('functions.php');
                  if (isset($_POST['submit'])) {
                    $c_name = $_POST['c_name'];
                    $designation = $_POST['designation'];
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $alternate_phone = $_POST['alternate_phone'];
                    foreach ($designation as $key => $value) {
                      $data = "insert into c_information(designation,c_name,name,email,phone,alternate_phone) values('" . $value . "','" . $c_name[$key] . "','" . $name[$key] . "','" . $email[$key] . "','" . $phone[$key] . "','" . $alternate_phone[$key] . "')";
                      mysqli_query($con, $data);
                    }
                  }

                    ?>
                  <tr>

                    <td><input type="text" class="form-control" name="designation[]" /></td>
                    <td>
                  <select class="form-control" name="c_name[]" id="c_name" required style="padding: 5px;width: 135px;">
                    <option>Select Company</option>
                    <?php
                    $res = mysqli_query($con, "select id, c_name from company order by c_name asc");
                    while ($row = mysqli_fetch_assoc($res)) {
                      if($list['c_name_id']==$row['id']){
                        echo "<option value=".$row['id']." selected>".$row['c_name']."</option>";
                      }else{
                        echo "<option value=".$row['id']." >".$row['c_name']."</option>";	
                      }
                    }
                    ?>
                  </select>

                  
                    </td>
                    <td><input type="text" class="form-control" name="name[]" required /></td>
                    <td><input type="email" class="form-control" name="email[]" required /></td>
                    <td><input type="mobile" class="form-control" name="phone[]" required /></td>
                    <td><input type="mobile" class="form-control" name="alternate_phone[]" required /></td>
                    <!-- <td><input type="button" class="btn btn-warning" name="add" id="add" value="Add" /></td> -->
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Save">
              </div>
            </form>
            
          </div>
        </div>
        <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Comapny Details &nbsp;&nbsp;<span><a href="client_info.php">View All</a> </span></h3>

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
                  <th>Name</th>
                  <th>Company Designation</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Alternate Phone</th>
                  <th>Delete</th>
                  
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
                  
//  $sql = mysqli_query($con,"SELECT c_information.*, company.*FROM c_information INNER JOIN company ON c_information.c_name = company.c_name");
//  echo $sql;
                $ress=mysqli_query($con,"SELECT c_information.*, company.*FROM c_information INNER JOIN company ON c_information.c_name = company.id");
                // $ress=mysqli_query($con,"SELECT * FROM c_information ORDER BY id DESC LIMIT 3");
                $i=1;
                while($row=mysqli_fetch_assoc($ress)){?>
                <tr>
                  <td><?php echo $i++?></td>
                  <td><?php echo $row['c_name']?></td>
                  <td><?php echo $row['name']?></td>
                  <td><?php echo $row['designation']?></td>
                  <td><?php echo $row['email']?></td>
                  <td><?php echo $row['phone']?></td>
                  <td><?php echo $row['alternate_phone']?></td>
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

<?php include('footer.php'); ?>