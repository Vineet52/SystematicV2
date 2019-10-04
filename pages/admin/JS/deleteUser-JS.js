$(()=>{
	$.ajax({
		url: 'PHPcode/deleteUser-SQL.php',
		type: 'POST',
		data: {choice:2} 
	})
	.done(data=>{
		console.log(data);
		if(data!="False")
		{
			let arr=JSON.parse(data);
			console.log(arr);
			let tableEntries="";
			let formView="";
			//let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				
				formView="<form action='' method='POST'><input type='hidden' id ='USER_ID' name='USER_ID' value='"+arr[k]["USER_ID"]+"'>"+"<input type='hidden' id ='EMPLOYEE_ID' name='EMPLOYEE_ID' value='"+arr[k]["EMPLOYEE_ID"]+"'>"+"<input type='hidden' id ='NAME' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' id ='SURNAME' name='SURNAME' value='"+arr[k]["SURNAME"]+"'>"+"<input type='hidden' id='USER_STATUS_NAME' name='USER_STATUS_NAME' value='"+arr[k]["USER_STATUS_NAME"]+"'>"+"<button class='btn btn-icon btn-2 btn-danger btn-sm' type='button' data-toggle='modal' data-target='#deleteUserModal'><span class='btn-inner--icon'><i class='fas fa-trash'></i></span><span class='btn-inner--text'>Delete</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["USER_ID"]+"</td><td>"+arr[k]["EMPLOYEE_ID"]+"</td><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["SURNAME"]+"</td><td>" + arr[k]["USER_STATUS_NAME"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
    });
    

    $("#deleteUserButton").click(function(e){
        e.preventDefault();


            let userID = $("#USER_ID").val();
            console.log(userID);
            //let dismissalReason = $("#reasonOFDismissal").val();
      
            $.ajax({
                url:'PHPcode/deleteUser-SQL.php',
                type:'post',
                data:{choice:4, user_ID:userID},
                success:function(data)
                {

                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation=="success")
                    {
                        $("#modal-title-defaultDismiss").text("Success!");
                        $("#modalTextDismiss").text("User successfully deleted");
                        $("#btnCloseDismiss").attr('onclick',"window.location='../../admin.php'");
                        $("#deleteUserModalSuccess").modal("show");
                    }
                    else if(confirmation == "Could not change user status")
                    {
                        $("#modal-title-defaultDismiss").text("Error!");
                        $("#modalTextDismiss").text("User could not be deleted , due to error in system , please try again");
                        $("#deleteUserModalSuccess").modal("show");
                    }
                    else
                    {
                        $("#modal-title-defaultDismiss").text("Error!");
                        $("#modalTextDismiss").text("User could not be deleted , due to error in system , please try again");
                        $("#deleteUserModalSuccess").modal("show");
                    }
                },
            });
        
        

    });




});