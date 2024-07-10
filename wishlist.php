<!DOCTYPE html>
<html>
   <head>
      <?php 
         require_once("head.php");
         include "config.php";
           ?>
      <script src="assets/js/c.js"></script>
      <title>Wishlish</title>
   </head>
   <body>
      <?php 
         require_once("header.php");
           ?>
  <br>
   <h2 class="sub-head margin-top-20" data-item="Nice choice!">Wishlist</h2>
           <div class="main-section sec-mob">

<div class="margin-top-20">
   <div class="flex_ cart_items_ align-items margin-top-20" style="width:800px;">
      <div class="cart_des first_des"><h4>Description</h4></div>
      <div class="cart_remove"><h4>Remove</h4></div>
      <div class="cart_price"><h4>Price</h4></div>
   </div> </div>
<?php
            $total=0;
                     $sql = "SELECT wishlist.id as id,wishlist.u_id as user,wishlist.p_id as prod,item.name as name,item.price as price,item.img1 as img from item,wishlist where wishlist.u_id='$me' and wishlist.p_id=item.id";
                    
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        $id=$row['id'];
                       $p_id=$row['prod'];
                       $name=$row['name'];$img=$row['img'];
                       $price=$row['price'];
                        echo '
<div class="flex_ cart_items_ align-items margin-top-20" style="width:800px;">
   <div class="cart_des flex_ align-items">
      <img src="prod/'.$img.'">&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="single-product.php?id='.$p_id.'">'.$name.'</a>
   </div>
  
   <div class="cart_remove remove_item_wish" title='.$id.'><i class="fas fa-times"></i></div>
   <div class="cart_price">
      <h4>$'.$price.'</h4>
   </div>
</div>
                        ';
                        $total+=$price;
                      }
                     }
                     $conn->close();
                     
                     ?>




</div><br>
<?php
require_once 'footer.php';
?>
   </body>
</html>