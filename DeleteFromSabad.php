<?php
include('connection.php');
?>

  <?php
  session_start();
  $user_id = $_SESSION["id"];
  $product_id = $_GET['product_id'];

  $sql = "DELETE From shop WHERE product_id = $product_id AND user_id = $user_id";

  if (mysqli_query($conn, $sql)) {
    header("Location:Sabad-Page-Finall.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
  ?>