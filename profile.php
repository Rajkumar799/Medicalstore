<!DOCTYPE html>
<html>
<head>
	<?php
require "head.php";
require_once "config.php";
 $me=$_SESSION['me'];  
   if(!isset($_SESSION['me'])){
     header('Location:404.php');
   }else{
   $sql = "SELECT *
           FROM cust
           WHERE id='$me'";
           $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
   
       // Assign fetched values to variables
       $fname = $row['name'];
       $lname=$row['lname'];
       $company = $row['company'];
       $phone = $row['phone'];
       $email = $row['email'];
       $state = $row['state'];
       $city = $row['city'];
       $add1 = $row['address1'];
       $add2 = $row['address2'];
       $pin = $row['pincode'];
       $land = $row['landmark'];
   } 
   
   
   
   }
	?>
	<title>My Profile</title>
   
<script src="assets/js/c.js"></script>
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
 		 <div class="checkout_left">
            <form method="post" class="save_profile_data">
               <br>
               <h3 class="left">Profile</h3>
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
                     <select onchange="print_city('state', this.selectedIndex);" id="s"  required class="state">      
                        <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
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
 	</div>
 </div>
 <br>
 <?php require "footer.php";?>
</body>
</html>