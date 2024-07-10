<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shopId = intval($_POST['id']);

    // Ban the shop by setting ban to 1
    $sql = "UPDATE shop SET ban = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $shopId);

    if ($stmt->execute()) {
        echo "Shop banned successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
