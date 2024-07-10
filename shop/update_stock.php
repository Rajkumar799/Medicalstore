<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the stock status
    $sql = "UPDATE item SET stock='$status' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo 1; // Success
    } else {
        echo 0; // Failure
    }
}
?>
