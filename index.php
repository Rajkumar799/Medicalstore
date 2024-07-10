<!DOCTYPE html>
<html>

<head>
    <!--<link rel="stylesheet" type="text/css" href="testi.css?v=-0">-->
    <?php 
         require_once("head.php");
         include "config.php";
           ?>
    <style>
        .home_cara {
            width: 100%;
            position: relative;
            height: 65vh;
        }

        .home_cara .banner {
            position: relative;
            height: 65vh;
        }

        .home_cara .banner>.mobile_banner {
            display: none;
            position: absolute;
            height: 65vh;
            width: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-image: url('banner/2.webp');
        }

        .home_cara .banner>.pc_banner {
            position: absolute;
            height: 65vh;
            width: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100%;
        }

        .pc_overlay {
            position: absolute;
            background-image: linear-gradient(to right, #00000052, transparent);
            height: 65vh;
            width: 100%;
        }

        .mobile_overlay {
            position: absolute;
            background-image: linear-gradient(to bottom, transparent, #000000cc);
            height: 65vh;
            width: 100%;
        }

        .banner_texts {
            position: absolute;
            z-index: 10;
            height: 65vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            max-width: 1300px;
            padding: 0 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .banner_texts>h1 {
            color: #fff !important;
            font-weight: bold;
            font-size: 45px;
            width: 40%;
        }

        .banner_texts p {
            color: #fff !important;
            font-size: 20px;
            width: 40%;
        }

        #owl-carousel3 .owl-nav {
            top: unset !important;
            left: unset !important;
            transform: unset !important;
            bottom: 20px !important;
            width: 80px;
            margin-left: 100px;
        }

        #owl-carousel3 .owl-nav button {
            background: transparent !important;
            border: 1px solid #fff !important;
        }

        #owl-carousel3 .owl-nav button i {
            color: #fff !important
        }

        @media(max-width:600px) {
            .pc_banner {
                display: none;
            }

            .mobile_banner {
                display: block !important;
            }

            .banner_texts>h1 {
                width: 100%;
                color: #fff !important;
                font-weight: bold;
                font-size: 30px;
            }

            .banner_texts p {
                color: #fff !important;
                font-size: 17px;
                width: 100%;
            }

            .banner_texts {
                justify-content: flex-end;
                left: unset;
                transform: unset;
                bottom: 70px;
            }

            #owl-carousel3 .owl-nav {
                margin-left: 20px;
            }
        }
    </style>
    <title>Home</title>
</head>

