<?php
include "config.php";
include "back/category.php";

if (isset($_COOKIE["me"])) {
    $_SESSION['me'] = $_COOKIE["me"];
}

if (!isset($_SESSION['wish_']) or !isset($_SESSION['cart_'])) {
    if (isset($_SESSION['me'])) {
        $me = $_SESSION['me'];

        $sqlWishlist = "SELECT COUNT(u_id) AS wish FROM wishlist WHERE u_id = '$me'";
        $sqlCart = "SELECT COUNT(u_id) AS cart FROM cart WHERE u_id = '$me'";

        $resultWishlist = $conn->query($sqlWishlist);
        $resultCart = $conn->query($sqlCart);
        if ($resultWishlist && $resultCart) {
            $rowWishlist = $resultWishlist->fetch_assoc();
            $rowCart = $resultCart->fetch_assoc();

            $wish_num = $rowWishlist['wish'];
            $cart_num = $rowCart['cart'];
        }
    } else {
        $wish_num = 0;
        $cart_num = 0;
    }
    $_SESSION['wish_'] = $wish_num;
    $_SESSION['cart_'] = $cart_num;
} else {
    $me = $_SESSION['me'];
}

$wish_num = $_SESSION['wish_'];
$cart_num = $_SESSION['cart_'];

$sqlActiveCoupons = "SELECT code, discount, type FROM coupon WHERE expired = 0";
$resultActiveCoupons = $conn->query($sqlActiveCoupons);
$activeCoupons = [];

