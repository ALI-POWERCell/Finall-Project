<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="shortcut icon" href="pictures/logo.png">
    <link rel="stylesheet" href="Css-Finall.css">
</head>

<body>
    <?php

    // echo $_POST["userName"];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $newFileName = null;
        if (isset($_FILES['imageUpload'])) {
            // Directory where the uploaded file will be saved
            $uploadDir = 'upload/';

            // Ensure the upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Get file details
            $file = $_FILES['imageUpload'];
            $fileName = basename($file['name']);
            $fileTmpPath = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileType = mime_content_type($fileTmpPath);

            // Define allowed file types and size (optional)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            // Validate file type and size
            if (!in_array($fileType, $allowedTypes)) {
                die('Error: Only JPEG, PNG, and GIF files are allowed.');
            }


            // Generate a unique file name to prevent overwriting
            $newFileName = uniqid() . '-' . $fileName;

            // Move the uploaded file to the target directory
            $destination = $uploadDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destination)) {
                // echo "File uploaded successfully: <a href='$destination'>$newFileName</a>";
            } else {
                // echo 'Error: Failed to upload the file.';
            }
        } else {
            // echo 'Error: No file uploaded.';
        }













        $xSpecification = isset($_POST['Specification']) ? htmlspecialchars($_POST['Specification'], ENT_QUOTES, 'UTF-8') : null;
        $xuserName = isset($_POST['userName']) ? htmlspecialchars($_POST['userName'], ENT_QUOTES, 'UTF-8') : null;
        $xprice = isset($_POST['price']) ? (float) $_POST['price'] : null;
        $xseller = isset($_POST['seller']) ? htmlspecialchars($_POST['seller'], ENT_QUOTES, 'UTF-8') : null;
        $xguarantee = isset($_POST['guarantee']) ? htmlspecialchars($_POST['guarantee'], ENT_QUOTES, 'UTF-8') : null;
        $xcount = isset($_POST['count']) ? (int) $_POST['count'] : null;
        $xoffPrice = isset($_POST['offPrice']) ? (float) $_POST['offPrice'] : null;
        $xBigName = isset($_POST['BigName']) ? htmlspecialchars($_POST['BigName'], ENT_QUOTES, 'UTF-8') : null;
        $ximage = "$newFileName"; // Assuming "test" as the image name for now
    



        // SQL commands
    
        $sql = "
        INSERT INTO products (Specification, name, price, seller, guarantee, count, `OFF-Price`, BigName, image,BigImage)
        VALUES (
            '$xSpecification', 
            '$xuserName', 
            $xprice, 
            '$xseller', 
            '$xguarantee', 
            $xcount, 
            $xoffPrice, 
            '$xBigName', 
            '$ximage',
            '$ximage'
        )";



        if (mysqli_query($conn, $sql)) {
            echo "<p class='msg-success'>با موفقیت ثبت شد</p>";
        } else {
            throw new Exception("<p class='msg-warning'>'با مشکل مواجه شد'</p>");
        }
    }
    mysqli_close($conn);

    ?>
</body>

</html>