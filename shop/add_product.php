<!DOCTYPE html>
<html>
   <head>
      
      <?php require "inc/head.php";?>
      <title>Add Products</title>
         
   </head>
   <body>
      
      <?php require "inc/nav.php";?>
      <div class="flex_">
         
         <?php require "inc/sidebar.php";?>
         <div class="right">
          <div class="padding">
            <div class="page-breadcrumb">
               <div class="row">
                  <div class="col-12 d-flex no-block align-items-center">
                     <h3 class="page-title">Add Products</h3>
                  </div>
               </div><br><br>
            </div>
            <form  action="back/add_product.php" method="post" enctype="multipart/form-data">
               <div>
                  
                  <div class="flex_">
                     <div>
                        <label for="image1" class="form-label">Image 1</label>
                        <input required class="form-control" type="file" id="image1" name="image1">
                     </div>
                     <div class="space"></div>
                     <div>
                        <label for="image2" class="form-label">Image 2</label>
                        <input required class="form-control" type="file" id="image2" name="image2">
                     </div>
                  </div>
                  <br>
                  <div class="flex_">
                     <div>
                        <label for="image3" class="form-label">Image 3</label>
                        <input required class="form-control" type="file" id="image3" name="image3">
                     </div>
                     <div class="space"></div>
                     <div>
                        <label for="image4" class="form-label">Image 4</label>
                        <input required class="form-control" type="file" id="image4" name="image4">
                     </div>
                  </div>
                  <br>
                  <div class="flex_">
                  <div class="mb-3">
                     <label for="productName" class="form-label">State</label>
                     <select name="state" class="form-control">
                        <option>--SELECT STATE--</option>
    <?php
   
    foreach ($_state_ as $state) {
        echo '<option value="' . $state . '">' . $state . '</option>';
    }
    ?>
</select>
                  </div>
               </div>

                  <div class="flex_">
                  <div class="mb-3">
                     <label for="productName" class="form-label">Name</label>
                     <input required type="text" class="form-control" id="productName" name="productName" placeholder="Name">
                  </div><div class="space"></div>
                  <div class="mb-3 can_append">
                     <label for="Category" class="form-label">Category</label>
                     <select name="cat_" required class="form-control" onchange="getSubcategories()" id="category">
                        <option>--SELECT CATEGORY--</option>
                        
                         <?php
                         include '../back/category.php';
       
        $shop_id = $_SESSION['shop_id'];
       
        foreach ($_cat_ as $__c) {
echo '<option value="'.$__c[0].'">'.$__c[2].'</option>';

}
   
        ?>
                     </select>
                    
                  </div><div class="space"></div>
                  <div class="mb-3 can_append">
                     <label for="Category" class="form-label">Category</label>
                     <select id="subcategory" name="subcategory" class="form-control">
                        <option>--SELECT SUB CATEGORY--</option>
                        
                         <?php
                         
   
                         ?>
                     </select>
                    
                  </div>
               </div>
               <div class="flex_">
                  <div class="mb-3">
                     <label for="productName" class="form-label">In stock</label>
                     <input type="number" class="form-control num" id="num" name="num" placeholder="Stock Number" required>
                  </div>
                  <div class="space"></div>
                  <div class="mb-3">
                     <label for="productName" class="form-label">Available Sizes (Optional)</label>
                     <input type="text" class="form-control size" id="size" name="size" placeholder="Example:- XL,ML,VX,WWE">
                  </div>
               </div>
               
                  <div class="mb-3">
                     <label for="des" class="form-label">Product Description</label>
                     <textarea class="form-control" name="description" placeholder="Description" required style="height: 300px" id="description"></textarea>
                  </div><div class="mb-3">
                     <label for="des" class="form-label">Product Specifications</label>
                     <textarea class="form-control" name="specs" placeholder="Example :- Country:India,Company:Apple,Spec:Description" required style="height: 150px" id="specs"></textarea>
                  </div>
                  <div class="flex_">
                  <div class="mb-3">
                     <label for="productPrice" class="form-label">Price Including Discount</label>
                     <input required type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Price">
                  </div>
                  <div class="space"></div>
                  <div class="mb-3">
                     <label for="productDiscount" class="form-label">Discount in %</label>
                     <input type="number" class="form-control" id="productDiscount" name="productDiscount" placeholder="Discount" value="0">
                  </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Submit</button>
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
  <script>
function getSubcategories() {
    var categoryId = document.getElementById('category').value;

    // Make an AJAX request to get subcategories based on the selected category ID
    // Replace 'your_backend_endpoint' with the actual endpoint or script handling the request
    // Adjust the dataType, method, and other parameters based on your backend implementation
    $.ajax({
        url: '../back/category.php',
        dataType: 'json',
        method: 'POST',
        data: { category_id: categoryId,action:"cat" },
        success: function(response) {
         console.log(response);
            var subcategoryDropdown = document.getElementById('subcategory');
            subcategoryDropdown.innerHTML = '<option value="">--SELECT SUB CATEGORY--</option>';

            // Populate subcategory dropdown with received data
            for (var i = 0; i < response.length; i++) {
                var option = document.createElement('option');
                option.value = i;
                option.text = response[i];
                subcategoryDropdown.appendChild(option);
            }
        },
        error: function(error) {
            console.error('Error fetching subcategories:', error);
        }
    });
}
</script>
   </body>
</html>