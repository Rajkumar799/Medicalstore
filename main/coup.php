<?php require "../config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Coupons</title>
</head>
<body>
    <?php require "inc/nav.php"; ?>
    <div class="flex_">
        <?php require "inc/sidebar.php"; ?>
        <div class="right">
            <div class="padding">
                <h3 class="page-title">Manage Coupons</h3>
                <br>
                <form class="coup flex_" method="post" action="create_coupon.php">
                    <input type="text" name="code" class="form-control" placeholder="Code" required>
                    <input type="number" name="discount" class="form-control" placeholder="Discount" required>
                    <select name="type_" class="form-control" required>
                        <option value="PERCENT">PERCENT</option>
                        <option value="AMOUNT">AMOUNT</option>
                    </select>
                    <input type="number" name="maxUse" class="form-control" placeholder="Max Use" required>
                    <input type="text" name="description" class="form-control" placeholder="Description" required>
                    <select class="form-control" name="cond" required>
                        <option value="3">-- CONDITION --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <input type="number" name="maxCart" class="form-control" placeholder="Max Cart Value" required>
                    <button type="submit" class="btn btn-success">Create Coupon</button>
                </form>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">
                <!-- Table to display data -->
                <table class="table table-striped padding" id="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Type</th>
                            <th>Max Use</th>
                            <th>Used Yet</th>
                            <th>Expired</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Condition</th>
                            <th>Cart Value</th>
                            <th>Expire</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM coupon";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $code = $row['code'];
                                $discount = $row['discount'];
                                $type = $row['type'];
                                $maxUse = $row['max_use'];
                                $usedYet = $row['used_yet'];
                                $expired = $row['expired'];
                                $date = $row['date'];
                                $description = $row['des'];
                                $condition = $row['cond'];
                                $maxCart = $row['max_cart'];

                                echo "
                                    <tr>
                                        <td>{$id}</td>
                                        <td>{$code}</td>
                                        <td>{$discount}</td>
                                        <td>{$type}</td>
                                        <td>{$maxUse}</td>
                                        <td>{$usedYet}</td>
                                        <td>{$expired}</td>
                                        <td>{$date}</td>
                                        <td>{$description}</td>
                                        <td>{$condition}</td>
                                        <td>{$maxCart}</td>
                                        <td><button class='btn btn-warning expire_coupon' title='{$id}'>Expire</button></td>
                                        <td><button class='btn btn-danger delete_coupon' title='{$id}'>Delete</button></td>
                                    </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='13'>0 results</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <script>
                function myFunction() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("tab");
                    tr = table.getElementsByTagName("tr");

                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1];
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

                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.delete_coupon').forEach(function(button) {
                        button.addEventListener('click', function() {
                            var couponId = this.getAttribute('title');
                            if (confirm('Are you sure you want to delete this coupon?')) {
                                deleteCoupon(couponId);
                            }
                        });
                    });

                    document.querySelectorAll('.expire_coupon').forEach(function(button) {
                        button.addEventListener('click', function() {
                            var couponId = this.getAttribute('title');
                            if (confirm('Are you sure you want to expire this coupon?')) {
                                expireCoupon(couponId);
                            }
                        });
                    });
                });

                function deleteCoupon(couponId) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "delete_coupon.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            alert('Coupon deleted successfully!');
                            location.reload();
                        }
                    };
                    xhr.send("id=" + couponId);
                }

                function expireCoupon(couponId) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "expire_coupon.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            alert('Coupon expired successfully!');
                            location.reload();
                        }
                    };
                    xhr.send("id=" + couponId);
                }
                </script>
            </div>
        </div>
    </div>
</body>
</html>
