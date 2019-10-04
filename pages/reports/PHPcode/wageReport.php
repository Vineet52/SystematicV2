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
        

        $funcArray = array();
        $employeeFullArray = array();

        $currentDate = date("Y-m-d");
        $currentDate = new DateTime($currentDate);
        $currentDate =  $currentDate->format("Y-m-d");




        $endDate=mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")-8, date("Y")
            );
            $previousDate = date("Y-m-d",$endDate);

            $usedDate = new DateTime($previousDate);
            $usedDate =  $usedDate->format("Y-m-d");

		$alles_query ="SELECT EMPLOYEE.EMPLOYEE_ID ,EMPLOYEE.NAME ,  WAGE.TOTAL_DUE 
                    FROM EMPLOYEE
                    INNER JOIN WAGE ON EMPLOYEE.EMPLOYEE_ID = WAGE.EMPLOYEE_ID
                    INNER JOIN EMPLOYEE_HOUR ON EMPLOYEE_HOUR.EMPLOYEE_ID = EMPLOYEE.EMPLOYEE_ID
                    WHERE WAGE.DATE_ISSUED BETWEEN '$usedDate' AND '$currentDate' 
                    GROUP BY EMPLOYEE_ID";
            
        $submit = mysqli_query($con,$alles_query);

        if (mysqli_num_rows($submit)>0) 
        {
            $count=0;
            while ($row = mysqli_fetch_assoc($submit))
            {
              $employeeId = $row['EMPLOYEE_ID'];
              $employeeName = $row["NAME"];
              $employeeTotal = $row["TOTAL_DUE"];
              $ac = "SELECT CHECK_IN_TIME,CHECK_OUT_TIME 
              FROM EMPLOYEE_HOUR
              WHERE EMPLOYEE_ID = '$employeeId' AND DATE >= '$usedDate' ";
              $result = mysqli_query($con,$ac);
    
              $checkTimeArray = [];
              $checkInTime;
                while($filter = mysqli_fetch_assoc($result))
                {
                    
                   
                    $first_date = new DateTime($filter['CHECK_IN_TIME']);
                    $second_date = new DateTime($filter['CHECK_OUT_TIME']);
                    $interval = $first_date->diff($second_date);
                   
                    array_push($checkTimeArray,$interval->h);
    
                }
    
                $employeeWageArray = array("EMPLOYEE_ID"=>$employeeId, "EMPLOYEE_NAME"=>$employeeName, "EMPLOYEE_WAGE_DUE"=>$employeeTotal, "HOURS"=>$checkTimeArray);
                array_push($employeeFullArray,$employeeWageArray);
            }
            echo json_encode($employeeFullArray);
	    }
	    else{
	         echo "Empty";
	    }

	?>