<?php
// Initialize
$servername = "localhost";
$dbname = "db";
$user = "root";
$pass = "";

// Create connection
$conn = mysqli_connect($servername, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
