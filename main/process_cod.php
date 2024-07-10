<?php
include "../config.php";
session_start(); // Ensure the session is started

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $me = $_SESSION['me'];

    // Log received data for debugging
    error_log("Received amount: " . var_export($amount, true));
    error_log("User ID: " . var_export($me, true));

    if (!isset($amount) || !isset($me) || empty($amount)) {
        error_log("Missing amount or user ID.");
        echo json_encode(['success' => false, 'message' => 'Invalid data.']);
        exit();
    }

    // Insert order into the database
    // Ensure 'total_amount' is the correct column name
    $sql = "INSERT INTO orders (u_id, total_amount, payment_method) VALUES ('$me', '$amount', 'COD')";
    if ($conn->query($sql) === TRUE) {
        error_log("Order inserted successfully");
        echo json_encode(['success' => true]);
    } else {
        // Log the error message for debugging
        error_log("Order processing failed: " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Order processing failed.']);
    }

    $conn->close(); // Close the connection
} else {
    error_log("Invalid request method.");
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
