<?php

$host = "localhost" ;
$user = "root";
$pass= "";
$dbname = "";

$connect = mysqli_connect($host,$user,$pass,$dbname);

if (!$connect) {
    die ("Connection failed");
}

?>