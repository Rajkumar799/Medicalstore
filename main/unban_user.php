<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = intval($_POST['id']);

    // Unban the user by setting ban to 0
    $sql = "UPDATE cust SET ban = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User unbanned successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
