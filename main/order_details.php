<?php
$ord_id = $_GET['id'];
$status = $_GET['type'];
?>
<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Order Details</title>
</head>
<body>
    <?php require "inc/nav.php"; ?>
    <div class="flex_">
        <?php require "inc/sidebar.php"; ?>
        <div class="right">
            <div class="padding">
                <?php
                if ($status == "delivered") {
                    echo '<h3 class="page-title">Delivered Order</h3>';
                } elseif ($status == "picked") {
                    echo '<h3 class="page-title">Picked Order</h3>';
                } else {
                    echo '<h3 class="page-title">Pending Order</h3>';
                }
                ?>
                <br>
                <table class="table table-striped padding">
                    <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Size</th>
                            <th>Shop ID</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT orders.qty AS qty, item.id AS id, orders.price AS price, item.name AS name, orders.u_id AS u_id, orders.shop_id AS s_id, orders.size AS size, paid FROM orders, item WHERE orders.p_id = item.id AND (orders.status = '$status' OR orders.status = 'picked') AND orders.order_id = '$ord_id'";
                        $result = $conn->query($sql);
                        $sl = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $name = $row['name'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $id = $row['id'];
                                $s_id = $row['s_id'];
                                $size = $row['size'];
                                $paid = $row['paid'];
                                $u_id = $row['u_id'];
                                
                                echo "
                                    <tr>
                                        <td>" . $sl . "</td>
                                        <td><a href='../single-product.php?id=" . $id . "'>" . $name . "</a></td>
                                        <td>" . $price . "</td>
                                        <td>" . $qty . "</td>
                                        <td>" . $size . "</td>
                                        <td><a href='shop.php?shop_id={$s_id}'>" . $s_id . "</a></td>
                                        <td>" . $paid . "</td>
                                    </tr>
                                ";
                                $sl++;
                            }
                        } else {
                            // No results case
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <?php echo "<button class='btn btn-success del__' title='{$ord_id}'>Delivered</button>"; ?>
                <br><br>
                <h4>Delivery Address</h4><br>
                <?php
                $sql = "SELECT * FROM cust WHERE id='$u_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <h4>" . $row['name'] . " " . $row['lname'] . "</h4>
                            <p>Address: " . $row['address1'] . " " . $row['address2'] . "</p>
                            <p>City & State: " . $row['city'] . ", " . $row['state'] . "</p>
                            <p>Pincode: " . $row['pincode'] . "</p>
                            <p>Phone: " . $row['phone'] . "</p>
                        ";
                    }
                } else {
                    // No address found case
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Example JavaScript for handling button click
        document.addEventListener('DOMContentLoaded', function () {
            var buttons = document.querySelectorAll('.del__');
            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var orderId = this.getAttribute('title');
                    // Perform AJAX request or form submission to update delivery status
                    // Example: You can use fetch API or XMLHttpRequest here
                    alert('Delivered for Order ID: ' + orderId);
                });
            });
        });
    </script>
</body>
</html>
