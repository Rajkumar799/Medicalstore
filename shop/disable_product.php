<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Update the disable status
    $sql = "UPDATE item SET disable='1' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo 1; // Success
    } else {
        echo 0; // Failure
    }
}
?>
