<?php
#  window.location.href = "capture.php?amount="+parseInt(amount)*100+"&id="+response.razorpay_payment_id;
$id=$_GET['id'];echo $id;
$am=$_GET['amount'];
include 'config.php';
$_SESSION['ord_id']=$id;
$key_id = "rzp_test_OXruRqJ6qMIrKK";
$key_secret = "3xUG6cNN3JbWwiS7J6FbmX5p";
$payment_id = $id;
$amount = $am;
$currency = "INR";
$paid=$_GET['paid'];
$_SESSION['paid']=$paid;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/payments/$payment_id/capture/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    'amount' => $am,
    'currency' => $currency,
    
)));
curl_setopt($ch, CURLOPT_USERPWD, "$key_id:$key_secret");

$response = curl_exec($ch);
curl_close($ch);
if (!$response) {
} else {
    $response_array = json_decode($response, true);
    print_r($response_array);
   if ($response_array['status'] == 'captured') {
        header('Location:thanks.php');
    } else {
        echo "<script>alert('Payment Successsful but not captured!');</script>";
        header('Location:thanks.php');
    }
}


?>