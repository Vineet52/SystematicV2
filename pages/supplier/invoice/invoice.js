var orderProductsArray;
var productsArray;
var saleTotal = 0;

function setTwoNumberDecimal(el) 
{
    el.value = parseFloat(el.value).toFixed(2);     
};

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

function remove_first_character(element) {
  return element.slice(1)
}

$(()=>{
	var orderProductsArrayString = $("#orderProductsArray").val();
	orderProductsArray = JSON.parse(orderProductsArrayString);
	console.log(orderProductsArray);
});

	$.ajax({
		url: '../PHPcode/getProducts_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			productsArray = JSON.parse(data);
			//console.log(productsArray);

			for (var i = 0; i < orderProductsArray.length; i++) 
			{
				var theProductID = orderProductsArray[i].PRODUCT_ID;
				var target = theProductID;
				var result = $.grep(productsArray, function(e){ return e.PRODUCT_ID == target; });			

				let pType="Individual";
				let pNumber= 1;
				if(result[0].PRODUCT_SIZE_TYPE==2)
				{
					pType="Case";
					pNumber=result[0].UNITS_PER_CASE;
				}
				else if(result[0].PRODUCT_SIZE_TYPE==3)
				{
					pType="Pallet";
					pNumber=result[0].CASES_PER_PALLET;
				}

				let theProductName = result[0].NAME+" ("+pNumber+" x "+result[0].PRODUCT_MEASUREMENT+result[0].PRODUCT_MEASUREMENT_UNIT+")"+" "+pType;

				orderProductsArray[i].PRODUCT_NAME = theProductName;
			}
			//console.log(orderProductsArray);

			var tableEntries = "";
			for (var i = 0; i < orderProductsArray.length; i++) {
				var productLineTotal = orderProductsArray[i].COST_PRICE * orderProductsArray[i].QUANTITY;
				productLineTotal = parseFloat(productLineTotal).toFixed(2);
				saleTotal = parseFloat(saleTotal) + parseFloat(productLineTotal);
				
				productLineTotal = numberWithSpaces(productLineTotal);
				productLineTotal = "R"+ productLineTotal;

				var productLineSellingPrice = orderProductsArray[i].COST_PRICE;
				productLineSellingPrice = parseFloat(productLineSellingPrice).toFixed(2);
				productLineSellingPrice = numberWithSpaces(productLineSellingPrice);
				productLineSellingPrice = "R"+ productLineSellingPrice;

				tableEntries+="<tr><td class='no'>"+(i+1)+"</td><td class='desc'><h3>"+orderProductsArray[i].PRODUCT_NAME+"</h3></td><td class='unit'>"+productLineSellingPrice+"</td><td class='qty'>"+orderProductsArray[i].QUANTITY+"</td><td class='total'>"+productLineTotal+"</td></tr>";
			}
			$("#tBody").append(tableEntries);

			var saleVAT = saleTotal * 0.15;
			saleTotal * 1.00;
			saleTotal = saleTotal.toFixed(2);
			//saleTotal = Math.round(saleTotal * 100) / 100;
			
			console.log(saleTotal);
			saleTotal = numberWithSpaces(saleTotal);
			saleTotal = "R"+ saleTotal;
			$("#saleTotal").append(saleTotal);

			saleVAT = parseFloat(saleVAT).toFixed(2);
			saleVAT = numberWithSpaces(saleVAT);
			saleVAT = "R"+ saleVAT;
			$("#saleVAT").append(saleVAT);

			var orderID = $("#ORDER_ID").val();
			
			var divHeight = $('body').height();
			var divWidth = $('body').width();
			var ratio = divHeight / divWidth;
			html2canvas(document.getElementById("content"), {
			    height: divHeight,
			    width: divWidth,
			    onrendered: function(canvas) {
					var image = canvas.toDataURL("image/png",1.0);
					var pdf = new jsPDF('p','pt','a4'); // using defaults: orientation=portrait, unit=mm, size=A4
					var width = pdf.internal.pageSize.getWidth();    
					var height = pdf.internal.pageSize.getHeight();

					height = ratio * width;
					pdf.addImage(image, 'PNG', -150, 20, width+300, height-70);
					//pdf.save('invoices/myPage.pdf'); //Download the rendered PDF.

					var doc = btoa(pdf.output());
					var data = new FormData();
					data.append("data", doc);
					var xhr = new XMLHttpRequest();
					xhr.open( 'post', 'upload.php?name=' + orderID , true );
					// console.log(data);
					xhr.send(data);

					xhr.onreadystatechange = function() {
					   	if (this.readyState == 4 && this.status == 200) {
					        // Typical action to be performed when the document is ready:
					        console.log(xhr.responseText);
					   	}
					};
			    }
			});
		}
		else
		{
			alert("Error");
		}
	});