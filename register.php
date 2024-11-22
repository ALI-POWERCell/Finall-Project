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

    if (isset($_POST["userName"])) {
        $xuserName = $_POST["userName"];
        $xPass = $_POST["pass"];

        $query = "SELECT * FROM `users` where UserName = '" . $xuserName . "';";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo '<p class="msg-repeat">فردی با این نام کاربری قبلا ثبت نام کرده است لطفا نام کاربری خود را تغییر دهید</p>';
        } else {

            // SQL command
            $sql = "INSERT INTO users (UserName,Password)";
            $sql .= " VALUES  ('$xuserName','$xPass')";


            try {
                if (preg_match('/^[a-zA-Z]{5,}$/', $xuserName)) {
                    if (mysqli_query($conn, $sql)) {
                        echo "<p class='msg-success'>با موفقیت ثبت شد</p>";
                    } else {
                        throw new Exception("<p class='msg-warning'>'با مشکل مواجه شد'</p>");
                    }
                } else {
                    throw new Exception("<p class='msg-warning'>نام کاربری باید شامل حروف لاتین انگلیسی باشد و حداقل (5) کاراکتر باشد</p>");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        mysqli_close($conn);
    }
    ?>
</body>

</html>