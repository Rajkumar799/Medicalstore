<!DOCTYPE html>
<html>
   <head>
      <?php

         include 'head.php';
         include "config.php";
         ?>
        <style type="text/css">
           .product_stars{
            justify-content: center;
            margin-bottom: 20px;
           }
           .product_name{
            white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 300px;justify-content: center;
           }
        </style>
      <title>Treanding Deals</title>
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
         
         ?>
         <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="">
              <h1 class="page-title">Trending Deals
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
              </h1>
            </div><!-- End .container -->
          </div>
          
          
      <section class="flex_ product_page deals_of_the_day">
         
         <div class="product_page_right justify-content-center align-items-center">
            <?php
               $sql = "SELECT * FROM item where disable='0'" .$_SESSION['_cat']. $_SESSION['_subcat']." and discount>=5 order by rand()";
               
               $result = $conn->query($sql);
               
               if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                      $id_ = $row["id"];
                      $name = $row["name"];
                      $price = $row["price"];
                      $img1 = $row["img1"];
                      $star = $row["star"];
                      $review = $row["reviews"];
                      $dis = $row["discount"];
                      $max_price=$row['max_price'];$shop=$row['shop'];
                      echo '<div class="product">
                <a href="single-product.php?id='.$id_.'">
                    <div class="product_img">
                        <img src="prod/' . $img1 . '" class="transform">';
                        if ($dis > 0) {
               echo '<p class="discount">' . $dis . '% OFF</p>';
               }
                        echo '<button class="btn-outline-heart">
                            <img src="assets/images/heart.svg" title="Add to Wishlist">
                        </button>
                    </div>
                </a>
                <div class="product_des">
                    <p class="deal_shop">' . $shop . '</p>
                    <p class="product_name">' . $name . '</p>
                    <div class="deal_prices">
                        <h3 class="deal_price_main">$' . $max_price . '</h3>
                        &nbsp;&nbsp;
                        <h3 class="deal_price">$' . $price . '</h3>
                    </div>

                    <p class="product_stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p>
                    <center> <button class="deal_btn_cart btn-outline add_cart" data-pid='.$id_.'>Add to Cart</button></center>
                    <div class="flex_ align-items justify-content-center time_deal_">
                        <div class="time_deal flex_ align-items justify-content-center flex-direction">
                            <p class="deal_time_ d_day">2</p>
                            <span class="deal_day">Days</span>
                        </div>
                        <div class="time_deal flex_ align-items justify-content-center flex-direction">
                            <p class="deal_time_ d_hour">12</p>
                            <span class="deal_day">Hours</span>
                        </div>
                        <div class="time_deal flex_ align-items justify-content-center flex-direction">
                            <p class="deal_time_ d_mins">28</p>
                            <span class="deal_day">Mins</span>
                        </div>
                        <div class="time_deal flex_ align-items justify-content-center flex-direction">
                            <p class="deal_time_ d_secs">34</p>
                            <span class="deal_day">Secs</span>
                        </div>
                    </div>
                </div>
            </div>';
                  }
               }else{
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