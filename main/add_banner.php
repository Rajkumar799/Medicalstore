<?php
require "../config.php";

// Handle deletion if the delete request is made
if(isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM banner WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        $delete_message = "Banner deleted successfully.";
    } else {
        $delete_message = "Failed to delete banner.";
    }
    $stmt->close();
}

// Get shop ID if set
if(isset($_GET['shop_id'])){
    $i_=$_GET['shop_id'];
}else{
    //
}
?>
<!DOCTYPE html>
<html>
   <head>
      <?php require "inc/head.php";?>
      <title>Products</title>
      <!-- Include jQuery for AJAX functionality -->
      <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
   </head>
   <body>
      <?php require "inc/nav.php";?>
      <div class="flex_">
         <?php require "inc/sidebar.php";?>
         <div class="right">
          <div class="padding">
              <h3 class="page-title">Category</h3>
            <form action="submit2.php" method="post" enctype="multipart/form-data" class="form-group" style="display: flex;">
                <input type="text" id="text3" name="text3" required class="form-control" placeholder="Heading">
                <input type="text" id="text4" name="text4" required class="form-control" placeholder="Paragraph">
                <input type="text" id="text5" name="text5" required class="form-control" placeholder="Link">
                <input type="file" id="image1" name="image1" accept="image/*" required class="form-control">
                <input type="file" id="image2" name="image2" accept="image/*" required class="form-control">
                <input type="submit" value="Submit" class="btn btn-success">
            </form>
            <br>
            <!-- Display delete message -->
            <?php if(isset($delete_message)): ?>
                <div class="alert alert-info"><?php echo $delete_message; ?></div>
            <?php endif; ?>
            <!-- Input field for search -->
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="form-control">
            <!-- Table to display data -->
            <table class="table table-striped padding" id="tab">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Link</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve data from the database
                    $sql="SELECT * FROM banner";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $link = $row['link'];
                            echo "
                                <tr>
                                    <td>" . $id . "</td>
                                    <td>" . $link . "</td>
                                    <td><button class='btn btn-danger delete_banner' data-id='".$id."'>Delete</button></td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='3'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $(".delete_banner").click(function() {
                        var id = $(this).data("id");
                        if (confirm("Are you sure you want to delete this banner?")) {
                            $.ajax({
                                url: '',
                                type: 'POST',
                                data: { delete_id: id },
                                success: function(response) {
                                    location.reload(); // Reload the page
                                }
                            });
                        }
                    });
                });

                function myFunction() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("tab");
                    tr = table.getElementsByTagName("tr");

                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1]; // Get the second column (Link)
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
