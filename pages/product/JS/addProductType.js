var selectedProdType;
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});

});

$("button#addProductType").on('click', event => {
	event.preventDefault();
	let form = $('#addProductTypeForm');
	form.validate();
	if(form.valid() === false)
	{
		event.stopPropagation();
	}
	else
	{
		console.log('starting AJAX');
		let productTypeName = $("#productTypeName").val();
		let productTypeDescription = $("#productTypeDescription").val();

		$.ajax({
			url: 'PHPcode/addProductType_.php',
			type: 'POST',
			data: { 
				productTypeName_ : productTypeName,
				productTypeDescription_ : productTypeDescription
			},
			beforeSend: function() {
	
	    	}
		})
		.done(response => {
			console.log(response);
			if (response == "success")
			{
				$('#modal-title-default').text("Success!");
				$('#modalText').text("Product type added sucessfully");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "product type exists")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("This product already exists");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "database error")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("Error adding product type");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			
			ajaxDone = true;
		});
	}	
});

