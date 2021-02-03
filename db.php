<?php

$server = "localhost";
$usernamel = "root";
$password = "";
$database = "IDISCUSE";

$conn = mysqli_connect($server, $usernamel,  $password, $database);

if (!$conn) {
     echo" Database connection is filed";
}



?>