<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Delete from database
    $sql = "DELETE FROM item WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo 1; // Success
    } else {
        echo 0; // Failure
    }
}
?>
