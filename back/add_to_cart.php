<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require "../config.php";
if ($_POST["action"] == "add_to_cart") {
    $p_id = $_POST["p_id"];
    $add_qty = $_POST["qty"];$size = $_POST["size"];
    if (!isset($_SESSION["me"])) {
        echo -1;
    } else {

        /**** EXTRA LINES ****/
 $sql="SELECT * from item where id='$p_id' and num>=$add_qty";
$result = $conn->query($sql);
if ($result->num_rows ==1) {
/**** EXTRA LINES ****/


        /******/
        $u_id = $_SESSION["me"];
        $sql = "SELECT * from cart where u_id='$u_id' and p_id='$p_id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $sql = "UPDATE cart SET qty='$add_qty' where p_id='$p_id' and u_id='$u_id'";

            if ($conn->query($sql) === true) {
                echo "Already Exist";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {

            /** INSERT **/
                    $sql = "INSERT INTO cart (u_id, p_id,qty,size)
                    VALUES ('$u_id', '$p_id','$add_qty','$size')";

                    if ($conn->query($sql) === true) {
                    echo "Product Added!";

                    $_SESSION["cart_"] += 1;
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            /**INSERT ENDS*/
        }
        /***********************/
/**** EXTRA LINES **/

    }




    else{
echo 0;


    }

/**** EXTRA LINES ***/

    }
} /**/ elseif ($_POST["action"] == "buy_now") {
    $p_id = $_POST["p_id"];
    $qty = $_POST["qty"];$size = $_POST["size"];


        /**** EXTRA LINES ****/
 $sql="SELECT * from item where id='$p_id' and num>=$qty";
$result = $conn->query($sql);
if ($result->num_rows ==1) {
/**** EXTRA LINES ****/


        /******/


    if (!isset($_SESSION["me"])) {
        echo -1;
    } else {
        $u_id = $_SESSION["me"];
        $sql = "SELECT * from cart where u_id='$u_id' and p_id='$p_id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                if ($row["qty"] == $qty) {
                    echo 200;
                } else {
                    $sql = "UPDATE  cart set qty='$qty' where u_id='$u_id' and p_id='$p_id'";
                    if ($conn->query($sql) === true) {
                        echo 200;

                        $_SESSION["cart_"] += 1;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        } else {
            $sql = "INSERT INTO cart (u_id, p_id,qty,size) VALUES ('$u_id', '$p_id','$qty','$size')";

            if ($conn->query($sql) === true) {
                echo 200;
                $_SESSION["cart_"] += 1;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }


/**** EXTRA LINES **/

    }




    else{
echo 0;


    }

/**** EXTRA LINES ***/



} elseif ($_POST["action"] == "delete_cart") {
    $p_id = $_POST["id"];
    $u_id = $_SESSION["me"];
    $sql = "DELETE FROM cart where u_id='$u_id' and p_id='$p_id'";
    if ($conn->query($sql) === true) {
        echo 200;
        $_SESSION["cart_"] -= 1;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($_POST["action"] == "delete_wish") {
    $p_id = $_POST["id"];
    $sql = "DELETE FROM wishlist where id='$p_id'";
    if ($conn->query($sql) === true) {
        echo 200;
        $_SESSION["wish_"] -= 1;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($_POST["action"] == "update_cart_") {
    $p_id = $_POST["id"];
    $u_id = $_SESSION["me"];
    $qty = $_POST["qty"];


   /**** EXTRA LINES ****/
$sql="SELECT * from item where id='$p_id' and num>=$qty";
$result = $conn->query($sql);
if ($result->num_rows ==1) {
/**** EXTRA LINES ****/

    $sql = "UPDATE cart SET qty='$qty' where p_id='$p_id' and u_id='$u_id'";
    if ($conn->query($sql) === true) {
        echo 200;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


/**** EXTRA LINES **/

    }




    else{
echo 0;


    }

/**** EXTRA LINES ***/

} elseif ($_POST["action"] == "add_wish") {
    if (!isset($_SESSION["me"])) {
    } else {
        $p_id = $_POST["id"];
        $u_id = $_SESSION["me"];
        /***/
        $sql = "SELECT * from wishlist where u_id='$u_id' and p_id='$p_id'";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "Already in wishlist!";
        } else {
            $sql = "INSERT INTO wishlist (u_id, p_id) VALUES ('$u_id','$p_id')";

            if ($conn->query($sql) === true) {
                echo "Product Added!";
                $_SESSION["wish_"] += 1;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    /***/
} elseif ($_POST["action"] == "coupon") {
    $me = $_SESSION["me"];
    /**/
    $total = 0;
    $sql = "SELECT cart.u_id as user,cart.p_id as prod,cart.qty as qty,item.name as name,item.price as price from item,cart where cart.u_id='$me' and cart.p_id=item.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $qty = $row["qty"];
            $price = $row["price"] * $qty;

            $total += $price;
        }
    }
    /**/
    $code = $_POST["code"];
    $sql = "SELECT * FROM coupon where code='$code' and expired='0' and (max_use>used_yet)";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $discount = (int) $row["discount"];
            $code = $row["code"];
            $type = $row["type"];
            $max_use = $row["max_use"];
            $used_yet = $row["used_yet"];
            $expired = $row["expired"];
            $date = $row["date"];
            $des = $row["des"];
            $max_cart = $row["max_cart"];
            $cond = $row["cond"]; // 1(for first puchase) 2(for cart value>amount) 3(for all)
            if ($expired == "1" || (int) $max_use == (int) $used_yet) {
                echo 0;
            } else {
                if ($cond == "1") {
                    $sql = "SELECT * FROM orders where u_id='$me'";
                    $result = $conn->query($sql);
                    if ($result->num_rows >= 1) {
                        echo -1;
                    } else {
                        $_SESSION["code_applied"] = 1;
                        $_SESSION["code"] = $code;
                        if ($type == "PERCENT") {
                            $p = $total * ($discount / 100);
                        } else {
                            $p = $discount;
                        }
$_SESSION['discount']=$p;
                        echo json_encode([$p, "success"]);
                    }
                } elseif ($cond == "2") {
                    
                    if ((int) $total >= (int) $max_cart) {
                        $_SESSION["code_applied"] = 1;
                        $_SESSION["code"] = $code;
                        if ($type == "PERCENT") {
                            $p = $total * ($discount / 100);
                        } else {
                            $p = $discount;
                        }
                         $_SESSION['discount']=$p;
                        echo json_encode([$p, "success"]);
                    } else {
                        echo -2;
                    }
                } elseif ($cond == "3") {
                    $_SESSION["code_applied"] = 1;
                    $_SESSION["code"] = $code;
                    if ($type == "PERCENT") {
                        $p = $total * ($discount / 100);
                    } else {
                        $p =$discount;
                    }$_SESSION['discount']=$p;

                    echo json_encode([$p, "success"]);
                }
            }
        }
    } else {
        echo 0;
    }
}elseif ($_POST['action']=="remove_history") {
$id=$_POST['id'];
$me=$_SESSION['me'];
$sql="DELETE FROM history where id='$id' and u_id='$me'";
if($conn->query($sql)===TRUE){
   echo 1;
}else{
   echo $conn->error;
}
}
?>
