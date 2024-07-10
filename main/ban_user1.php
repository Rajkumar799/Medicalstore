<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['id'];

    if (empty($userId)) {
        echo "User ID is required.";
        exit;
    }

    // Update the ban status in the database
    $sql = "UPDATE cust SET ban = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User banned successfully.";
    } else {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
