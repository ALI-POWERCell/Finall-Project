<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نظر</title>
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

            <button onclick="update()" id="update" class="update-icon"><i class="icon-user user-icon"></i></button>
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

    <div class="basic-message">
        <div>
            <h1 class="h1-style">ثبت نظر</h1>
            <form action="comment.php" method="post">
                <p class="style-message">متن پیام : </p>
                <textarea class="message-input" type="text" name="message" required></textarea>

                <input type="hidden" value=" <?php $_SESSION["id"] ?>">
                <div style="margin-bottom: -2%; margin-top: -3.7%;">
                    <button class="style-btn-Sabt">ثبت</button>
                </div>
            </form>
        </div>
    </div>



    <div class="basic-messages">
        <h1 class="h1-style">نظرات</h1>
        <?php
        $sql = "SELECT * FROM message";
        $result = mysqli_query($conn, $sql);
        $r = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
        ?>

                <div>

                    <form action="deletecomment.php" method="post">

                        <?php

                        echo '<textarea readonly class="messages" type="text">' . $row["comment"] . '</textarea>';
                        echo '<input class="message-input" type="hidden" name="messageid" value="' . $row["id"] . '">';
                        ?>
                        <?php

                        if ($row["userid"] == $_SESSION["id"])
                            echo
                            '<button class="btn-delete">حذف</button>';

                        ?>

                    </form>

                </div>
                <div id="hr-ha">
                    <hr class="hr-message">
                    </hr>
                </div>

            <?php $r++;
            }
            ?>
        <?php
        }
        ?>
    </div>

    <div class="footer">
        <button class="topFunction" onclick="topFunction()">
            <p class="txt-topFunction">بازگشت به بالا</p>
        </button>
        <p class="logo-footer">Mobile-Shop</p>
        <p class="telephone">تلفن پشتیبانی :&nbsp 09309476493 &nbsp&nbsp&nbsp&nbsp&nbspهفت روز هفته، ۲۴ ساعت شبانه‌ روز
            پاسخگوی شما هستیم.</p>
        <hr class="hr-footer">
        <p class="kolieh">کلیه حقوق این سایت متعلق به شرکت نوآوران فن آوازه (فروشگاه آنلاین Mobile-Shop) می باشد.</p>
    </div>
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

        function update() {
            document.getElementById("update");
            open("update.php", "_self");
        }

        function btnLogout() {
            document.getElementById("logout");
            window.open("logout.php", "_self")
        }

        function btnMobile() {
            document.getElementById("btn-mobile");
            window.open("Mobile-page.php", "_self");
        }
    </script>
</body>

</html>