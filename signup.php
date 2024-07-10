<?php 

include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
<?php include 'head.php'; ?>
  <title>SignUp</title>
  <style>
      .box{
        width: 500px;
        max-width: 95%;
        padding: 30px;
        background: #fff;
        border:1px solid var(--s);
        margin: auto;
        margin-top: 30px;

      }
  </style>
</head>
<body>
    
  <?php include 'header.php'; ?>
 <div class="box">
     <h2>SignUp</h2><br>
     <form class="sign">
        
                  <div class="form_input">
                     <label for="fname">Mobile Number</label>
                     <input type="number" name="fname" required  class="mobile">
                  </div>
                  
                  <div class="form_input">
                     <label for="lname">Email</label>
                     <input type="email" name="lname" required  class="email">
                  </div>
              
               <div class="form_input">
                  <label for="company">Password</label>
                  <input type="password" name="company" class="password">
               </div>
               <button type="submit" class="signup">Sign Up</button>
     </form>
     
 </div>
 <script type="text/javascript">
    $(document).ready(function() {
        $(".sign").on("submit", function(e) {
            e.preventDefault(); // Prevent the default form submission
            
            var m = $(".mobile").val();
            var e = $(".email").val();
            var p = $(".password").val();
            
            $.post("back/login.php", { action: "signup", m: m, e: e, p: p }, function(res) {
                if (res == 1) {
                    alert("Signup successful! Now Login!");
                    // Optionally, redirect to login page or perform other actions
                } else {
                    alert("Some error occurred!");
                }
            });
        });
    });
</script>

</body>
</html>