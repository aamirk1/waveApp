 $(document).ready(function(){
	
	$(document).on('click', '.deleteWeb', function(){
		var id = $(this).attr("id");
		console.log(id);
		if(confirm("Are you sure you want to remove this website?")){
			$.ajax({
				url:"web_delete.php",
				type:"POST",
				dataType: "json",
				data:{id:id, action:'webdelete'},	
					
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
		location.reload();
	});
});	

 