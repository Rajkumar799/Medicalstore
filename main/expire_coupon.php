<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "UPDATE coupon SET expired = 1 WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Coupon expired successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
