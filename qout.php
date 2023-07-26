<?php
class Qout{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "cms";   
	private $invoiceUserTable = 'invoice_user';	
    private $qoutOrderTable = 'qout_order';
	private $qoutOrderItemTable = 'qout_order_item';
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
	public function saveQout($POST) {		
		$sqlInsert = "
			INSERT INTO ".$this->qoutOrderTable."(user_id, qout_receiver_name, qout_receiver_address, duedate, qout_total_before_tax, qout_total_tax, qout_tax_per, qout_total_after_tax, note) 
			VALUES ('".$POST['userId']."', '".$POST['companyName']."', '".$POST['address']."', '".$POST['duedate']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['taxRate']."', '".$POST['totalAftertax']."', '".$POST['notes']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->qoutOrderItemTable."(qout_id, item_code, item_name, qout_item_quantity, qout_item_price, qout_item_final_amount) 
			VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	
	public function updateQout($POST) {
		if($POST['qoutId']) {	
			$sqlInsert = "
				UPDATE ".$this->qoutOrderTable." 
				SET qout_receiver_name = '".$POST['companyName']."', qout_receiver_address= '".$POST['address']."',duedate= '".$POST['duedate']."', qout_total_before_tax = '".$POST['subTotal']."', 
				qout_total_tax = '".$POST['taxAmount']."', qout_tax_per = '".$POST['taxRate']."', qout_total_after_tax = '".$POST['totalAftertax']."', note = '".$POST['notes']."' 
				WHERE user_id = '".$POST['userId']."' AND qout_id = '".$POST['qoutId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
			
			// return  $this->updateQout($sqlInsert);	
		}		
		$this->deleteQoutItems($POST['qoutId']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->qoutOrderItemTable."(qout_id, item_code, item_name, qout_item_quantity, qout_item_price, qout_item_final_amount) 
				VALUES ('".$POST['qoutId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}       	
	}	
	public function getQoutList(){
		$sqlQuery = "
			SELECT * FROM ".$this->qoutOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}	
	public function getQout($qoutId){
		$sqlQuery = "
			SELECT * FROM ".$this->qoutOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."' AND qout_id = '$qoutId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getQoutItems($qoutId){
		$sqlQuery = "
			SELECT * FROM ".$this->qoutOrderItemTable." 
			WHERE qout_id = '$qoutId'";
		return  $this->getData($sqlQuery);	
	}
	public function deleteQoutItems($qoutId){
		$sqlQuery = "
			DELETE FROM ".$this->qoutOrderItemTable." 
			WHERE qout_id = '".$qoutId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deleteQout($qoutId){
		$sqlQuery = "
			DELETE FROM ".$this->qoutOrderTable." 
			WHERE qout_id = '".$qoutId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deleteQoutItems($qoutId);	
		return 1;
	}
}
?>