<!DOCTYPE html>
<html>
   <head>
      <?php 
         require_once("head.php");
         include "config.php";
           ?>
      <script src="assets/js/c.js"></script>
      <title>Cart</title>
   </head>
   <body>
      <?php 
         require_once("header.php");
           ?>
    <br>
   <h2 class="sub-head margin-top-20" data-item="Go Ahead">Shopping Cart</h2>
           <div class="main-section sec-mob">

<div class="margin-top-20">
   <div class="flex_ cart_items_ align-items margin-top-20">
      <div class="cart_des first_des"><h4>Description</h4></div>
      <div class="cart_qty"><h4>Quantity</h4></div>
      <div class="cart_update"><h4>Update</h4></div>
      <div class="cart_remove"><h4>Remove</h4></div>
      <div class="cart_price"><h4>Price</h4></div>
   </div> </div>
<?php
            $total=0;
                     $sql = "SELECT cart.id as id,cart.u_id as user,cart.p_id as prod,cart.qty as qty,item.name as name,item.price as price,item.num as item_qty,item.stock as stock,item.img1 as img from item,cart where cart.u_id='$me' and cart.p_id=item.id";
                    
                     $result = $conn->query($sql);
                       $status=0;
                     if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        $id=$row['id'];
                       $p_id=$row['prod'];
                       $name=$row['name'];$img=$row['img'];
                       $qty=$row['qty']; $item_qty=$row['item_qty'];$stock=$row['stock'];
                       $price=$row['price']*$qty;
                     
                       if($qty>$item_qty or $stock=='0'){$status=1;
                        echo '
<div class="flex_ cart_items_ align-items margin-top-20">
   <div class="cart_des flex_ align-items">
      <img src="prod/'.$img.'">&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="single-product.php?id='.$p_id.'" style="color:var(--red);">'.$name.'</a>
   </div>
   <div class="cart_qty first_des">
      <div class="flex_ div_outline align-items justify-content" style="width:150px">
         <div class="flex_ justify-content-center cart_qty_dec pointer">
            <i class="fas fa-minus"></i>
         </div>
         <div class="flex_ justify-content-center qty_main_div">
            <div class="cart_qty_increased">'.$qty.'</div>
         </div>
         <div class="flex_ justify-content-center cart_qty_inc pointer">
            <i class="fas fa-plus"></i>
         </div>
      </div>
   </div>
   <div class="cart_update" title='.$p_id.'><i class="fas fa-sync-alt"></i></div>
   <div class="cart_remove remove_item_cart" title='.$p_id.'><i class="fas fa-trash-alt red"></i></div>
   <div class="cart_price">
      <h4>$'.$price.'</h4>
   </div>
</div>
                        ';
                     }else{
                        echo '
                     
<div class="flex_ cart_items_ align-items margin-top-20">
   <div class="cart_des flex_ align-items">
      <img src="prod/'.$img.'">&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="single-product.php?id='.$p_id.'">'.$name.'</a>
   </div>
   <div class="cart_qty first_des">
      <div class="flex_ div_outline align-items justify-content" style="width:150px">
         <div class="flex_ justify-content-center cart_qty_dec pointer">
            <i class="fas fa-minus"></i>
         </div>
         <div class="flex_ justify-content-center qty_main_div">
            <div class="cart_qty_increased">'.$qty.'</div>
         </div>
         <div class="flex_ justify-content-center cart_qty_inc pointer">
            <i class="fas fa-plus"></i>
         </div>
      </div>
   </div>
   <div class="cart_update" title='.$p_id.'><i class="fas fa-sync-alt"></i></div>
   <div class="cart_remove remove_item_cart" title='.$p_id.'><i class="fas fa-trash-alt red"></i></div>
   <div class="cart_price">
      <h4>$'.$price.'</h4>
   </div>
</div>
                        ';}
                        $total+=$price;
                      }
                     }
                     $conn->close();
                     
                     ?>





</div>
<div class="container">
   <?php 
if($status==1){
   echo '<p class="margin-top-20" style="color:var(--red);">ACTION NEEDED! SELECTED QTY > AVAILABLE QTY!</p>';
}
   ?>
   
</div>
<div class="buttons_checkout">
   <span class="cart_total">Total : $<?php echo $total;?></span><div class="space"></div>
   <a href="checkout.php"><button class="flex_ align-items"><i class="fas fa-shopping-cart" style="color:#fff"></i>&nbsp;&nbsp;&nbsp;Checkout</button></a>
</div><br>
<?php
require_once 'footer.php';
?>
   </body>
</html>