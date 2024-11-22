<?php
session_start();
include('connection.php');
//SQL Command

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
            <input placeholder="جستجو در Mobile-Shop" class="search" type="search">
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


    <div class="parent1">
        <div class="Sabad">
            <div class="title_Sabad">
                <h4>سبد خرید شما</h4>
            </div>
            <div class="card_sabad">
                <?php
                $user_id = $_SESSION['id'];
                $price = 0;
                $sql = "SELECT *,shop.id as basket_id,shop.count as countshop,products.count as product_count From shop
                    INNER JOIN products ON products.id = shop.product_id
                    INNER JOIN users ON users.id = shop.user_id
                    WHERE shop.user_id = " . $user_id;
                $result = mysqli_query($conn, $sql);
                $r = 0;
                $sum_count = 0;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                        $id = $row['basket_id']; // id sabade kharid
                        $product_id = $row['product_id'];
                        $product_count = $row['product_count']; // tedad kol mahsool
                        $BigName = ($row['BigName']);
                        $spec = json_decode($row['Specification'], true);
                        $price = ($row['price']);
                        $BigImage = ($row['BigImage']);
                        $OFF_Price = ($row['OFF-Price']);
                        $count = $row['countshop']; // tedad mahsole entekhab shode dar sabad
                        $Seller = ($row['Seller']);
                        $guarantee = ($row['guarantee']);
                        $bas_id = $row['id'];
                        $sum_count += $count;
                ?>


                        <div class="parent-spec-sabad">
                            <div class="parent-right-sabad">
                                <img class="img-sabad" src="<?php echo $row['BigImage']; ?>" />

                                <div class="parent-counter">
                                    <div>
                                        <input type="button" value="+" class="btn-plus counter" data-field="quantity" data-id="<?php echo $id; ?>">
                                        <input readonly step="1" max="<?php echo $product_count; ?>" value="<?php echo $count ?>" name="quantity" id="quantity" class="quantity-field counter-input">
                                        <input max="<?php echo $product_count; ?>" id="mines" type="button" value="-" class="btn-mines counter" data-field="quantity" data-id="<?php echo $id; ?>">
                                    </div>


                                    <a href="DeleteFromSabad.php?product_id=<?php echo $product_id; ?>">
                                        <button class="btn-trash" id="trash" onclick="trash()">
                                            <i class="icon-trash trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="parent-text-sabad">
                                <h1 class="title-phone-sabad"><?php echo $BigName ?></h1>
                                <div class="div-txt-sabad">
                                    <i class=" icon-color-adjust icons"></i>&nbsp;
                                    <h2 class="h2-sabad">رنگ : <?php echo $spec["رنگ"] ?></h2>
                                </div>

                                <div class="div-txt-sabad">
                                    <i class="icon-get-pocket icons"></i>&nbsp;
                                    <h2 class="h2-sabad"><?php echo $guarantee ?></h2>
                                </div>


                                <div class="div-txt-sabad">
                                    <i class="icon-shop icons"></i>&nbsp;
                                    <h2 class="h2-sabad"><?php echo $Seller ?></h2>
                                </div>

                                <?php if ($OFF_Price != NULL) {

                                    $Darsad = ($price * $OFF_Price) / 100;
                                    $Discount = $price - $Darsad;
                                ?>
                                    <div>
                                        <div style="display: inline-flex; margin-top: 5px;">
                                            <h2 class="h2-sabad">قیمت :</h2>&nbsp;
                                            <h2 class="price-through-sabad"><?php echo number_format($price) ?></h2>
                                        </div>&nbsp;
                                        <span class="takhfif-phone-sabad"><?php echo number_format($OFF_Price); ?>% تخفیف</span>
                                        <h2 class="h2-sabad-price" data-uni-price="<?php echo $Discount; ?>" data-price="<?php echo $Discount * $count; ?>" id="price<?php echo $id; ?>"><?php echo number_format($Discount * $count) ?> تومان</h2>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="div-price-else">
                                        <h2 class="h2-sabad-else">قیمت :</h2>&nbsp;
                                        <div class="div-txt-sabad" style="margin-top: unset;">

                                            <h2 class="h2-sabad-price" data-uni-price="<?php echo $price; ?>" data-price="<?php echo $price * $count; ?>" id="price<?php echo $id; ?>">
                                                <?php echo number_format($price * $count); ?> تومان</h2>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>

                        <div id="hr-ha">
                            <hr class="hr-sabad">
                            </hr>
                        </div>

                    <?php $r++;
                    }
                    ?>
            </div>
        </div>
        <div class="box-left-sabad">
            <div class="Sabad_Box_Left">
                <p class="txt-box-left-sabad" id="total_count" class="total_count">تعداد کالاها :&nbsp;<?php echo "(<span id='total_count_value'>" . $sum_count . "</span>)" ?></p>
                <hr class="hr-box-left-sabad">
                <p class="txt-box-left-sabad">قیمت کل : </p>
                <p class="price-all" id="total_price"></p>

                <div class="div-btn">
                    <button class="btn-box-left-sabad" onclick="edame()" id="edame">
                        <p class="txt-btn-box-left-Sabad">ادامه</p>
                    </button>
                </div>
            <?php
                } else {
                    echo "
                        <div class='empitySabad'>
                            <img src='pictures/empty-cart.svg'>
                            <p class='style-txt-sabad'>سبد خرید شما خالی است!</p>
                        
                    </div> ";
                }
            ?>
            </div>

        </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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

        function check_quantity() {
            if ($('#quantity').attr('value') == 1) {
                $("#mines").attr("disabled", true);
            } else {
                $("#mines").removeAttr("disabled");
            }
        }


        $('.parent-counter').on('click', '.btn-plus', function(e) {

            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
            var product_count = parent.find('input[name=' + fieldName + ']').attr('max');

            if (!isNaN(currentVal) && currentVal < product_count) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                var id = $(this).attr("data-id");
                var price = $("#price" + id).attr("data-uni-price") * (currentVal + 1);

                $("#total_count_value").text(parseInt($("#total_count_value").text()) + 1);

                $("#price" + id).text((parseInt(price).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " تومان"));
                $("#price" + id).attr("data-price", (parseInt(price)));
                $.post("basket.php", {
                    id: id,
                    type: "add"
                })
            }
            total_price();

        })


        $('.parent-counter').on('click', '.btn-mines', function(e) {

            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
            if (!isNaN(currentVal) && currentVal > 1) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                var id = $(this).attr("data-id");
                var price = $("#price" + id).attr("data-uni-price") * (currentVal - 1);

                $("#total_count_value").text(parseInt($("#total_count_value").text()) - 1);

                $("#price" + id).text((parseInt(price).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " تومان"));
                $("#price" + id).attr("data-price", (parseInt(price)));
                $.post("basket.php", {
                    id: id,
                    type: "mines"
                })
            }
            total_price();

        });


        function edame() {
            document.getElementById("edame");
            window.open("sefaresh.php", "_self");
        }

        function total_price() {
            var total = 0;
            $(".h2-sabad-price").each(function() {
                total += parseInt($(this).attr('data-price'));
            });
            $('#total_price').text(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " تومان");
        }
        $.fn.digits = function() {
            return this.each(function() {
                $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            })
        }
        total_price();
    </script>

</body>

</html>