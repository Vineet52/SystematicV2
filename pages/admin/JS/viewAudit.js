$(()=>{




	

	var functionalityArr;
	$.ajax({
		url:'PHPcode/viewAuditCode.php',
		type:'POST',
		data:{choice:3}
	})
	.done(data=>{
		if(data!="False")
		{	


				$.ajax({
					url:'PHPcode/subFunctionality.php',
					type:'POST',
					data:{choice:3}
				})
				.done(data2=>{
					if(data!="False")
					{	


						functionalityArr=JSON.parse(data2);
						var arr=JSON.parse(data);
						let tableEntries="";
						let formView="";
						for(let k=0;k<arr.length;k++)
						{
							
							let id=arr[k]["SUB_FUNCTIONALITY_ID"];
							let subName=funcName(id,functionalityArr);
							//formView="<form action='maintain_truck.php' method='POST'><input type='hidden' name='REGISTRATION' value='"+arr[k]["REGISTRATION_NUMBER"]+"'>"+"<input type='hidden' name='TRUCK_NAME' value='"+arr[k]["TRUCK_NAME"]+"'>"+"<input type='hidden' name='TRUCK_ID' value='"+arr[k]["TRUCK_ID"]+"'>"+"<input type='hidden' name='CAPACITY' value='"+arr[k]["CAPACITY"]+"'>"+"<input type='hidden' name='ACTIVE' value='"+arr[k]["ACTIVE"]+"'>"+"<button class='btn btn-icon btn-2 btn-primary btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-wrench'></i></span><span class='btn-inner--text'>Maintain</span></button>"+"</form>";
							tableEntries+="<tr><td>"+arr[k]["USER_ID"]+"</td><td>"+arr[k]["AUDIT_DATE"]+"</td><td>"+subName+"</td><td>"+arr[k]["CHANGES"]+"</td></tr>";
						}
						$("#tBody").append(tableEntries);



						console.log(arr);
						var index = arr.findIndex(obj => obj.AUDIT_DATE=="2019-08-24 22:28:20");
						console.log(index);
					
					}
					else
					{
						alert("Sub functionality table is empty");
					}
				});




		}
		else
		{
			alert("Error");
		}
	});



});

function funcName(id,arrFunc){
	let indexFunc= arrFunc.findIndex(obj => obj.SUB_FUNCTIONALITY_ID==id);
	let funcName=arrFunc[indexFunc]["NAME"];
	console.log(funcName);
	return funcName;

}