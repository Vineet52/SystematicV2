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
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  else
  {
    

    $reason = $_POST["reason"];
    $employee_ID =  $_POST["employee_ID"];
    $day = date("Y-m-d");

    
    if(isset($reason) && isset($employee_ID))
    {
        $sql ="INSERT INTO `EMPLOYEE_DISMISAL`(`REASON_OF_DISMISAL`,`DATE_OF_DISMISAL` , `EMPLOYEE_ID`) VALUES('$reason', '$day','$employee_ID')";
        $submitQuery = mysqli_query($DBConnect,$sql);

        if($submitQuery)
        {
            $query = "UPDATE `EMPLOYEE`
            SET `EMPLOYEE_STATUS_ID` = 3
            WHERE `EMPLOYEE_ID` = '$employee_ID' ";
             $changeStatus = mysqli_query($DBConnect,$query);

            if($changeStatus)
            {
                echo "success";
            }
            else
            {
                echo "Could not change employee status";
            }
        }
        else
        {
            echo "Couldnt insert employee dismissal detalils";
        }
    }
    //Close database connection
    mysqli_close($DBConnect);
  }
?>