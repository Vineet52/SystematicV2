<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Order Invoice - Stock Path</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link href="../../../assets/img/brand/favicon.png" rel="icon" type="image/png">
    <script src="assets/jquery.min.js"></script>
    <script src="assets/dom-to-image.min.js"></script>
    <script src="assets/jspdf.min.js"></script>
    <script src="assets/html2canvas.min.js"></script>
  </head>
  <body id="content">
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">

        <h2 class="name">Greens Supermarket</h2>
        <div>Plot 80 Poprtion 2,
              Bethanie Road,
              Brits, 0250</div>
        <div>+27 12 254 0224</div>
        <div><a>info@greens.co.za</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <h2 class="name"><b>ORDER TO:</b></h2>
          <h2 class="name"><?php echo $_POST['SUPPLIER_NAME']; ?></h2>
          <div class="address"><?php echo $_POST['ADDRESS']; ?></div>
          <div class="email"><a><?php echo $_POST['EMAIL']; ?></a></div>
        </div>
        <div id="invoice">
          <h1>ORDER #<?php echo $_POST['ORDER_ID']; ?></h1>
          <div class="date"><b>Date of Invoice: &nbsp;</b><?php echo(date('d/m/Y')); ?></div>
          <div class="date"><b>Time of Invoice: &nbsp;</b><?php echo(date('g:ia')); ?></div>
          <div class="date"><b>Salesperson: &nbsp;</b> <?php echo $_POST['ORDERED_BY']; ?></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="">#</th>
            <th class="desc">ITEM NAME</th>
            <th class="">COST PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="">SUBTOTAL</th>
          </tr>
        </thead>
        <tbody id="tBody">
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td id="saleTotal"></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 15%</td>
            <td id="saleVAT"></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks"></div>
      <div id="notices">
      </div>
       <input type="hidden" id="orderProductsArray" value='<?php echo( $_POST['ORDER_PRODUCTS']); ?>'>
    </main>
    <input type="hidden" id="ORDER_ID" value="<?php echo $_POST['ORDER_ID']; ?>">
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
  <!-- Core -->
  <script src="../../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Make Sale JS -->
  <script src="invoice.js"></script>
</html>