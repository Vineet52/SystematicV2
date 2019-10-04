$(document).on('change', '.custom-file-input', function (event) {
    $(this).next('.custom-file-label').html(event.target.files[0].name);
})

$(document).ready(function(){


    $("#uploadForm").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "PHPcode/apply_for_credit_.php",
            type: "POST",
            data:  new FormData(this),
            beforeSend: function(){
                $('.loadingModal').modal('show');
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                $('.loadingModal').modal('hide');
                console.log(data);
                if(data=="successfile has been uploaded successfullyfile has been uploaded successfullyfile has been uploaded successfully"){
                	$('#modal-title-default2').text("Success!");
                    $('#modalText').text("Customer credit account successfully added");
                    $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                    $("#modalHeader").css("background-color", "#1ab394");
                    $('#successfullyAdded').modal("show");
                    $("#btnClose").attr("onclick","window.location='search.php'");
                    $("#displayModal").modal("show");


                }
                else{
                
                    $('#modal-title-default2').text("Error!");
                    $('#modalText').text("Database error");
                    $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                    $("#modalHeader").css("background-color", "red");
                    $('#successfullyAdded').modal("show");
                    $("#btnClose").attr("data-dismiss","modal");
                    $("#displayModal").modal("show");
                }

            }           
        });
    }));
});