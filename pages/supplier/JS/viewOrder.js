var productsArr;
var orderProductsArray;
var orderTotal = 0.00;

$(()=>{
	let collectionCheck=$("#collectionCheck").text();
	console.log(ORDER_ID);
	console.log(collectionCheck);
	if(collectionCheck=="")
	{
		$("#btnAddCollection").attr("disabled",false);
	}
	else
	{
		$("#btnAddCollection").attr("disabled",true);
	}
	$.ajax({
		url:'PHPcode/getOrderProducts.php',
		type:'POST',
		data:{orderID : ORDER_ID}
	})
	.done(response=>{
		if(response!="False")
		{
			orderProductsArray=JSON.parse(response);
			console.log(orderProductsArray);
			$("#oProd").val(JSON.stringify(orderProductsArray));
			$("#oProducts").val(JSON.stringify(orderProductsArray));
			for(let k=0;k<orderProductsArray.length;k++)
			{
				buildTable(k);
			}
			let total = orderTotal;
			let vat = total*0.15;
			
			total = total.toFixed(2);
			total = numberWithSpaces(total);

			vat = vat.toFixed(2);
			vat = numberWithSpaces(vat);

			$("#sTotal").text("R"+total);
			$("#sVAT").text("R"+vat);
		}
		else
		{
			alert("Error");
		}

	});	

	$.ajax({
		url: 'PHPcode/getOrderReturns_.php',
		type: 'POST',
		data: { 
			orderID : ORDER_ID
		},
		beforeSend: function() {

    	}
	})
	.done(response => {
		
		console.log(response);
		returnsArray=JSON.parse(response);
		$("#oReturns").val(JSON.stringify(returnsArray));

		//console.log("RETURNS");
		//console.log(returnsArray);

		if (response != "false")
		{
			for(let k=0;k<returnsArray.length;k++)
			{
				buildReturnsTable(k);
			}
		}
		else if(response == "false")
		{
			$("#tBodyReturns").append("<tr><td class='py-3 text-left'><b>No Returns</b></td></tr>");
		}
		else if(response == "Database error")
		{
			$('#modal-title-default2').text("Database Error!");
			$('#modalText').text("Database error whilst verifying password");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		
		ajaxDone = true;
	});

	for(let k=1;k<=2;k++)
	{
		if(ORDER_STATUS_ID!=k)
		{
			$("#"+k).removeClass("progtrckr-todo");
			$("#"+k).addClass("progtrckr-done");
		}
		else
		{
			$("#"+k).removeClass("progtrckr-todo");
			$("#"+k).addClass("progtrckr-done");
			break;
		}
	}

	let orderDetails=JSON.parse($("#oDetails").text());
	console.log(orderDetails);
	$("#oDet").val(JSON.stringify(orderDetails));
	$("#acOrdID").val(orderDetails["SUPPLIER_ID"]);
	$("#acOrderDetails").val(JSON.stringify(orderDetails));
	if(ORDER_STATUS_ID==2)
	{
		$("#btnReceiveStock").attr("disabled",true);
		$("#btnAddCollection").attr("disabled",true);
	}
	else
	{
		$("#btnReturn").attr("disabled",true);
	}

});

let buildTable=function(tmp)
{
	let tableEntry=$("<tr></tr>");
	let productQuantityEntry=$("<td></td>").addClass("py-3 text-center").text(orderProductsArray[tmp]["QUANTITY"]);
	let productNameEntry=$("<td></td>").addClass("py-3").text(orderProductsArray[tmp]["PRODUCT_NAME"]);

	let productUnitPrice = parseFloat(orderProductsArray[tmp]["PRICE"]);
	productUnitPrice = productUnitPrice.toFixed(2);
	productUnitPrice = numberWithSpaces(productUnitPrice);
	productUnitPrice = "R"+ productUnitPrice;

	let productUnitPriceEntry=$("<td></td>").addClass("text-right py-3").text(productUnitPrice);

	let productTotalPrice = parseFloat(orderProductsArray[tmp]["QUANTITY"]).toFixed(2)*parseFloat(orderProductsArray[tmp]["PRICE"]).toFixed(2);
	orderTotal += productTotalPrice;

	productTotalPrice = productTotalPrice.toFixed(2);
	productTotalPrice = numberWithSpaces(productTotalPrice);
	productTotalPrice = "R"+ productTotalPrice;

	let productTotalEntry=$("<td></td>").addClass("text-right py-3").text(productTotalPrice);

	tableEntry.append(productQuantityEntry);
	tableEntry.append(productNameEntry);
	tableEntry.append(productUnitPriceEntry);
	tableEntry.append(productTotalEntry);
	$("#tBody").append(tableEntry);
}

let buildReturnsTable=function(tmp)
{
	let tableEntry=$("<tr></tr>");

	let productQuantityEntry=$("<td></td>").addClass("py-3 text-center").text(returnsArray[tmp]["QUANTITY"]);
	let productNameEntry=$("<td></td>").addClass("py-3").text(returnsArray[tmp]["PRODUCT_NAME"]);

	let productUnitPrice = parseFloat(returnsArray[tmp]["SELLING_PRICE"]);
	productUnitPrice = productUnitPrice.toFixed(2);
	productUnitPrice = numberWithSpaces(productUnitPrice);
	productUnitPrice = "R"+ productUnitPrice;

	let productUnitPriceEntry=$("<td></td>").addClass("text-right py-3").text(productUnitPrice);

	let productTotalPrice = parseFloat(returnsArray[tmp]["QUANTITY"]).toFixed(2)*parseFloat(returnsArray[tmp]["SELLING_PRICE"]).toFixed(2);
	productTotalPrice = productTotalPrice.toFixed(2);
	productTotalPrice = numberWithSpaces(productTotalPrice);
	productTotalPrice = "R"+ productTotalPrice;

	let productTotalEntry=$("<td></td>").addClass("text-right py-3").text(productTotalPrice);
	tableEntry.append(productQuantityEntry);
	tableEntry.append(productNameEntry);
	$("#tBodyReturns").append(tableEntry);

}

function setTwoNumberDecimal(el) 
{
    el.value = parseFloat(el.value).toFixed(2);     
};

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}