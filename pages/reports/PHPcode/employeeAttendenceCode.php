<?php		
		
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

		$day=$_POST['DATE'];
		// $day='2019-08-21';
		$date=date_create($day);
		$date=date_format($date,"Y-m-d");

		$sql_query ="SELECT EMPLOYEE.NAME, EMPLOYEE_HOUR.DATE, EMPLOYEE.SURNAME, EMPLOYEE.EMPLOYEE_ID, EMPLOYEE.EMPLOYEE_TYPE_ID, EMPLOYEE_TYPE.WAGE_EARNING,EMPLOYEE_HOUR.DATE ,EMPLOYEE_HOUR.EMPLOYEE_HOUR_ID, EMPLOYEE_HOUR.CHECK_IN_TIME, EMPLOYEE_HOUR.CHECK_OUT_TIME 
			FROM EMPLOYEE
			INNER JOIN EMPLOYEE_TYPE ON EMPLOYEE.EMPLOYEE_TYPE_ID = EMPLOYEE_TYPE.EMPLOYEE_TYPE_ID
			LEFT JOIN EMPLOYEE_HOUR ON EMPLOYEE.EMPLOYEE_ID = EMPLOYEE_HOUR.EMPLOYEE_ID
			WHERE EMPLOYEE_TYPE.WAGE_EARNING='1' OR EMPLOYEE_HOUR.DATE='$date' 
			GROUP BY EMPLOYEE.EMPLOYEE_ID;";
	    $result = mysqli_query($con,$sql_query);
	    //$row = mysqli_fetch_array($result);

	    if (mysqli_num_rows($result)>0) {
	        $count=0;
	        while ($row=$result->fetch_assoc())
	        {
	        	$vals[]=$row;
	        	//$vals[$count]["ID"]=$row["SUPPLIER_ID"];
	        	$count=$count+1;
	        }

	        //$vals['time_in']="d";
	        echo json_encode($vals);
	        // echo mysqli_num_rows($result);
	        
	    }
	    else{
	         echo "Empty";
	    }

	?>