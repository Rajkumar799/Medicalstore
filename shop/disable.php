<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Disabled Products</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Enable Product
        $(".enable_product").click(function() {
            var button = $(this);
            var id = button.attr("title");
            $.post("enable_product.php", { id: id }, function(res) {
                if (res == 1) {
                    alert("Product Enabled");
                    button.closest("tr").remove(); // Remove the row from the table
                } else {
                    alert("Failed to enable product");
                }
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
                        $shop_id = $_SESSION['shop_id'];
                        $sql = "SELECT * FROM `item` WHERE shop_id='$shop_id' and disable='1'";
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
                                        <td><button class='btn btn-success enable_product' title='" . $id . "'>Enable</button></td>
                                    </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='6'>0 results</td></tr>";
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
                </script>
            </div>
        </div>
    </div>
</body>
</html>
