<?php
include "config.php";
session_start(); // Ensure the session is started

if (!isset($_SESSION['me'])) {
    header('Location:404.php');
    exit();
}

$me = $_SESSION['me'];
if (isset($_SESSION['code_applied'])) {
    $_SESSION['code_applied'] = 0;
    $_SESSION['code'] = 0;
    $_SESSION['discount'] = 0;
}

$sql = "SELECT * FROM cust WHERE id='$me'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row['name'];
    $lname = $row['lname'];
    $company = $row['company'];
    $phone = $row['phone'];
    $email = $row['email'];
    $state = $row['state'];
    $city = $row['city'];
    $add1 = $row['address1'];
    $add2 = $row['address2'];
    $pin = $row['pincode'];
    $land = $row['landmark'];
} else {
    header('Location:404.php');
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="assets/js/c.js"></script>
    <title>Checkout</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="checkout_main_div mobile-flex-direction-reverse">
        <div class="checkout_left">
            <form method="post" class="save_profile_data">
                <br><br>
                <h3 class="left">Shipping Details</h3>
                <div class="flex_">
                    <div class="form_input">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" required value="<?php echo $fname; ?>" class="fname">
                    </div>
                    <div class="space"></div>
                    <div class="form_input">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" required value="<?php echo $lname; ?>" class="lname">
                    </div>
                </div>
                <div class="form_input">
                    <label for="company">Company</label>
                    <input type="text" name="company" value="<?php echo $company; ?>" class="company">
                </div>
                <div class="flex_">
                    <div class="form_input">
                        <label for="phone">Phone</label>
                        <input type="number" name="phone" required value="<?php echo $phone; ?>" class="phone">
                    </div>
                    <div class="space"></div>
                    <div class="form_input">
                        <label for="email">Email</label>
                        <input type="email" name="email" required value="<?php echo $email; ?>" class="email" disabled>
                    </div>
                </div>
                <div class="flex_">
                    <div class="form_input">
                        <label for="state">State</label>
                        <select onchange="print_city('state', this.selectedIndex);" id="s" required class="state">
                            <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                        </select>
                    </div>
                    <div class="space"></div>
                    <div class="form_input">
                        <label for="city">City</label>
                        <select id="state" required class="city">
                            <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                        </select>
                        <script>
                            print_state("s");
                        </script>
                    </div>
                </div>
                <div class="flex_">
                    <div class="form_input">
                        <label for="address1">Address line 1</label>
                        <input type="text" name="address1" required value="<?php echo $add1; ?>" class="address1">
                    </div>
                    <div class="space"></div>
                    <div class="form_input">
                        <label for="address2">Address line 2</label>
                        <input type="text" name="address2" required value="<?php echo $add2; ?>" class="address2">
                    </div>
                </div>
                <div class="form_input">
                    <label for="pincode">Pincode</label>
                    <input type="number" name="pincode" required value="<?php echo $pin; ?>" class="pincode">
                </div>
                <div class="form_input">
                    <label for="landmark">Landmark</label>
                    <input type="text" name="landmark" required value="<?php echo $land; ?>" class="landmark">
                </div>
                <button type="submit" class="margin-top save_profile_details btn-small">Save Details</button><br><br>
            </form>
        </div>
        <div class="space"></div>
        <div class="checkout_right">
            <div class="coupon_div">
                <p class="c_text_">Have a coupon? <a href="#" class="apply_coupon">Apply Now</a></p>
                <form class="form_coupon" id="coupon_form">
                    <div class="flex_">
                        <input type="text" id="coupon_code" class="coupon_" placeholder="Discount Coupon Code">
                        <button type="button" id="apply_coupon_btn">Apply Now</button>
                    </div>
                </form>
            </div>
            <div class="margin-top-20">
                <h3 class="center">Order Summary</h3>
                <div class="products_">
                    <div class="flex_ justify-bet">
                        <div>Products</div>
                        <div>Total</div>
                    </div>
                    <?php
                    $total = 0;
                    $sql = "SELECT cart.u_id as user, cart.p_id as prod, cart.qty as qty, item.name as name, item.price as price 
                            FROM item, cart 
                            WHERE cart.u_id='$me' AND cart.p_id=item.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $p_id = $row['prod'];
                            $name = $row['name'];
                            $qty = $row['qty'];
                            $price = $row['price'] * $qty;
                            echo '<div class="flex_ justify-bet">
                                    <div>
                                        <a href="single-product.php?id=' . $p_id . '">' . $name . '<span class="bold">&nbsp;&nbsp; x ' . $qty . '</span></a>
                                    </div>
                                    <div class="pro_price">$' . $price . '</div>
                                  </div>';
                            $total += $price;
                        }
                    }
                    ?>
                    <div class="flex_ justify-bet">
                        <div>
                            <a href="#"><span class="bold">Total</span></a>
                        </div>
                        <div class="pro_price bold"> <span class="t_price bold"><?php echo $total; ?></span></div>
                    </div>
                    <div class="flex_ justify-bet">
                        <div>
                            <a href="#"><span class="bold">Discount</span></a>
                        </div>
                        <div class="pro_price bold coupon_discount">0</div>
                        <div>
                            <a href="#"><span class="bold">Delivery</span></a>
                        </div>
                        <div class="pro_price bold coupon_discount">0</div>
                    </div>
                    <div class="flex_ justify-bet">
                        <div>
                            <a href="#"><span class="bold">Sub Total</span></a>
                        </div>
                        <div class="pro_price bold sub_total_price"><?php echo $total; ?></div>
                    </div>
                </div>
                <div style="padding: 25px; display: flex;">
                    <button type="button" class="margin proceed_payment" title="<?php echo $total; ?>">Pay & Continue</button>
                    <div class="space"></div>
                    <button type="button" class="margin cash_on_delivery" title="<?php echo $total; ?>">COD</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php require_once 'footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('apply_coupon_btn').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission

                var couponCode = document.getElementById('coupon_code').value.trim();
                if (couponCode === '') {
                    alert('Please enter a coupon code.');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'main/apply_coupon.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            document.querySelector('.coupon_discount').innerText = '₹' + response.discount;
                            document.querySelector('.sub_total_price').innerText = '₹' + response.new_total;
                            alert('Coupon applied successfully!');
                        } else {
                            alert(response.message);
                        }
                    }
                };
                xhr.send('coupon_code=' + encodeURIComponent(couponCode));
            });

            document.querySelector('.cash_on_delivery').addEventListener('click', function() {
                var totalAmount = this.title;
                console.log('Total Amount:', totalAmount); // Log the total amount for debugging
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'main/process_cod.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            console.log('XHR Response:', xhr.responseText); // Log the raw response
                            try {
                                var response = JSON.parse(xhr.responseText);
                                console.log('Parsed Response:', response); // Log the parsed response
                                if (response.success) {
                                    window.location.href = 'thank_you.php';
                                } else {
                                    alert(response.message);
                                }
                            } catch (e) {
                                console.error('Parsing Error:', e);
                                alert('An error occurred while processing your request.');
                            }
                        } else {
                            console.error('XHR Error:', xhr.status);
                        }
                    }
                };
                xhr.send('amount=' + encodeURIComponent(totalAmount));
            });
        });
    </script>
</body>
</html>
