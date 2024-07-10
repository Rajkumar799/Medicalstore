<?php
require "../config.php";
$u_id = $_SESSION["me"];
if ($_POST["action"] == "review") {
    if (!isset($_SESSION["me"])) {
        echo -1;
    } else {
        $p_id = $_SESSION["single-product-id"];
        $star = $_POST["star"];
        $title = $_POST["title"];
        $rev = $_POST["rev"];
        date_default_timezone_set("Asia/Kolkata");
        $today = date("d-m-Y");

        $sql="SELECT * FROM orders WHERE u_id='$u_id' and p_id='$p_id' and status='delivered'";
        //$result = $conn->query($sql);

          $rows =$conn->query($sql)->num_rows;
          if($rows>0){
          	/**/
          	$sql = "INSERT INTO `review`( `u_id`, `review`, `date`, `star`, `short_rev`, `p_id`) VALUES ('$u_id','$rev','$today','$star','$title','$p_id')";
        if ($conn->query($sql) === true) {
            /**/
            $sql = "UPDATE item set reviews=reviews+1 where id='$p_id'";
            if ($conn->query($sql) === true) {
                echo 1;
            } else {
                echo 0;
            }
            /**/
        } else {
            echo 0;
        }/**ENDS**/
       }else{
       	echo -200;
       }





        







    }
} elseif ($_POST["action"] == "review_delete") {
    $id = $_POST["id"];
    $sql = "DELETE from review where p_id='$id' and u_id='$u_id'";
    if ($conn->query($sql) === true) {
        $sql = "UPDATE item set reviews=reviews-1 where id='$id'";
        if ($conn->query($sql) === true) {
            echo 200;
        } else {
            echo "Error!";
        }
    } else {
        echo "Error!";
    }
}elseif ($_POST["action"] == "review_edit") {
    $id = $_SESSION['p_sess'];
    $star = $_POST["star"];
     $title = $_POST["title"];
    $rev = $_POST["rev"];
    $sql = "UPDATE review set `review`='$rev',`star`='$star',`short_rev`='$title' where p_id='$id' and u_id='$u_id'";
    if ($conn->query($sql) === true) {
        echo 1;
        $_SESSION['p_sess']=-1;
    } else {
        echo 0;
    }
}
?>
