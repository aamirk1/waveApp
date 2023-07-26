<?php

session_start();
include 'qout.php';
$qout = new Qout();
if(!empty($_GET['qout_id']) && $_GET['qout_id']) {
	echo $_GET['qout_id'];
	$qoutValues = $qout->getQout($_GET['qout_id']);		
	$qoutItems = $qout->getQoutItems($_GET['qout_id']);		
}
$qoutDate = date("d-M-Y, H:i:s", strtotime($qoutValues['qout_date']));
$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>Qoutation</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="65%">
	To,<br />
	<b>RECEIVER (BILL TO)</b><br />
	Name : '.$qoutValues['qout_receiver_name'].'<br /> 
	Billing Address : '.$qoutValues['qout_receiver_address'].'<br />
	</td>
	<td width="35%">         
	Qoutation No. : '.$qoutValues['qout_id'].'<br />
	Qoutation Date : '.$qoutDate.'<br />
	Qoutation Due Date : '.$qoutValues['duedate'].'<br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Sr No.</th>
	<th align="left">Item Code</th>
	<th align="left">Item Name</th>
	<th align="left">Quantity</th>
	<th align="left">Price</th>
	<th align="left">Actual Amt.</th> 
	</tr>';
$count = 0;   
foreach($qoutItems as $qoutItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$qoutItem["item_code"].'</td>
	<td align="left">'.$qoutItem["item_name"].'</td>
	<td align="left">'.$qoutItem["qout_item_quantity"].'</td>
	<td align="left">'.$qoutItem["qout_item_price"].'</td>
	<td align="left">'.$qoutItem["qout_item_final_amount"].'</td>   
	</tr>';
}
$output .= '
	<tr>
	<td align="right" colspan="5"><b>Sub Total</b></td>
	<td align="left"><b>'.$qoutValues['qout_total_before_tax'].'</b></td>
	</tr>
	<tr>
	<td align="right" colspan="5"><b>Tax Rate :</b></td>
	<td align="left">'.$qoutValues['qout_tax_per'].' %</td>
	</tr>
	<tr>
	<td align="right" colspan="5">Tax Amount: </td>
	<td align="left">'.$qoutValues['qout_total_tax'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="5">Total: </td>
	<td align="left">'.$qoutValues['qout_total_after_tax'].'</td>
	</tr>
	<tr>
	</tr>';
$output .= '
	</table>
	</td>
	</tr>
	</table>';
$output .= '
	<div style="margin-top:30px;">
	<img src="./dist/img/icons.png" alt="sign" />
	</div>';
// create pdf of Qoutation	
$qoutFileName = 'Qoutation-'.$qoutValues['qout_id'].'.pdf';

require_once('./dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$dompdf->loadHtml(html_entity_decode($output));

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->stream("new file", array("Attachment"=>0));
$pdf= $dompdf->output();

$dompdf->stream($qoutFileName, array("Attachment" => false));


?>