<body>
    <?php 
         require_once("header.php");
           ?>
    <div class="owl-carousel" id="owl-carousel3">


 <?php
        // Retrieve data from the database
        
        $sql="SELECT * FROM banner";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $link = $row['link'];
                $big=$row['big'];
                $small=$row['small'];
                $t1=$row['t1'];
                $t2=$row['t2'];
                

                echo '<div class="home_cara ">
            <div class="banner">
                <div class="pc_banner" style="background-image: url(\'banner/'.$big.'\');">
                    <div class="pc_overlay"></div>
                </div>
                <div class="mobile_banner" style="background-image: url(\'banner/'.$small.'\');">
                    <div class="mobile_overlay"></div>
                </div>
                <div class="banner_texts">
                    <h1>'.$t1.'</h1>
                    <p class="margin-top-10">'.$t2.'</p>
                    <button class="margin-top-20 btn-small" onclick=window.location.href="'.$link.'">Learn More &nbsp;&nbsp;<i class="fas fa-arrow-right white"></i></button>
                </div>
            </div>
        </div>';
            }
        } else {
           // echo "0";
        }
        ?>


        
        
        




    </div>


    <div class="container flex_ flex_wrap justify-content-center margin-top-20 small-icons ">

        <div class="flex_ align-items">
            <div>
                <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7222 1H31.5555V19.0556H10.7222V1Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.7222 7.94446H5.16667L1.00001 12.1111V19.0556H10.7222V7.94446Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M25.3055 26C23.3879 26 21.8333 24.4454 21.8333 22.5278C21.8333 20.6101 23.3879 19.0555 25.3055 19.0555C27.2232 19.0555 28.7778 20.6101 28.7778 22.5278C28.7778 24.4454 27.2232 26 25.3055 26Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M7.25001 26C5.33235 26 3.77778 24.4454 3.77778 22.5278C3.77778 20.6101 5.33235 19.0555 7.25001 19.0555C9.16766 19.0555 10.7222 20.6101 10.7222 22.5278C10.7222 24.4454 9.16766 26 7.25001 26Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <div class="space"></div>
            <div>
                <h4>Free Delivery</h4>
                <p>For Specific Products</p>
            </div>
        </div>





        <div class="flex_ align-items">
            <div>
                <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.5 24.3333V15C1.5 11.287 2.975 7.72602 5.60051 5.10051C8.22602 2.475 11.787 1 15.5 1C19.213 1 22.774 2.475 25.3995 5.10051C28.025 7.72602 29.5 11.287 29.5 15V24.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M29.5 25.8889C29.5 26.714 29.1722 27.5053 28.5888 28.0888C28.0053 28.6722 27.214 29 26.3889 29H24.8333C24.0082 29 23.2169 28.6722 22.6335 28.0888C22.05 27.5053 21.7222 26.714 21.7222 25.8889V21.2222C21.7222 20.3971 22.05 19.6058 22.6335 19.0223C23.2169 18.4389 24.0082 18.1111 24.8333 18.1111H29.5V25.8889ZM1.5 25.8889C1.5 26.714 1.82778 27.5053 2.41122 28.0888C2.99467 28.6722 3.78599 29 4.61111 29H6.16667C6.99179 29 7.78311 28.6722 8.36656 28.0888C8.95 27.5053 9.27778 26.714 9.27778 25.8889V21.2222C9.27778 20.3971 8.95 19.6058 8.36656 19.0223C7.78311 18.4389 6.99179 18.1111 6.16667 18.1111H1.5V25.8889Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <div class="space"></div>
            <div>
                <h4>24 X 7 Support</h4>
                <p>Contact us 24 hours a day</p>
            </div>
        </div>









        <div class="flex_ align-items">
            <div>
                <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" class='svg_fill'>
                    <mask id="mask0_1211_583" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="31" height="30">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H30.0024V29.9998H0V0Z" fill="white"></path>
                    </mask>
                    <g mask="url(#mask0_1211_583)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4168 27.1116C14.3017 27.9756 15.7266 27.9651 16.6056 27.0816L17.6885 26.0017C18.5285 25.1632 19.6894 24.6848 20.8728 24.6848H22.4178C23.6687 24.6848 24.6856 23.6678 24.6856 22.4184V20.875C24.6856 19.6736 25.1506 18.5441 25.9995 17.6937L27.0795 16.6122C27.519 16.1713 27.7544 15.5998 27.7529 14.9938C27.7514 14.3894 27.513 13.8209 27.0825 13.3919L26.001 12.309C25.1506 11.4525 24.6856 10.3246 24.6856 9.12318V7.58277C24.6856 6.33184 23.6687 5.3149 22.4178 5.3149H20.8758C19.6744 5.3149 18.545 4.84842 17.6945 4.00397L16.6116 2.91954C15.7101 2.02709 14.2717 2.03159 13.3913 2.91804L12.3128 3.99947C11.4519 4.84992 10.3225 5.3149 9.12553 5.3149H7.58212C6.33269 5.3164 5.31575 6.33334 5.31575 7.58277V9.12018C5.31575 10.3216 4.84927 11.451 4.00332 12.303L2.93839 13.3694C2.92789 13.3814 2.91739 13.3904 2.90689 13.4009C2.02644 14.2874 2.03094 15.7258 2.91739 16.6062L4.00032 17.6892C4.84927 18.5411 5.31575 19.6706 5.31575 20.872V22.4184C5.31575 23.6678 6.33119 24.6848 7.58212 24.6848H9.12253C10.3255 24.6863 11.4549 25.1527 12.3053 26.0002L13.3868 27.0786C13.3958 27.0891 13.4063 27.0996 13.4168 27.1116ZM14.9972 30.0002C13.8468 30.0002 12.6963 29.5652 11.8159 28.6923C11.8039 28.6803 11.7919 28.6683 11.7799 28.6548L10.715 27.5914C10.2905 27.1699 9.72352 26.9359 9.12055 26.9344H7.58164C5.09029 26.9344 3.06541 24.908 3.06541 22.4182V20.8717C3.06541 20.2688 2.82992 19.7033 2.40694 19.2773L1.32851 18.2004C-0.423392 16.4575 -0.444391 13.6197 1.27601 11.8498C1.28951 11.8363 1.30301 11.8228 1.31651 11.8093L2.40844 10.7143C2.82992 10.2899 3.06541 9.72139 3.06541 9.11993V7.58252C3.06541 5.09266 5.09029 3.06628 7.58014 3.06478H9.12505C9.72652 3.06478 10.2935 2.82929 10.724 2.40482L11.7964 1.32938C13.5498 -0.436017 16.4161 -0.445016 18.1845 1.31288L19.281 2.40932C19.7054 2.83079 20.2724 3.06478 20.8754 3.06478H22.4173C24.9086 3.06478 26.935 5.09116 26.935 7.58252V9.12293C26.935 9.72439 27.169 10.2929 27.5935 10.7203L28.6704 11.7988C29.5239 12.6462 29.9978 13.7787 30.0023 14.9861C30.0068 16.1935 29.5404 17.329 28.6899 18.1854L27.5905 19.2818C27.169 19.7063 26.935 20.2718 26.935 20.8747V22.4182C26.935 24.908 24.9086 26.9344 22.4188 26.9344H20.8724C20.2784 26.9344 19.6979 27.1744 19.2765 27.5929L18.1995 28.6698C17.3191 29.5562 16.1581 30.0002 14.9972 30.0002Z" fill="currentColor"></path>
                    </g>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.145 19.9811C10.857 19.9811 10.569 19.8716 10.3501 19.6511C9.91058 19.2116 9.91058 18.5006 10.3501 18.0612L18.0596 10.3501C18.4991 9.91064 19.2115 9.91064 19.651 10.3501C20.0905 10.7896 20.0905 11.502 19.651 11.9415L11.94 19.6511C11.721 19.8716 11.433 19.9811 11.145 19.9811Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7544 20.2476C17.925 20.2476 17.247 19.5772 17.247 18.7477C17.247 17.9183 17.9115 17.2478 18.7409 17.2478H18.7544C19.5839 17.2478 20.2543 17.9183 20.2543 18.7477C20.2543 19.5772 19.5839 20.2476 18.7544 20.2476Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2548 12.748C10.4254 12.748 9.74744 12.0775 9.74744 11.2481C9.74744 10.4186 10.4119 9.74817 11.2413 9.74817H11.2548C12.0843 9.74817 12.7548 10.4186 12.7548 11.2481C12.7548 12.0775 12.0843 12.748 11.2548 12.748Z" fill="currentColor"></path>
                </svg>
            </div>
            <div class="space"></div>
            <div>
                <h4>Coupon Discount</h4>
                <p>Use code provided above</p>
            </div>
        </div>




    </div>

    <section class="container margin-top-20">
        <div class="flex_ align-items justify-content  _headings_">
            <h2 class="sub-head2 margin-top-20" data-item="Find The best">Categories</h2>

            <div class="flex_ align-items">
                <button class="cara_arrows"><i class="fa fa-arrow-left"></i></button>
                <button class="cara_arrows"><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
        <section class="category-section">

            <div class="category-container owl-carousel" id="owl-carousel1">
                <?php
                  foreach ($_cat_ as $__c) {
                  echo '<a href="product.php?cat='.$__c[0].'"><div class="category-item" id="cate_4">
                                    <img src="cat/'.$__c[1].'" alt="'.$__c[2].'">
                                    <p>'.$__c[2].'</p>
                                 </div></a>';
                  
                  }
                              ?>
            </div>

        </section>
    </section>
    <br>
    <section class="container">
        <div class="flex_ mobile-flex-direction align-items justify-content">
            <div class="new_cat_box">
                <img src="cat/lap.webp">
                <div class="shop-body">
                    <h3>A<br></h3><br>
                    <a href="product.php?cat=0" class="cta-btn">Shop now <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="new_cat_box">
                <img src="cat/head.webp">
                <div class="shop-body">
                    <h3>b<br></h3><br>
                    <a href="product.php?cat=1" class="cta-btn">Shop now <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="new_cat_box">
                <img src="cat/cam.webp">
                <div class="shop-body">
                    <h3>c<br></h3><br>
                    <a href="product.php?cat=2" class="cta-btn">Shop now <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section class="container margin-top-20" style="padding:0;">
        <div class="flex_ align-items justify-content  _headings_ mobile-flex-direction">
            <h2 class="sub-head2 margin-top-20" data-item="products"> Med</h2>
            <div class="head_cat">
                <span class="active_">ALL</span>
                <?php
                $i=0;
                while($i<=4){
                    $link="window.location.href='product.php?cat=".$_cat_[$i][0]."'";
                    echo "<span onclick=".$link.">".$_cat_[$i][2]."</span>";
                    $i+=1;
                }
                ?>
                
            </div>
            <div class="flex_ align-items">
                <button class="no_btn" onclick="window.location.href='product.php'">Show more&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
            </div>
        </div>


        <div class=" margin-top-20 flex_ flex_wrap justify-content-center home_page_prod owl-carousel" id="owl-carousel2">
            <?php
               $sql = "SELECT * FROM item where disable='0' order by id desc limit 12 ";
               
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
                      $max_price=$row['max_price'];
                      echo '<div class="product">
                    <a href="single-product.php?id=' .
                          $id_ .
                          '"> <div class="product_img">
                        <img src="prod/' .
                          $img1 .
                          '" class="transform">';
               
                        if ($dis > 0) {
               echo '<p class="discount">' . $dis . '% OFF</p>';
               }
                echo '<button class="btn-outline-heart">
                 <img src="assets/images/heart.svg" title="Add to Wishlist">
                 </button>
                     </div></a>
                     <div class="product_des">
               <p class="product_name">'.$name.'</p>
               <div class="flex_ padding">
               <p class="product_stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p>
               &nbsp;&nbsp;
               <p class="product_rev">('.$review.' Reviews)</p>
               </div>
               <div class="flex_ padding margin-bottom-20 margin-top-10 justify-align cart_and_price mobile-cart-price">
               <div>';
               if ($row['stock'] == 0 or $row['num'] == 0) {
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
                  }
               }
               ?>
        </div>
    </section>
    <!-- <section id="hot-deal">
        <div class="hot_times">
            <div class="_time_">
                <h3>24/7</h3>
                <p>Delivery</p>
            </div>
            <div class="_time_">
                <h3>24/7</h3>
                <p>Help Line</p>
            </div>
        </div>
        <div class="texts_">
            <h2>Fast Delivery</h2>
            <p>Contact in WhatsApp or call</p>
            <button onclick="window.location.href='trending.php'">SHOP NOW</button>
        </div>
    </section><br> -->
    <section class="container deals_of_the_day">
        <div class="flex_ align-items justify-content  _headings_ mobile-flex-direction">
            <h2 class="sub-head2 margin-top-20" data-item="Find The best">med care</h2>
            <div class="head_cat">
                                <span class="active_">ALL</span>
                <?php
                $i=0;
                while($i<=4){
                    $link="window.location.href='trending.php?cat=".$_cat_[$i][0]."'";
                    echo "<span onclick=".$link.">".$_cat_[$i][2]."</span>";
                    $i+=1;
                }
                ?>
            </div>
            <div class="flex_ align-items">
                <button class="no_btn" onclick="window.location.href='trending.php'">Show more&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
        <!------------------------>
        <div class="margin-top-20 flex_ flex_wrap  justify-content-center">
            <?php
               $sql = "SELECT * FROM item where disable='0' and discount>=5 order by rand() desc limit 4 ";
               
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
               }
               ?>
            
















        </div>
        <!----------------->
    </section>
    <!---------- RECCOMMENDED --------------------->
    <section class="margin-top-20 recommend">
      <div class="container">
        <div class="flex_ align-items justify-content  _headings_ mobile-flex-direction">
            <h2 class="sub-head2 margin-top-20" data-item="What you like?">Recent Searches</h2>

            <div class="flex_ align-items">
                <button class="no_btn" onclick="window.location.href='recent.php'">SHOW MORE&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="flex_ margin-top-20 mobile-flex-direction align-items justify-content-center">



         <div class="product relative _product_image__">
            <div class="product_image__">
               <img src="banner\medicine-delivery-service-design-template-9c1236238b7f95e2974f2d1994dd5c64.jpg">
            </div>
            <button onclick="window.location.href='single-product.php?id=2'">Shop Now &nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-right white"></i></button>
         </div>



