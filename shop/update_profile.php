<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shop_id = $_SESSION['shop_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE shop SET name=?, email=?, phone=?, address=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $shop_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully.";
        header("Location: profile.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
