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
    $funcArray = array();
    $AccessLevelsArray = array();

    
    $sql = "SELECT * FROM ACCESS_LEVEL ORDER BY ROLE_NAME";
    //var_dump($sql);
    $submit = mysqli_query($DBConnect,$sql);
    if($submit)
    {
      if (mysqli_num_rows($submit)>0)
      {
        $count=0;
        while ($row = mysqli_fetch_assoc($submit))
        {
          $accessId = $row['ACCESS_LEVEL_ID'];
          $accessName = $row['ROLE_NAME'];
          $ac = "SELECT ACCESS_LEVEL_FUNCTIONALITY.FUNCTIONALITY_ID, FUNCTIONALITY.NAME FROM ACCESS_LEVEL_FUNCTIONALITY JOIN FUNCTIONALITY ON  ACCESS_LEVEL_FUNCTIONALITY.FUNCTIONALITY_ID = FUNCTIONALITY.FUNCTIONALITY_ID 
          WHERE ACCESS_LEVEL_FUNCTIONALITY.ACCESS_LEVEL_ID = '$accessId'";
          $result = mysqli_query($DBConnect,$ac);

          $funcArray = [];

            while($filter = mysqli_fetch_assoc($result))
            {
              
              array_push($funcArray,$filter['NAME']);

            }

            $roleArray = array("ACCESS_LEVEL_ID"=>$accessId, "ACCESS_LEVEL_NAME"=>$accessName, "FUNTIONALITY"=>$funcArray);
            array_push($AccessLevelsArray,$roleArray);
        }
        echo json_encode($AccessLevelsArray);
      }
    }
    else
    {
      echo "False";
    }
    
    //Close the connection
    mysqli_close($DBConnect);
  }
  
?>