<?php
if(!isset($_SESSION['me'])){
    echo "<div class='sign-in-please flex_ justify-content-center align-items flex-direction'><h3>NOTHING FOUND :(</h3><p class='margin-top-10'>Please Sign In first to see your recent searches!</p></div>";
}
else{
    $me=$_SESSION['me'];
$sql="SELECT item.id as id,item.name as name,item.price as price,item.img1 as img1,item.star as star,item.reviews as reviews,item.discount as discount,item.max_price as max_price,item.stock as stock,item.num as num from item,history where history.u_id='$me' and history.p_id=item.id order by history.id desc limit 3";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    //print_r($row);
                      $id_ = $row["id"];
                      $name = $row["name"];
                      $price = $row["price"];
                      $img1 = $row["img1"];
                      $star = $row["star"];
                      $review = $row["reviews"];
                      $dis = $row["discount"];
                      $max_price=$row['max_price'];
                      echo '<div class="product">
                    <a href="single-product.php?id=' .
                          $id_ .
                          '"> <div class="product_img">
                        <img src="prod/' .
                          $img1 .
                          '" class="transform">';
               
                        if ($dis > 0) {
               echo '<p class="discount">' . $dis . '% OFF</p>';
               }
                echo '<button class="btn-outline-heart">
                 <img src="assets/images/heart.svg" title="Add to Wishlist">
                 </button>
                     </div></a>
                     <div class="product_des">
               <p class="product_name">'.$name.'</p>
               <div class="flex_ padding">
               <p class="product_stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p>
               &nbsp;&nbsp;
               <p class="product_rev">('.$review.' Reviews)</p>
               </div>
               <div class="flex_ padding margin-bottom-20 margin-top-10 justify-align cart_and_price mobile-cart-price">
               <div>';
               if ($row['stock'] == 0 or $row['num'] == 0) {
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
                  }
              }else{
                echo "<div class='sign-in-please flex_ justify-content-center align-items flex-direction'><h3>NOTHING FOUND :(</h3><p class='margin-top-10'>It looks like you have not visited any product!</p></div>";
              }
}
?>








        </div>
        </div>
    </section>
    <!-----------RECOMMEND OFF -------------------->
    <!-------------------------------------------->
    <!-- <section class="container margin-top-20 flex_ justify-content mobile-flex-direction">
      <div class="big_deals" style="background-image: url('banner/b1.jpg');">
         <div class="flex_ flex-direction justify-content b1">
               <div>
               <h2 class="red">Deal of the Day</h2>
               <p class="">Limited Quantity</p>
               </div>
               <div>
                  <h3></h3>
                  <p class="margin-top-20 big_price bold"></p>
                  <button class="margin-top-20" onclick="window.location.href='single-product.php?id=2'">Shop Now&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-right" style="color:var(--p)"></i></button>
               </div>
               <div class="flex_ align-items  time_deal_">
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
      </div>
      <div class="big_deals" style="background-image: url('banner/b2.jpg');">
         <div class="flex_ flex-direction justify-content b1">
               <div>
               <h2 class="red"></h2>
               <p class=""></p>
               </div>
               <div>
                  <h3></h3>
                  <p class="margin-top-20 big_price bold">$2,499</p>
                  <button class="margin-top-20" onclick="window.location.href='single-product.php?id=2'">Start Saving Money Now&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-right" style="color:var(--p)"></i></button>
               </div>
               <div class="flex_ align-items  time_deal_">
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
      </div>
       
    </section> -->
    <!--------------------------------------------->
    
    <!----------featured_prod---------><br>
    <section class="container margin-top-20">
       <div class="flex_ justify-content-center flex_wrap margin-top-20">
        <?php
