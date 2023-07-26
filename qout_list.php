<?php 
session_start();
include('header.php');
include('sidebar.php');
include 'qout.php';
$qout = new Qout();
// $invoice->checkLoggedIn();
?>
<script src="js/qout.js"></script>
<link href="css/style.css" rel="stylesheet">




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Qout</h1>
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
				
        <div class="">		
          <!-- <h2 class="title">Qout System</h2> -->
          <?php include('qout_menu.php');?>			  
            <table id="data-table" class="table table-condensed table-striped">
              <thead>
                <tr>
                  <th>Qout No.</th>
                  <th>Create Date</th>
                  <th>Customer Name</th>
                  <th>Qout Total</th>
                  <th>Print</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <?php		
          $qoutList = $qout->getQoutList();
              foreach($qoutList as $qoutDetails){
            $qoutDate = date("d/M/Y, H:i:s", strtotime($qoutDetails["qout_date"]));
                  echo '
                    <tr>
                      <td>'.$qoutDetails["qout_id"].'</td>
                      <td>'.$qoutDate.'</td>
                      <td>'.$qoutDetails["qout_receiver_name"].'</td>
                      <td>'.$qoutDetails["qout_total_after_tax"].'</td>
                      <td><a href="print_qout.php?qout_id='.$qoutDetails["qout_id"].'" title="Print qout"><span class="glyphicon glyphicon-print"></span></a></td>
                      <td><a href="edit_qout.php?update_id='.$qoutDetails["qout_id"].'"  title="Edit qout"><span class="glyphicon glyphicon-edit"></span></a></td>
                      <td><a href="#" id="'.$qoutDetails["qout_id"].'" class="deleteqout"  title="Delete qout"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                  ';
              }       
              ?>
            </table>	
        </div>	

				</div>
			</div>
		</div>
  <!-- /.container-fluid -->
    </section>

</div>



<?php include('footer.php');?>