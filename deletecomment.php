<?php
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
        $xid = $_POST['messageid'] ;
        $sql = "DELETE FROM `message` WHERE id = $xid ";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='msg-success'>با موفقیت حذف شد</p>";
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    ?>
</body>

</html>