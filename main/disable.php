<?php require "../config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Disabled Products</title>
</head>
<body>
    <?php require "inc/nav.php"; ?>
    <div class="flex_">
        <?php require "inc/sidebar.php"; ?>
        <div class="right">
            <div class="padding">
                <h3 class="page-title">Disabled Products</h3>
                <br>
                <!-- Input field for search -->
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">
                <!-- Table to display data -->
                <table class="table table-striped padding" id="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Food Name</th>
                            <th>Price</th>
                            <th>Reviews</th>
                            <th>Ratings</th>
                            <th>Enable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve data from the database
                        $sql = "SELECT * FROM `item` WHERE disable='1'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $price = $row['price'];
                                $reviews = htmlentities($row['reviews']);
                                $star = $row['star'];

                                echo "
                                    <tr>
                                        <td>" . $id . "</td>
                                        <td><a href='single.php?id={$id}'>" . $name . "</a></td>
                                        <td>" . $price . "</td>
                                        <td>" . $reviews . "</td>
                                        <td>" . $star . "</td>
                                        <td><button class='btn btn-success enable_product' data-id='".$id."'>Enable</button></td>
                                    </tr>
                                ";
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

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tab");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Get the second column (Food Name)
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

        // AJAX to enable product
        document.addEventListener('DOMContentLoaded', function() {
            var enableButtons = document.querySelectorAll('.enable_product');
            enableButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var productId = this.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Handle successful response
                                alert(xhr.responseText); // Replace with appropriate action
                                // Optionally, refresh or update the table
                                // Example: location.reload();
                            } else {
                                // Handle error
                                alert('Error: ' + xhr.status);
                            }
                        }
                    };
                    xhr.open('POST', 'enable_product.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('id=' + productId);
                });
            });
        });
    </script>
</body>
</html>
