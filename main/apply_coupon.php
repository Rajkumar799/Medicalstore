<?php
include '../config.php';
session_start();

$me = $_SESSION['me'];
$coupon_code = $_POST['coupon_code'];

$response = array('success' => false, 'message' => 'Invalid coupon code', 'discount' => 0, 'new_total' => 0);

if (!isset($me)) {
    $response['message'] = 'User not logged in';
    echo json_encode($response);
    exit();
}

// Assume a fixed exchange rate
$exchange_rate = 1;

$sql = "SELECT * FROM coupon WHERE code='$coupon_code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $coupon = $result->fetch_assoc();
    $discount = $coupon['discount'];
    
    $sql = "SELECT SUM(item.price * cart.qty) AS total 
            FROM item, cart 
            WHERE cart.u_id='$me' AND cart.p_id=item.id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total = $row['total'];
    
    // Convert the total to INR
    $total_inr = $total * $exchange_rate;
    
    // Calculate the new total after discount in INR
    $discount_inr = $total_inr * ($discount / 100);
    $new_total_inr = $total_inr - $discount_inr;

    $response['success'] = true;
    $response['message'] = 'Coupon applied successfully';
    $response['discount'] = $discount_inr;
    $response['new_total'] = $new_total_inr;
} else {
    $response['message'] = 'Invalid coupon code';
}

echo json_encode($response);
?>
