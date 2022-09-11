<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "tracking";
$DBcon = new mysqli($server, $username, $password, $database);
if ($DBcon->connect_error) {
    if ($DBcon->connect_error == "Connection refused" || $DBcon->connect_error == "No such file or directory") {
        ///include "function.php";
        //die($DBcon->connect_error);
    }
    die("Connection failed: " . $DBcon->connect_error);
}
date_default_timezone_set("Africa/Cairo");
mysqli_query($DBcon, "SET NAMES 'utf8mb4'");
mysqli_set_charset($DBcon, 'utf8mb4');
