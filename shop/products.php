<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Products</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Disable Product
        $(".disable_product").click(function() {
            var row = $(this).closest("tr");
            var id = $(this).attr("title");
            $.post("disable_product.php", { id: id }, function(res) {
                if (res == 1) {
                    alert("Product Disabled");
                    row.remove(); // Remove the row from the table
                } else {
                    alert("Failed to disable product");
                }
            });
        });

        // Update Stock Status
        $(".in_, .out_").click(function() {
            var row = $(this).closest("tr");
            var id = $(this).attr("title");
            var newStatus = $(this).hasClass("in_") ? 0 : 1;
            $.post("update_stock.php", { id: id, status: newStatus }, function(res) {
                if (res == 1) {
                    alert("Stock status updated");
                    location.reload(); // Reload the page to update the status
                } else {
                    alert("Failed to update stock status");
                }
            });
        });

        // Delete Product
        $(".delete_product").click(function() {
            if (confirm("Are you sure you want to delete this product?")) {
                var row = $(this).closest("tr");
                var id = $(this).attr("title");
                $.post("delete_product.php", { id: id }, function(res) {
                    if (res == 1) {
                        alert("Product deleted");
                        row.remove(); // Remove the row from the table
                    } else {
                        alert("Failed to delete product");
                    }
                });
            }
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
                <h3 class="page-title">All Products</h3>
                <br>
                <!-- Input field for search -->
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">
                <!-- Table to display data -->
                <table class="table table-striped padding" id="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Available Stock</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Reviews</th>
                            <th>Disable</th>
                            <th>Stock</th>
                            <th>Delete</th> <!-- Add a column for the Delete button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve data from the database
                        $shop_id = $_SESSION['shop_id'];
                        $sql = "SELECT * FROM `item` WHERE shop_id='$shop_id' and disable='0' order by id desc";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $price = $row['price'];
                                $reviews = htmlentities($row['reviews']);
                                $star = $row['star'];
                                $discount = $row['discount'];
                                $max_price = $row['max_price'];
                                $sto_ = $row['stock'];
                                $num = $row['num'];
                                $stockButton = $sto_ == '0' 
                                    ? "<button class='btn btn-warning in_' title='$id'>Out Of Stock</button>" 
                                    : "<button class='btn btn-success out_' title='$id'>In Stock</button>";

                                echo "
                                    <tr title='$id'>
                                        <td class='have_max_price' title='$max_price'>$id</td>
                                        <td class='have_discount' title='$discount'><a href='single.php?id=$id'>$name</a></td>
                                        <td>$num</td>
                                        <td>$max_price</td>
                                        <td>$discount</td>
                                        <td>$reviews</td>
                                        <td><button class='btn btn-danger disable_product' title='$id'>Disable</button></td>
                                        <td>$stockButton</td>
                                        <td><button class='btn btn-danger delete_product' title='$id'>Delete</button></td> <!-- Add delete button -->
                                    </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='9'>0 results</td></tr>"; // Update colspan to 9 to match the number of columns
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
                        td = tr[i].getElementsByTagName("td")[1]; // Get the second column (Product Name)
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
            </div>
        </div>
    </div>
</body>
</html>
