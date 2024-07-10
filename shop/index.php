<?php
session_start();
if (!isset($_SESSION['shop_id'])) {
    header("Location: login.php");
    exit();
}
$shop_id = $_SESSION['shop_id'];
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
   <?php require "inc/head.php"; ?>
   <title>Home</title>
</head>
<body>
   <?php require "inc/nav.php"; ?>
   <div class="flex_">
      <?php include "inc/sidebar.php"; ?>
      <div class="right">
         <?php
         $ord_pen = 0;
         $ord_con = 0;
         $total_pen = 0;
         $total_con = 0;
         $tot_rev = 0;
         $total_ = 0;
         $p_id_ = array();

         $sql = "SELECT * FROM item WHERE shop_id='$shop_id'";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $tot_rev += intval($row['reviews']);
                 $total_ += 1;
                 array_push($p_id_, $row['id']);
             }
         }
         $_SESSION['products'] = $p_id_;
         $sql = 'SELECT * FROM orders WHERE p_id IN (' . implode(',', array_map('intval', $p_id_)) . ')';
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 if ($row['status'] == "delivered" || $row['status'] == "picked") {
                     $ord_con += $row['qty'];
                     $total_con += $row['price'] * $row['qty'];
                 } elseif ($row['status'] == "ordered") {
                     $ord_pen += $row['qty'];
                     $total_pen += $row['price'] * $row['qty'];
                 }
             }
         }
         ?>
         <div class="padding">
            <h3 class="page-title">Dashboard</h3><br>
            <div class="row row_ flex_ flex-wrap">
               <!-- Column -->
               <div class="col-md-6 col-lg-2 col-xlg-3">
                  <div class="card card-hover">
                     <div class="box bg-cyan text-center">
                         <h3 class="text-white"><?php echo $total_; ?></h3>
                        <h6 class="text-white">Total Products</h6>
                     </div>
                  </div>
               </div>
               <!-- Column -->
               <div class="col-md-6 col-lg-4 col-xlg-3">
                  <div class="card card-hover">
                     <div class="box bg-success text-center">
                           <h3 class="text-white"><?php echo $ord_con; ?></h3>
                        
                        <h6 class="text-white">Confirmed Orders</h6>
                     </div>
                  </div>
               </div>
               <!-- Column -->
               <div class="col-md-6 col-lg-2 col-xlg-3">
                  <div class="card card-hover">
                     <div class="box bg-warning text-center">
                         <h3 class="text-white"><?php echo $ord_pen; ?></h3>
                        <h6 class="text-white">Pending Orders</h6>
                     </div>
                  </div>
               </div>
               <!-- Column -->
               <div class="col-md-6 col-lg-2 col-xlg-3">
                  <div class="card card-hover">
                     <div class="box bg-danger text-center">
                         <h3 class="text-white"><?php echo $total_con; ?></h6>
                        <h6 class="text-white">Confirmed Payment</h6>
                     </div>
                  </div>
               </div>
               <!-- Column -->
               <div class="col-md-6 col-lg-2 col-xlg-3">
                  <div class="card card-hover">
                     <div class="box bg-info text-center">
                        <h3 class="text-white"><?php echo $total_pen; ?></h3>
                        <h6 class="text-white">Pending Payments</h6>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2 col-xlg-3">
                  <div class="card card-hover">
                     <div class="box bg-warning text-center">
                        <h3 class="text-white"><?php echo $tot_rev; ?></h3>
                        <h6 class="text-white">Total Reviews</h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>
</html>
