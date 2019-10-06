<?php include_once("../sessionCheckPages.php");?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Search Employee - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">

  <!-- Link scanning library -->
 <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>
</head>

<body>
  <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Search Employee</a>
        <?php include_once("../usernavbar.php");?>
        
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-custom pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
               <div class="input-group input-group-rounded input-group-merge">
                 
                 <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Employee name or ID number" title="Type in a name" class="form-control form-control-rounded form-control-prepended" aria-label="Search">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-search"></span>
                    </div>
                  </div>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    Scan QR
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">QR Scanner</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!--img class="img-fluid" src="../../assets/img/brand/qr.png"-->

                          <div id="qrscan"  class="embed-responsive embed-responsive-16by9">
                                            <video autoplay="true" id="videoElement" class="embed-responsive-item">

                                            
                                            </video>
                                          </div>
                                          <script>
                                            /* var video = document.querySelector("#videoElement");

                                              if (navigator.mediaDevices.getUserMedia) {
                                                navigator.mediaDevices.getUserMedia({ video: true })
                                                  .then(function (stream) {
                                                    video.srcObject = stream;
                                                  })
                                                  .catch(function (err0r) {
                                                    console.log("Something went wrong!");
                                                  });
                                              }*/



                                          let scanner = new Instascan.Scanner(
                                              {
                                                video: document.getElementById('videoElement')
                                              }
                                          );

                                          scanner.addListener('scan', function(content) {

                                            $("#scanQr").click(function(e) {

                                              e.preventDefault();
                                              console.log(content);
                                          let savedID = content;
                                          $.ajax({
                                          type: 'POST',
                                          url: 'PHPcode/searchScanner-SQL.php',
                                          data: {qrCode : content},
                                          beforeSend: function(){
                                            $('.loadingModal').modal('show');
                                            }
                                          })
                                          .done(data => {
                                          // do something with data
                                          $('.loadingModal').modal('hide');
                                                  console.log(data);
                                                  let confirmation = data.trim();
                                                
                                                  if(confirmation == "success")
                                                  {
                                                      //Add this when fully done.
                                                      
                                                    
                                                        /*$('#modal-title-default').text("Success!");
                                                        $('#modalText').text("Employee found ,you will shortly be redirected to the view screen");
                                                        $('#scannerSearch').modal("show");

                                                        $("#successSearch").click(function(e) {

                                                            e.preventDefault();*/
                                                            window.location=`view.php?employeeID='${savedID}'`;
                                                           // window.location=`wage_calc.php?employeeID='${savedID}'`;
                                                        //});
                                                      /* setTimeout(function(){redirect()},10000);
                                                      
                                                      function redirect()
                                                      {
                                                        // go do that thing
                                                          
                                                      
                                                      }*/


                                                      // alert('The scanned content is: ' + content);
                                                    // window.open(content, "_blank");

                                                  }
                                                  else if(confirmation != "success")
                                                  {
                                                    $('#modal-title-default').text("Error!");
                                                    $('#modalText').text("Employee not found , please try again or search employee");
                                                    $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
						                                        $("#modalHeader").css("background-color", "red");
                                                    $('#scannerSearch').modal("show");
                                                  }
                                              })
                                              .fail(()=>
                                                  {
                                                      console.log("ajax failed");
                                                  });

                                                  
                                      });
                                            });
                                        


                                      Instascan.Camera.getCameras().then(cameras => 
                                      {
                                          if(cameras.length > 0){
                                              scanner.start(cameras[0]);
                                          } else {
                                              console.error("No Camera Device");
                                          }
                                      });


                  </script>							 
				
                        </div>
                        <div class="modal-footer">
                          <p>Place Employee QR inside the QR scanner box</p>
                          <button type="button" class="btn btn-primary" id="scanQr" onclick="">Scan QR</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                          </div>
                        </div>
                      </div>
                  </div>
            </div>
          </div>
          <div class="table-responsive">

            <table id="myTable" class="table align-items-center table-flush">
               <thead class="thead-light">
              <tr class="header">
                <th>Employee ID</th>
                <th >Name</th>
                <th >Surname</th>
                <th> ID Number</th>
                <th style="width:1rem;"></th>
              </tr>
            </thead>
            <tbody id="tBody">
              <tr id="emptySearch" style="display: none;" class="table-danger mb-3">
                <td><b>No Employee Found</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              </tbody>
            </table>
            <div class="form-group col-md-2 mt-3">
              <button type="button" class="btn btn-block btn-primary mb-3" data-toggle="modal" data-target="#modal-default" onclick="window.history.go(-1); return false;">Back</button>
            </div>
            <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to dismiss the selected employee?</p>
                    </div>
                    <div class="modal-body text-left">
                      <div class="col mb-4">
                        <label for="c2">Reason for dismissal</label>
                        <div class="input-group"> 
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Breach of contract</span>
                          </div>
                          <input type="text" value=""  class="form-control " id="reasonOFDismissal" autofocus />
                        </div> 
                      </div>
                    </div>

                    <div class="modal-footer">
                      
                    <button type="button" class="btn btn-success" data-dismiss="modal" >Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="dismissEmployeeSuccess" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                    
                      <div class="modal-header" id="modalHeader">
                          <h6 class="modal-title" id="modal-title-default">Success!</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      
                      <div class="modal-body">
                          <p id="modalText">Employee successfully dismissed</p>
                              <div id="animation" style="text-align:center;">

                              </div>
                          
                      </div>
                      
                      <div class="modal-footer">
                          
                          <button type="button"  id="btnClose" class="btn btn-link  ml-auto" data-dismiss="modal" onclick="">Close</button> 
                      </div>
                      
                  </div>
              </div>
            </div>


           

            <script>
              function myFunction() 
            {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");
              var showCount = 0;
              for (i = 0; i < tr.length; i++) 
              {
                td = tr[i].getElementsByTagName("td")[1];
                td2 = tr[i].getElementsByTagName("td")[3];
                if (td || td2) 
                {
                  txtValue = td.textContent || td.innerText;
                  txtValue2 = td2.textContent || td2.innerText;
                  if ((txtValue.toUpperCase().indexOf(filter)> -1)|| txtValue2.replace(/\s/g, '').toUpperCase().indexOf(filter)> -1) 
                  {
                    tr[i].style.display = "";
                    showCount += 1;
                  } 
                  else 
                  {
                    tr[i].style.display = "none";
                  }
                }       
              }

              if (showCount === 0)
              {
                $("#emptySearch").show();
              } 
              else
              {
                $("#emptySearch").hide();
              }
            }
            </script>
          </div>
        </div>
      </div>
    </div>
  

      <?php include_once("../footer.php");?>
    </div>
  </div>



  <div class="modal loadingModal fade bd-example-modal-lg justify-content-center" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-sm">
          <div class="modal-content px-auto" style="">
              <img class="loading" src="../../assets/img/loading/loading.gif">
          </div>
      </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <script type="text/javascript" src="JS/searchEmployee.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>