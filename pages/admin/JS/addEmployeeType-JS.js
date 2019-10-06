$(document).ready(function()
{
        let switchStatus = false;
        $("#toggle-two").on('change', function() {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
                console.log(switchStatus + "first if" );// To verify
            }
            else {
            switchStatus = $(this).is(':checked');
            console.log(switchStatus + "else statement" );// To verify
            }
        });


        $.ajax({
            url:"PHPcode/addEmployeeType-SQL.php",
            type:'POST',
            data:{choice:0}
        })
        .done(data=>{
            if(data!="False")
            {
                console.log(data);
                let arr=JSON.parse(data);
                let tableEntries="";
                for(let k=0;k<arr.length;k++)
                {
                let entry=$("<option></option>").attr("name",arr[k]["ACCESS_LEVEL_ID"]);
                entry.text(arr[k]["ROLE_NAME"]); 
                $("#aLevel").append(entry);
                }   
            }
            else
            {
                alert("Error");
            }
        });

     

        $("#addEmployeeTypeSave").on("click",function(e)
            {

                e.preventDefault();
                //alert("Yeyi");
                let accessLevelID = parseInt($("#aLevel option:selected").attr("name"));;
                let postionName = $("#posName").val();
                let wageEarningID;
                if(switchStatus)
                {
                    wageEarningID = 1;
                }
                else
                {
                    wageEarningID = 0;
                }
            

             

                console.log(accessLevelID);

                //console.log(username);
                $.ajax({
                    url:"PHPcode/addEmployeeType-SQL.php",
                    type:'POST',
                    data:{choice:1 , accessLevel:accessLevelID , position:postionName , wage_earner:wageEarningID}
                })
                .done(data=>{

                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation== "success")
                    {
                        $("#modal-title-default").text("Success!");
                        $("#modalText").text("Employee Type added successfully");
                        $("#btnClose").attr("onclick","window.location='../../admin.php'");
                        $("#displayModal").modal("show");
                    }
                    else if(confirmation == "Employee Type exists!")
                    {
                        $("#modal-title-default").text("Error!");
                        $("#modalText").text("Employee Type exists! , press close and try again");
                        $("#displayModal").modal("show");
                    }
                    else
                    {
                        $("#modal-title-default").text("Error!");
                        $("#modalText").text("Database error");
                       
                        $("#displayModal").modal("show");
                    }
                });

            });
                                $("#modal-title-default").text("Success!");
                        $("#modalText").text("Employee Type added successfully");
                        $("#btnClose").attr("onclick","window.location='../../admin.php'");
                        $("#displayModal").modal("show");

});