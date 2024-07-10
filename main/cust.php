<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Customers</title>
</head>
<body>
    <?php require "inc/nav.php"; ?>
    <div class="flex_">
        <?php require "inc/sidebar.php"; ?>
        <div class="right">
            <div class="padding">
                <h3 class="page-title">Customers</h3>
                <br>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">
                <table class="table table-striped padding" id="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Last</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Add1</th>
                            <th>Add2</th>
                            <th>Pincode</th>
                            <th>Landmark</th>
                            <th>Ban User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM cust WHERE ban != '1'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['lname']}</td>
                                        <td>{$row['company']}</td>
                                        <td>{$row['phone']}</td>
                                        <td>{$row['state']}</td>
                                        <td>{$row['city']}</td>
                                        <td>{$row['address1']}</td>
                                        <td>{$row['address2']}</td>
                                        <td>{$row['pincode']}</td>
                                        <td>{$row['landmark']}</td>
                                        <td><button class='btn btn-danger ban_user' title='{$row['id']}'>Ban</button></td>
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
                    document.querySelectorAll('.ban_user').forEach(function(button) {
                        button.addEventListener('click', function() {
                            var userId = this.title;
                            if (confirm('Are you sure you want to ban this user?')) {
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', 'ban_user1.php', true);
                                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        alert('User has been banned successfully.');
                                        location.reload();
                                    } else {
                                        alert('An error occurred while banning the user.');
                                    }
                                };
                                xhr.send('id=' + userId);
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
