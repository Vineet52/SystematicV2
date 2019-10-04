<?php include_once("../sessionCheckPages.php");?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Make Sale - Stock Path</title>
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
  <!-- Validation Stylesheet -->
  <link rel="stylesheet" href="../../assets/css/site-demos.css">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Make Sale</a>
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
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col col-sm-12 col-md-12 col-xl-8 px-0">
          <div class="card card-stats shadow">
              <div class="card-header border-0 bg-secondary">
                <div class="input-group input-group-rounded input-group-merge">
                  <input type="search" class="form-control form-control-rounded form-control-prepended" id="searchProduct" placeholder="Enter Product Name" autofocus="true">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-search"></span>
                    </div>
                  </div>
                  <input type="hidden" id="productsDropdownToggle" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div id="menu" class="dropdown-menu col px-4 mb-3" aria-labelledby="productsDropdownToggle">
                    <div id="menuItems"></div>
                    <div id="empty" class="dropdown-header table-danger" style="color: black">
                      No product found
                    </div>
                  </div>
                </div>
            </div>
          <div class="card-body">
            <div class="table-responsive col-12 pl-0">

              <table id="productsTable" class="table align-items-center table-flush">
                 <thead class="thead-light">
                <tr class="header">
                  <th class="col-3" style="width: 2rem"> Quantity</th>
                  <th class="pl-0" style="width: 20rem"> Item Name</th>
                  <th class="pl-4" style="text-align: center;"> Unit Price</th>
                  <th class="text-right pr-1" style="width: 8rem"> Total </th>
                  <th class="text-centre px-0" style="width: 0.5rem"></th>
                  <th class="text-right pr-1 pl-2"> Guide Price</th>
                  <th class="text-right pr-1"> Cost Price</th>
                  <th class="text-right pr-1"> Profit </th>
                  
                </tr>
              </thead>
                <tbody id="tBody">
                </tbody>
                <tfoot class="tfoot-light">
                <tr class="footer">
                  <td></td>
                  <td></td>
                  <th class="text-right pr-1"><b>TOTAL</b></th>
                  <td class="text-right pr-1" id="totalOfSale"><b></b></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr class="footer">
                  <td></td>
                  <td></td>
                  <th class="text-right pr-1"><b>VAT (15%)</b></th>
                  <td class="text-right pr-1" id="vatOfSale"><b></b></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        </div>

        <div class="col-4 col-sm-12 col-md-12  col-md-4 col-xl-4 bg-transparent float-lg-top">
          <div class="card card-stats table" id="myTabContent" >
            <div class="card-header bg-secondary">
              <div class="row"> 
                <div class="col">
                  <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" id="customerSearchInput" placeholder="Enter Customer Name" title="Type in a name" class="form-control form-control-rounded form-control-prepended">
                    <div class="input-group-prepend">
                      <div class="input-group-text bg-customGreen" id="searchCustomerButton">
                      <span class="fa fa-search" style="color: white"></span>
                      </div>
                    </div>
                    <input type="hidden" id="customerDropdownToggle" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div id="menuCust" class="dropdown-menu col px-2 mb-2" aria-labelledby="customerDropdownToggle">
                      <div id="menuOfCustomers"></div>
                      <div id="empty2" class="dropdown-header table-danger" style="color: black">
                        No Customer found
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-3" style="height: 15rem">

              <table class="table align-items-center table-flush table-borderless table-responsive" id= "customerCard">
                <tbody class="list">    
                    <tr>
                      
                  </tr>
                  <tr>
                      <th> No Customer Added</th>
                      <td >
                          
                      </td>
                    </tr>                  
                </tbody>
              </table>

            </div>
            <div class="card-body pl-2" style="height: 5rem">
              <span class="col">
                <button class="btn btn-warning" onclick="window.location='../customer/register.php'">
                    <span class="btn-inner--icon mr-2">
                      <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="btn-inner--text">
                      Add Customer
                    </span>
                </button>
              </span>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                   <div class="custom-control custom-checkbox mb-3">
                    <input class="custom-control-input" id="addSaleDeliveryCheckbox" type="checkbox" data-toggle="collapse" data-target="#customerAddresses" aria-expanded="false" aria-controls="customerAddresses">
                    <label class="custom-control-label" for="addSaleDeliveryCheckbox">Add Sale Delivery</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col collapse pl-5" id="customerAddresses">

                </div>
              </div>
            </div>
            <div class="card-body pl-2 pb-4" >
              <span class="col">
                  <button class="btn btn-success" id="finaliseSale" data-toggle="modal" data-target="#modal-salesManagerPassword">
                    <span class="btn-inner--icon  mr-2">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="btn-inner--text">
                      Finalise Sale
                    </span>
                  </button>

                </span>
            </div>
          </div>
        </div>

        

        <div class="modal fade" id="modal-salesManagerPassword" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="modal-title-default">Finalise Sale</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group col">
                  <label for="bane">Sales Manager Password</label>
                  <input type="password" class="form-control" id="salesManagerPassword" aria-describedby="emailHelp" placeholder="Enter password" required>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-success  ml-auto" id="confirmSalesManagerPassword">Approve Sale</button> 
              </div>
            </div>
          </div>
        </div>
        
        <div class="form-group col-md-2 errorModal successModal text-center">
          <div class="modal fade" id="successfullyAdded" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
              <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                    <h6 class="modal-title" id="modal-title-default2">Success</h6>
                </div>
                <div class="modal-body">
                  <p id="modalText">Successfully Added</p>
                  
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
  <!-- Validation JS -->
  <script src="../../assets/js/jquery.validate.min.js"></script>
  <script src="../../assets/js/additional-methods.min.js"></script>
  <!-- Make Sale JS -->
  <script src="JS/makeSale.js"></script>
  <!-- Get Session Variable -->
  <script type="text/javascript">
    var SESSION = eval('(<?php echo json_encode($_SESSION)?>)');
  </script>
</body>

</html>

