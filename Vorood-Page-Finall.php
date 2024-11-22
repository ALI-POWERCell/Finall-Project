<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
</head>

<body>
    <div class="basic-submit-vorood">
        <form name="frmUser" action="login.php" method="post">

            <div>
                <h1 class="h1-style">ورود</h1>
                <div>
                    <p style="color:red;">
                        <?php
                        session_start();
                        if (isset($_SESSION['Message'])) {
                            echo $_SESSION['Message'];
                            unset($_SESSION['Message']);
                        }
                        ?>
                    </p>
                </div>
                <p class="style-username">: نام کاربری</p>

                <input class="passcode-input" name="username" required value="<?php if (isset($_COOKIE["UserName"])) echo $_COOKIE["UserName"] ?>">
                <p class="style-passcode">: رمز عبور</p>
                <input class="passcode-input" name="password" required value="<?php if (isset($_COOKIE["Password"])) echo $_COOKIE["Password"] ?>">
            </div>
            <br />
            <div class="parent-checkbox">
                <input type="checkbox" name="remember">
                <p class="checkbox">مرا به خاطر بسپار</p>
            </div>

            <div>
                <button class="style-btn-Vorood" name="submit">ورود</button>
            </div>

        </form>
    </div>
</body>

</html>