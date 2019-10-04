<?php

  $userRoleName = "";
  $userRoleSubFunctionalities = Array();

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
      $response = "database Error";
      echo $response;
  }
  else
  {
    $exists = false;

    // Retrieve product details from $_POST
    $userRoleName = mysqli_real_escape_string($DBConnect, $_POST['userRoleName_']);
    $userRoleSubFunctionalities  = $_POST['subFunctionalities_'];
    $userRoleFunctionalities = Array();

    $arraySize = sizeof($userRoleSubFunctionalities);
    for ($i=0; $i < $arraySize; $i++) 
    { 
      $numberSplit = explode('.', $userRoleSubFunctionalities[$i]);
      $number = $numberSplit[0];
      if(!in_array($number, $userRoleFunctionalities, true))
      {
        array_push($userRoleFunctionalities, $number);
      }
    }

    $query = "SELECT * FROM ACCESS_LEVEL WHERE ROLE_NAME = '$userRoleName'";
    $result = mysqli_query( $DBConnect, $query);
    if (mysqli_num_rows($result)) 
    {
        $exists = true;
    }

    if($exists == false)
    { 
      //Add product to database
      $queryRole = "INSERT INTO ACCESS_LEVEL(ROLE_NAME) VALUES( '$userRoleName')";
      mysqli_query($DBConnect, $queryRole);

      $lastIDQuery = "SELECT LAST_INSERT_ID();";        
      $lastIDQueryResult = mysqli_query($DBConnect, $lastIDQuery);
      $lastID = mysqli_fetch_array($lastIDQueryResult)[0];

      $arraySize = sizeof($userRoleFunctionalities);
      for ($i=0; $i < $arraySize; $i++) 
      { 
        $queryFunctionality = "INSERT INTO ACCESS_LEVEL_FUNCTIONALITY(ACCESS_LEVEL_ID, FUNCTIONALITY_ID) VALUES( '$lastID','$userRoleFunctionalities[$i];')";
        mysqli_query($DBConnect, $queryFunctionality);
      }

      $queryDashboard = "INSERT INTO ACCESS_LEVEL_FUNCTIONALITY(ACCESS_LEVEL_ID, FUNCTIONALITY_ID) VALUES( '$lastID','0')";
      mysqli_query($DBConnect, $queryDashboard);

      $arraySize = sizeof($userRoleSubFunctionalities);
      for ($i=0; $i < $arraySize; $i++) 
      { 
        $querysubFunctionality = "INSERT INTO ACCESS_LEVEL_SUB_FUNCTIONALITY(ACCESS_LEVEL_ID, SUB_FUNCTIONALITY_ID) VALUES( '$lastID', '$userRoleSubFunctionalities[$i]')";
        mysqli_query($DBConnect, $querysubFunctionality);
      }

        //Close database connection
      mysqli_close($DBConnect);

      //Send success response
      $response = "success";
      echo $response;
    }
    else
    {
      mysqli_close($DBConnect);
      $response = "User role exists";
      echo $response;
    }
  }
?>