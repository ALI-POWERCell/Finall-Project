<?php
session_start();
include('connection.php');
$q = $_GET['id'];
?>
<!DOCTYPE html>
<html class="style-html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گوشی موبایل</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
    <link rel="stylesheet" href="icons/fontello.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script>
        window.addEventListener("load", function () {
            document.querySelector(".loading-page").classList.add("loaded");
        })
    </script>
</head>

<body dir="rtl" class="basic">
    <div class="loading-page">
        <div class="loading-circle">
            <span>Mobile-Shop</span>
        </div>
    </div>
    <div class="parent-header">
        <div class="parent-logo-search">
            <p onclick="mobileshop()" id="Mobile-Shop" class="header">Mobile-Shop</p>
            <input placeholder="جستجو در Mobile-Shop" class="search" type="search" onsearch="showProducts(this)"
                onkeyup="showProducts(this)">
        </div>
        <div class="txt-align margin-buttons">
            <button onclick="sabad()" id="Sabad" class="shop-sabad"><i class=" icon-basket sabad-icon"></i>
            </button>

            <?php
            if (isset($_SESSION["UserName"])) {
                ?>
                <p style="margin-left: 10px;">
                    <?php
                    echo $_SESSION["UserName"];
                    ?>
                </p>
                <button onclick="update()" id="update" class="update-icon"><i class="icon-user user-icon"></i></button>
                <button onclick="btnLogout()" id="logout" class="logout">خروج</button>

            <?php } else {
                ?>
                <button onclick="btnVorood()" id="vorood" class="vorood">ورود</button>
                <button onclick="btnSubmit()" id="submit" class="submit">ثبت نام</button>
                <?php
            } ?>

        </div>
    </div>
    <div class="navbar">
        <a href="Finall-Project.php">خانه</a>
        <div class="subnav">
            <button onclick="mobile()" id="Mobile" class="subnavbtn">گوشی موبایل</button>
        </div>
    </div>
    <?php

    $sql = "SELECT * From products WHERE id=" . $q;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            $id = $row['id'];
            $spec = json_decode($row['Specification'], true);
            $name = ($row['name']);
            $BigName = ($row['BigName']);
            $price = ($row['price']);
            $BigImage = ($row['BigImage']);
            $OFF_Price = ($row['OFF-Price']);
            $Seller = ($row['Seller']);
            $guarantee = ($row['guarantee']);
            $count = ($row['count']);
            ?>

            <div class="bannerr pt-4">
                <form id="AddProduct" method="post" action="SubmitUpdateProduct.php" enctype="multipart/form-data">
                    <!-- enctype="multipart/form-data" -->
                    <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
                    <input type="hidden" name="Specification" id="Specification" />
                    <div class="container">
                        <div class="row">
                            <div class="mb-3 col-4">
                                <label for="userName" class="form-label">نام</label>
                                <input type="text" class="form-control" id="userName" name="userName"
                                    value="<?php echo ($name != ""?$name:"") ?>">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="price" class="form-label">قیمت</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="<?php echo ($price) ?>">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="seller" class="form-label">فروشنده</label>
                                <input type="text" class="form-control" id="seller" name="seller"
                                    value="<?php echo ($Seller) ?>">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="guarantee" class="form-label">گارانتی</label>
                                <input type="text" class="form-control" id="guarantee" name="guarantee"
                                    value="<?php echo ($guarantee) ?>">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="count" class="form-label">موجودی</label>
                                <input type="number" class="form-control" id="count" name="count"
                                    value="<?php echo ($count) ?>">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="offPrice" class="form-label">قیمت با تخفیف</label>
                                <input type="number" class="form-control" id="offPrice" name="offPrice"
                                    value="<?php echo ($OFF_Price) ?>">
                            </div>
                            <div class="mb-3 col-8">
                                <label for="name" class="form-label">نام کامل</label>
                                <textarea type="text" class="form-control" id="BigName"
                                    name="BigName"><?php echo ($BigName) ?></textarea>
                            </div>
                            <div class="mb-3 col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="imageUpload" class="form-label">آپلود تصویر</label>
                                        <input type="file" class="form-control" name="imageUpload" id="imageUpload"
                                            accept="image/*">
                                    </div>
                                    <div class="col-6">
                                        <h6>پیش نمایش:</h6>
                                        <img id="imagePreview" src="<?php print($BigImage) ?>" alt="Preview" class="img-fluid"
                                            style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;width: 250px;">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3>آپشن ها</h3>
                                <div class="row">
                                    <!-- <div class="mb-3 col-4">
                                </div> -->

                                    <div class="container mt-5">
                                        <div id="defult_Value">
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="رنگ" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["رنگ"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="حافظه داخلی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["حافظه داخلی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="بازه ی اندازه صفحه نمایش" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["بازه ی اندازه صفحه نمایش"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="شبکه های ارتباطی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["شبکه های ارتباطی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="وزن" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["وزن"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="توضیحات سیم کارت" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["توضیحات سیم کارت"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="ساختار بدنه" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["ساختار بدنه"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="ویژگی‌های خاص" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["ویژگی‌های خاص"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="تعداد سیم کارت" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["تعداد سیم کارت"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="زمان معرفی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["زمان معرفی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="تراشه" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["تراشه"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="پردازنده‌ی مرکزی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["پردازنده‌ی مرکزی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="نوع پردازنده" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["نوع پردازنده"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="فرکانس پردازنده‌ی مرکزی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["فرکانس پردازنده‌ی مرکزی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="پردازنده‌ی گرافیکی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["پردازنده‌ی گرافیکی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="حافظه داخلی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["حافظه داخلی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="مقدار RAM" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["مقدار RAM"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="فناوری صفحه‌ نمایش" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["فناوری صفحه‌ نمایش"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="اندازه" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["اندازه"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="رزولوشن" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["رزولوشن"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="تراکم پیکسلی" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["تراکم پیکسلی"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="سایر قابلیت‌ها" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["سایر قابلیت‌ها"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="سیستم عامل" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["سیستم عامل"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="نسخه سیستم عامل" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["نسخه سیستم عامل"] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3 field-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="نام" name="name[]"
                                                        value="مشخصات باتری" readonly />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="مقدار" name="value[]"
                                                        value="<?php echo $spec["مشخصات باتری"] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="SubmitDeleteProduct.php?id=<?php echo $q?>" class="btn btn-danger">حذف</a>
                        </div>
                    </div>
                </form>
            </div>
            <?php
        }
    } ?>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <div class="footer">
        <?php
        if (isset($_SESSION["UserName"])) {

            ?>
            <button class="topFunction" onclick="topFunction()">
                <p class="txt-topFunction">بازگشت به بالا</p>
            </button>
            <button class="topFunction" onclick="massage()" id="message">
                <p class="txt-topFunction">ثبت نظر</p>
            </button>
        <?php } else {
            ?>
            <button class="topFunction" onclick="topFunction()">
                <p class="txt-topFunction">بازگشت به بالا</p>
            </button>
            <?php
        } ?>
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
            <?php
            if (isset($_SESSION["UserName"])) {
                ?>
                open("Sabad-Page-Finall.php", "_self");

            <?php } else {
                ?>
                alert("!لطفا ابتدا لاگین کنید");
            <?php } ?>
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function mobile() {
            document.getElementById("Mobile");
            open("Mobile-page.php", "_self");
        }

        function showProducts(str) {
            str = str.value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $("#responseProducts").html(this.responseText);

                }
            }
            xmlhttp.open("GET", "getFullProducts.php?q=" + str, true);
            xmlhttp.send();
        }

        function btnSubmit() {
            document.getElementById("submit");
            window.open("Submit-Page-Finall.html");
        }

        function btnVorood() {
            document.getElementById("vorood");
            window.open("Vorood-Page-Finall.php", "_self");
        }

        function update() {
            document.getElementById("update");
            open("update.php", "_self");
        }

        function massage() {
            document.getElementById("message");
            open("message.php", "_self");
        }


        function btnLogout() {
            document.getElementById("logout");
            window.open("logout.php", "_self");
        }


    </script>

    <script>
        document.getElementById('addFieldButton').addEventListener('click', function () {
            const fieldContainer = document.getElementById('fieldContainer');
            const newFieldRow = document.createElement('div');
            newFieldRow.className = 'row mb-3 field-row';
            newFieldRow.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" placeholder="نام" name="name[]">
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" placeholder="مقدار" name="value[]">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-field">حذف</button>
            </div>
        `;
            fieldContainer.appendChild(newFieldRow);
        });

        document.getElementById('fieldContainer').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-field')) {
                e.target.closest('.field-row').remove();
            }
        });

        document.getElementById('submitButton').addEventListener('click', function () {
            const names = document.getElementsByName('name[]');
            const values = document.getElementsByName('value[]');
            const jsonData = {};

            for (let i = 0; i < names.length; i++) {
                const name = names[i].value.trim();
                const value = values[i].value.trim();
                if (name && value) {
                    jsonData[name] = value;
                }
            }

            console.log(jsonData);
            alert('JSON Data: ' + JSON.stringify(jsonData));
        });

        document.getElementById('submitform').addEventListener('click', function () {
            const names = document.getElementsByName('name[]');
            const values = document.getElementsByName('value[]');
            const jsonData = {};

            for (let i = 0; i < names.length; i++) {
                const name = names[i].value.trim();
                const value = values[i].value.trim();
                if (name && value) {
                    jsonData[name] = value;
                }
            }

            console.log(JSON.stringify(jsonData));
            document.getElementById('Specification').value = JSON.stringify(jsonData);
            const form = document.getElementById('AddProduct');
            form.submit();
        })

        document.getElementById('imageUpload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>