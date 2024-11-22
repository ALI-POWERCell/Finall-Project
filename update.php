<?php
include('connection.php');
session_start();
?>
<!DOCTYPE html>
<html class="style-html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
    <link rel="stylesheet" href="icons/fontello.css">

    <script>
        window.addEventListener("load", function() {
            document.querySelector(".loading-page").classList.add("loaded");
        })
    </script>

</head>

<body class="basic" dir="rtl">
    <div class="loading-page">
        <div class="loading-circle">
            <span>Mobile-Shop</span>
        </div>
    </div>

    <div class="parent-header">
        <div class="parent-logo-search">
            <p onclick="mobileshop()" id="Mobile-Shop" class="header">Mobile-Shop</p>
        </div>
        <div class="txt-align margin-buttons">
            <button onclick="sabad()" id="Sabad" class="shop-sabad"><i class=" icon-basket sabad-icon"></i>
            </button>

            <p style="margin-left: 10px;">

                <?php
                echo $_SESSION["UserName"];
                ?>

            </p>

            <button onclick="btnLogout()" id="logout" class="logout">خروج</button>

        </div>
    </div>
    <div class="navbar">
        <div style="display: flex;" class="subnav">
            <a onclick="home()" id="Home" href="#">خانه</a>
        </div>
        <div class="subnav">
            <button onclick="mobile()" id="Mobile" class="subnavbtn">گوشی موبایل</button>
        </div>
    </div>
    <div class="basic-update">
        <form class="form" action="update.php" method="post">
            <h1 class="h1-style">ویرایش</h1>

            <?php
            if (isset($_POST["passcode"])) {
                $xpasscode = $_POST["passcode"];

                // SQL command
                $sql = "UPDATE `users` SET `Password` = '$xpasscode' WHERE `id`= '" . $_SESSION["id"] . "'";

                //Query Execute
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='msg-success-update'>با موفقیت ویرایش شد</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                mysqli_close($conn);
            }
            ?>

            <p class="style-passcode">رمز عبور:</p>
            <input class="passcode-input" type="text" name="passcode" required><br /><br />
            <button class="update" type="submit">ويرایش</button>
        </form>
    </div>

    <div class="footer">

        <button class="topFunction" onclick="topFunction()">
            <p class="txt-topFunction">بازگشت به بالا</p>
        </button>
        <button class="topFunction" onclick="massage()" id="message">
            <p class="txt-topFunction">ثبت نظر</p>
        </button>

        <p class="logo-footer">Mobile-Shop</p>
        <p class="telephone">تلفن پشتیبانی :&nbsp 09309476493 &nbsp&nbsp&nbsp&nbsp&nbspهفت روز هفته، ۲۴ ساعت شبانه‌ روز
            پاسخگوی شما هستیم.</p>
        <hr class="hr-footer">
        <p class="kolieh">کلیه حقوق این سایت متعلق به شرکت نوآوران فن آوازه (فروشگاه آنلاین Mobile-Shop) می باشد.</p>
    </div>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        function mobileshop() {
            document.getElementById("Mobile-Shop");
            open("Finall-Project.php", "_self");
        }

        function sabad() {
            document.getElementById("Sabad");
            open("Sabad-Page-Finall.php", "_self");
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function home() {
            document.getElementById("Home");
            open("Finall-Project.php", "_self");
        }

        function mobile() {
            document.getElementById("Mobile");
            open("Mobile-page.php", "_self");
        }

        function massage() {
            document.getElementById("message");
            open("message.php", "_self");
        }

        function btnLogout() {
            document.getElementById("logout");
            window.open("logout.php", "_self");
        }

        function btnMobile() {
            document.getElementById("btn-mobile");
            window.open("Mobile-page.php", "_self");
        }
    </script>
</body>

</html>