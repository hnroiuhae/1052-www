<?php
$conn = new mysqli("db", "pi", "pi", "pi");
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>
