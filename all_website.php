<?php 
include('header.php');
include('sidebar.php');
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/script.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
	<section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
            
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Website Details &nbsp;&nbsp;<span><a href="websites.php">Add New Record</a> </span></h3>

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

                            $ress=mysqli_query($con,"SELECT * FROM website ORDER BY id");
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
                            <a href="view_all_web.php?id=<?php echo $row['id']?>" title="View Website">View All</a>
                            <a href="edit_website.php?id=<?php echo $row['id']?>"  title="Edit Website">edit</a>
                            <a href="#" id=<?php echo $row['id']?> class="deleteWeb"  title="Delete Website">del</a>
                            <!-- <td><a href="#" id="'.$invoiceDetails["order_id"].'" class="deleteInvoice"  title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td> -->
                    
                            
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