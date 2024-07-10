<?php
require "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $id = $_POST['id'];

    if ($action == "disable_product") {
        $sql = "UPDATE item SET disable='1' WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo 1;
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action == "out_of_stock") {
        $sql = "UPDATE item SET stock='0' WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo 1;
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action == "in_stock") {
        $sql = "UPDATE item SET stock='1' WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo 1;
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action == "update_price") {
        $price = $_POST['p'];
        $max = $_POST['max'];
        $sql = "UPDATE item SET price=?, max_price=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dii", $price, $max, $id);
        if ($stmt->execute()) {
            echo 1;
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
