<?php
require('fpdf.php');
include 'config.php';

// Check connection

// Function to fetch customer details
function getCustomerDetails($userId, $conn) {
    $query = "SELECT  `email`, `name`, `lname`, `phone`,  `state`, `city`, `address1`, `address2`, `pincode`, `landmark` FROM `cust` WHERE `id` = $userId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Create an array with custom keys
        $customKeysArray = array(
            
            'Name' => $row['name']." ".$row['lname'],'Email' => $row['email'],
            'Phone' => $row['phone'],
            'Address' =>$row['address1'].", ". $row['address2'],
            'City & State' => $row['city'].", ".$row['state'],
            
            'Pincode' => $row['pincode'],
            
        );

        return $customKeysArray;}
         else {
        return null;
    }
}

// Function to fetch order details
function getOrderDetails($orderId, $conn) {
    $query = "SELECT * FROM `orders` WHERE `order_id` = '$orderId'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return null;
    }
}

// Function to fetch item details
function getItemDetails($itemId, $conn) {
    $query = "SELECT * FROM `item` WHERE `id` = $itemId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to generate PDF
function generatePDF($userId, $orderId, $conn,$ship) {
    $sum=0;
    // Create PDF
    $pdf = new FPDF();
    $pdf->AddFont('font','','font.php');
    $pdf->SetFont('font', '', 12);
    $pdf->AddPage();

    // Fetch customer details
    $customerDetails = getCustomerDetails($userId, $conn);

    // Fetch order details
    $orderDetails = getOrderDetails($orderId, $conn);

    // Output customer details at the top
    $pdf->Cell(0, 10, 'ORDER ID - ' . $orderId, 0, 1, 'C');
    foreach ($customerDetails as $key => $value) {
        $pdf->Cell(0, 10, "$key: $value", 0, 1, 'L');
    }

    // Output order summary in tabular form
    $pdf->Ln();

    $pdf->Cell(10, 10, 'ID', 1);
    $pdf->Cell(115, 10, 'Product Name', 1);
    $pdf->Cell(15, 10, 'Qty', 1);
    $pdf->Cell(25, 10, 'Price', 1);
    $pdf->Cell(25, 10, 'Total', 1);
    $pdf->Ln();

    // Fetch and output item details for each item in the order
    foreach ($orderDetails as $item) {
        $itemId = $item['p_id'];
        $itemDetails = getItemDetails($itemId, $conn);
        $pdf->Cell(10, 10, $itemDetails['id'], 1);
       $pdf->Cell(115, 10, substr($itemDetails['name'], 0, 50), 1);
        $pdf->Cell(15, 10, $item['qty'], 1);
        $pdf->Cell(25, 10, $itemDetails['price'], 1);
        $pdf->Cell(25, 10, (int)$itemDetails['price']*(int)$item['qty'], 1);
        $sum+=(int)$itemDetails['price']*(int)$item['qty'];
        $pdf->Ln(); // Move to the next line for the next item
    }
$pdf->Cell(165, 10, "Total Amount", 1);
$pdf->Cell(25, 10, $sum, 1);
$pdf->Ln();
$pdf->Cell(165, 10, "Discount", 1);
$pdf->Cell(25, 10, $ship, 1);
$pdf->Ln();
$pdf->Cell(165, 10, "Sub Total", 1);
$pdf->Cell(25, 10, (int)$sum-(int)$ship, 1);
$pdf->Ln();
    // Save PDF or output as needed
    $pdf->Output($orderId.'.pdf', 'D');
}

// Example usage
$userId = $_SESSION['me'];  // Replace with the actual user ID
$orderId = $_GET['ord_id'];  // Replace with the actual order ID
$ship=$_GET['ship'];
generatePDF($userId, $orderId, $conn,$ship);

// Close database connection
$conn->close();
?>
