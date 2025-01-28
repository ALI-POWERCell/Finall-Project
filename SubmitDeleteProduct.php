<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
</head>

<body>
    <?php

    // echo $_POST["userName"];
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if (isset($_GET['id'])) {
            $xid = $_GET['id'];


            // SQL commands
    
            $sql = "Delete from products Where id = " . $xid;



            if (mysqli_query($conn, $sql)) {
                echo "<p class='msg-success'>با موفقیت حذف شد</p>";
            } else {
                throw new Exception("<p class='msg-warning'>'با مشکل مواجه شد'</p>");
            }
        }
        else{
            echo("<p class='msg-warning'>با مشکل مواجه شد</p>");
        }
    }
    mysqli_close($conn);

    ?>
</body>

</html>