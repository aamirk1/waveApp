<?php 
include('header.php');
include('sidebar.php');
include 'Invoice.php';
$invoice = new Invoice();
?>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Invoice</h1>
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
          <h2 class="title">Invoice System</h2>
          <?php include('menu.php');?>			  
            <table id="data-table" class="table table-condensed table-striped">
              <thead>
                <tr>
                  <th>Invoice No.</th>
                  <th>Create Date</th>
                  <th>Customer Name</th>
                  <th>Invoice Total</th>
                  <th>Print</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <?php		
          $invoiceList = $invoice->getInvoiceList();
              foreach($invoiceList as $invoiceDetails){
            $invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["order_date"]));
                  echo '
                    <tr>
                      <td>'.$invoiceDetails["order_id"].'</td>
                      <td>'.$invoiceDate.'</td>
                      <td>'.$invoiceDetails["order_receiver_name"].'</td>
                      <td>'.$invoiceDetails["order_total_after_tax"].'</td>
                      <td><a href="print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" title="Print Invoice"><span class="glyphicon glyphicon-print"></span></a></td>
                      <td><a href="edit_invoice.php?update_id='.$invoiceDetails["order_id"].'"  title="Edit Invoice"><span class="glyphicon glyphicon-edit"></span></a></td>
                      <td><a href="#" id="'.$invoiceDetails["order_id"].'" class="deleteInvoice"  title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>
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
