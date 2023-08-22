<?php 
require_once '../components/db_connect.php';

$id = $_GET['id'];

$sql= "SELECT * FROM recipes WHERE recipes_id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

$currentvalue = $row['verified'];

$newvalue = ($currentvalue == 'verified') ? 'unverified' : 'verified';

$updatesql = "UPDATE `recipes` SET `verified`='$newvalue' WHERE recipes_id = $id";

if(mysqli_query($connect,$updatesql)){
    header("location: recipes.php");
}
