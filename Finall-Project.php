<?php
session_start();
include('connection.php');
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
      <input placeholder="جستجو در Mobile-Shop" class="search" type="search" onsearch="showProducts(this)" onkeyup="showProducts(this)">

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
    <div style="display: flex;" class="subnav">
      <a onclick="home()" id="Home" href="#">خانه</a>
    </div>
    <div class="subnav">
      <button onclick="mobile()" id="Mobile" class="subnavbtn">گوشی موبایل</button>
    </div>
  </div>

  <!-- slider -->


  <div class="slideshow-container">
    <?php
    $sql = "SELECT * FROM products WHERE Banner IS NOT NULL";
    $r = 0;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
        $Banner = $row['Banner'];
        $id = $row["id"];
        $r++;
    ?>
        <div class="mySlides fade">
          <div class="numbertext"><?php echo $r; ?> / 3</div>
          <a href="Specification.php?id=<?php echo $id; ?>">
            <img class="banner<?php echo $r; ?>" src="<?php echo $Banner; ?>">
        </div>

      <?php
      }
      ?>
    <?php
    }
    ?>



    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

  </div>
  <br>

  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>


  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }
  </script>

  <div class="banner-m">
    <div class="btn-m">
      <h4>گوشی موبایل</h4>
      <button onclick="btnMobile()" id="btn-mobile" type="button">سایر محصولات</button>
    </div>
    <div class="Parent-cards" id="responseProducts">
      <?php
      $sql = "select * from products LIMIT 5";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $price = ($row['price']);
      ?>

          <div class="card-main margin-card">
            <a style="text-decoration: none;color:black" href="Specification.php?id=<?php echo $row['id'] ?>">
              <img class="properties-m" src="<?php echo $row['image']; ?>">

              <p class="txt-picture1"><?php echo $row['name']; ?></p>
              <p class="font-size-price"><b><?php echo number_format($price) ?> تومان</b></p>
            </a>
          </div>

      <?php
        }
      }
      ?>

    </div>
  </div>
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

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
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

    function showProducts(str) {
      str = str.value;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          $("#responseProducts").html(this.responseText);
        }
      }
      xmlhttp.open("GET", "getProducts.php?q=" + str, true);
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
      window.open("logout.php", "_self")
    }

    function btnMobile() {
      document.getElementById("btn-mobile");
      window.open("Mobile-page.php", "_self");
    }
  </script>
</body>

</html>