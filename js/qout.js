 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".qout_itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.qout_itemRow', function() {  	
		if ($('.qout_itemRow:checked').length == $('.qout_itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".qout_itemRow").length;
	$(document).on('click', '#qout_addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="qout_itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" name="productCode[]" id="qout_productCode_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="productName[]" id="qout_productName_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="qout_quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="qout_price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="total[]" id="qout_total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#qoutItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".qout_itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=qout_quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=qout_price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	// $(document).on('blur', "#amountPaid", function(){
	// 	var amountPaid = $(this).val();
	// 	var totalAftertax = $('#totalAftertax').val();	
	// 	if(amountPaid && totalAftertax) {
	// 		totalAftertax = totalAftertax-amountPaid;			
	// 		$('#amountDue').val(totalAftertax);
	// 	} else {
	// 		$('#amountDue').val(totalAftertax);
	// 	}	
	// });	
	$(document).on('click', '.deleteqout', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action_qout.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_qout'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	
function calculateTotal(){
	var totalAmount = 0; 
	$("[id^='qout_price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("qout_price_",'');
		var price = $('#qout_price_'+id).val();
		var quantity  = $('#qout_quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
		$('#qout_total_'+id).val(parseFloat(total));
		totalAmount += total;			
	});
	$('#subTotal').val(parseFloat(totalAmount));	
	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();	
	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotal);		
		// var amountPaid = $('#amountPaid').val();
		// var totalAftertax = $('#totalAftertax').val();	
		// if(/*amountPaid &&*/ totalAftertax) {
		// 	totalAftertax = totalAftertax /*-amountPaid*/;			
		// 	$('#amountDue').val(totalAftertax);
		// } else {		
		// 	$('#amountDue').val(subTotal);
		// }
	}
}

 