$(document).ready(function(){
    $("#sendEmail").on("submit",function(e){
        e.preventDefault();

        let emailSent = $("#email").val();
        //console.log(emailSent);
            $.ajax({
                url:'PHPcode/sendEmail.php',
                type:'post',
                data:{email:emailSent}
            })
            .done(function(data)
                {

                    console.log(data);
                    if(data=="success")
                    {
                        $("#modal-title-default").text("Success!");
                        $("#modalText").text("Reset password link sent. Check your email");
                        $("#successfullyChanged").modal("show");

                       window.location = `PHPcode/generatePasswordLink.php?email='${emailSent}'`;
                        
                       
                       
                    }
                    else
                    {
                        $('#alert-sendEmail').empty();
                        $('#alert-sendEmail').append("<div class='alert alert-danger' role='alert'><span class='alert-inner--text'><strong>Error sending email!</strong> </span></div>");    
                    }
                
            });
     
    });
});