<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shopId = intval($_POST['id']);

    // Unban the shop by setting ban to 0
    $sql = "UPDATE shop SET ban = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $shopId);

    if ($stmt->execute()) {
        echo "Shop unbanned successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
