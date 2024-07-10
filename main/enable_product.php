<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['id']);
        
        // Update query to enable product
        $update_sql = "UPDATE `item` SET disable = '0' WHERE id = '$product_id'";

        if ($conn->query($update_sql) === TRUE) {
            echo "Product enabled successfully!";
        } else {
            echo "Error enabling product: " . $conn->error;
        }
    } else {
        echo "ID not received";
    }
} else {
    echo "Invalid request method";
}
?>
