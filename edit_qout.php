<?php 
session_start();
include('header.php');
include('sidebar.php');
include 'qout.php';
$qout = new Qout();
// $invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName'] && !empty($_POST['qoutId']) && $_POST['qoutId']) {	
	$qout->updateQout($_POST);	
	header("Location:qout_list.php");	
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	$qoutValues = $qout->getQout($_GET['update_id']);		
	$qoutItems = $qout->getQoutItems($_GET['update_id']);		
}
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
				
					

				<div class="container content-qout">
					<form action="" id="qout-form" method="post" class="qout-form" role="form" novalidate=""> 
						<div class="load-animate animated fadeInUp">
							<div class="row">
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<?php include('qout_menu.php');?>			
								</div>		    		
							</div>
							<input id="currency" type="hidden" value="$">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<h3>From,</h3>
									<?php echo $_SESSION['user']; ?><br>	
									<?php echo $_SESSION['address']; ?><br>	
									<?php echo $_SESSION['mobile']; ?><br>
									<?php echo $_SESSION['email']; ?><br>		      						      									
								</div>      		
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
									<h3>To,</h3>
									<div class="form-group">
										<input value="<?php echo $qoutValues['qout_receiver_name']; ?>" type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
									</div>
									<div class="form-group">
										<textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"><?php echo $qoutValues['qout_receiver_address']; ?></textarea>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<h3>Due Date</h3>
									<div class="form-group">
										<input type="date" value="<?php echo $qoutValues['duedate']; ?>" class="form-control" width="10%"style="width: 20rem;" name="duedate" id="duedate" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<table class="table table-bordered table-hover" id="qoutItem">	
										<tr>
											<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
											<th width="15%">Item No</th>
											<th width="38%">Item Name</th>
											<th width="15%">Quantity</th>
											<th width="15%">Price</th>								
											<th width="15%">Total</th>
										</tr>
										<?php 
										$count = 0;
										foreach($qoutItems as $qoutItem){
											$count++;
										?>								
										<tr>
											<td><input class="qout_itemRow" type="checkbox"></td>
											<td><input type="text" value="<?php echo $qoutItem["item_code"]; ?>" name="productCode[]" id="qout_productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
											<td><input type="text" value="<?php echo $qoutItem["item_name"]; ?>" name="productName[]" id="qout_productName_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
											<td><input type="number" value="<?php echo $qoutItem["qout_item_quantity"]; ?>" name="quantity[]" id="qout_quantity_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
											<td><input type="number" value="<?php echo $qoutItem["qout_item_price"]; ?>" name="price[]" id="qout_price_<?php echo $count; ?>" class="form-control price" autocomplete="off"></td>
											<td><input type="number" value="<?php echo $qoutItem["qout_item_final_amount"]; ?>" name="total[]" id="qout_total_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
											<input type="hidden" value="<?php echo $qoutItem['qout_item_id']; ?>" class="form-control" name="itemId[]">
										</tr>	
										<?php } ?>		
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
									<button class="btn btn-success" id="qout_addRows" type="button">+ Add More</button>
								</div>
							</div>
							<div class="row">	
								<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<h3>Notes: </h3>
									<div class="form-group">
										<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"><?php echo $qoutValues['note']; ?></textarea>
									</div>
									<br>
									<div class="form-group">
										<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
										<input type="hidden" value="<?php echo $qoutValues['qout_id']; ?>" class="form-control" name="qoutId" id="qoutId">
										<input data-loading-text="Updating Quotation..." type="submit" name="qout_btn" value="Save qout" class="btn btn-success submit_btn qout-save-btm">
									</div>
									
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<span class="form-inline">
										<div class="form-group">
											<label>Subtotal: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency">$</div>
												<input value="<?php echo $qoutValues['qout_total_before_tax']; ?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
											</div>
										</div>
										<div class="form-group">
											<label>Tax Rate: &nbsp;</label>
											<div class="input-group">
												<input value="<?php echo $qoutValues['qout_tax_per']; ?>" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
												<div class="input-group-addon">%</div>
											</div>
										</div>
										<div class="form-group">
											<label>Tax Amount: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency">$</div>
												<input value="<?php echo $qoutValues['qout_total_tax']; ?>" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
											</div>
										</div>							
										<div class="form-group">
											<label>Total: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency">$</div>
												<input value="<?php echo $qoutValues['qout_total_after_tax']; ?>" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
											</div>
										</div>
										
									</span>
								</div>
							</div>
							<div class="clearfix"></div>		      	
						</div>
					</form>			
				</div>
			</div>	
				</div>
			</div>
		</div>
  <!-- /.container-fluid -->
    </section>

</div>








<?php include('footer.php');?>