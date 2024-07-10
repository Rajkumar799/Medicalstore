<!DOCTYPE html>
<html>
   <head>
      <?php
         $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
         $host = $_SERVER['HTTP_HOST'];
         $url_ = $protocol . '://' . $host . $_SERVER['REQUEST_URI'];
         $_u_=str_replace("product.php", "list.php", $url_);
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
         text-overflow: ellipsis;font-weight: var(--normal);
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
         if(!isset($_GET['state'])){
         
         $_SESSION['state']=''; 
         
         
         }
         else{
         $_SESSION['state']=" and state='".$_GET['state']."'";
         }
         if(!isset($_GET['search'])){
         
         $_SESSION['se_']=''; 
         
         
         }
         else{
         $_SESSION['se_']=" and (name like '%".$_GET['search']."%' or des_short like '%".$_GET['search']."%')";
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
      <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
         <div class="">
            <h1 class="page-title">
               Products
               <div class="flex_ justify-content-center">
                  <?php
                     if(isset($_GET['cat']) || isset($_GET['subcat'])){
                     
                     
                     if(isset($_GET['cat']) && $_GET['cat']!=""){
                         echo "<span>".$_cat_[$_GET['cat']][2]."</span>";
                     }if(isset($_GET['subcat']) && $_GET['subcat']!=""){
                       echo "<span>&nbsp;>&nbsp;".$_cat_[$_GET['cat']][3][$_GET['subcat']]."</span>";
                     }}else{
                         echo "<span>&nbsp;>&nbspShop Now</span>";
                     }
                     
                     ?>
               </div>
            </h1>
         </div>
         <!-- End .container -->
      </div>
      <div class="container flex_ justify-content margin-top-20">
         <div class="flex_ align-items">
            <p>View : <i class="fas fa-list pointer" style="color:#777;font-size: 20px;" onclick="window.location.href='<?php echo $_u_;?>'"></i> &nbsp;&nbsp;<i class="fas fa-th pointer" style="font-size: 20px;"></i></p>
         </div>
      </div>
      <section class="flex_ product_page">
         <div class="product_page_left">
            <div class="products_left">
               
               <div class="margin-top-20 cat_p_">
                  <p class="filter-price-text">Category</p>
                  <?php
                  include "back/category.php";
                     foreach ($_cat_ as $cat) {
    echo '<div class="flex_ align-items">
            <input type="checkbox" class="cat_inp" onclick="get_cat(\'' . $cat[0] . '\')">&nbsp;&nbsp;' . $cat[2] . '
          </div>';
}
                  ?>
               </div>
             
              
               
               <div class="fil-line margin-top-20"></div>
               <div class="margin-top-20 cat_p_">
                  <p class="filter-price-text">State</p>
                  <?php
                     foreach ($_state_ as $state) {
    echo '<div class="flex_ align-items">
            <input type="checkbox" class="cat_inp" onclick="get_state(\'' . $state . '\')">&nbsp;&nbsp;' . $state . '
          </div>';
}
                  ?>
                  
                  
               </div>
               
            </div>
         </div>
         <div class="space"></div>
         <div class="product_page_right">
            
            <?php
               $_SESSION['fetch_id']=0;
               $_SESSION['p_sql']=
               $sql = "SELECT * from item where id>".$_SESSION['fetch_id']." and disable='0'  and (price<=".$_SESSION['max']." and price>=".$_SESSION['min'].")".$_SESSION['_cat']. $_SESSION['_subcat'].$_SESSION['se_'].$_SESSION['state']." limit 10";
              
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
               echo '
<div class="p_list flex_ margin-bottom-10">
                    <div class="image_and_dis">
                        <img src="prod/' . $img1 . '">';
        if ($dis > 0) {
            echo '<p class="p_dis">' . $dis . '% OFF</p>';
        }
        echo '
                        
                    </div>
                    <div class="flex_ align-items justify-content mobile-flex-direction no-align-center" style="width:100%;">
                    <div class="flex_ flex-direction p_list_p justify-content-center">
                        <p class="p_list_shop_name">' . $shop . '</p>
                        <a class="p_list_p_name margin-top-10" href="single-product.php?id=' . $id_ . '">' . $name . '</a>
                        <p class="p_list_des margin-top-10">' . $des . '</p>
                    </div>
                    <div class="p_details flex_ justify-content-center flex-direction">
                        <p class="product_price" style="transform: translateX(0);"><span class="pr_dis">$' . $max_price . '</span>$' . $price . '</p>
                        <div class="flex_ margin-top-10">
                            <p class="product_stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p>
                            &nbsp;
                            <p class="product_rev">(' . $review . ' Reviews)</p>

                        </div>
                        <div class="flex_ align-items margin-top-10">';
                        if ($row['stock'] == 0 or $row['num'] == 0) {
                        echo '<button class="btn-outline margin-top-10 p_no_stock" style="color:var(--red);border:1px solid var(--red);">OUT OF STOCK</button>';
                        } else {
                        echo '<button class="btn-outline margin-top-10 add_cart" data-pid=' . $id_ . '>Add to Cart</button>';
                        }
                        echo '&nbsp;&nbsp;
                        <button class="p_wish_btn add_to_wish" title=' . $id_ . '>
                        <img src="assets/images/heart.svg" title="Add to Wishlist">
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
               ';
               $_SESSION['fetch_id']=$row['id'];
               
               
               }
               }
               else{
               echo "<img src='assets/images/no.svg' style='width:200px;margin:auto;padding:100px 0'>";
               }
               
               ?>
         
         </div>
      </section>
      <center><button class="list_load_more_prod">Load More</button></center>
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
         function get_state(s) {
   var url = window.location.href;
if (url.includes("?")) {
   if(url.includes("state=")){
window.location.href=url+"&state="+s;
   }else{
    window.location.href=url+"&state="+s;}

} else {
    window.location.href=url+"?state="+s;
}
}function get_cat(s) {
   var url = window.location.href;
if (url.includes("?")) {
   if(url.includes("cat=")){

    window.location.href=url+"&cat="+s;
   }else{
    window.location.href=url+"&cat="+s;
}
} else {
    window.location.href=url+"?cat="+s;
}
}
      </script>
   </body>
</html>