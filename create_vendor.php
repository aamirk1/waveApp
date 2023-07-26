<?php 
session_start();
include('header.php');
include('sidebar.php');
// include('functions.php');
include('connection.php');
include('vendor.php');
$vendor = new Vendor();
// $qout->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {	
	$vendor->savePurchase($_POST);
	header("Location:vendor_list.php");	
	// redirect('vendor_list.php');
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
					 <div class="container content-purchase">
						<form action="" id="purchase-form" method="post" class="purchase-form" role="form" novalidate=""> 
							<div class="load-animate animated fadeInUp">
								<div class="row">
									<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
										<?php include('vendor_menu.php');?>	
									</div>		    		
								</div>
								<input id="currency" type="hidden" value="₹">
								<div class="row">
									<!-- <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
										<h3>From,</h3>
										/* //echo $_SESSION['user']; ?><br>	
										// echo $_SESSION['address']; ?><br>	
										// echo $_SESSION['mobile']; ?><br>
										//echo $_SESSION['email']; ?>*<br>	
									</div>      		 -->
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
											<select name="currency" id="currency" style="width: 30%;border: solid 2px;background: black;border-radius: 50px;padding: 2px;">
												<option value="₹ Rupees">₹ Rupees</option>
												<option value="$ Dollar">$ Dollar</option>
												<option value="£ Pound">£ Pound</option>
											</select> 
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
										<h4>From,</h4>
										<div class="form-group">
											<input type="text" class="form-control" name="companyName" id="companyName" placeholder="Shop Name" autocomplete="off">
										</div>
										<div class="form-group">
											<textarea class="form-control" rows="3" name="address" id="address" placeholder="Shop Address"></textarea>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Number">
										</div>
										
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
										<h4>Purchase Date</h4>
										<div class="form-group">
											<input type="date" class="form-control" width="10%"style="width: 20rem;" name="purchase_date" id="duedate" autocomplete="off">
										</div>
										<h5>GST Number</h5>
										<div class="form-group">
											<input type="text" class="form-control" width="10%"style="width: 20rem;" name="gst_number" id="duedate" autocomplete="off">
										</div>
										<h5>Warranty Durations</h5>
										<div class="form-group">
											<input type="text" class="form-control" width="10%"style="width: 20rem;" name="warranty_duration" id="duedate" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
										<table class="table table-bordered table-hover" id="purchaseItem">	
											<tr>
												<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
												<th width="15%">Item No</th>
												<th width="38%">Item Name</th>
												<th width="15%">Qantity</th>
												<th width="15%">Price</th>								
												<th width="15%">Total</th>
											</tr>							
											<tr>
												<td><input class="purchase_itemRow" type="checkbox"></td>
												<td><input type="text" name="productCode[]" id="purchase_productCode_1" class="form-control" autocomplete="off"></td>
												<td><input type="text" name="productName[]" id="purchase_productName_1" class="form-control" autocomplete="off"></td>			
												<td><input type="number" name="quantity[]" id="purchase_quantity_1" class="form-control quantity" autocomplete="off"></td>
												<td><input type="number" name="price[]" id="purchase_price_1" class="form-control price" autocomplete="off"></td>
												<td><input type="number" name="total[]" id="purchase_total_1" class="form-control total" autocomplete="off"></td>
											</tr>						
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
											<textarea class="form-control txt" rows="5" name="description" id="description" placeholder="Your Descriptions..."></textarea>
										</div>
										<br>
										<div class="form-group">
          <input type="file" name="pdf_file"
                 class="form-control" accept=".pdf" style="width: 40%;"
                 title="Upload PDF"/>
        </div>
										<div class="form-group">
											<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userid">
											<input data-loading-text="Saving Purchase..." type="submit" name="purchase_btn" value="Save purchase" class="btn btn-success submit_btn pur-save-btm">						
										</div>
										
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
										<span class="form-inline">
											<div class="form-group">
												<label>Subtotal: &nbsp;</label>
												<div class="input-group">
													<div class="input-group-addon currency">₹</div>
													<input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
												</div>
											</div>
											<div class="form-group">
												<label>Tax Rate: &nbsp;</label>
												<div class="input-group">
													<input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
													<div class="input-group-addon">%</div>
												</div>
											</div>
											<div class="form-group">
												<label>Tax Amount: &nbsp;</label>
												<div class="input-group">
													<div class="input-group-addon currency">₹</div>
													<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
												</div>
											</div>							
											<div class="form-group">
												<label>Total: &nbsp;</label>
												<div class="input-group">
													<div class="input-group-addon currency">₹</div>
													<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
												</div>
											</div>
											<div class="form-group">
												<label>Amount Paid: &nbsp;</label>
												<div class="input-group">
													<div class="input-group-addon currency">₹</div>
													<input value="" type="number" class="form-control" name="purchase_amount_paid" id="amountPaid" placeholder="Amount Paid">
												</div>
											</div>
											<div class="form-group">
												<label>Amount Due: &nbsp;</label>
												<div class="input-group">
													<div class="input-group-addon currency">₹</div>
													<input value="" type="number" class="form-control" name="purchase_total_amount_due" id="amountDue" placeholder="Amount Due">
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
		
    </section>
</div>
<?php include('footer.php');?>