<?php
// Start or resume session
session_start();

// Include database connection
require "../config.php";

// Check if product id is sent via POST
if (isset($_POST['id'])) {
    $product_id = $_POST['id'];

    // Example of updating the 'disable' field in the database
    $update_sql = "UPDATE `item` SET disable='1' WHERE id='$product_id'";
    
    if ($conn->query($update_sql) === TRUE) {
        // Return success message or any other response if needed
        echo "Product disabled successfully!";
    } else {
        // Handle database error
        echo "Error: " . $conn->error;
    }
} else {
    // Handle if id parameter is not provided
    echo "Product ID not provided.";
}
?>
