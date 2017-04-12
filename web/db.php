<?php
$conn = new mysqli("127.0.0.1", "root", "381654729", "test01");
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>
