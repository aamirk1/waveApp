 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".purchase_itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.purchase_itemRow', function() {  	
		if ($('.purchase_itemRow:checked').length == $('.purchase_itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".purchase_itemRow").length;
	$(document).on('click', '#purchase_addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="purchase_itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" name="productCode[]" id="purchase_productCode_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="productName[]" id="purchase_productName_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="purchase_quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="purchase_price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="total[]" id="purchase_total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#purchaseItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".purchase_itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=purchase_quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=purchase_price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deletePurchase', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action_vendor.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_purchase'},				
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
	$("[id^='purchase_price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("purchase_price_",'');
		var price = $('#purchase_price_'+id).val();
		var quantity  = $('#purchase_quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
		$('#purchase_total_'+id).val(parseFloat(total));
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
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax -amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}
}

 