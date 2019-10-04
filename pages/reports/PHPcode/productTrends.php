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

		/*$day=$_POST['DATE'];
		// $day='2019-08-21';
		$date=date_create($day);
        $date=date_format($date,"Y-m-d");*/
        
        $dateFrom = $_POST['DATEFROM'];
        //var_dump($dateFrom);
        $dateTo = $_POST['DATETO'];
        //var_dump($dateTo);

        $startDate = new DateTime($dateFrom);
        $startDate = $startDate->format("Y-m-d");

        $endDate = new DateTime($dateTo);
        $endDate = $endDate->format("Y-m-d");

        $sql="SELECT  *
        FROM SALE
        ORDER BY SALE_DATE DESC 
        LIMIT 1 ";
        $query = mysqli_query($con, $sql);

        $dateModified;

        if (mysqli_num_rows($query)>0) 
        {
            while ($row= $query->fetch_assoc())
	        {
                if($row["SALE_DATE"] < $endDate)
                {
                    $endDate = $row["SALE_DATE"] ;
                }
                else
                {

                }
	        }
        }

		$alles_query ="SELECT SALE.SALE_DATE ,SALE_PRODUCT.PRODUCT_ID , SALE_PRODUCT.SELLING_PRICE, SUM(SALE_PRODUCT.QUANTITY) as TOTAL_PRODUCT_QUANTITY ,PRODUCT.PRODUCT_MEASUREMENT,PRODUCT.PRODUCT_MEASUREMENT_UNIT, PRODUCT.NAME ,PRODUCT.CASES_PER_PALLET,PRODUCT.UNITS_PER_CASE , PRODUCT.PRODUCT_SIZE_TYPE ,PRODUCT_TYPE.TYPE_NAME,PRODUCT_TYPE.PRODUCT_TYPE_ID
                    FROM SALE_PRODUCT 
                    INNER JOIN SALE ON SALE_PRODUCT.SALE_ID = SALE.SALE_ID
                    INNER JOIN PRODUCT ON PRODUCT.PRODUCT_ID=SALE_PRODUCT.PRODUCT_ID
                    INNER JOIN PRODUCT_TYPE ON PRODUCT_TYPE.PRODUCT_TYPE_ID = PRODUCT.PRODUCT_TYPE_ID
                    WHERE SALE.SALE_DATE BETWEEN '$startDate' AND '$endDate' 
                    GROUP BY PRODUCT.PRODUCT_ID
                    ORDER BY COUNT(PRODUCT.PRODUCT_ID) DESC";
            
        $submit = mysqli_query($con,$alles_query);
     

        if (mysqli_num_rows($submit)>0) 
        {
	        $count=0;
	        while ($row= $submit->fetch_assoc())
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