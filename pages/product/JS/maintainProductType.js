var selectedProdType;
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});

});

$("button#maintainProductType").on('click', event => {
	event.preventDefault();
	let form = $('#maintainProductTypeForm');
	form.validate();
	if(form.valid() === false)
	{
		event.stopPropagation();
	}
	else
	{
		let productTypeID = $("#ProductTypeID").val();

		let productTypeName = $("#productTypeName").val();
		let productTypeDescription = $("#productTypeDescription").val();

		let prevProductTypeName = $("#previousTypeName").val();
		let prevProductTypeDescription = $("#previousDescription").val();

		$.ajax({
			url: 'PHPcode/maintainProductType_.php',
			type: 'POST',
			data: { 
				productTypeID_ : productTypeID,
				productTypeName_ : productTypeName,
				productTypeDescription_ : productTypeDescription,
				prevProductTypeName_ : prevProductTypeName,
				prevProductTypeDescription_ : prevProductTypeDescription
			},
			beforeSend: function() {
	
	    	}
		})
		.done(response => {
			console.log(response);
			if (response == "success")
			{
				$('#modal-title-default').text("Success!");
				$('#modalText').text("Product type maintained sucessfully");
				$("#modalCloseButton").attr("onclick","window.location='search_type.php'");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "product type exists")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("A product type with the changed name already exists");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "no changes made")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("You have not made any changes to the product type");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "database error")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("Database error adding product type");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			
			ajaxDone = true;
		});
	}	
});