$sql="SELECT * from item order by rand() limit 9";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    //print_r($row);
                      $id_ = $row["id"];
                      $name = $row["name"];
                      $price = $row["price"];
                      $img1 = $row["img1"];
                      $shop=$row['shop'];
                      $max_price=$row['max_price'];
                      echo '<div class="featured_prod flex_ align-items">
                <img src="prod/'.$img1.'">
                <div class="_p__">
                   <p>'.$shop.'</p>
                   <a href="single-product.php?id='.$id_.'">'.$name.'</a>
                   <div class="flex_ align-items"><h3 class="deal_price_main">$'.$max_price.'</h3>
                        &nbsp;&nbsp;$'.$price.'</div>
                </div>
             </div>';
                  }
              }
        ?>
            
            

       </div>
    </section>
    <!------------------->
    <div class="container margin-top-20">
        <!--<h2 class="sub-head margin-top-20" data-item="Restaurants">Our Partners</h2>-->
        <div class="logos_ flex_">
            <div class="flex_ align-items justify-content-center partner-logo margin-top-20">
                <img src="cat\image_66839b952e36f7.37367466.png">
                <img src="cat\image_66839bba8a2176.62059031.png">
                <img src="assets\images\free.png">
                <img src="assets\images\delivery.png">
                <img src="assets\images\fast.png">
            </div>
        </div>
    </div>
    <section class="container margin-top-20 flex_ align-items mobile-flex-direction-reverse">
        <div class=" flex-1">
            <h2 class="sub-head margin-top-20" data-item="Who are we?">About Andhrameds</h2>
            <p class="margin-top-20">
            Welcome to Andhrameds, your trusted online medical delivery service dedicated to providing quality healthcare products and services at your doorstep. Our mission is to ensure that everyone has easy and convenient access to essential medications, health supplements, and wellness products without leaving the comfort of their home.        </p>
            </p>
            <div class="flex_ about_det">
                <div class="flex-1 flex_ flex-direction align-items">
                    <h2>35+</h2>
                    <h4>Our Team</h4>
                </div>
                <div class="flex-1 flex_ flex-direction align-items">
                    <h2>75+</h2>
                    <h4>Our Shops</h4>
                </div>
                <div class="flex-1 flex_ flex-direction align-items">
                    <h2>85+</h2>
                    <h4>Our Brands</h4>
                </div>
            </div>
            <div class="flex_ margin-top-20 flex-direction">
                <div class="margin-top-10 flex_">
                    <a class="share_icon_div share-ig" target="blank" href=""><i class="fab fa-instagram"></i></a>
                    <a class="share_icon_div share-tw" target="blank" href=""><i class="fab fa-twitter"></i></a>
                    <a class="share_icon_div share-wh" target="blank" href=""><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <br>
            <a href="#"><button class="btn-small">LEARN MORE&nbsp;&nbsp;<i class="fas fa-arrow-right white"></i></button></a>
        </div>
        <div class="flex-1 flex_ align-items justify-content-center">
            <img src=cat\image_66839b952e36f7.37367466.png class="about_image">
        </div>
    </section>
    
    <div class="news_letter relative margin-top-20">
        <!--<img src="assets/images/ramen.png">-->
        <!-- <div class="container ">
            <center><img src="assets/images/mail.png" class="margin-top-20" style="height:80px"></center>
            <h2 class="sub-head margin-top-20" data-item="news updates">Newsletters</h2>
            <form class="margin-top-20 flex_  news_form">
                <input type="email" class="news__" placeholder=psychoblackheart17@gmail.com required>
                <button type="submit">Subscribe</button>
            </form>
            <br><br>
        </div> -->
    </div>


      <div style="position: fixed;bottom: 110px;right:30px;display: flex;flex-direction: column;z-index: 100000;">
         <a href="https://wa.me/7995847197" target="blank" style="width:50px;height: 50px;border-radius: 50px;background: var(--p);color: #fff; " class="flex_ align-items justify-content-center"><i class="fab fa-whatsapp" style="color: #fff;"></i></a>
         <br>
         <a href="tel:+917995847197" style="width:50px;height: 50px;border-radius: 50px;background: var(--p);color: #fff;" class="flex_ align-items justify-content-center"><i class="fas fa-phone-alt" style="color: #fff;"></i></a>
      </div>

      
    <?php require "footer.php";?>
    <!--<script type="text/javascript" src="testi.js?v=-s3"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Initialize the owl carousel plugin
        $('#owl-carousel1').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true, // Add this option to enable autoplay
            autoplayTimeout: 30000, // Set the timeout to 3 seconds
            responsive: {
                0: {
                    items: 3
                },
                500: {
                    items: 4
                },
                600: {
                    items: 4
                },
                700: {
                    items: 4
                },
                900: {
                    items: 5
                },
                1200: {
                    items: 9
                }
            }
        });
        $('#owl-carousel2').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true, // Add this option to enable autoplay
            autoplayTimeout: 30000, // Set the timeout to 3 seconds
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 1
                },
                600: {
                    items: 1
                },
                700: {
                    items: 2
                },
                900: {
                    items: 2
                },
                1200: {
                    items: 4
                }
            }
        });
        $('#owl-carousel3').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true, // Add this option to enable autoplay
            autoplayTimeout: 3000, // Set the timeout to 3 seconds
            responsive: {
                0: {
                    items: 1
                },

            }
        })
    </script>
    <script>
        var copy = document.querySelector(".partner-logo").cloneNode(true);
        document.querySelector(".logos_").appendChild(copy);

        var a = $(".home_page_prod>.product").width();
        var windowWidth = window.innerWidth;

        // Log the window width to the console
        console.log("Window width: " + windowWidth + " pixels");
        if (windowWidth <= 600) {
            $(".product_img").css({
                'height': parseInt(a) + 20 + 'px'
            });
            $(".product_img>img").css({
                'height': parseInt(a) + 20 + 'px',
                'width': a + 'px'
            });
            $(".product_name").each(function() {
                // Check if text length exceeds 20 characters
                if ($(this).text().length > 40) {
                    // Trim the text to 20 characters and add ellipsis
                    var trimmedText = $(this).text().substring(0, 40) + "...";
                    // Set the updated text
                    $(this).text(trimmedText);
                }
            });
            //$(".home_page_prod .add_cart").html('<i class="fas fa-cart-arrow-down"></i>');
        }
    </script>

</body>

</html>