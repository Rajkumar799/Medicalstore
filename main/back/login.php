<?php
session_start();
$today = date("d-m-Y");
include "../../back/smtp/PHPMailerAutoload.php";
include "../../config.php";

$shop_id = $_SESSION['shop_id'];

if ($_POST['action'] == "login") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    // Debugging lines - uncomment these to check input values
    // echo "Email: " . $email . " Password: " . $pass;

    if ($_POST['action'] == "login") {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
    
        if ($email == "rk@gmail.com" && $pass == "123") {
            $_SESSION['type'] = "admin";
            $_SESSION['shop_id'] = 1; // Example shop_id, set appropriately
            header("Location: ../index.php");
            exit();
        } else {
            echo "Wrong Credentials!";
        }
    }
} elseif ($_POST['action'] == "disable_product") {
    $id = $_POST['id'];
    $sql = "UPDATE `item` SET `disable`='1' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "enable_product") {
    $id = $_POST['id'];
    $sql = "UPDATE `item` SET `disable`='0' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "review_abuse") {
    $id = $_POST['id'];
    $sql = "DELETE FROM review WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE item set reviews=reviews-1 where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo 1;
        } else {
            echo "Error!";
        }
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "review_decline") {
    $id = $_POST['id'];
    $sql = "UPDATE `review` SET `abuse`='0' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "ban_user") {
    $id = $_POST['id'];
    $sql = "UPDATE `cust` SET `ban`='1' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "unban_user") {
    $id = $_POST['id'];
    $sql = "UPDATE `cust` SET `ban`='0' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "ban_shop") {
    $id = $_POST['id'];
    $sql = "UPDATE `shop` SET `ban`='1' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE item set disable=1 where shop_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo 1;
        } else {
            echo "Error!";
        }
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "unban_shop") {
    $id = $_POST['id'];
    $sql = "UPDATE `shop` SET `ban`='0' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE item set disable=0 where shop_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo 1;
        } else {
            echo "Error!";
        }
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "decline_shop") {
    $id = $_POST['id'];
    $sql = "DELETE from `shop` WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "accept_shop") {
    $id = $_POST['id'];
    $sql = "UPDATE `shop` SET `pending`='0' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "pick__") {
    $id = $_POST['id'];
    $t_ = $_POST['t_'];
    $sql = "UPDATE `orders` SET `status`='picked',pickup_time='$today',t_id='$t_' WHERE order_id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Send email function here...
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "del__") {
    $id = $_POST['id'];
    $sql = "UPDATE `orders` SET `status`='delivered',del_time='$today' WHERE order_id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Send email function here...
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "expire_coupon") {
    $id = $_POST['id'];
    $sql = "UPDATE `coupon` SET `expired`='1' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "delete_coupon") {
    $id = $_POST['id'];
    $sql = "DELETE FROM coupon WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "delete_cat") {
    $id = $_POST['id'];
    $sql = "DELETE FROM cat WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "delete_banner") {
    $id = $_POST['id'];
    $sql = "DELETE FROM banner WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
} elseif ($_POST['action'] == "create_coup") {
    $code = $_POST['code'];
    $discount = $_POST['discount'];
    $type = $_POST['type_'];
    $maxUse = $_POST['maxUse'];
    $description = $_POST['description'];
    $condition = $_POST['cond'];
    $maxCart = $_POST['maxCart'];

    $sql = "INSERT INTO `coupon` (`code`, `discount`, `type`, `max_use`, `des`, `cond`, `max_cart`) 
            VALUES ('$code', '$discount', '$type', '$maxUse', '$description', '$condition', '$maxCart')";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo $conn->error;
    }
}
?>
