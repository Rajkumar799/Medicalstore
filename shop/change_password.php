<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shop_id = $_SESSION['shop_id'];
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);

    $sql = "UPDATE shop SET password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newPassword, $shop_id);

    if ($stmt->execute()) {
        echo "Password changed successfully.";
        header("Location: profile.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
