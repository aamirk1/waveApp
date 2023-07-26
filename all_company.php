<?php 
include('header.php');
include('sidebar.php');
?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
            
            <div class="card">
          <div class="card-header">
            <h3 class="card-title">Comapny Details &nbsp;&nbsp;<span><a href="company.php">Add New Company</a> </span></h3>

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
      </div>
        </div>
    <!-- /.container-fluid -->
    </section>

</div>
<?php include('footer.php')?>