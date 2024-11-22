<?php
session_start();
include('connection.php');
$user_id = $_SESSION['id'];
$id = $_POST['id'];
$type = $_POST['type'];
if($type == "add")
    $sql = "UPDATE shop SET count = count + 1 WHERE user_id =".$user_id." AND id= " . $id;
else if($type == "mines")
    $sql = "UPDATE shop SET count = count - 1 WHERE user_id =".$user_id." AND id= " . $id;
else if($type ="delete")
    $sql = "DELETE shop WHERE user_id =".$user_id." AND id= " . $id;
$result = mysqli_query($conn, $sql);
?>