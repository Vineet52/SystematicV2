<?php
	
	$productTypeID = "";
  	$productTypeName = "";
	$productTypeDescription = "";
	$previousProductTypeName = "";
	$previousProductTypeDescription = "";

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
	  	$response = "database error";
      	echo $response;
      	//die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
	{
		$exists = false;

		// Retrieve product details from $_POST
		$productTypeID = mysqli_real_escape_string($DBConnect, $_POST['productTypeID_']);
		$productTypeName = mysqli_real_escape_string($DBConnect, $_POST['productTypeName_']);
		$productTypeDescription  = mysqli_real_escape_string($DBConnect, $_POST['productTypeDescription_']);
		$previousProductTypeName = mysqli_real_escape_string($DBConnect, $_POST['prevProductTypeName_']);
		$previousProductTypeDescription = mysqli_real_escape_string($DBConnect, $_POST['prevProductTypeDescription_']);

		$changesMade = 0;
		$query = "UPDATE PRODUCT_TYPE SET ";

		if($productTypeName != $previousProductTypeName) 
		{	
			$query .= "TYPE_NAME = '$productTypeName'";

			$queryCheck = "SELECT * FROM PRODUCT_TYPE WHERE TYPE_NAME = '$productTypeName'";
		    $result = mysqli_query( $DBConnect, $queryCheck);
		    if (mysqli_num_rows($result)) 
		    {
		        $exists = true;
		    }

			$changesMade++;
		}
		if ($productTypeDescription != $previousProductTypeDescription) 
		{	
			if ($changesMade > 0) 
			{
				$query .= ", ";
			}
			$query .= "DESCRIPTION = '$productTypeDescription'";
			$changesMade++;
		}

		if ($changesMade > 0) 
		{
			$query .= " WHERE PRODUCT_TYPE_ID = '$productTypeID'";

		    if($exists == false)
		    {	
				//Update product type in database
		      	mysqli_query($DBConnect, $query);

				//Send success response
				$response = "success";
		      	echo $response;
		    }
		    else
		    {
		    	$response = "product type exists";
		      	echo $response;
		    }
		}
		else
		{
			$response = "no changes made";
		   	echo $response;
		}

	    //Close database connection
		mysqli_close($DBConnect);
	}
?>