<?php

	$saleID = "";

	$url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

	$dbparts = parse_url($url);

	$hostname = $dbparts['host'];
	$username = $dbparts['user'];
	$password = $dbparts['pass'];
	$database = ltrim($dbparts['path'],'/');

	$DBConnect = mysqli_connect($hostname, $username, $password, $database);

	if($DBConnect === false)
	{
	//Send error response
	  $response = "database Error";
	  echo $response;
	}
	else
	{
		// Retrieve product details from $_POST
		$saleID = mysqli_real_escape_string($DBConnect, $_POST['saleID']);
		$saleProducts  = $_POST['saleProducts'];

		//echo json_encode($saleProducts);

		//UPDATE AVAILABLE QUANTITY
		$queryUpdateSaleStatus = "UPDATE SALE SET SALE_STATUS_ID = 3 WHERE SALE_ID = $saleID";
		mysqli_query($DBConnect, $queryUpdateSaleStatus);

		$arraySize = sizeof($saleProducts);
		for ($i=0; $i < $arraySize; $i++) 
		{
			$productLineProductID = mysqli_real_escape_string($DBConnect, $saleProducts[$i]['PRODUCT_ID']);
			$productLineQuantity = mysqli_real_escape_string($DBConnect, $saleProducts[$i]['QUANTITY']);

			$queryUpdateSaleProductQuantity = "UPDATE SALE_PRODUCT SET QTY_ON_HAND = QTY_ON_HAND - $productLineQuantity WHERE PRODUCT_ID = $productLineProductID AND SALE_ID = '$saleID'";
			mysqli_query($DBConnect, $queryUpdateSaleProductQuantity);
		}

		//Close database connection
		mysqli_close($DBConnect);

		//Send success response
		$response = "success";
		echo $response;
	}
?>