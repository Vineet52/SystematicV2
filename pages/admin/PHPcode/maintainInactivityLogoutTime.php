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
        $response = "Database error";
        echo $response;
    }
    else
    {
        $newLogoutTime = $_POST["minutes"];

        $maxTimeQ = "UPDATE LOGOUT_INACTIVITY SET MAX_TIME = '$newLogoutTime' WHERE TIME_ID = 1";
        $maxTimeQResult = mysqli_query($DBConnect, $maxTimeQ);

        if ($maxTimeQResult == true) 
        {
            $response = "success";
            echo $response;
        }
        else
        {
            $response = "failed";
            echo $response;
        }

        //Close database connection
        mysqli_close($DBConnect);
    }
?>
