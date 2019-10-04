function setTwoNumberDecimal(el) {
    el.value = parseFloat(el.value).toFixed(2);
};

var selectedProdType;
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});
	
	$("select#productType").change(function(){
        selectedProdType = $(this).children("option:selected").val();
    });

    $.ajax({
		url: 'PHPcode/getProductTypes_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!= false)
		{
			let arr = JSON.parse(data);
			let options="";
			let formView="";
			let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				options+="<option value='"+arr[k]["PRODUCT_TYPE_ID"]+"' >"+arr[k]["TYPE_NAME"]+"</option>";
			}
			$("#productType").append(options);

			var oldProductTypeID = $('input[name=PRODUCT_TYPE_ID]').val();
			$("#productType option[value='"+oldProductTypeID+"']").attr('selected','selected');
			selectedProdType = oldProductTypeID;
		}
		else
		{
			alert("Error");
		}
	});

	var oldMeasurementUnit = $('input[name=PRODUCT_MEASUREMENT_UNIT]').val();
	$("#productMeasurementUnit option[value='"+oldMeasurementUnit+"']").attr('selected','selected');
	 
});

$("button#maintainProduct").on('click', event => {
	event.preventDefault();
	let form = $('#maintainProductForm');
	form.validate();
	if(form.valid() === false)
	{
		event.stopPropagation();
	}
	else
	{
		var productGroupID = $('input[name=PRODUCT_GROUP_ID]').val();
		var prevProductName = $('input[name=NAME]').val();
		var prevUnitsPerCase = $('input[name=UNITS_PER_CASE]').val();
		var prevCasesPerPallet = $('input[name=CASES_PER_PALLET]').val();
		var prevCostPrice = $('input[name=COST_PRICE]').val();
		var prevGuideDiscount = $('input[name=GUIDE_DISCOUNT]').val();
		var prevSellingPrice = $('input[name=SELLING_PRICE]').val();
		var prevProductMeasurement = $('input[name=PRODUCT_MEASUREMENT]').val();
		var prevProductMeasurementUnit = $('input[name=PRODUCT_MEASUREMENT_UNIT]').val();
		var prevProductTypeID = $('input[name=PRODUCT_TYPE_ID]').val();
		var prevProductDescription = $('input[name=PRODUCT_DESCR]').val();
		

		let productName = $("#productName").val();
		let productDescription = $("#productDescription").val();
		let unitsInCase = $("#unitsInCase").val();
		let casesInPallet = $("#casesInPallet").val();
		let costPrice = $("#costPrice").val();
		let discountPrice = $("#discountPrice").val();
		let sellingPrice = $("#sellingPrice").val();
		let measurement = $("#productMeasurement").val();
		let measurementUnit = $("#productMeasurementUnit").val();
		let productType = selectedProdType;

		$.ajax({
			url: 'PHPcode/maintainProduct_.php',
			type: 'POST',
			data: { 
				productGroupID_ : productGroupID,
				prevProductName_ : prevProductName,
				prevUnitsPerCase_ : prevUnitsPerCase,
				prevCasesPerPallet_ : prevCasesPerPallet,
				prevCostPrice_ : prevCostPrice,
				prevGuideDiscount_ : prevGuideDiscount,
				prevSellingPrice_ : prevSellingPrice,
				prevProductMeasurement_ : prevProductMeasurement,
				prevProductMeasurementUnit_ : prevProductMeasurementUnit,
				prevProductTypeID_ : prevProductTypeID,
				prevProductDescription_ : prevProductDescription,
				productName_ : productName,
				productDescription_ : productDescription,
				productTypeID_ : productType,
				unitsInCase_ : unitsInCase,
				casesInPallet_ : casesInPallet,
				costPrice_ : costPrice,
				discountPrice_ : discountPrice,
				sellingPrice_ : sellingPrice,
				measurement_ : measurement,
				measurementUnit_ : measurementUnit
			},
			beforeSend: function() {
	
	    	}
		})
		.done(response => {
			console.log(response);
			if (response == "success")
			{
				$('#modal-title-default').text("Success!");
				$('#modalText').text("Product maintained sucessfully");
				$("#modalCloseButton").attr("onclick","window.location='../../product.php'");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "product exists")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("A product with the changed name already exists");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "no changes made")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("You have not made any changes to the product");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "database error")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("Database error adding product");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			
			ajaxDone = true;
		});
	}	
});

