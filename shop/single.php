<!DOCTYPE html>
<html>
   <head>
      <?php require "inc/head.php";?>
      <title>Product Details</title>
      <style type="text/css">
          .flex_ button{
            height: 35px!important;
          }
      </style>
   </head>
   <body>
      
      <?php require "inc/nav.php";?>
      <div class="flex_">
         
         <?php require "inc/sidebar.php";?>
         <div class="right">
          <div class="padding">
            <h3 class="page-title">Update Product</h3>
                  <br>
          
            <?php
                  $shop_id=$_SESSION['shop_id'];$p_id=$_GET['id']; $_SESSION['my_']=$p_id;
                     $sql = "SELECT * FROM item WHERE shop_id='$shop_id' and id='$p_id'";
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                            $name= $row['name'];
                            $i__=$row['id'];
                            $dis= $row['des_short'];
                            $price= $row['max_price'];
                            $discount= $row['discount']; $specs= $row['specs'];
                            $img1= $row['img1'];
                            $img2= $row['img2'];
                            $img3= $row['img3'];
                            $img4= $row['img4'];
                            $size= $row['size'];   $num= $row['num'];

                            
                         }
                     } else {
                         header('Location:../404.php');
                     }
                     ?>
                     <div>

<div class="flex_ "><form class="flex_" id="image1" enctype="multipart/form-data">
    <span>Image1</span> : &nbsp;&nbsp;
    <input type="file" class="form-control" name="file1" placeholder="Image1" accept="image/*">
    <input type="text" name="p_i" value="<?php echo $img1; ?>" hidden>
    <input type="text" name="id" value="<?php echo $i__; ?>" hidden>
    <input type="text" name="action" value="file1" hidden>
    <button class="btn btn-danger submit-btn" type="button" data-form="image1">Change</button>
</form>&nbsp;&nbsp;&nbsp;&nbsp;
<form class="flex_" id="image2" enctype="multipart/form-data">
    <span>Image2</span> : &nbsp;&nbsp;
    <input type="file" class="form-control" name="file2" placeholder="Image2" accept="image/*">
    <input type="text" name="p_i" value="<?php echo $img2; ?>" hidden>
    <input type="text" name="id" value="<?php echo $i__; ?>" hidden>
    <input type="text" name="action" value="file2" hidden>
    <button class="btn btn-danger submit-btn" type="button" data-form="image2">Change</button>
</form></div><br>
<div class="flex_ ">
<form class="flex_" id="image3" enctype="multipart/form-data">
    <span>Image3</span> : &nbsp;&nbsp;
    <input type="file" class="form-control" name="file3" placeholder="Image3" accept="image/*">
    <input type="text" name="p_i" value="<?php echo $img3; ?>" hidden>
    <input type="text" name="id" value="<?php echo $i__; ?>" hidden>
    <input type="text" name="action" value="file3" hidden>
    <button class="btn btn-danger submit-btn" type="button" data-form="image3">Change</button>
</form>&nbsp;&nbsp;&nbsp;&nbsp;
<form class="flex_" id="image4" enctype="multipart/form-data">
    <span>Image4</span> : &nbsp;&nbsp;
    <input type="file" class="form-control" name="file4" placeholder="Image4" accept="image/*">
    <input type="text" name="p_i" value="<?php echo $img4; ?>" hidden>
    <input type="text" name="id" value="<?php echo $i__; ?>" hidden>
    <input type="text" name="action" value="file4" hidden>
    <button class="btn btn-danger submit-btn" type="button" data-form="image4">Change</button>
</form>
</div>
<div id="message"></div>
<script type="text/javascript">
   $(document).ready(function() {
    $('.submit-btn').click(function() {
        var formId = $(this).data('form');
        var formData = new FormData($('#' + formId)[0]);

        $.ajax({
            url: 'change.php', // Replace with your server-side upload endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#message').html('<div class="alert alert-success">'+response+'</div>');
                console.log('Image uploaded successfully:', response);
            },
            error: function(xhr, status, error) {
                $('#message').html('<div class="alert alert-danger">Error uploading image</div>');
                console.error('Error uploading image:', error);
            }
        });
    });
});

</script>

                     </div>
                     <br>
            <form  class="update_product">
               <div>
                  
                  <div class="mb-3">
                     <label for="productName" class="form-label">Name</label>
                     <input required type="text" class="form-control name" id="productName" name="productName" placeholder="Name" value="<?php echo $name;?>">
                  </div>
                  <div class="flex_">
                    <div class="mb-3">
                     <label for="productName" class="form-label">In Stock</label>
                     <input type="text" class="form-control num" id="num" name="num" placeholder="Available Quantity" value="<?php echo $num;?>">
                  </div>
                  <div class="space"></div>
                      <div class="mb-3">
                     <label for="productName" class="form-label">Available Sizes (Optional)</label>
                     <input type="text" class="form-control size" id="size" name="size" placeholder="Example:- XL,ML,VX,WWE" value="<?php echo $size;?>">
                  </div>
                  </div>
                  

                  <div class="mb-3">
                     <label for="des" class="form-label">Product Description</label>
                     <textarea class="form-control des" name="description" placeholder="Description" required style="height: 300px" id="description"><?php echo $dis;?></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="des" class="form-label">Product Specifications</label>
                     <textarea class="form-control specs" name="specs" placeholder="Example :- Country:India,Company:Apple,Spec:Description" required style="height: 150px" id="specs"><?php echo $specs;?></textarea>
                  </div>
                  <div class="flex_">
                  <div class="mb-3">
                     <label for="productPrice" class="form-label">Price Including Discount</label>
                     <input required type="number" class="form-control max" id="productPrice" name="productPrice" placeholder="Price" value="<?php echo $price;?>">
                  </div><div class="space"></div>
                  <div class="mb-3">
                     <label for="productDiscount" class="form-label">Discount in %</label>
                     <input required type="number" class="form-control dis" id="productDiscount" name="productDiscount" placeholder="Discount" value="<?php echo $discount;?>">
                  </div>
              </div>
                  <button class="btn btn-primary" type="submit">Update</button>
                  <p class='btn btn-danger disable_product' title='<?php echo $p_id;?>'>Disable</p>
               </div>
            </form>
            </div>
         </div>
      </div>
      </div>
       <script>
    document.getElementById('description').addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
       // Prevents the default behavior of Enter key (new line)
        var textarea = e.target;
        var cursorPosition = textarea.selectionStart; // Get the cursor position
        var textBeforeCursor = textarea.value.substring(0, cursorPosition); // Text before the cursor
        var textAfterCursor = textarea.value.substring(cursorPosition); // Text after the cursor
        textarea.value = textBeforeCursor + '<br/>' + textAfterCursor; // Insert line break
        //textarea.setSelectionRange(cursorPosition + 5, cursorPosition + 5); // Move cursor after the inserted line break
      }
    });
  </script>
   </body>
</html>