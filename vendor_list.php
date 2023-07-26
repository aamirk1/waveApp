<?php 
session_start();
include('header.php');
include('sidebar.php');
include('vendor.php');
$vendor = new Vendor();
// $invoice->checkLoggedIn();
?>
<script src="js/vendor.js"></script>
<link href="css/style.css" rel="stylesheet">




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Vendor</h1>
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
          <?php include('vendor_menu.php');?>			  
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
          $purchaseList = $vendor->getPurchaseList();
              foreach($purchaseList as $purchaseDetails){
            $purchaseDate = date("d/M/Y", strtotime($purchaseDetails["purchase_date"]));
                  echo '
                    <tr>
                      <td>'.$purchaseDetails["vendor_id"].'</td>
                      <td>'.$purchaseDate.'</td>
                      <td>'.$purchaseDetails["shop_name"].'</td>
                      <td>'.$purchaseDetails["purchase_total_after_tax"].'</td>
                      <td><a href="print_vendor.php?vendor_id='.$purchaseDetails["vendor_id"].'" title="Print vendor"><span class="glyphicon glyphicon-print"></span></a></td>
                      <td><a href="edit_vendor.php?update_id='.$purchaseDetails["vendor_id"].'"  title="Edit vendor"><span class="glyphicon glyphicon-edit"></span></a></td>
                      <td><a href="#" id="'.$purchaseDetails["vendor_id"].'" class="deletePurchase"  title="Delete qout"><span class="glyphicon glyphicon-remove"></span></a></td>
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