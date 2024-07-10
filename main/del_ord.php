<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Delivered Orders</title>
</head>
<body>
    <?php require "inc/nav.php"; ?>
    <div class="flex_">
        <?php require "inc/sidebar.php"; ?>
        <div class="right">
            <div class="padding">
                <h3 class="page-title">Delivered Orders</h3>
                <br>
                <!-- Search input -->
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetching data from database
                        $sql = "SELECT DISTINCT(order_id) AS ord_, order_time, coupon, discount, paid FROM orders WHERE status='delivered'";
                        $result = $conn->query($sql);
                        $sl = 1;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $ord_ = $row['ord_'];
                                $order_time = $row['order_time'];
                                $paid = $row['paid'];
                                $coupon = $row['coupon'];
                                $discount = (int)$row['discount'];

                                echo "
                                    <tr>
                                        <td>" . $sl . "</td>
                                        <td><a href='order_details.php?type=delivered&id=" . $ord_ . "'>" . $ord_ . "</a></td>
                                        <td>" . $order_time . "</td>
                                        <td>" . $coupon . "</td>
                                        <td>" . $discount . "</td>
                                        <td>" . $paid . "</td>
                                    </tr>
                                ";
                                $sl++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>0 results</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript function for table filtering -->
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tab");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column with Order ID
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
    </script>
</body>
</html>
