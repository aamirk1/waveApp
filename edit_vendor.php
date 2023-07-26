<?php 
session_start();
include('header.php');
include('sidebar.php');
include 'vendor.php';
$vendor = new Vendor();
// $invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName'] && !empty($_POST['vendorId']) && $_POST['vendorId']) {	
	$vendor->updatePurchase($_POST);	
	header("location:vendor_list.php");	
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	$purchaseValues = $vendor->getPurchase($_GET['update_id']);		
	$purchaseItems = $vendor->getPurchaseItems($_GET['update_id']);		
}
?>
<script src="js/vendor.js"></script>
<link href="css/style.css" rel="stylesheet">





<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Purchase</h1>
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
				
					

				<div class="container content-vendor">
					<form action="" id="vendor-form" method="post" class="vendor-form" role="form" novalidate=""> 
						<div class="load-animate animated fadeInUp">
							<div class="row">
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<?php include('vendor_menu.php');?>			
								</div>		    		
							</div>
							<div class="row">
									<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 pull-right">
									<select name="currency" id="currency" style="width: 55%;border: solid 2px;background: black;border-radius: 50px;padding: 2px;">
														<option value="₹ Rupees">₹ Rupees</option>
														<option value="$ Dollar">$ Dollar</option>
														<option value="£ Pound">£ Pound</option>
													</select> 
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
										<p><?php echo $purchaseValues['currency']; ?></p> 
									</div>
									</div>
							<input id="currency" type="hidden" value="$">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
									<h3>From,</h3>
									<div class="form-group">
										<input value="<?php echo $purchaseValues['shop_name']; ?>" type="text" class="form-control" name="companyName" id="shop_name" placeholder="Shop Name" autocomplete="off">
									</div>
									<div class="form-group">
										<textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"><?php echo $purchaseValues['shop_address']; ?></textarea>
									</div>
									<div class="form-group">
										<input value="<?php echo $purchaseValues['mobile']; ?>" type="text" class="form-control" name="mobile" id="companyName" placeholder="Shop Mobile Number" autocomplete="off">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<h3>Purchase Date</h3>
									<div class="form-group">
										<input type="date" value="<?php echo $purchaseValues['purchase_date']; ?>" class="form-control" width="10%" style="width: 20rem;" name="purchase_date" id="duedate" autocomplete="off">
									</div>
									<h5>GST Number</h5>
									<div class="form-group">
										<input type="text" value="<?php echo $purchaseValues['gst_number']; ?>" class="form-control" width="10%" style="width: 20rem;" name="gst_number" id="duedate" autocomplete="off">
									</div>
									<h5>Warranty Durations</h5>
									<div class="form-group">
										<input type="text" value="<?php echo $purchaseValues['warranty_duration']; ?>" class="form-control" width="10%" style="width: 20rem;" name="warranty_duration" id="duedate" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<table class="table table-bordered table-hover" id="purchaseItem">	
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
										foreach($purchaseItems as $purchaseItem){
											$count++;
										?>								
										<tr>
											<td><input class="purchase_itemRow" type="checkbox"></td>
											<td><input type="text" value="<?php echo $purchaseItem["item_code"]; ?>" name="productCode[]" id="purchase_productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
											<td><input type="text" value="<?php echo $purchaseItem["item_name"]; ?>" name="productName[]" id="purchase_productName_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
											<td><input type="number" value="<?php echo $purchaseItem["purchase_item_quantity"]; ?>" name="quantity[]" id="purchase_quantity_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
											<td><input type="number" value="<?php echo $purchaseItem["purchase_item_price"]; ?>" name="price[]" id="purchase_price_<?php echo $count; ?>" class="form-control price" autocomplete="off"></td>
											<td><input type="number" value="<?php echo $purchaseItem["purchase_item_final_amount"]; ?>" name="total[]" id="purchase_total_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
											<input type="hidden" value="<?php echo $purchaseItem['purchase_item_id']; ?>" class="form-control" name="itemId[]">
										</tr>	
										<?php } ?>		
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
									<button class="btn btn-success" id="purchase_addRows" type="button">+ Add More</button>
								</div>
							</div>
							<div class="row">	
								<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<h3>Description: </h3>
									<div class="form-group">
										<textarea class="form-control txt" rows="5" name="description" id="descriptions" placeholder="Enter Description"><?php echo $purchaseValues['description']; ?></textarea>
									</div>
									<!-- <div class="form-group">
											<input type="file" style="width: 40%;" class="form-control" name="purchase_invoice" id="mobile" placeholder="Number">
										</div> -->
									<br>
									<div class="form-group">
										<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
										<input type="hidden" value="<?php echo $purchaseValues['vendor_id']; ?>" class="form-control" name="vendorId" id="vendorId">
										<input data-loading-text="Updating Purchase..." type="submit" name="purchase_btn" value="Save Purchase" class="btn btn-success submit_btn purchase-save-btm">
									</div>
									
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<span class="form-inline">
										<div class="form-group">
											<label>Subtotal: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency"><?php echo $purchaseValues['currency']; ?></div>
												<input value="<?php echo $purchaseValues['purchase_total_before_tax']; ?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
											</div>
										</div>
										<div class="form-group">
											<label>Tax Rate: &nbsp;</label>
											<div class="input-group">
												<input value="<?php echo $purchaseValues['purchase_tax_per']; ?>" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
												<div class="input-group-addon">%</div>
											</div>
										</div>
										<div class="form-group">
											<label>Tax Amount: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency"><?php echo $purchaseValues['currency']; ?></div>
												<input value="<?php echo $purchaseValues['purchase_total_tax']; ?>" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
											</div>
										</div>							
										<div class="form-group">
											<label>Total: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency"><?php echo $purchaseValues['currency']; ?></div>
												<input value="<?php echo $purchaseValues['purchase_total_after_tax']; ?>" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
											</div>
										</div>
										<div class="form-group">
											<label>Amount Paid: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency"><?php echo $purchaseValues['currency']; ?></div>
												<input value="<?php echo $purchaseValues['purchase_amount_paid']; ?>" type="number" class="form-control" name="purchase_amount_paid" id="amountPaid" placeholder="Amount Paid">
											</div>
										</div>
										<div class="form-group">
											<label>Amount Due: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency"><?php echo $purchaseValues['currency']; ?></div>
												<input value="<?php echo $purchaseValues['purchase_total_amount_due']; ?>" type="number" class="form-control" name="purchase_total_amount_due" id="amountDue" placeholder="Amount Due">
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