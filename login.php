<?php
include('connection.php');
session_start();
$message = "";
if (count($_POST) > 0) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT * FROM users WHERE UserName='" . $username . "' and Password = '" . $password . "'";
    $result = mysqli_query($conn, $query);
    $row  = mysqli_fetch_array($result);
    if (is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION['isLogin'] = 1;
        $_SESSION["UserName"] = $username;
        if (!empty($_POST["remember"])) {
            setcookie("UserName", $username, time() + 180, '/');
            setcookie("Password", $password, time() + 180, '/');
        } else {
            setcookie("UserName", "",time() - 60, "/");
            setcookie("Password", "",time() - 60, "/");
            echo "Cookies Not Set";
        }
    } else {
        $message = "نام کاربری یا رمز عبور اشتباه است";
        $_SESSION["Message"] = $message;
        header("Location:Vorood-Page-Finall.php");
    }
}
if (isset($_SESSION["id"])) {
    header("Location:Finall-Project.php");
}
