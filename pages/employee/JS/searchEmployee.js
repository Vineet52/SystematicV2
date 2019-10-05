$(()=>{
	$.ajax({
		url: 'PHPcode/employeecode.php',
		type: 'POST',
		data: {choice:2},

	})
	.done(data=>{
		
		if(data!="False")
		{
			let arr=JSON.parse(data);
			//console.log(arr);
			let tableEntries="";
			let formView="";
			//let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				
				formView="<form action='view.php' method='POST'><input type='hidden' name='EMPLOYEE_ID' value='"+arr[k]["EMPLOYEE_ID"]+"'>"+"<input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='IDENTITY_NUMBER' value='"+arr[k]["IDENTITY_NUMBER"]+"'>"+"<input type='hidden' name='SURNAME' value='"+arr[k]["SURNAME"]+"'>"+"<input type='hidden' name='CONTACT_NUMBER' value='"+arr[k]["CONTACT_NUMBER"]+"'>"+"<input type='hidden' name='EMAIL' value='"+arr[k]["EMAIL"]+"'>"+"<input type='hidden' name='ADDRESS_ID' value='"+arr[k]["ADDRESS_ID"]+"'>"+"<input type='hidden' name='TITLE_ID' value='"+arr[k]["TITLE_ID"]+"'>"+"<input type='hidden' name='EMPLOYEE_TYPE_ID' value='"+arr[k]["EMPLOYEE_TYPE_ID"]+"'>"+"<input type='hidden' name='EMPLOYEE_STATUS_ID' value='"+arr[k]["EMPLOYEE_STATUS_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-user'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["EMPLOYEE_ID"]+"</td><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["SURNAME"]+"</td><td>"+arr[k]["IDENTITY_NUMBER"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});
});