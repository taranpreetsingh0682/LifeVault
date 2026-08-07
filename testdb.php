<?php
$conn = new mysqli("127.0.0.1", "root", "", "lifevault");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

echo "Database Connected Successfully!";
?>