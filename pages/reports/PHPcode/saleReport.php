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
        
        $salePeriod = $_POST['SALEPERIOD'];
        //var_dump($salePeriod);
        //var_dump($dateFrom);
        $date = date("Y-m-d");
        //var_dump($dateTo);

        $currentDate = new DateTime($date);
        $currentDate = $currentDate->format("Y-m-d");
        $endDate;
        $previousDate;
        $alles_query;
        $submit;
        if($salePeriod=="Daily")
        {

            $alles_query ="SELECT CAST(SALE_DATE AS DATE) AS SALE_DATE ,SUM(SALE_AMOUNT) as SALE_AMOUNT,COUNT(SALE_ID) as TOTAL_SALES
                                FROM SALE
                                WHERE SALE_DATE LIKE '%$currentDate%'
                                GROUP BY CAST(SALE_DATE AS DATE)";
    
            $submit = mysqli_query($con,$alles_query);
            //var_dump($alles_query);
        }
        else if($salePeriod=="Weekly")
        {
            $today = mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                );
                $TodaysDate = date("Y-m-d H:i:s",$today);
                $newDate = new DateTime($TodaysDate);
                $newDate =  $newDate->format("Y-m-d");



            $endDate=mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")-8, date("Y")
                );
                $previousDate = date("Y-m-d H:i:s",$endDate);
                $usedDate = new DateTime($previousDate);
                $usedDate =  $usedDate->format("Y-m-d");

                $alles_query ="SELECT CAST(SALE_DATE AS DATE) AS SALE_DATE ,SUM(SALE_AMOUNT) as SALE_AMOUNT,COUNT(SALE_ID) as TOTAL_SALES
                                FROM SALE
                                WHERE SALE_DATE BETWEEN '$usedDate' AND  '$newDate'
                                GROUP BY CAST(SALE_DATE AS DATE)";

               // var_dump($alles_query);
        
                $submit = mysqli_query($con,$alles_query);
        }
        else
        {


            $today = mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                );
                $TodaysDate = date("Y-m-d H:i:s",$today);
                $newDate = new DateTime($TodaysDate);
                $newDate =  $newDate->format("Y-m-d");

            $endDate=mktime(
                date("H"), date("i"), date("s"), date("m") ,date("d")-31, date("Y")
                );
                $previousDate = date("Y-m-d",$endDate);

                $usedDate = new DateTime($previousDate);
                $usedDate =  $usedDate->format("Y-m-d");

                $alles_query ="SELECT CAST(SALE_DATE AS DATE) AS SALE_DATE ,SUM(SALE_AMOUNT) as SALE_AMOUNT,COUNT(SALE_ID) as TOTAL_SALES
                                FROM SALE
                                WHERE SALE_DATE BETWEEN '$usedDate' AND  '$newDate'
                                GROUP BY CAST(SALE_DATE AS DATE)";
        
                $submit = mysqli_query($con,$alles_query);
        }

        

        

		
        //var_dump($alles_query);
        
       /* $filterID = [];

        while($max = mysqli_fetch_assoc($submit))
        {
            $prodID = $max['PRODUCT_ID'];
            $findIDs = "SELECT COUNT($prodID) as maxProducTID
                        FROM SALE_PRODUCT
                        WHERE PRODUCT_ID = '$prodID'";
            $IDresult = mysqli_query($con,$findIDs);
            $idRow = mysqli_fetch_assoc($IDresult);


            array_push($filterID,$idRow["maxProducTID"]);
        }
        $maxProductID = max()
	    //$row = mysqli_fetch_array($result);*/

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
	         echo json_encode("Empty");
	    }

	?>