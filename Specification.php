<?php
session_start();
include('connection.php');
$q = $_GET['id'];
//SQL Command

$sql = "SELECT * From products WHERE id=" . $q;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {

    $id = $row['id'];
    $spec = json_decode($row['Specification'], true);
    $BigName = ($row['BigName']);
    $price = ($row['price']);
    $BigImage = ($row['BigImage']);
    $OFF_Price = ($row['OFF-Price']);
    $Seller = ($row['Seller']);
    $guarantee = ($row['guarantee']);
    $count = ($row['count'])
?>

    <!DOCTYPE html>
    <html class="style-html">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mobile-Shop</title>
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
        <a onclick="home()" id="Home" href="#">خانه</a>
        <div class="subnav">
          <button onclick="mobile()" id="Mobile" class="subnavbtn">گوشی موبایل</button>
        </div>
      </div>
      <div>

        <h1 class="title"><?php echo $BigName ?></h1>

      </div>
      <div class="parent1">
        <div class="div-img">
          <img class="img" src="<?php echo $row['BigImage']; ?>" />
        </div>
        <div class="div-center-texts">
          <h2 class="h2">رنگ : <?php echo $spec["رنگ"] ?></h2>
          <div>
            <ul class="ul-txt-center">ویژگی های کالا
              <li class="li-txt-center">حافظه داخلی : <?php echo $spec["حافظه داخلی"] ?></li>
              <li class="li-txt-center">بازه ی اندازه صفحه نمایش : <?php echo $spec["بازه ی اندازه صفحه نمایش"] ?></li>
              <li class="li-txt-center">شبکه های ارتباطی : <?php echo $spec["شبکه های ارتباطی"] ?></li>
            </ul>
          </div>
        </div>
        <?php
        if ($row['count'] == 0)
          echo "<div class='box-left'>
            <div class='boxEmpity'>
            <p class='title-Empity'>ناموجود</p>
              <p class='txtEmpity'>این کالا فعلا موجود نیست</p>
            </div>
          </div>";
        elseif ($row['count'] >= 1) {

        ?>
          <div class="box-left">
            <div class="parent-box-left-takhfif">
              <p class="txt-box-left">فروشنده : <?php echo $Seller ?></p>
              <hr class="hr-box-left">
              <p class="txt-box-left">گارانتی : <?php echo $guarantee ?></p>
              <hr class="hr-box-left">
              <p class="txt-box-left">موجود در انبار فروشنده</p>
              <hr class="hr-box-left">

              <?php if ($OFF_Price != NULL) {
                echo '<p class="txt-box-left">قیمت فروشنده :</p>';
                $Darsad = ($price * $OFF_Price) / 100;
                $Discount = $price - $Darsad;
              ?>

                <div class="parent-takhfif-phone">
                  <p class="price-through"><?php echo number_format($price) ?></p>
                  <span class="takhfif-phone"><?php echo number_format($OFF_Price); ?>%</span>
                </div>

                <p class="price_off"><?php echo number_format($Discount) ?> تومان</p>
              <?php
              } else {
              ?>
                <p class="txt-box-left">قیمت فروشنده : </p>
                <p <?php echo ' class="price" ' ?> class="price_off"><?php echo number_format($price); ?> تومان</p>
              <?php } ?>

              <?php

              if (isset($_SESSION["UserName"])) {

                $pId = $_GET['id'];
                $query = "SELECT * FROM `shop` WHERE user_id =" . $_SESSION["id"] . " and product_id = " . $pId . ";";
                $result2 = mysqli_query($conn, $query);
                if (mysqli_num_rows($result2) > 0) {

                  echo "<p class='msg-entity'>این کالا هم اکنون در سبد خرید شما موجود است</p>";
                  echo "<div class='div-btn'>
                <button class='btn-box-left' onclick='sabad()' id='Sabad'>
                  <p class='txt-btn-box-left'>ورود به صفحه سبد خرید</p>
                </button></div>";
                } else {

                  echo "<div class='div-btn'>
                <button class='btn-box-left' onclick='addShop()' id='addShop'>
                  <p class='txt-btn-box-left'>افزودن به سبد خرید</p>
                </button>
              </div>";
                }
              } else {
                echo '<div class="div-btn">
                <button class="btn-box-left" onclick="addShop()" id="addShop">
                  <p class="txt-btn-box-left">افزودن به سبد خرید</p>
                </button>
              </div>';
              }
              ?>


            <?php
          }
            ?>
            </div>
          </div>
      </div>

      <hr class="big-hr">
      <p class="title2">مشخصات کالا</p>
      <table>
        <tr>
          <td>
            <div class="div-right-table">
              <p>
                <li>وزن</li>
              </p>
              <p class="p-table"><?php echo $spec["وزن"] ?></p>
              <p>
                <li>توضیحات سیم کارت</li>
              </p>
              <p class="p-table"><?php echo $spec["توضیحات سیم کارت"] ?></p>
              <p>
                <li>ساختار بدنه</li>
              </p>
              <p class="p-table"><?php echo $spec["ساختار بدنه"] ?></p>
              <p>
                <li>ویژگی‌های خاص</li>
              </p>
              <p class="p-table"><?php echo $spec["ویژگی‌های خاص"] ?></p>
              <p>
                <li>تعداد سیم کارت</li>
              </p>
              <p class="p-table"><?php echo $spec["تعداد سیم کارت"] ?></p>
              <p>
                <li>زمان معرفی</li>
              </p>
              <p class="p-table"><?php echo $spec["زمان معرفی"] ?></p>
              <p>
                <li>تراشه</li>
              </p>
              <p class="p-table"><?php echo $spec["تراشه"] ?></p>
              <p>
                <li>پردازنده‌ی مرکزی</li>
              </p>
              <p class="p-table"><?php echo $spec["پردازنده‌ی مرکزی"] ?></p>
              <p>
                <li>نوع پردازنده</li>
              </p>
              <p class="p-table"><?php echo $spec["نوع پردازنده"] ?></p>
              <p>
                <li>فرکانس پردازنده‌ی مرکزی</li>
              </p>
              <p class="p-table"><?php echo $spec["فرکانس پردازنده‌ی مرکزی"] ?></p>
              <p>
                <li>پردازنده‌ی گرافیکی</li>
              </p>
              <p class="p-table"><?php echo $spec["پردازنده‌ی گرافیکی"] ?></p>
            </div>
          </td>
          <td class="td2">
            <div class="div-left-table">
              <p>
                <li>حافظه داخلی</li>
              </p>
              <p class="p-table"><?php echo $spec["حافظه داخلی"] ?></p>
              <p>
                <li>مقدار RAM</li>
              </p>
              <p class="p-table"><?php echo $spec["مقدار RAM"] ?></p>
              <p>
                <li>فناوری صفحه‌ نمایش</li>
              </p>
              <p class="p-table"><?php echo $spec["فناوری صفحه‌ نمایش"] ?></p>
              <p>
                <li>اندازه</li>
              </p>
              <p class="p-table"><?php echo $spec["اندازه"] ?></p>
              <p>
                <li>رزولوشن</li>
              </p>
              <p class="p-table"><?php echo $spec["رزولوشن"] ?></p>
              <p>
                <li>تراکم پیکسلی</li>
              </p>
              <p class="p-table"><?php echo $spec["تراکم پیکسلی"] ?></p>
              <p>
                <li>سایر قابلیت‌ها</li>
              </p>
              <p class="p-table"><?php echo $spec["سایر قابلیت‌ها"] ?></p>
              <p>
                <li>سیستم عامل</li>
              </p>
              <p class="p-table"><?php echo $spec["سیستم عامل"] ?></p>
              <p>
                <li>نسخه سیستم عامل</li>
              </p>
              <p class="p-table"><?php echo $spec["نسخه سیستم عامل"] ?></p>
              <p>
                <li>مشخصات باتری</li>
              </p>
              <p class="p-table"><?php echo $spec["مشخصات باتری"] ?></p>

            </div>
          </td>
        </tr>
      </table>
    <?php
  }
    ?>
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

  <?php
}
  ?>

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
      <?php   } ?>
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

    function addShop() {
      document.getElementById("addShop");
      <?php
      if (isset($_SESSION["UserName"])) {
      ?>
        open("addtosabad.php?product_id=<?php echo $id; ?>", "_self");

      <?php } else {
      ?>
        alert("!لطفا ابتدا لاگین کنید");
      <?php   } ?>
    }

    function btnSubmit() {
      document.getElementById("submit");
      window.open("Submit-Page-Finall.html");
    }

    function btnVorood() {
      document.getElementById("vorood");
      window.open("Vorood-Page-Finall.php", "_self");
    }

    function btnLogout() {
      document.getElementById("logout");
      window.open("logout.php", "_self")
    }

    function massage() {
      document.getElementById("message");
      open("message.php", "_self");
    }
  </script>
    </body>

    </html>