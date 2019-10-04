<?php

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
	  	$response = "databaseError";
      	echo $response;
      	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
		$sql_query = "
		SELECT PRODUCT_GROUP_ID,PRODUCT_ID, NAME, PRODUCT_DESCR, CASES_PER_PALLET, UNITS_PER_CASE, COST_PRICE, GUIDE_DISCOUNT, SELLING_PRICE, PRODUCT_TYPE.TYPE_NAME, PRODUCT.PRODUCT_TYPE_ID, PRODUCT_MEASUREMENT, PRODUCT_MEASUREMENT_UNIT,
		MAX(CASE WHEN PRODUCT_SIZE_TYPE = '1' THEN QUANTITY_AVAILABLE END) INDIVIDUAL_QUANTITY,
		MAX(CASE WHEN PRODUCT_SIZE_TYPE = '2' THEN QUANTITY_AVAILABLE END) CASES_QUANTITY,
		MAX(CASE WHEN PRODUCT_SIZE_TYPE = '3' THEN QUANTITY_AVAILABLE END) PALLETS_QUANTITY
		FROM PRODUCT LEFT JOIN PRODUCT_TYPE ON PRODUCT_TYPE.PRODUCT_TYPE_ID = PRODUCT.PRODUCT_TYPE_ID
		GROUP BY PRODUCT_GROUP_ID
		ORDER BY NAME";
	    $result = mysqli_query($DBConnect,$sql_query);

	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["SUPPLIER_ID"];
	        	$count=$count+1;
	        }
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else
	    {
	        echo "Error: " . $sql_query. "<br>" . mysqli_error($con);
	    }
	    mysqli_close($DBConnect);
	}
?>