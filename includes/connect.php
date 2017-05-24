<?php
    $host = "localhost";
    $username = "hello";
    $password = "universe";
    $db_name = "warehouse";
    $connected = mysqli_connect("$host", "$username", "$password", "$db_name");
    if(!$connected)
    {
        die("Unable to connect with database, error:".mysqli_connect_error());
    }
?>