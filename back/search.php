<?php

include "../config.php";
if($_POST['action']=="search"){
$data = $_POST['data'];
$sql = "SELECT * FROM item WHERE name LIKE '%$data%' and disable='0'";
$result = $conn->query($sql);

$responseData = array(); // Initialize an array to hold the response data

if ($result === false) {
  // Handle the query error, if any
  $responseData['error'] = "Query error: " . $conn->error;
} else {
  $items = array(); // Initialize an array to store the retrieved items

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $items[] = $row; // Store each row in the $items array
    }
    $_SESSION['fetched_items'] = $items; // Store the fetched items in the session
    $responseData['items'] = $items; // Add the items to the response data
  } else {
    $responseData['items'] = array(); // No items found, set empty array
  }
}

$conn->close(); // Close the database connection

// Encode the response data as JSON and send it
header('Content-Type: application/json');
echo json_encode($responseData, JSON_PRETTY_PRINT);
}
elseif($_POST['action']=="search_shop"){
  $data = $_POST['data'];
$sql = "SELECT * FROM shop WHERE name LIKE '%$data%' and ban='0'";
$result = $conn->query($sql);

$responseData = array(); // Initialize an array to hold the response data

if ($result === false) {
  // Handle the query error, if any
  $responseData['error'] = "Query error: " . $conn->error;
} else {
  $items = array(); // Initialize an array to store the retrieved items

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $items[] = $row; // Store each row in the $items array
    }
    $_SESSION['fetched_items'] = $items; // Store the fetched items in the session
    $responseData['items'] = $items; // Add the items to the response data
  } else {
    $responseData['items'] = array(); // No items found, set empty array
  }
}

$conn->close(); // Close the database connection

// Encode the response data as JSON and send it
header('Content-Type: application/json');
echo json_encode($responseData, JSON_PRETTY_PRINT);
}
?>
