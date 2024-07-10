<!DOCTYPE html>
<html>
<head>
    <?php
require "head.php";
require_once "config.php";
if(!isset($_SESSION['me'])){
                     header('Location:404.php');
                  }else{
                      $me=$_SESSION['me'];
                  }
    ?>
    <title>Track</title>
</head>
<body>
<?php
require 'header.php';
?>
 <div class="container flex_ margin-top-20 mobile-flex-direction">
    <div class="left_nav">
        <?php
      require_once "side_bar.php";
      ?>
    </div>
    <div class="space-50"></div>
    <div class="right_content">
         <?php
               $sql = "SELECT cust.name as name,cust.lname as lname,review.review as review,review.date as date,review.star as star,review.short_rev as title,review.id as id,review.p_id as p_id from cust,review where (cust.id=review.u_id and review.u_id='$me')";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                   // output data of each row
                   while ($row = $result->fetch_assoc()) {
                    $id=$row['id'];
                       $name = $row["name"] . " " . $row["lname"];
                       $date = date("d F Y", strtotime($row["date"]));
                       $title = $row["title"];
                       $review = $row["review"];
                       $star = $row["star"];
                        $p_id = $row["p_id"];
                       if ($star == "1") {
                           $starr = '<div>
                                          <i class="fas fa-star"></i>
                                       </div>';
                       } elseif ($star == "2") {
                           $starr =
                               '<div>
                                          <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                       </div>';
                       } elseif ($star == "3") {
                           $starr =
                               '<div>
                                          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                       </div>';
                       } elseif ($star == "4") {
                           $starr = '<div>
                                          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                       </div>';
                       } elseif ($star == "5") {
                           $starr = '<div>
                                          <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                       </div>';
                       }
                       echo '
                                          <div class="review_ margin-top-20">
                                    <div class="reviwer flex_ align-items">
                                       <img src="assets/images/user.png">
                                       &nbsp;&nbsp;
                                       <h3>' .
                           $name .
                           '</h3>
                                    </div>
                                    <div class="flex_ align-items margin-top-10">
                                    ' .
                           $starr .
                           '
                                       
                                       &nbsp;&nbsp;<span class="bold">' .
                           $title .
                           '</span>
                                    </div>
                                    <p class="review_time margin-top-10">' .
                           $date .
                           '</p>
                                    <p class="verified_purchase margin-top-10 bold"><a href="single-product.php?id='.$p_id.'">VIEW PRODUCT</a></p>
                                    <p class="main_review margin-top-10">
                                       ' .
                           $review .
                           '
                                    </p>
                                    
                                    <div class="flex_" >
                                    <button class="review_edit" title="'.$p_id.'">EDIT REVIEW</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <button class="review_delete" title="'.$p_id.'">DELETE REVIEW</button>
                                    </div>
                                 </div>
                                          ';
                   }
               } else {
                   echo '<p class="margin-top-20">No reviews yet!</p>';
               }
               ?>
               
    </div>
 </div>
 <br>
 <div style="height: 100vh;width:100%;background: #0000009e;position: fixed;top: 0;z-index: 100000000000;display: none;" class="show_re_edit" >
     <div style="padding: 30px;border-radius: 5px;margin:auto;background: #fff;width:500px;position: absolute;top:50%;left:50%;transform: translate(-50% , -50%);max-width: 95%;">
        <div class="flex_ justify-bet"><h3>Update Review</h3><span style="cursor: pointer;" class="update_rev_close">Close</span> </div>
         <div class="flex_ margin-top-20 feedback_star">
                                          <i class="fas fa-star" title="1"></i>
                                          <i class="fas fa-star" title="2"></i>
                                          <i class="fas fa-star" title="3"></i>
                                          <i class="fas fa-star" title="4"></i>
                                          <i class="fas fa-star" title="5"></i>
                                       </div>
                                       <input type="text" name="" class="star_count" hidden>
                                       <div class="form_input margin-top-20">
                                          <label for="">Title*</label>
                                          <input type="Title" placeholder="Title" class="review_title" style="width:400px;">
                                       </div>
                                       <div class="form_input margin-top-10">
                                          <label for="">Review*</label>
                                          <textarea placeholder="Review" class="review_feedback" style="width:400px;"></textarea>
                                       </div>
                                       <button class="margin-top-10 edit_review" style="width:100px;">Post</button>
     </div>
 </div>
 <br>
<?php require_once 'footer.php';?>
</body>
</html>