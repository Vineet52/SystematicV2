<?php
  include_once("../sessionCheckPages.php");
  $help="../../help/CancelOrderCollection.html";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Cancel Supplier Collection - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>
 <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Cancel Supplier Order Collection</a>
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
            <div class="card-header bg-transparent">
              <h3 class="mb-0"><span id="cColID">Supplier Collection No. #321 :</span><span id="cColSupName"><b>Coca Cola</b></span></h3>
            </div>
            <div class="card-body">

              <div class="row mt-3">
                <div class="tab-content col" id="myTabContent">
                  <div class="tab-pane fade show active" id="home"  aria-labelledby="home-tab">
                    <form>
                      <div class="col">
                        <label hidden="true" id="collectionData"><?php echo $_POST["COLLECTION_DATA"];?></label>
                        <div class="form-group">
                            <p><span><b>Collection Date: </b></span><span id="cColDate"></span></p>
                        </div>

                        <div class="form-group">
                          <p><span><b>Collection Address: </b></span><span id="cCollectionAddress"></span></p>
                        </div>
                        <div class="form-row pb-0">
                          <div class="form-group col-md-4 mb-2">
                            <p><span><b>Suburb: </b></span><span id="cColSuburb">Hatfield</span></p>
                          </div>
                          <div class="form-group col-md-4 mb-2">
                            <p><span><b>City: </b></span><span id="cColCity"></span></p>
                          </div>
                          <div class="form-group col-md-2 mb-2">
                            <p><span><b>Zip: </b></span><span id="cColZip"></span></p>
                          </div>
                        </div>
                        <div class="form-row mt-0">
                          <div class="form-group col-md-4">
                            <p><b>Collected Date: </b> N/A</p>
                          </div>
                          <div class="form-group col-md-6">
                            <p><span><b>Delivery Status: </b></span> <span id="cColStatus"></span</p>
                          </div>
                        </div>

                      </div> 
                      <div class="form-group col-md-3">
                          <button type="button" class="btn btn-block btn-danger mb-3 px-3" data-toggle="modal" data-target="#modal-default">Cancel Supplier Collection</button>
                          <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true" id="warnModal">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">
                                  
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-default">Warning!</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <p>Are you sure you want to cancel Supplier Collection?</p>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal" id="btnYes" >Yes</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button> 
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group col-md-2 errorModal successModal text-center">
                          <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                              <div class="modal-content">
                                <div class="modal-header" id="modalHeader">
                                    <h6 class="modal-title" id="MHeader">Success</h6>
                                </div>
                                <div class="modal-body">
                                  <p id="MMessage">Successfully Added</p>
                                  
                                  <div id="animation" style="text-align:center;">

                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal" id="btnClose">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                          </div>
                        </div>
                    </form>
                  </div>
                
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once("../footer.php");?>
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
  <script type="text/javascript" src="JS/cancelCollection.js"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
</body>

</html>