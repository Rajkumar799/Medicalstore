<?php
// update_tracking.php

// Include your database connection file
require "../config.php";

// Validate and sanitize input
$order_id = $_POST['order_id'];
$tracking_id = $_POST['tracking_id'];

// Update the tracking ID in the database
$sql = "UPDATE orders SET t_id = '$tracking_id' WHERE order_id = '$order_id'";
if ($conn->query($sql) === TRUE) {
    // Successfully updated
    http_response_code(200);
    echo "Tracking ID updated successfully";
} else {
    // Error updating
    http_response_code(500);
    echo "Error updating tracking ID: " . $conn->error;
}

$conn->close();
?>
