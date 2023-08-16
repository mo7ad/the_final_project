<?php

$host = "localhost" ;
$user = "root";
$pass= "";
$dbname = "be19_fp_group_one";

$connect = mysqli_connect($host,$user,$pass,$dbname);

if (!$connect) {
    die ("Connection failed");
}
