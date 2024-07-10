<!DOCTYPE html>
<html>
   <head>
      <?php

         include 'head.php';
         include "config.php";
         ?>
        
      <title>Recent Searches</title>
   </head>
   <body>
      <?php 
         require_once("header.php");
         
         
         ?>
         <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="">
              <h1 class="page-title">Recent Searches<span>Shop Now</span></h1>
            </div><!-- End .container -->
          </div>
          
          
      <section class="flex_ product_page">
         
         <div class="product_page_right justify-content-center">
            <?php
               $sql="SELECT item.id as id,item.name as name,item.price as price,item.img1 as img1,item.star as star,item.reviews as reviews,item.discount as discount,item.max_price as max_price,item.stock as stock,item.num as num,history.id as _id_ from item,history where history.u_id='$me' and history.p_id=item.id order by history.id desc";
               
               $result = $conn->query($sql);
               
               if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
               $id_=$row['id'];$_id_=$row['_id_'];
               $name=$row['name'];
               $price=$row['price'];
               $img1=$row['img1'];
               $star=$row['star'];
               $review=$row['reviews'];
               $dis=$row['discount'];$max_price=$row['max_price'];
               echo '<div class="product">
               <a href="single-product.php?id='.$id_.'"> <div class="product_img">
               <img src="prod/'.$img1.'" class="transform">';
                if ($dis > 0) {
            echo '<p class="discount">' . $dis . '% OFF</p>';
        }
               echo '<button class="btn-outline-heart">
               <img src="assets/images/heart.svg" title="Add to Wishlist">
               </button>
               </div></a>
               <div class="product_des">
               <p class="product_name">'.$name.'</p>
               <div class="flex_ padding st__">
               <p class="product_stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p>
               &nbsp;&nbsp;
               <p class="product_rev">('.$review.' Reviews)</p>
               </div>
               <div class="flex_ padding margin-bottom-20 margin-top-10 justify-align cart_and_price">
               <div class="flex_">';
               if ($row['stock'] == 0  or $row['num'] == 0) {
            echo '<button class="btn-outline margin-top-10 p_no_stock" style="color:var(--red);border:1px solid var(--red);">OUT OF STOCK</button>';
        }else{
         echo '<button class="btn-outline margin-top-10 add_cart" data-pid='.$id_.'>Add to Cart</button>';
        }
               
               
               
               echo '<button class="btn-outline margin-top-10 remove_history flex_ align-items justify-content-center" title="'.$_id_.'"><i class="fas fa-trash-alt red"></i></button></div>
               <p class="product_price">';

               if ($dis > 0) {
            echo '<span class="pr_dis">$' . $max_price . '</span>';
        }echo '$'.$price.'</p>
               </div>
               </div>
               </div>';
               
               
               
               }
               }
               else{
               echo "<img src='assets/images/no.svg' style='width:200px;margin:auto;padding:100px 0'>";
               }
               
               ?>
         </div>
      </section>
      
      <br>
      <?php
         include 'footer.php';
         ?>
   
   </body>
</html>