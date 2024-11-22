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
    <title>ثبت نظر</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
</head>

<body>
    <?php
    if (isset($_POST["message"])) {
        $xmessage = $_POST["message"];
        $xuserid = $_SESSION["id"];


        // SQL command
        $sql = "INSERT INTO message (comment,userid)";
        $sql .= " VALUES ('$xmessage','$xuserid')";

        //Query Execute
        if (mysqli_query($conn, $sql)) {
            echo "<p class='msg-success'>با موفقیت ثبت شد</p>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>

</body>

</html>