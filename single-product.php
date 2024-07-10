<!DOCTYPE html>
<html>
<head>
    <?php
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $currentUrl = $protocol . '://' . $host . $_SERVER['REQUEST_URI'];
        require_once "head.php";
        require_once "config.php";
        $p_id = $_GET["id"];
        $_SESSION["single-product-id"] = $p_id;
        $sql = "SELECT * FROM item where id='$p_id' and disable='0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $p_id = $row["id"];
                $name = $row["name"];
                $price = $row["price"];
                $shop = $row["shop"];
                $img1 = $row["img1"];
                $img2 = $row["img2"];
                $img3 = $row["img3"];
                $img4 = $row["img4"];
                $shop_id = $row["shop_id"];
                $des_short = $row["des_short"];
                $max_price = $row["max_price"];
                $review = $row["reviews"];
                $specs = $row["specs"];
                $sto_ = $row['stock'];
                $size = $row['size'];
                $discount = $row['discount'];
                $num = $row['num'];
            }
            /**************/

            if(isset($_SESSION['me'])){
                $me = $_SESSION['me'];
                $sql = "SELECT * from history where p_id=$p_id and u_id=$me";
                $result = $conn->query($sql);
                if ($result->num_rows != 1) {
                    $sql = "INSERT into history (u_id,p_id) values ($me,$p_id)";
                    $conn->query($sql);
                }
            }
            /****************/
        } else {
            header("Location:404.php");
        }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <title><?php echo $name; ?></title>
