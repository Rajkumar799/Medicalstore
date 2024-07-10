<!DOCTYPE html>
<html>
<head>
	<?php
require "head.php";
require_once "config.php";
$ord_id=$_GET['id'];
$me=$_SESSION['me'];
	?>
	<title>Details - <?php echo $ord_id;?></title>
</head>
<body>
<?php
require 'header.php';
?>
 <div class="container flex_ margin-top-20 mobile-flex-direction">
 	<div class="left_nav margin-top-20">
 		<?php
      require_once "side_bar.php";
       $sql = "SELECT distinct(status) as status,order_time,pickup_time,del_time,t_id,coupon from orders where order_id='$ord_id'";
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                       $sta=$row['status'];
                       $order_time=$row['order_time'];
                       $pickup_time=$row['pickup_time'];
                       $del_time=$row['del_time'];
                       $t_=$row['t_id'];
                   
                       
                      }
                     }else{header('Location:404.php');}
      ?>
 	</div>
   <div class="product_journey margin-top-20">
      <?php
      if($sta=='ordered'){
         echo '
      <div class="product_journey_rel margin-top-20">
         

      <h4 class="abs_top">'.$order_time.'<p>ORDERED</p></h4>
       

      </div>';
   }elseif ($sta=="picked") {
       echo '
      <div class="product_journey_rel margin-top-20">
         <div class="flex_ flex-direction align-items" style="width: 20px;">
            <div class="circle fill-col"></div>
            <div class="line l1 fill-col"></div>
            <div class="circle c1 fill-col"></div>
            <div class="line l2"></div>
            <div class="circle c2"></div>
         </div>

         <h4 class="abs_top">'.$order_time.'<p>ORDERED</p></h4>
         <h4 class="abs_mid">'.$pickup_time.'<p>PICKED</p></h4>

      </div>';
   }
   elseif ($sta=="delivered") {
       echo '
      <div class="product_journey_rel margin-top-20">
         <div class="flex_ flex-direction align-items" style="width: 20px;">
            <div class="circle fill-col"></div>
            <div class="line l1 fill-col"></div>
            <div class="circle c1 fill-col"></div>
            <div class="line l2 fill-col"></div>
            <div class="circle c2 fill-col"></div>
         </div>

         <h4 class="abs_top">'.$order_time.'<p>ORDERED</p></h4>
         <h4 class="abs_mid">'.$pickup_time.'<p>PICKED</p></h4>
         <h4 class="abs_bottom">'.$del_time.'<p>DELIVERED</p></h4>

      </div>';
   }
      
      ?>
   </div>
 	<div class="right_content margin-top-mobile">
 		 <div class="checkout_right margin-top-20">
            <div>
               <h3 class="center">Order Summary</h3>
               <div class="products_">
                  <div class="flex_ justify-bet">
                     <div>Products</div>
                     <div>Total</div>
                  </div>
                  <?php
                     $total=0;
                     $sql = "SELECT orders.u_id as user,orders.discount as discount,orders.status as status,orders.p_id as prod,orders.qty as qty,item.name as name,item.price as price from item,orders where orders.u_id='$me' and orders.order_id='$ord_id' and item.id=orders.p_id";
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                       $p_id=$row['prod'];
                       $name=$row['name'];
                       $qty=$row['qty'];$discount=$row['discount'];
                       $price=$row['price']*$qty;
                        echo '<div class="flex_ justify-bet">
                          <div>
                            <a href="single-product.php?id='.$p_id.'">'.$name.'<span class="bold">&nbsp;&nbsp; x '.$qty.'</span></a>
                          </div>
                          <div class="pro_price">$'.$price.'</div>
                        </div>';
                        $total+=$price;
                      }
                     }
                     $conn->close();
                     
                     ?>
                  <div class="flex_ justify-bet">
                     <div>
                        <a href="#"><span class="bold">Total</span></a>
                     </div>
                     <div class="pro_price bold">$<?php echo $total;?></div>
                  </div>
                  <div class="flex_ justify-bet">
                     <div>
                        <a href="#"><span class="bold">Discount</span></a>
                     </div>
                     <div class="pro_price bold">$<?php echo (int)$discount;?></div>
                  </div>
                  <div class="flex_ justify-bet">
                     <div>
                        <a href="#"><span class="bold">Total Paid</span></a>
                     </div>
                     <div class="pro_price bold">$<?php echo (int)$total-(int)$discount;?></div>
                  </div>
               </div>
               
            </div>
            <button onclick=window.location.href="generate.php?ord_id=<?php echo $ord_id; ?>&ship=<?php echo $discount; ?>" >Download Invoice</button>
             <br><br>
            
            <?php
           
            if($t_==""){
               echo "<p>Once the product is picked you will get 'TRACKING ID' here!</p>";
            }
            else{
               echo "<p>Tracking Order :- ".$t_." /For Help call <a href='7995847197' target='blank'>Click Here to Call</a></p>";
            }
            ?>
         </div>
 	</div>
 </div><br>
 <?php include "footer.php";?>
</body>
</html>