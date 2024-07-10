<?php 

include "config.php";
include 'back/smtp/PHPMailerAutoload.php';

if (!isset($_SESSION["ord_id"])) {
    header("Location:404.php");
}else{
  //  $ord_id = $_SESSION["ord_id"];
    $ord_id="ID".time();
}
$me = $_SESSION["me"];
 $ma = $_COOKIE['user_email'];
 $code=$_SESSION['code']; 
 $paid=$_SESSION['paid'];
$total = 0;
 $sql = "SELECT cart.p_id as prod, cart.qty as qty,cart.size as size, item.name as name, item.price as price,item.shop_id as shop_ from item, cart where cart.u_id='$me' and cart.p_id = item.id";
$result = $conn->query($sql);
$itemsArray = [];

$today = date("d-m-Y");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $p_id = $row["prod"];
        $name = $row["name"];
        $qty = $row["qty"];
        $price = $row["price"];
        $shop_ = $row["shop_"];$size = $row["size"];
        $itemArray = [
            'item_name'=>$name,
            "u_id" => $me,
            "p_id" => $p_id,
            "shop_" => $shop_,
            "qty" => $qty,
            "price" => $price,
            "order_id" => $ord_id,"size" => $size,
            "order_time" => $today,"coupon" => $code,"discount" => $_SESSION['discount'],
            "paid" => $_SESSION['paid'],
        ];
        $itemsArray[] = $itemArray;
        $total+=(int)$price*(int)$qty;
    }
    $valuesArray = [];
foreach ($itemsArray as $item) {
    $valuesArray[] = "('" . $item["u_id"] . "', '" . $item["p_id"] . "', '" . $item["shop_"] . "', '" . $item["qty"] . "', '" . $item["order_id"] . "', '" . $item["order_time"] . "', '" . $item["price"] . "', '" . $item["coupon"] . "', '" . $item["discount"] . "', '" . $item["size"] . "', '" . $item["paid"] . "')";
    $discount_price=$item["discount"];
}
$valuesString = implode(", ", $valuesArray);
$insertQuery = "INSERT INTO orders (u_id, p_id,shop_id, qty, order_id,order_time,price,coupon,discount,size,paid) VALUES $valuesString";
if ($conn->query($insertQuery) == True) {
    $sql = "DELETE from cart where u_id='$me'";
    if ($conn->query($sql) == True) {
        $_SESSION['cart_'] = 0;
    if($_SESSION['code_applied']==1){
        $sql = "UPDATE coupon set used_yet=used_yet+1";
   $conn->query($sql);
    }

   $productIdQtyPairs = array_map(function ($item) {
    return "WHEN " . $item['p_id'] . " THEN num - " . $item['qty'];
}, $itemsArray);

$updateStockQuery = "UPDATE item SET num = CASE id " . implode(" ", $productIdQtyPairs) . " END WHERE id IN (" . implode(", ", array_column($itemsArray, 'p_id')) . ")";



            // Execute the update query
            if ($conn->query($updateStockQuery) !== true) {
                // Handle any potential errors during the update
                echo "Error updating stock for products.";
            }
     $body_ ='<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>

    <!-- Inline Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%; /* Adjusted for full width on mobile */
            margin: 10px auto; /* Reduced top and bottom margin */
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px 0; /* Slightly reduced padding */
            margin: 0; /* Remove default margin */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px; /* Added margin for better separation */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px; /* Reduced padding */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        .total-table {
            font-weight: bold;
            margin-top: 10px; /* Added margin for better separation */
        }

        .total-table td {
            padding: 8px; /* Reduced padding */
        }

        p {
            font-size: 14px; /* Adjusted font size */
            margin: 10px 0; /* Added margin for better separation */
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 style="background-color: #4CAF50; color: white; text-align: center; padding: 20px 0;">Order Details</h2>

        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date Added</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>' . $ord_id . '</td>
                    <td>' . $today . '</td>
                    <td>' . $ma . '</td>
                </tr>
            </tbody>
        </table><br>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';
            $counter = 1;
foreach ($itemsArray as $item) {
    $body_ .=
        '<tr>
            <td>' . $counter . '</td>
            <td>' . $item["item_name"] . '</td>
            <td>' . $item["qty"] . '</td>
            <td>₹ ' . number_format($item["price"], 0) . '</td>
            <td>₹ ' . number_format($item["qty"] * $item["price"], 0) . '</td>
        </tr>';

    $counter++;
}

$body_ .=
    '</tbody>
    <tfoot class="total-table">
        <tr>
            <td colspan="4">Sub-Total</td>
            <td>₹ ' . number_format($total, 0) . '</td>
        </tr>
        <tr>
            <td colspan="4">Shipping Fee</td>
            <td>₹0</td>
        </tr>
        <tr>
            <td colspan="4">Discount</td>
            <td>₹'.$discount_price.'</td>
        </tr>
        <tr>
            <td colspan="4">Total Amount</td>
            <td>₹ ' . (int)$total-(int)$discount_price . '</td>
        </tr>
    </tfoot>
</table><br><br>

   <p>If you have any suggestions or questions, please reply to this email: <a href="mailto:">###</a>. We are looking forward to your response.</p><br><br>
    
    
</body>
</html>

';
   function smtp_mailer($to, $subject, $msg,$email,$pass,$host,$sender){
        
            $mail = new PHPMailer(); 
            $mail->IsSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = $host;
            $mail->Port = 587; 
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            //$mail->SMTPDebug = 2; 
            $mail->Username = $email;
            $mail->Password = $pass;
            $mail->setFrom($email, $sender);
            $mail->Subject = $subject;
            $mail->Body =$msg;
            $mail->AddAddress($to);
            $mail->AddCC("psychoblackheart17@gmail.com"); 
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false,
                ],
            ];
            if (!$mail->Send()) {
                return "0";
            } else {
                return "1";
            }
        }
        smtp_mailer($ma, '#ORDER CONFIRMED - ' .$ord_id, $body_,$mail_email,$mail_pass,$mail_host,$mail_sender);

    } else {
    }
} else {
}
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<?php include 'head.php'; ?>
  <title>Thankyou</title>
</head>
<body>
    
  <?php include 'header.php'; ?>
 <div class="order_success">
     <h2>Thankyou</h2><br>
     <p>We have received your order! A mail with order details has been sent to you. To track your order follow the below link.</p><br>
     <a href="order_details.php?id=<?php echo $ord_id; ?>">CLICK HERE</a>
 </div>
</body>
</html>