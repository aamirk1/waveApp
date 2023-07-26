<?php
include('connection.php');
class Vendor{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "cms";   
	private $invoiceUserTable = 'invoice_user';	
    private $purchaseBillTable = 'purchase_bill';
	private $purchaseOrderItemTable = 'purchase_order_item';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: ');
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: ');
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function loginUsers($email, $password){
		$sqlQuery = "
			SELECT id, email, first_name, last_name, address, mobile 
			FROM ".$this->invoiceUserTable." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:index.php");
		}
	}		
	// $target_dir = "uploads/";
	// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	// $uploadOk = 1;
	// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	
	public function savePurchase($POST) {
		// if($_GET['id']==0){
		// 	if($_FILES['pdf_file']['type']!='pdf_file/pdf'){
		// 		$msg="Please select only png,jpg and jpeg image formate";
		// 	}
		// }else{
		// 	if($_FILES['pdf_file']['type']!=''){
		// 			if($_FILES['pdf_file']['type']!='pdf_file/pdf'){
		// 			$msg="Please select only png,jpg and jpeg image formate";
		// 		}
		// 	}
		// }
		
		include("connection.php");

		$pdf_file ='';
		$msg ='';
		if($msg == ''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['pdf_file']['name']!=''){
				$pdf_file=rand(111111111,999999999).'_'.$_FILES['pdf_file']['name'];
				move_uploaded_file($_FILES['pdf_file']['tmp_name'],'/media/'.$pdf_file);
				$update_sql="update purchase_bill set pdf_file='$pdf_file'";
			}else{
				$update_sql="update purchase_bill set pdf_file='$pdf_file' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			// $pdf_file=rand(111111111,999999999).'_'.$_FILES['pdf_file']['name'];
			// move_uploaded_file($_FILES['pdf_file']['tmp_name'],'/media/'.$pdf_file);
			$sqlInsert = "
			INSERT INTO ".$this->purchaseBillTable."(user_id,currency, shop_name, pdf_file, shop_address, mobile, purchase_date, purchase_total_before_tax, purchase_total_tax, purchase_tax_per, purchase_total_after_tax, purchase_amount_paid, purchase_total_amount_due, gst_number, warranty_duration, description) 
			VALUES ('".$POST['userid']."', '".$POST['currency']."', '".$POST['companyName']."', '".$POST['pdf_file']."', '".$POST['address']."', '".$POST['mobile']."', '".$POST['purchase_date']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['taxRate']."', '".$POST['totalAftertax']."' , '".$POST['purchase_amount_paid']."', '".$POST['purchase_total_amount_due']."', '".$POST['gst_number']."', '".$POST['warranty_duration']."', '".$POST['description']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->purchaseOrderItemTable."(vendor_id, item_code, item_name, purchase_item_quantity, purchase_item_price, purchase_item_final_amount) 
			VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}     
		}
		}
		
		  	
	}	
	public function updatePurchase($POST) {
		if($POST['vendorId']) {	
			$sqlInsert = "
				UPDATE ".$this->purchaseBillTable." 
				SET currency = '".$POST['currency']."',shop_name = '".$POST['companyName']."', shop_address= '".$POST['address']."',purchase_date= '".$POST['purchase_date']."', gst_number = '".$POST['gst_number']."', warranty_duration = '".$POST['warranty_duration']."', purchase_total_before_tax = '".$POST['subTotal']."', 
				purchase_total_tax = '".$POST['taxAmount']."', purchase_tax_per = '".$POST['taxRate']."', purchase_total_after_tax = '".$POST['totalAftertax']."', purchase_amount_paid = '".$POST['purchase_amount_paid']."', purchase_total_amount_due = '".$POST['purchase_total_amount_due']."', description = '".$POST['description']."' 
				WHERE user_id = '".$POST['userId']."' AND vendor_id = '".$POST['vendorId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
			
			// return  $this->updatePurchase($sqlInsert);	
		}		
		$this->deletePurchaseItems($POST['vendorId']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->purchaseOrderItemTable."(vendor_id, item_code, item_name, purchase_item_quantity, purchase_item_price, purchase_item_final_amount) 
				VALUES ('".$POST['vendorId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}       	
	}	
	public function getPurchaseList(){
		$sqlQuery = "
			SELECT * FROM ".$this->purchaseBillTable." 
			WHERE user_id = '".$_SESSION['userid']."' ";
		return  $this->getData($sqlQuery);
	}	
	public function getPurchase($vendorId){
		$sqlQuery = "
			SELECT * FROM ".$this->purchaseBillTable." 
			WHERE user_id = '".$_SESSION['userid']."' AND vendor_id = '$vendorId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getPurchaseItems($vendorId){
		$sqlQuery = "
			SELECT * FROM ".$this->purchaseOrderItemTable." 
			WHERE vendor_id = '$vendorId'";
		return  $this->getData($sqlQuery);	
	}
	public function deletePurchaseItems($vendorId){
		$sqlQuery = "
			DELETE FROM ".$this->purchaseOrderItemTable." 
			WHERE vendor_id = '".$vendorId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deletePurchase($vendorId){
		$sqlQuery = "
			DELETE FROM ".$this->purchaseBillTable." 
			WHERE vendor_id = '".$vendorId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deletePurchaseItems($vendorId);	
		return 1;
	}
}
?>