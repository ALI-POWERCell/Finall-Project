<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="icons/fontello.css">
    <link rel="stylesheet" href="Css-Finall.css">
</head>

<body>
    <?php
    include("connection.php");
    $q = $_GET['q'];
    //SQL Command
    $sql = "SELECT * From products WHERE name LIKE'%" . $q . "%' LIMIT 5";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
    ?>
            <div class="card-main margin-card-main">
                <a style="text-decoration: none;color:black" href="Specification.php?id=<?php echo $row['id'] ?>">
                    <img class="properties-m" src="<?php echo $row['image']; ?>">
                    <p class="txt-picture1"><?php echo $row['name']; ?></p>
                    <p class="font-size-price"><b><?php echo number_format($row['price']); ?> تومان</b></p>
            </div>
    <?php
        }
    } else {
        echo "<div style='flex: auto; margin-bottom: 33px;'><p class='search-false'><i class='icon-attention attention-icon'></i>&nbsp;نتیجه‌ ای یافت نشد!<br><br>
    از عبارت‌ های متداول‌ تر استفاده کنید و یا املای عبارت وارد ‌شده را بررسی کنید.</p></div>";
    }
    mysqli_close($conn);
    ?>
</body>

</html>