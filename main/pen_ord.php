<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Pending Orders</title>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tab");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Get the second column (Order ID)
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var buttons = document.querySelectorAll('.update_tracking');
            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var orderId = this.getAttribute('data-orderid');
                    var trackingIdInput = this.parentElement.previousElementSibling.querySelector('.my_tracking_id');
                    var trackingId = trackingIdInput.value.trim();

                    // Perform AJAX request to update tracking ID
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'update_tracking.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            // Optionally handle success response
                            alert('Tracking ID updated successfully for Order ID: ' + orderId);
                        } else {
                            // Handle error or other response
                            alert('Error updating tracking ID for Order ID: ' + orderId);
                        }
                    };
                    xhr.send('order_id=' + encodeURIComponent(orderId) + '&tracking_id=' + encodeURIComponent(trackingId));
                });
            });
        });
    </script>
</head>
<body>
    <?php require "inc/nav.php"; ?>
    <div class="flex_">
        <?php require "inc/sidebar.php"; ?>
        <div class="right">
            <div class="padding">
                <h3 class="page-title">Pending Orders</h3><br>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">

                <!-- Table to display data -->
                <table class="table table-striped padding" id="tab">
                    <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Coupon Code</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Tracking ID</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $shop_id = $_SESSION['shop_id'];
                        $sql = "SELECT DISTINCT(order_id) AS ord_, order_time, t_id, coupon, discount, paid FROM orders WHERE status='ordered' OR status='picked'";
                        $result = $conn->query($sql);
                        $sl = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $ord_ = $row['ord_'];
                                $order_time = $row['order_time'];
                                $t_id_ = $row['t_id'];
                                $coupon = $row['coupon'];
                                $discount = (int)$row['discount'];
                                $paid = $row['paid'];

                                echo "
                                    <tr>
                                        <td>" . $sl . "</td>
                                        <td><a href='order_details.php?type=ordered&id=" . $ord_ . "'>" . $ord_ . "</a></td>
                                        <td>" . $order_time . "</td>
                                        <td>" . $coupon . "</td>
                                        <td>" . $discount . "</td>
                                        <td>" . $paid . "</td>
                                        <td><input type='text' class='form-control my_tracking_id' placeholder='Tracking ID' value='" . $t_id_ . "'></td>
                                        <td><button class='btn btn-success update_tracking' data-orderid='" . $ord_ . "'>Update</button></td>
                                    </tr>
                                ";
                                $sl++;
                            }
                        } else {
                            echo "<tr><td colspan='8'>0 results</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
