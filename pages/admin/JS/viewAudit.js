$(()=>{



	var tableEntries="";
	

	var functionalityArr;
	$.ajax({
		url:'PHPcode/viewAuditCode.php',
		type:'POST',
		data:{choice:3}
	})
	.done(data=>{
		if(data!="Error")
		{	
			
			var arr=JSON.parse(data);
			//console.log(arr);
			let options="";
			
			for(let k=0;k<arr.length;k++)
			{
				options+="<option value='"+arr[k]["NAME"]+"' >"+arr[k]["NAME"]+"</option>";
				var formattedTime = moment(arr[k]["AUDIT_DATE"]).format('L - LT');
				tableEntries+="<tr><td>"+arr[k]["USERNAME"]+"</td><td>"+formattedTime+"</td><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["CHANGES"]+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			$("#function_name").append(options);
	// 		var option=[];
	// 		for (var i = 0; i < arr.length; i++) {
	// 			option[i]=arr[i]["NAME"];
	// 		}
	// let x = (option) => names.filter((v,i) => names.indexOf(v) === i)
	// 		x(option);

}

		}
		else
		{
			
		}
	});
	$("button#refresh").on('click', event => {
		event.preventDefault();
		$("#tBody").empty();
		$("#tBody").append(tableEntries);
	});

	$("button#advanced_search").on('click', event => {
		event.preventDefault();

			let username = $("#username").val();
			let function_name = $("#function_name").val();
			let data_changed = $("#data_changed").val();
			
			console.log(username+function_name+data_changed);

			$.ajax({
				url:'PHPcode/advanced_search.php',
				type:'POST',
				data:{username:username,sub_name:function_name,changed:data_changed}
			})
			.done(data=>{
				if(data!="Error")
				{	
					console.log(data);
					var arr=JSON.parse(data);
					$("#tBody").empty();
					// console.log(arr);
					// let options="";
					let search_res="";
					for(let k=0;k<arr.length;k++)
					{
					
						search_res+="<tr><td>"+arr[k]["USERNAME"]+"</td><td>"+arr[k]["AUDIT_DATE"]+"</td><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["CHANGES"]+"</td></tr>";
					}
					$("#tBody").append(search_res);
					$("#modal-form").modal('hide');


				}
				else
				{
					// $("#tBody").empty();
					$("#emptySearch").show();
					setTimeout(function () {
					  	$("#emptySearch").hide();
					}, 5000);
				
					
					//let error_mes='<tr id="emptySearch" style="display: none;" class="table-danger mb-3"><td><b>No Audit Log Entry Found</b></td><td></td><td></td><td></td></tr>';
					// /$("#tBody").append(error_mes);
					$("#modal-form").modal('hide');
					
				}
			});
		
	});



});
