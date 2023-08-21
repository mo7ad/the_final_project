<?php
     require_once "../db_connect.php";

     $id = $_GET["id"];
     $sql = "DELETE FROM `meal_planner` WHERE planner_id = $id";
     if(mysqli_query($connect, $sql)){
        header("location: meal_planner.php");
     }else{
        echo "Error";
     }

?>