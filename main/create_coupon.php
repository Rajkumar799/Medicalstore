<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $discount = $_POST['discount'];
    $type = $_POST['type_'];
    $maxUse = $_POST['maxUse'];
    $description = $_POST['description'];
    $condition = $_POST['cond'];
    $maxCart = $_POST['maxCart'];

    $sql = "INSERT INTO coupon (code, discount, type, max_use, des, cond, max_cart) VALUES ('$code', '$discount', '$type', '$maxUse', '$description', '$condition', '$maxCart')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Coupon created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
