<!DOCTYPE html>
<html>
   <head>
      <?php
         include 'head.php';
         include "config.php";
         ?>
         <style>
            @media(max-width:600px) {
.product_page_right>.product{
width: 50%;margin: 0;border-radius: 0;
}
.product_page_right{
justify-content: center;flex-direction: row;
}
.product_page_right .product_img{
height: auto;
}.product_page_right .product_name{
font-size: 14px;
/*white-space: nowrap;*/
overflow: hidden;
text-overflow: ellipsis;font-weight: normal;
padding:0 7px;
}.product_page_right .discount{
top:10px;
left: 10px;font-size: 12px;
}.product_page_right .btn-outline-heart{
top:10px;
right: 10px;height: 30px;
width: 30px;
}.product_page_right .btn-outline-heart img{height: 15px;width: 15px;}.product_page_right .add_cart{

}.product_page_right .padding{
padding: 7px;
}.product_page_right .product_des .margin-bottom-20{
margin-bottom: 5px;margin-top: 0;
}.product_page_right .product_rev{
display: none;
}.product_page_right .add_cart i{
line-height: 0;color: var(--p);
}
}
         </style>
      <title>Products</title>
   </head>
   <body>
      <?php 
         require_once("header.php");
         if(!isset($_GET['cat'])){
         
         $_SESSION['_cat']=''; 
         
         
         }
         else{
         $_SESSION['_cat']=" and cat=".$_GET['cat'];
         }
         if(!isset($_GET['subcat'])){
         
         $_SESSION['_subcat']=''; 
         
         
         }
         else{
         $_SESSION['_subcat']=" and subcat=".$_GET['subcat'];
         }
         if(!isset($_GET['max'])){
         $_SESSION['max']=1000000;
         }else{
         $_SESSION['max']=$_GET['max'];
         }
         if(!isset($_GET['min'])){
         $_SESSION['min']=0;
         }else{
         $_SESSION['min']=$_GET['min'];
         }
         
         ?>
      <section class="flex_ product_page">
         <div class="product_page_left">
            <div class="products_left">
               <div class="filter-product">
                  <p class="filter-price-text">Price Filter</p>
                  <div class="flex_ align-items justify-content price-range_">
                     <p>0</p>
                     <p>1000000</p>
                  </div>
                  <div class="price-range-slider">
                     <input type="range" min="0" max="100" value="0" id="minPrice">
                     <input type="range" min="0" max="100" value="<?php echo (int)$_SESSION['max'];?>" id="maxPrice">
                     <div class="range-pro"></div>
                  </div>
                  <form class="flex_ align-items justify-content margin-top-20" method="get" action="shop_prod.php">
                     <div class="flex_ align-items no-css">
                        <p>$</p>
                        <p class="f_l_11"><?php echo $_SESSION['min'];?></p>
                        <input type="number" name="min" class="f_l_1" value="<?php echo $_SESSION['min'];?>" hidden>
                        <p>-</p>
                        <p>$</p>
                        <p class="f_l_12"><?php echo $_SESSION['max'];?></p>
                        <input type="number" name="max" class="f_l_2" value="<?php echo $_SESSION['max'];?>" hidden>
                     </div>
                     <button type="submit" class="filter-btn">Filter</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="space"></div>
         <div class="product_page_right">
            <?php
               $_SESSION['fetch_id']=0;
if(isset($_GET['id'])){
    $s__=$_GET['id'];
    $_SESSION['shop_prod_id']=$s__;
}else{
    $s__=$_SESSION['shop_prod_id'];
}
               
                $_SESSION['p_sql']=
               $sql = "SELECT * from item where id>".$_SESSION['fetch_id']." and disable='0'  and (price<=".$_SESSION['max']." and price>=".$_SESSION['min'].")".$_SESSION['_cat']."{$_SESSION['_subcat']} and shop_id='$s__'";
               $result = $conn->query($sql);
               
               if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
               $id_=$row['id'];
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
               <div>';
               if ($row['stock'] == 0  or $row['num'] == 0) {
            echo '<button class="btn-outline margin-top-10 p_no_stock" style="color:var(--red);border:1px solid var(--red);">OUT OF STOCK</button>';
        }else{
         echo '<button class="btn-outline margin-top-10 add_cart" data-pid='.$id_.'>Add to Cart</button>';
        }
               
               
               
               echo '</div>
               <p class="product_price">';

               if ($dis > 0) {
            echo '<span class="pr_dis">$' . $max_price . '</span>';
        }echo '$'.$price.'</p>
               </div>
               </div>
               </div>';
               $_SESSION['fetch_id']=$row['id'];
               
               
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
      <script type="text/javascript">
         $(document).ready(function() {
         const minSlider = $('#minPrice');
         const maxSlider = $('#maxPrice');
         const displayMin = $('.f_l_1');
         const displayMax = $('.f_l_2');
         const displayMinText = $('.f_l_11');
         const displayMaxText = $('.f_l_12');
         const rangeProgress = $('.range-pro');
         
         function updateRange() {
         const minValue = parseInt(minSlider.val()) * 10000;
         const maxValue = parseInt(maxSlider.val()) * 10000;
         const minPercentage = minSlider.val() + '%';
         const maxPercentage = (maxSlider.val() - minSlider.val()) + '%';
         
         rangeProgress.css({
         "left": minPercentage,
         "width": maxPercentage
         });
         
         displayMin.val(minValue);
         displayMinText.text(minValue);
         displayMax.val(maxValue);
         displayMaxText.text(maxValue);
         }
         
         minSlider.on('input', updateRange);
         maxSlider.on('input', updateRange);
         updateRange();
         var a = $(".product_page_right>.product").width();
 var windowWidth = window.innerWidth;

    // Log the window width to the console
    console.log("Window width: " + windowWidth + " pixels");
    if(windowWidth<=600){
        $(".product_img").css({'height':parseInt(a)+20+'px'});
        $(".product_img>img").css({'height':parseInt(a)+20+'px','width':a+'px'});
        $(".product_name").each(function() {
            // Check if text length exceeds 20 characters
            if ($(this).text().length > 40) {
                // Trim the text to 20 characters and add ellipsis
                var trimmedText = $(this).text().substring(0, 40) + "...";
                // Set the updated text
                $(this).text(trimmedText);
            }
        });
       // $(".product_page_right .add_cart").html('<i class="fas fa-cart-arrow-down"></i>');
     }
         });
         
      </script>
   </body>
</html>