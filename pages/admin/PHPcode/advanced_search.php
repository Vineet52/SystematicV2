<?php
		
	 //db connection
    $url = 'mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';
    
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $con = mysqli_connect($hostname, $username, $password, $database);

    //Check connection
    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else
    {

    	$username=$_POST["username"];
    	$sub_name=$_POST["sub_name"];
    	$changes=$_POST["changed"];

		// SELECT AUDIT_LOG.AUDIT_DATE, USER.USERNAME , SUB_FUNCTIONALITY.NAME, AUDIT_LOG.CHANGES
		// FROM AUDIT_LOG 
		// INNER JOIN USER ON AUDIT_LOG.USER_ID = USER.USER_ID 
		// INNER JOIN SUB_FUNCTIONALITY ON AUDIT_LOG.SUB_FUNCTIONALITY_ID = SUB_FUNCTIONALITY.SUB_FUNCTIONALITY_ID
		// WHERE USER.USERNAME = "rangy@gmail.com" AND SUB_FUNCTIONALITY.NAME="Maintain Customer" AND AUDIT_LOG.CHANGES LIKE "%%" AND CAST(AUDIT_DATE AS DATE) = '2019-10-01'



		$sql_query ="SELECT AUDIT_LOG.AUDIT_DATE, USER.USERNAME , SUB_FUNCTIONALITY.NAME, AUDIT_LOG.CHANGES
		FROM AUDIT_LOG 
		INNER JOIN USER ON AUDIT_LOG.USER_ID = USER.USER_ID 
		INNER JOIN SUB_FUNCTIONALITY ON AUDIT_LOG.SUB_FUNCTIONALITY_ID = SUB_FUNCTIONALITY.SUB_FUNCTIONALITY_ID 
		WHERE USER.USERNAME = '$username' AND SUB_FUNCTIONALITY.NAME='$sub_name' AND AUDIT_LOG.CHANGES LIKE '%$changes%'";
	    $result = mysqli_query($con,$sql_query);
	    //$row = mysqli_fetch_array($result);
	    //var_dump( $result);
	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["SUPPLIER_ID"];
	        	$count=$count+1;
	        }
	        $json_data=json_encode($vals);
	        echo json_encode($vals);
	        
	    }
	    else{
	         echo "Error";
	    }

	  }
?>