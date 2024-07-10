<?php require "../config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Products</title>
</head>
<body>
    <?php require "inc/nav.php"; ?>
    <div class="flex_">
        <?php require "inc/sidebar.php"; ?>
        <div class="right">
            <div class="padding">
                <h3 class="page-title">Banned Shops</h3>
                <br>
                <!-- Input field for search -->
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">
                <!-- Table to display data -->
                <table class="table table-striped padding" id="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Locate</th>
                            <th>Unban Shop</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM shop WHERE ban='1'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $address = $row['address'];
                                $lat = $row['lat'];
                                $lon = $row['lon'];

                                echo "
                                    <tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$email}</td>
                                        <td>{$phone}</td>
                                        <td>{$address}</td>
                                        <td>{$lat}</td>
                                        <td>{$lon}</td>
                                        <td><a href='https://maps.apple.com/?q={$lat},{$lon}' target='_blank'><button class='btn btn-success'>Map</button></a></td>
                                        <td><button class='btn btn-success unban_shop' title='{$id}'>Unban</button></td>
                                    </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='9'>0 results</td></tr>";
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
                        document.querySelectorAll('.unban_shop').forEach(function(button) {
                            button.addEventListener('click', function() {
                                var shopId = this.title;
                                if (confirm('Are you sure you want to unban this shop?')) {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'unban_shop.php', true);
                                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                    xhr.onload = function() {
                                        if (xhr.status === 200) {
                                            alert('Shop has been unbanned successfully.');
                                            location.reload();
                                        } else {
                                            alert('An error occurred while unbanning the shop.');
                                        }
                                    };
                                    xhr.send('id=' + shopId);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>
</html>
