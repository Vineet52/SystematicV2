$(document).ready(function(){
    console.log("Catch all these errors");
    $("#deleteButton").click(function(e){
        e.preventDefault();


            let employeeID = $("#EMPLOYEE_ID").val();
            let dismissalReason = $("#reasonOFDismissal").val();
      
            $.ajax({
                url:'PHPcode/dismissEmployee-SQL.php',
                type:'post',
                data:{employee_ID:employeeID, reason:dismissalReason},
                beforeSend: function(){
                    $('.loadingModal').modal('show');
                }
                })
                .done(data=>
                {
                    $('.loadingModal').modal('hide');
                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation=="success")
                    {
                        $("#modal-title-defaultDismiss").text("Success!");
                        $("#modalTextDismiss").text("Employee successfully dismissed");
                        $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
						$("#modalHeader").css("background-color", "#1ab394");
                        $("#btnCloseDismiss").attr('onclick',"window.location='../../employee.php'");
                        $("#dismissEmployeeSuccess").modal("show");
                    }
                    else if(confirmation == "Could not change employee status")
                    {
                        $("#modal-title-defaultDismiss").text("Error!");
                        $("#modalTextDismiss").text("Employee could not be dismissed , due to error in system , please try again");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                        $("#dismissEmployeeSuccess").modal("show");
                    }
                    else
                    {
                        $("#modal-title-defaultDismiss").text("Error!");
                        $("#modalTextDismiss").text("Employee could not be dismissed , due to error in system , please try again");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                        $("#dismissEmployeeSuccess").modal("show");
                    }
                
            });
        
        

    });
});