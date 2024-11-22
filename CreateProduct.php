<?php
// session_start();
// include('connection.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سبد خرید</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
    <link rel="stylesheet" href="icons/fontello.css">

    <script>
        window.addEventListener("load", function () {
            document.querySelector(".loading-page").classList.add("loaded");
        })
    </script>
</head>

<body class="basic" dir="rtl">
    <form action="">
        <label for="name">name:</label><br>
        <input type="text" id="name" name="name" value="" /><br>

        <label for="price">price:</label><br>
        <input type="text" id="price" name="price" value="" /><br>

        <label for="Seller ">Seller:</label><br>
        <input type="text" id="Seller" name="Seller" value="" /><br>

        <label for="guarantee">guarantee:</label><br>
        <input type="text" id="guarantee" name="guarantee" value="" /><br>

        <label for="count">count:</label><br>
        <input type="text" id="count" name="count" value="" /><br>

        <label for="OFF-Price">OFF-Price:</label><br>
        <input type="text" id="OFF-Price" name="OFF-Price" value="" /><br>
        <button type="submit " value="Submit">ذخیره</button>
    </form>
</body>

</html>