if ($resultActiveCoupons->num_rows > 0) {
    while ($row = $resultActiveCoupons->fetch_assoc()) {
        $activeCoupons[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include your head content -->
    <?php include 'head.php'; ?>
    <style>
        .coupon-banner {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
            font-size: 16px;
            overflow: hidden;
            white-space: nowrap;
        }
        .coupon-banner p {
            margin: 0;
            display: inline-block;
            padding: 0 15px;
        }
        .mobile__ .user_icons {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .mobile__ .icon_div {
            position: relative;
        }
        .mobile__ .icon_div span {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
        .coupon-banner-mobile {
            display: none;
        }
        @media (max-width: 600px) {
            .coupon-banner {
                display: none;
            }
            .coupon-banner-mobile {
                display: block;
                background-color: #f8f9fa;
                padding: 10px;
                text-align: center;
                border-bottom: 1px solid #e9ecef;
                font-size: 14px;
                white-space: nowrap;
                overflow-x: scroll;
            }
            .coupon-banner-mobile p {
                display: inline-block;
                padding: 0 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Active Coupons Display for Desktop -->
    <div class="coupon-banner">
        <p>Welcome!</p>
        <?php foreach ($activeCoupons as $coupon) { ?>
            <p>Coupon: <?php echo $coupon['code']; ?> - <?php echo $coupon['discount']; ?><?php echo $coupon['type'] == 'PERCENT' ? '%' : '$'; ?></p>
        <?php } ?>
    </div>

    <!-- Active Coupons Display for Mobile -->
    <div class="coupon-banner-mobile">
        <p>Welcome!</p>
        <?php foreach ($activeCoupons as $coupon) { ?>
            <p>Coupon: <?php echo $coupon['code']; ?> - <?php echo $coupon['discount']; ?><?php echo $coupon['type'] == 'PERCENT' ? '%' : '$'; ?></p>
        <?php } ?>
    </div>

    <header>
        <nav>
            <img src="assets/images/logo.jpg" class="logo">
            <div class="search_bar">
                <input type="text" class="search_bar_inp pc_search_input" placeholder="Search For Products..">
                <div class="line"></div>
                <select class="purpose">
                    <!-- <option value="0">Product</option> -->
                    <option value="1">Shop</option>
                </select>
                <button class="search_btn pc_search_button"><i class='fas fa-search'></i></button>
                <div class="show_search"></div>
            </div>
            <div class="user_icons">
                <?php if (!isset($_SESSION['me'])) {
                    echo '<div class="user_and_account show_login">
                        <img src="assets/images/user.svg?">
                        <div class="_account">
                            <p class="hello_">Hello, Sign In</p>
                            <p class="nav_your_account_">Your Account</p>
                        </div>
                    </div>';
                } else {
                    $user_name_ = $_COOKIE['user_name'];
                    echo '<a href="profile.php"><div class="user_and_account">
                        <img src="assets/images/user.svg?">
                        <div class="_account">
                            <p class="hello_">Hello, ' . $user_name_ . '</p>
                            <p class="nav_your_account_">Your Account</p>
                        </div>
                    </div></a>';
                } ?>
                &nbsp;&nbsp;
                <div class="icon_div">
                    <a href="cart.php"><img src="assets/images/cart.svg"></a>
                    <?php if ($cart_num != 0) {
                        echo "<span>" . $cart_num . "</span>";
                    } ?>
                </div>
                <div class="icon_div">
                    <a href="wishlist.php"><img src="assets/images/heart.svg"></a>
                    <?php if ($wish_num != 0) {
                        echo "<span>" . $wish_num . "</span>";
                    } ?>
                </div>
            </div>
        </nav>
    </header>
    <section class="navbar_links container">
        <div class="navbar_links_inside flex_ align-items">
            <div class="all_cat">
                <div class="all_cat_">
                    <p class="flex_">
                        <button class="trans flex_" id="allCategoryButton">
                            <i class="fas fa-align-left white"></i>
                            <div class="space"></div>All Category
                        </button>
                    </p>
                    <i class="fas fa-angle-down white"></i> 
                </div>
                <div class="cat_options" id="categoryOptions" style="display: none;">
                    <?php
                    foreach ($_cat_ as $index => $__c) {
                        echo '<a class="flex_ cat_options_ pc-header"> <p style="display:flex;align-items:center"><img src="cat/'.$__c[1].'" style="width:40px;height:40px;object-fit:contain">' . $__c[2] . '</p> <i class="fas fa-angle-right"></i> </a>';

                        if (isset($__c[3]) && is_array($__c[3])) {
                            echo '<div class="subcategories"><ul>';

                            foreach ($__c[3] as $subcatIndex => $subcat) {
                                echo '<li><a href="product.php?cat=' . $index . '&subcat=' . $subcatIndex . '">' . $subcat . '</a></li>';
                            }

                            echo '</ul></div>';
                        }
                    }
                    ?>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#allCategoryButton').click(function() {
                            $('#categoryOptions').toggle();
                        });

                        var windowWidth = window.innerWidth;
                        if (windowWidth <= 600) {
                            $(".cat_options_").click(function() {
                                $(".subcategories").hide();
                                $(this).next(".subcategories").slideToggle(100);
                            });
                        } else {
                            $(".cat_options_").hover(function() {
                                $(".subcategories").hide();
                                $(this).next(".subcategories").show(0);
                            });
                        }
                    });
                </script>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Recently Added</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="track.php">Track Products</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </section>

    <!-- Mobile header and navigation -->
    <div class="mobile__">
        <section class="mob-head flex_ align-items justify-content">
            <div class="">
                <img src="assets/images/logo.jpg" class="mob-logo">
            </div>
            <div>
                <div class="user_icons">
                    <?php if (!isset($_SESSION['me'])) {
                        echo '<div class="user_and_account show_login">
                            <img src="assets/images/user.svg">
                        </div>';
                    } else {
                        echo '<a href="profile.php"><div class="user_and_account">
                            <img src="assets/images/user.svg">
                        </div></a>';
                    } ?>
                    &nbsp;&nbsp;
                    <div class="icon_div">
                        <a href="cart.php"><img src="assets/images/cart.svg"></a>
                        <?php if ($cart_num != 0) {
                            echo "<span>" . $cart_num . "</span>";
                        } ?>
                    </div>
                    <div class="icon_div">
                        <img src="assets/images/search.svg" class="toggle-search">
                    </div>
                    <div class="icon_div">
                        <img src="assets/images/nav.svg" onclick="openmenu('open')">
                    </div>
                </div>
            </div>
        </section>
        <div class="toggle_search">
            <div class="search_bar">
                <input type="text" class="search_bar_inp mobile_search_input" placeholder="Search For Products..">
                <div class="line"></div>
                <select class="purpose">
                    <option value="0">Product</option>
                    <option value="1">Shop</option>
                </select>
                <button class="search_btn mobile_search_button"><i class='fas fa-search'></i></button>
                <div class="show_search"></div>
            </div>
        </div>
        <div class="mobile-menu">
            <div class="head-mobile flex_ align-items">
                <img src="assets/images/logo.jpg" class="mob-logo">
                <i class="fas fa-times" onclick="openmenu('close');"></i>
            </div>
            <div class="all_cat">
                <div class="all_cat_">
                    <p class="flex_">
                        <button class="trans flex_">
                            <i class="fas fa-align-left white"></i>
                            <div class="space"></div>All Category
                        </button>
                    </p>
                    <i class="fas fa-angle-down white"></i> 
                </div>
                <div class="cat_options">
                    <?php
                    foreach ($_cat_ as $index => $__c) {
                        echo '<a class="flex_ cat_options_"> <p style="display:flex;align-items:center"><img src="cat/'.$__c[1].'" style="width:40px;height:40px;object-fit:contain">' . $__c[2] . '</p> <i class="fas fa-angle-right"></i> </a>';

                        if (isset($__c[3]) && is_array($__c[3])) {
                            echo '<div class="subcategories"><ul>';

                            foreach ($__c[3] as $subcatIndex => $subcat) {
                                echo '<li><a href="product.php?cat=' . $index . '&subcat=' . $subcatIndex . '">' . $subcat . '</a></li>';
                            }

                            echo '</ul></div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="track.php">Track Products</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="reviews.php">Reviews</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="back/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="black_layer">
        <div class="my_login_div" style="max-height: 600px;">
            <div class="my_login_relative flex_ align-items">
                <div class="left flex_ align-items">
                    <img src="assets/images/login_.svg">
                </div>
                <div class="right">
                    <form class="log">
                        <h1>Login</h1>
                        <br><br>
                        <div class="form_input">
                            <label for="fname">Mobile*</label>
                            <input type="number" name="fname" required class="login_email">
                        </div>
                        <br>
                        <div class="form_input otp_inp ">
                            <label for="fname">Password*</label>
                            <input type="password" name="fname" required class="otp_login"><br>
                        </div>
                        <p><a href="signup.php">Don't have an account?</a></p><br>
                        <p>By continuing, you agree to Food Express's <a>Terms of Use</a> and <a>Privacy Policy</a>.</p>
                        <br>
                        <button class="log"><i class="fas fa-shield-alt white"></i>&nbsp;&nbsp; Login</button>
                    </form>
                </div>
                <div class="login_cross">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".log").on("submit", function(e) {
                e.preventDefault(); // Prevent the default form submission

                var m = $(".login_email").val();

                var p = $(".otp_login").val();

                $.post("back/login.php", { action: "log", m: m, p: p }, function(res) {
                    if (res == 1) {
                        window.location.href = "index.php"
                        // Optionally, redirect to login page or perform other actions
                    } else {
                        alert(res);
                    }
                });
            });
        });
    </script>
</body>
</html>
