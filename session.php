<?php
    session_start();
    
    if (!isset($_SESSION['id'])){
        header('location:login.php');
    }

    $user_id = $_SESSION['id'];
    $query = mysqli_query($conn,"select * from users where user_id = '$user_id'")or die(mysqli_error());
    $row = mysqli_fetch_array($query);
    $display_name = utf8_decode($row['display_name']);

    #$ip = $_SERVER["REMOTE_ADDR"];
    #$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
    #$ip = $details->timezone;
    #date_default_timezone_set($ip);
?>