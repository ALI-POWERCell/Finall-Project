<?php 
include('connection.php');
session_start();
    if (isset($_SESSION["UserName"])) {
        $user_id = $_SESSION["id"];
        $product_id = $_GET['product_id'];
        
        $sql = "INSERT INTO shop(user_id,product_id,count)Values('".$user_id."','".$product_id."',1)";
        mysqli_query($conn,$sql);
        header("Location: Sabad-Page-Finall.php");
    }
?>