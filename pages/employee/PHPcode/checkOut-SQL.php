<?php 
include_once("../../sessionCheckPages.php");

$url ='mysql://lf7jfljy0s7gycls:qzzxe2oaj0zj8q5a@u0zbt18wwjva9e0v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/c0t1o13yl3wxe2h3';

$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');
$DBConnect;

$DBConnect = mysqli_connect($hostname, $username, $password, $database);

if($DBConnect === false)
{
die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{




    

    $realCheckin;
    $realCheckout;
    $get_query="SELECT * FROM CHECKIN_CHECKOUT_TIME
    WHERE CHECKIN_CHECKOUT_TIME_ID = '0'";
    $get_result=mysqli_query($DBConnect,$get_query);

    if(mysqli_num_rows($get_result)>0)
    {
        if($row= mysqli_fetch_assoc($get_result))
        {
                        $realCheckin = $row["ARRIVAL_TIME"];
                        $realCheckout = $row["DEPATURE_TIME"];


                        $employeeID = $_POST["qrCode"];
                        
                      
                          $sql = "SELECT HASH FROM EMPLOYEE_QR WHERE (EMPLOYEE_ID='$employeeID')";
                          $query_QR = mysqli_query($DBConnect , $sql);
                      
                          //$request ="SELECT * FROM `chats` WHERE ((receiver_id='$receiver' and sender_id='$sender') or (receiver_id='$sender' and sender_id='$receiver'))
                          //ORDER BY date_order Asc" ;
                          //echo $request;
                          //$submit = mysqli_query($conn,$request);
                      
                          $time = new DateTime();
                          $currentTime = $time->format("H:i:s");//checkin/checkout time.
                      
                         
                          $addedTime = "";//flag
                      
                           //date("H:i:s");
                           $time = new DateTime();
                           $currentTime = $time->format("Y-m-d H:i:s");//checkin/checkout time.
                          
                          
                           $addedTime = "";//flag
                       
                            //date("H:i:s");
                           $day = date("Y-m-d");
                           $setCheckinTime = new DateTime($realCheckin);
                           $setCheckinTime = $setCheckinTime->format("Y-m-d H:i:s");
                           
                           $checkoutTime = new DateTime($realCheckout);
                           $checkoutTime = $checkoutTime->format("Y-m-d H:i:s");

                           $checkIfTime = "SELECT * FROM EMPLOYEE_HOUR  WHERE `EMPLOYEE_ID` ='$employeeID' and `DATE`= '$day'";
                           $subCheckTime = mysqli_query($DBConnect,$checkIfTime);

                           $arraySub= mysqli_fetch_assoc($subCheckTime);
                           if($arraySub["CHECK_OUT_TIME"] != "NULL")
                           {
                            
                               $nameQuery = "SELECT NAME, SURNAME FROM EMPLOYEE
                               WHERE EMPLOYEE_ID = '$employeeID'";
                   
                               $employeNameQueryResult = mysqli_query($DBConnect,$nameQuery);
                               $employee= mysqli_fetch_assoc($employeNameQueryResult);
                   
                               $nameSurname = $employee["NAME"]." ".$employee["SURNAME"];
                               echo "Already CheckedOut!";
                           }
                            
                          if($query_QR)
                          {
                              if(($currentTime < $checkoutTime) && ($currentTime > $setCheckinTime))
                              {
                                   //$currentTime = $setCheckinTime;
                                  
                                  
                                  $query = "UPDATE `EMPLOYEE_HOUR` 
                                  SET `CHECK_OUT_TIME`= '$currentTime'
                                  WHERE `EMPLOYEE_ID` ='$employeeID' and `DATE`= '$day'";
                                
                                  $submitQuery = mysqli_query($DBConnect,$query);
                                  
                                  if($submitQuery)
                                  {
                                      $addedTime = "Time SQL works";
                                  }
                      
                              }
                              else if($currentTime >= $checkoutTime)
                              {
                                   
                                  $currentTime = $checkoutTime;
                                  $query = "UPDATE `EMPLOYEE_HOUR` 
                                  SET `CHECK_OUT_TIME`= '$currentTime'
                                  WHERE `EMPLOYEE_ID` ='$employeeID' and `DATE`= '$day'";
                      
                                  $submitQuery = mysqli_query($DBConnect,$query);
                      
                                  if($submitQuery)
                                  {
                                      $addedTime = "Time SQL works";
                                  }
                              }
                              else
                              {
                                  echo "Too early to checkout";
                              }
                      
                      
                          }
                          else
                          {
                              echo "Employee does not exist on system";
                          }
                            $verifyID = sha1($employeeID);

                            //Audit Log Check-In Changes
                            $changes="ID : ".$employeeID."| Employee Checked-Out | Employee CheckOut Date and Time :".$currentTime;



                          //var_dump($verifyID);
                          while($correctHash = mysqli_fetch_assoc($query_QR))
                          {
                              if($correctHash["HASH"]== $verifyID && $addedTime == "Time SQL works" )
                              {
                                $DateAudit = date('Y-m-d H:i:s');
                                $Functionality_ID='2.5';
                                $userID = $_SESSION['userID'];
                                $audit_query="INSERT INTO AUDIT_LOG (AUDIT_DATE,USER_ID,SUB_FUNCTIONALITY_ID,CHANGES) VALUES('$DateAudit','$userID','$Functionality_ID','$changes')";
                                $audit_result=mysqli_query($DBConnect,$audit_query);    


                                $success = "success";
                                echo $success;
                                break;
                              }
                          }
                      
                      
                          //Used for search
                          /*$obj = array();
                          while($looper = mysqli_fetch_assoc($query_QR))
                          {
                              $obj[] = $looper;
                          }*/

        }
        else
        {
           
                echo "No checkin/checkout times set";
            
        }
    }
    else
    {
       
            echo "No checkin/checkout times set";
        
    }
    

    mysqli_close($DBConnect);


}
//$conn->close();


/*$request = "UPDATE FriendRequest SET sender_id ='$sender' WHERE confirmedFriend = 'yes' and user_id ='$sender' and otherUser ='$receiver'";
$yeah=mysqli_query($conn,$request);



$query = "UPDATE FriendRequest SET receiver_id='$receiver' WHERE confirmedFriend = 'yes' and user_id ='$sender' and otherUser ='$receiver'";
$submit=mysqli_query($conn,$query);*/

?>