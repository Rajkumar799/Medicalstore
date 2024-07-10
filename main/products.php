<?php
// Start or resume session
session_start();

// Include database connection
require "../config.php";

// Check if shop_id is set in GET parameter
if (isset($_GET['shop_id'])) {
    $shop_id = $_GET['shop_id'];
    $sql = "SELECT * FROM `item` WHERE disable='0' and shop_id='$shop_id' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM `item` WHERE disable='0' ORDER BY id DESC";
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php";?>
    <title>Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .padding {
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php require "inc/nav.php";?>
    <div class="flex_">
        <?php require "inc/sidebar.php";?>
        <div class="right">
            <div class="padding">
                <h3 class="page-title">All Products</h3>
                
                <br>
                <!-- Search input field -->
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">
                
                <!-- Table to display products -->
                <table class="table table-striped padding" id="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Available Qty</th>
                            <th>Price</th>
                            <th>Reviews</th>
                            <th>Ratings</th>
                            <th>Disable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $price = $row['price'];
                                $reviews = htmlentities($row['reviews']);
                                $star = $row['star'];
                                $num = $row['num'];

                                echo "
                                <tr>
                                    <td>" . $id . "</td>
                                    <td><a href='single.php?id={$id}'>" . $name . "</a></td>
                                    <td>" . $num . "</td>
                                    <td>" . $price . "</td>
                                    <td>" . $reviews . "</td>
                                    <td>" . $star . "</td>
                                    <td><button class='btn btn-danger disable_product' data-id='{$id}' title='Disable'>Disable</button></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>0 results</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript/jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle search functionality
            function myFunction() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("tab");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1]; // Get the second column (Item Name)
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

            // Function to handle disable product button click
            $('.disable_product').click(function() {
                var id = $(this).data('id');
                
                // Confirm before disabling
                if (confirm("Are you sure you want to disable this product?")) {
                    // AJAX request to disable_product.php
                    $.ajax({
                        url: 'disable_product.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            // Refresh the page or update UI as needed
                            alert('Product disabled successfully!');
                            location.reload(); // Reload the page to reflect changes
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error disabling product. Please try again.');
                        }
                    });
                }
            });
        });
    </script>

</body>
</html>
