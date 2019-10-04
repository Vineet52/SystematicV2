<?php include_once("../sessionCheckPages.php"); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>View Delivery - Stock Path</title>
  <!-- Favicon -->
  <link href="../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<style type="text/css">
  .dropdown-menu{
    transform: translate3d(0px, 2.7rem, 0px)!important;
  }
</style>

<body>
 <?php include_once("../header.php");?>
   <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">View Delivery</a>
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
      <div class="row mb-3">
          <div class="card shadow col">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Delivery Details</h3>
            </div>
            <div class="card-body">
              <div class="mb-5">
                <ol class="progtrckr" data-progtrckr-steps="5">
                  <li id="1" class="progtrckr-todo">Not Delivered</li>
                  <li id="2" class="progtrckr-todo">Truck Assigned</li>
                  <li id="3" class="progtrckr-todo">Final Assignment</li>
                 <li id="4" class="progtrckr-todo">On Delivery</li>
                 <li id="5" class="progtrckr-todo">Delivered</li>
                </ol>
              </div>
              <div class="row mb-3">
                <div class="col-7 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3">
                      <label id="dctData" hidden="true"><?php echo $_POST["DCT_STATUS_ID"];?></label>
                      <label id="pData" hidden="true"><?php echo $_POST["PRODUCT_DATA"];?></label>
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Customer ID
                              </th>
                              <td id="vCustomerID">
                                 <?php echo $_POST["CUSTOMER_ID"];?> 
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                  Name
                              </th>
                              <td id="vCustomerName">
                                  <?php
                                   echo $_POST["CUSTOMER_NAME"];?> 
                              </td>
                            </tr>  
                            <tr>
                              <th>
                                  Email
                              </th>
                              <td id="vCustomerEmail">
                                  <?php echo $_POST["EMAIL"];?> 
                              </td>
                            </tr>
                            <tr>
                              <th>
                                  Contact No
                              </th>
                              <td id="vContact">
                                 <?php echo $_POST["CONTACT_NUMBER"];?> 
                              </td>
                            </tr>  
                            <tr>
                              <th>
                                  Address
                              </th>
                              <td id="vAddress">
                                  <?php echo $_POST["ADDRESS_NAME"];?> 
                              </td>
                            </tr>             
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
              <div class="col-5 table">
                  <div class="card card-stats table light" id="myTabContent" >
                    <div class="card-body px-3" style="height: 17.8rem">
                      <table class="table align-items-center table-flush table-borderless table-responsive">
                        <tbody class="list">    
                            <tr>
                              <th style="width: 12rem">
                                  Invoice #
                              </th>
                              <td id="vSaleID">
                                  <?php echo $_POST["SALE_ID"];?>
                              </td>
                            </tr>                               
                            <tr>
                              <th>
                                  Date
                              </th>
                              <td id="vDelDate">
                                  <?php echo $_POST["EXPECTED_DATE"];?>
                              </td>
                            </tr>  
                            <tr>
                              <th>
                                  Salesperson
                              </th>
                              <td id="vEmployeeName">
                                  <?php echo $_POST["EMPLOYEE_NAME"];?> 
                              </td>
                            </tr>
             
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card shadow">
                <div class="table-responsive">

                  <table id="myTable" class="table align-items-center table-flush">
                     <thead class="thead-light">
                    <tr class="header">
                      <th class="text-center"> Quantity</th>
                      <th> Item Name</th>
                      <th class="pl-4 text-right"> Unit Price</th>
                      <th class="text-right"> Total </th>
                    </tr>
                  </thead>
                  <tbody id="tBody">                    
                    </tbody>
                    <tfoot class="tfoot-light">
                    <!-- <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>TOTAL</b></th>
                      <td class="text-right"><b id="sTotal"></b></td>
                    </tr>
                    <tr class="footer">
                      <td></td>
                      <td></td>
                      <th class="text-right"><b>VAT (15%)</b></th>
                      <td class="text-right"><b id="sVAT"></b></td>
                    </tr> -->
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <br>
            <div class="col mt-4">
              <button class="btn btn-icon btn-2 btn-primary mt-0" type="button" onclick="window.history.go(-1); return false;">
                <span class="btn-inner--text">Close</span>
              </button>
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
  <script type="text/javascript" src="JS/finaliseView.js"></script>
</body>

</html>