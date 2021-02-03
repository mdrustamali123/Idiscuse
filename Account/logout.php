<?php

session_start();

session_destroy();
echo "your are log out";

header('location: ../index.php');

?>