</head>
<body>
    <?php require_once "header.php"; ?>
    <section class="container flex_ single-product mobile-flex-direction margin-top-10">
        <div class="flex_ mobile-flex-direction" style="flex-direction: row-reverse;">
            <div class="flex_ align-items justify-content-center product-big-image">
                <img id="mainImage" src="prod/<?php echo $img1; ?>">
                <div class="arrows_left_right">
                    <div class="p_arrow_left" onclick="changeImage('left')">
                        <i class="fas fa-angle-left"></i>
                    </div>
                    <div class="p_arrow_right" onclick="changeImage('right')">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
            <div class="flex_ flex-direction mobile-row">
                <div class="single-product-imgs">
                    <img src="prod/<?php echo $img1; ?>" class='image__1'>
                </div>
                <div class="single-product-imgs">
                    <img src="prod/<?php echo $img2; ?>" class='image__2'>
                </div>
                <div class="single-product-imgs">
                    <img src="prod/<?php echo $img3; ?>" class='image__3'>
                </div>
                <div class="single-product-imgs">
                    <img src="prod/<?php echo $img4; ?>" class='image__4'>
                </div>
            </div>
        </div>
        <div class="space"></div>
        <div>
            <div class="single-product-det">
                <p class="shop_name"><?php echo $shop; ?>'s Shop</p>
                <h2 class="single-product-name margin-top-10"><?php echo $name; ?></h2>
                <div class="flex_ align-items margin-top-20">
                    <?php
                        if($num == 0 or $sto_ == 0){
                            echo '<p class="instock">Out Of Stock</p>';
                        } else {
                            echo '<p class="instock">In Stock</p>';
                        }
                    ?>
                    <div class="space"></div>
                    <?php 
                        if($num > 10){
                            echo "<span style='color:#25D366'>".$num." Products Left</span>";
                        } elseif($num <= 10 && $num > 0){
                            echo "<span style='color:var(--red)'>HURRY UP! Only ".$num." Products Left</span>";
                        } elseif($num == 0){
                            echo "<span style='color:var(--red)'>STOCK OUT! Check back later</span>";
                        }
                    ?>
                </div>
                <div class="flex_ margin-top-20 align-items">
                    <?php 
                        if($discount != 0){
                            echo '<p class="full-price">$'.$max_price.'</p>
                                  <div class="space"></div>';
                        }
                    ?>
                    <p class="dis-price">$<?php echo $price; ?></p>
                    <?php
                        if($discount != 0){
                            echo '<p class="full-discount">'.$discount.'% OFF</p>';
                        }
                    ?>
                </div>
                <?php
                    if($size != ""){
                        echo "<select class='size_paste margin-top-20'><option value='0'>--SELECT SIZE--</option>";
                        $sizeArray = explode(',', $size);
                        
                        foreach ($sizeArray as $sizeItem) {
                            echo '<option class="size-button" value="'. $sizeItem .'">' . $sizeItem . '</option>';
                        }
                        echo "</select>";
                    }

                    if($sto_ == '0' or $num == 0){
                        echo '<br><span class="outstock">Out Of Stock</span>';
                    } else {
                        echo '<div class="flex_ flex-direction"> 
                                <div class="flex_ flex-wrap margin-top-20 mobile-use"> 
                                    <div class="flex_ div_outline align-items justify-content"> 
                                        <div class="flex_ justify-content-center qty_dec"> 
                                            <i class="fas fa-minus"></i> 
                                        </div> 
                                        <div class="flex_ justify-content-center"> 
                                            <div class="qty_increased">1</div> 
                                        </div> 
                                        <div class="flex_ justify-content-center qty_inc"> 
                                            <i class="fas fa-plus"></i> 
                                        </div> 
                                    </div> 
                                    <div class="space"></div> 
                                    <div class="width-100 width_-100">
                                        <button class="buy_product_now" p-id='.$p_id.' >Buy Now</button>
                                    </div> 
                                    <div class="space"></div> 
                                    <div class="flex_ width-100 width_-100"> 
                                        <button class="add_cart_outline add_to_cart" data-pid='.$p_id.'>Add to Cart</button> 
                                    </div> 
                                    <div class="space"></div> 
                                    <div class="flex_"> 
                                        <button class="add_cart_outline square add_to_wish" title='.$p_id.'> 
                                            <i class="fas fa-heart" style="color:var(--p);"></i> 
                                        </button> 
                                    </div> 
                                </div> 
                              </div>';
                    }
                ?>
                <div class="container margin-top-20 flex_ p-info flex_wrap">
                    <div class="flex_ flex-direction justify-content-center align-items">
                        <img src="assets/images/free.png">
                        <a href="#">Free Delivery</a>
                    </div>
                    <div class="flex_ flex-direction justify-content-center align-items">
                        <img src="assets/images/delivery.png">
                        <a href="#">Pay on Delivery</a>
                    </div>
                    <div class="flex_ flex-direction justify-content-center align-items">
                        <img src="assets/images/fast.png">
                        <a href="#">Fast Delivery</a>
                    </div>
                </div>
                <div class="flex_ margin-top-20 flex-direction">
                    <div class="margin-top-10 flex_ share_product">
                        <a class="share_icon_div share-wh" target="blank" href="https://api.whatsapp.com/send?text=<?php echo $currentUrl; ?>"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="container margin-top-20">
        <div class="tabs_">
            <span class="tab-des active-link-tab" title="p-des">Description</span>
            <span class="tab-spec" title="p-specs">Specification</span>
            <span class="tab-rev" title="p-rev">Reviews</span>
        </div>
        <div class="p-rev">
            <div class="review_cont flex_ mobile-flex-direction">
                <div class="write_rev_cont margin-right-10">
                    <div class="flex_ flex-direction align-items">
                        <span class="color_head">Customer Reviews</span>
                        <div class="space"></div>
                        <button class="write_rev">Write a review</button>
                    </div>
                </div>
                <div class="write_rev_cont">
                    <div class="rev_form_cont">
                        <form action="server/write-review.php" method="post">
                            <div class="form-group">
                                <input type="hidden" name="pid" value="<?php echo $p_id; ?>">
                                <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
                                <label>Write a review</label>
                                <textarea placeholder="Enter your review here" name="review"></textarea>
                            </div>
                            <div class="form-group margin-top-20">
                                <label>Rating</label>
                                <div class="ratings">
                                    <span class="rating-star" data-value="5">&#9733;</span>
                                    <span class="rating-star" data-value="4">&#9733;</span>
                                    <span class="rating-star" data-value="3">&#9733;</span>
                                    <span class="rating-star" data-value="2">&#9733;</span>
                                    <span class="rating-star" data-value="1">&#9733;</span>
                                </div>
                                <input type="hidden" name="rating" value="0">
                            </div>
                            <button class="rev_submit" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="rev_cont_show">
                <div class="margin-top-20">
                    <?php
                        $sql = "SELECT * from review where p_id=$p_id order by id desc";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                    <div class="review">
                                        <div class="review_header">
                                            <span class="review_author">' . $row["user"] . '</span>
                                            <div class="ratings">';
                                            
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $row["rating"]) {
                                        echo '<span class="rating-star">&#9733;</span>';
                                    } else {
                                        echo '<span class="rating-star">&#9734;</span>';
                                    }
                                }
                                
                                echo '    </div>
                                        </div>
                                        <div class="review_body">
                                            <p>' . $row["review"] . '</p>
                                        </div>
                                    </div>';
                            }
                        } else {
                            echo '<p>No reviews yet. Be the first to review this product!</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="p-des">
            <?php echo $des_short; ?>
        </div>
        <div class="p-specs">
            <p class="p_specs_cont"><?php echo $specs; ?></p>
        </div>
    </section>
    <br>
    <section class="container margin-top-20">
        <a class="flex_ align-items color_pri justify-content-center">More FROM &nbsp;&nbsp;&nbsp;<i class="fas fa-angle-right" style="color:var(--p);"></i></a>
        <h2 class="flex_ align-items color_head justify-content-center margin-top-10"><?php echo $shop; ?></h2>
        <div class="margin-top-20 owl-carousel">
            <?php
                $sql = "SELECT * FROM item WHERE shop_id=$shop_id and disable=0 and id!=$p_id limit 6";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $id_ = $row['id'];
                    $price = $row['price'];
                    $review = $row['reviews'];
                    $img1 = $row['img1'];
                    $max_price = $row['max_price'];
                    $dis = $row['discount'];
                    $shop_id = $row['shop_id'];

                    echo '
                        <div class="product">
                            <a href="single-product.php?id=' . $id_ . '"> 
                                <div class="product_img">
                                    <img src="prod/' . $img1 . '" class="transform">
                                    '. ($dis > 0 ? '<p class="discount">' . $dis . '% OFF</p>' : '') .'
                                    <button class="btn-outline-heart">
                                        <img src="assets/images/heart.svg" title="Add to Wishlist">
                                    </button>
                                </div>
                            </a>
                            <div class="product_des">
                                <p class="product_name">' . $name . '</p>
                                <div class="flex_ padding">
                                    <p class="product_stars">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </p>
                                    &nbsp;&nbsp;
                                    <p class="product_rev">(' . $review . ' Reviews)</p>
                                </div>
                                <div class="flex_ padding margin-bottom-20 margin-top-10 justify-align">
                                    <div>
                                        ' . ($row['stock'] == 0 or $row['num'] == 0 ? 
                                            '<button class="btn-outline margin-top-10 p_no_stock" style="color:var(--red);border:1px solid var(--red);">OUT OF STOCK</button>' :
                                            '<button class="btn-outline margin-top-10 add_cart" data-pid=' . $id_ . '>Add to Cart</button>') .'
                                    </div>
                                    <p class="product_price">
                                        '. ($dis > 0 ? '<span class="pr_dis">$' . $max_price . '</span>' : '') .'
                                        $' . $price . '
                                    </p>
                                </div>
                            </div>
                        </div>';
                }
            ?>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    900: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }
                }
            });

            $('.tab-des').click(function() {
                $('.tab-spec, .tab-rev').removeClass('active-link-tab');
                $(this).addClass('active-link-tab');
                $('.p-des').show();
                $('.p-specs, .p-rev').hide();
            });

            $('.tab-spec').click(function() {
                $('.tab-des, .tab-rev').removeClass('active-link-tab');
                $(this).addClass('active-link-tab');
                $('.p-specs').show();
                $('.p-des, .p-rev').hide();
            });

            $('.tab-rev').click(function() {
                $('.tab-des, .tab-spec').removeClass('active-link-tab');
                $(this).addClass('active-link-tab');
                $('.p-rev').show();
                $('.p-des, .p-specs').hide();
            });

            $('.image__1').click(function() { $('#mainImage').attr('src', 'prod/<?php echo $img1; ?>'); });
            $('.image__2').click(function() { $('#mainImage').attr('src', 'prod/<?php echo $img2; ?>'); });
            $('.image__3').click(function() { $('#mainImage').attr('src', 'prod/<?php echo $img3; ?>'); });
            $('.image__4').click(function() { $('#mainImage').attr('src', 'prod/<?php echo $img4; ?>'); });

            $('.qty_dec').click(function() {
                let qty = $('.qty_increased').text();
                if (qty > 1) {
                    qty--;
                    $('.qty_increased').text(qty);
                }
            });

            $('.qty_inc').click(function() {
                let qty = $('.qty_increased').text();
                qty++;
                $('.qty_increased').text(qty);
            });

            $('.rating-star').click(function() {
                const rating = $(this).data('value');
                $('input[name="rating"]').val(rating);
                $('.rating-star').each(function(index, element) {
                    if (index < rating) {
                        $(element).html('&#9733;');
                    } else {
                        $(element).html('&#9734;');
                    }
                });
            });
        });
    </script>
    <?php include "footer.php"; ?>
</body>
</html>
