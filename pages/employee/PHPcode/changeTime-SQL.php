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

          $userID; 
          $checkInTime = 0; 
          $checkOutTime = 0;

          if(isset($_POST["userID"]))
          {
            $userID = $_POST["userID"]; 
          }
          if(isset($_POST["checkin"]))
          {
            $checkInTime = $_POST["checkin"];
          }
          if(isset($_POST["checkout"]))
          {
            $checkOutTime = $_POST["checkout"];
          }
          
          $checkintimeSet = "";
          $checkouttimeSet = "";
          $successIn = "";
          $successOut = "";

          if($checkOutTime != 0)
          {
              $sql = "UPDATE CHECKIN_CHECKOUT_TIME 
              SET `DEPATURE_TIME` = '$checkOutTime', `USER_ID` = '$userID'
              WHERE CHECKIN_CHECKOUT_TIME_ID = '0'";
              $query_QR = mysqli_query($DBConnect , $sql);
              
              
              if($query_QR)
              {
                $successOut = "success";
                $checkouttimeSet = "Checkout Time has been successfully changed";
              }
              else
              {
                  echo "Failure";
              }
          }
          if($checkInTime != 0)
          {
              $sql = "UPDATE CHECKIN_CHECKOUT_TIME 
              SET `ARRIVAL_TIME` = '$checkInTime', `USER_ID` = '$userID'
              WHERE CHECKIN_CHECKOUT_TIME_ID = '0'";
              $query_QR = mysqli_query($DBConnect , $sql);
              
            
              if($query_QR)
              {
                $successIn = "success";
                $checkintimeSet = "Check-in Time has been successfully changed";
              }
              else
              {
                  echo "Failure";
              }
          }




          if(($successOut=="success") && ($successIn !="success"))
          {
            echo $checkouttimeSet;
          } 
          else if(($successOut !="success") && ($successIn =="success"))
          {
            echo $checkintimeSet;
          }   
          else if(($successOut=="success") && ($successIn =="success"))
          {
            echo $checkouttimeSet . " and " . $checkintimeSet;
          }
          else
          {
            echo "Nothing was changed!";
          }
 
     mysqli_close($DBConnect); 
    //Close database connection
   
  }
?>