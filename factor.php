<!DOCTYPE html>
<html class="style-html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاکتور خرید</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
    <link rel="stylesheet" href="icons/fontello.css">

    <script>
        window.addEventListener("load", function() {
            document.querySelector(".loading-page").classList.add("loaded");
        })
    </script>
</head>
<?php
include('connection.php');
session_start();
$user_id = $_SESSION['id'];

$sql = "SELECT *,shop.id as basket_id,shop.count as countshop,products.count as product_count From shop
        INNER JOIN products ON products.id = shop.product_id
        INNER JOIN users ON users.id = shop.user_id
        WHERE shop.user_id = " . $user_id;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row["product_id"];
        $product_count = $row["countshop"];
        $price = $row["price"];

        $OFF_Price = is_null($row['OFF-Price']) ? 0 : intval($row['OFF-Price']);

        $total_price = ($price - (($price * $OFF_Price) / 100)) * $product_count;

        $sql = "INSERT INTO factor(user_id,product_id,product_count,price,total_price)
                Values('" . $user_id . "','" . $product_id . "','" . $product_count . "','" . ($price - (($price * $OFF_Price) / 100)) . "','" . $total_price . "')";

        if (mysqli_query($conn, $sql)) {
            $sql = "UPDATE products SET count = count - " . $product_count . " WHERE id = " . $product_id;
            mysqli_query($conn, $sql);
        }
    }
}
echo "<p class='msg-success' style='margin-top: 5%;'>پرداخت با موفقیت انجام شد</p>";
?>

<?php

$user_id = $_SESSION['id'];

$name = $_POST["name"];
$tel = $_POST["phone"];
$address = $_POST["address"];
$email = $_POST["email"];

$sql = "UPDATE users 
            SET name='$name',tel='$tel',address='$address',email='$email' WHERE id = " . $user_id;

$result = mysqli_query($conn, $sql);
header("payment.php");
?>

<body class="basic" dir="rtl">
    <div class="loading-page">
        <div class="loading-circle">
            <span>Mobile-Shop</span>
        </div>
    </div>
    <div class="factor">
        <div class="Sabad" style="padding-bottom: 1.3%;">
            <div class="title_Sabad" style="justify-content: center;">
                <h3>فاکتور خرید شما</h3>
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
                        $product_count = $row['product_count'];
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
                                <h5 class="number-product">(<?php echo $count ?> عدد)</h5>
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
                        <hr class="hr-sabad">
                        </hr>
                    <?php $r++;
                    }
                    ?>

                    <div class="parent-info-factor">

                        <?php
                        $sql = "SELECT name,tel,address,email FROM users WHERE id = " . $user_id;
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_array($result)) {

                                $name = $row['name'];
                                $tel = $row['tel'];
                                $address = $row['address'];
                                $email = $row['email'];

                        ?>
                                <div class="parent-customer-box">
                                    <p class="title-customer">اطلاعات خریدار</p>
                                    &nbsp;&nbsp;
                                    <p class="txt-box-left">نام : <?php echo $name ?></p>
                                    <hr class="hr-box-left">
                                    <p class="txt-box-left txt-box-customer">تلفن همراه : <?php echo $tel ?></p>
                                    <hr class="hr-box-left">
                                    <p class="txt-box-left txt-box-customer">آدرس : <?php echo $address ?></p>
                                    <hr class="hr-box-left">
                                    <p class="txt-box-left txt-box-customer">ایمیل : <?php echo $email ?></p>
                                </div>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>

                        <div class="factorBox">
                            <div class="parent-textBox-factor">
                                <p class="txt-box-left-sabad" id="total_count" class="total_count">تعداد کالاها :&nbsp;<?php echo "<span id='total_count_value'>" . $sum_count . "</span>" ?></p>
                                <hr class="hr-box-left-sabad">
                                <p class="txt-box-left-sabad">قیمت کل : </p>
                                <p class="price-all-factor" id="total_price"></p>
                            </div>
                        </div>
                    </div>
            </div>
        <?php
                    $sql = "DELETE from shop WHERE user_id = " . $user_id;
                    mysqli_query($conn, $sql);
                }
        ?>

        <div style="text-align: center;">
            <button id="BackToStore" class="btnBackToStore" onclick="BackToStore()">
                <p class="txt-BackToStore">بازگشت به فروشگاه</p>
            </button>
        </div>
        </div>

    </div>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        function BackToStore() {
            document.getElementById("BackToStore");
            window.open("Finall-Project.php", "_self");
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