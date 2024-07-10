 <footer class="footer">
        
         <div class="foot container">
            <div class="f1">
               <h4 class="logo_white"><img src="assets/images/logo.jpg"></h4>
               
<p>Founder Bandla Dinesh</p>
              
            </div>
            <div class="f2">
               <h4 class="wh">Useful Links</h4>
               <ul class="f_links">
                  <li><a href="about.php">About</a></li>
                  <li><a href="#">Our Services</a></li>
                  <li><a href="#">How to shop</a></li>
                  <li><a href="#">FAQs</a></li>
                  <li><a href="contact.php">Conatct Us</a></li>
                  
               </ul>
            </div>
            <div class="f3">
               <h4 class="wh">Customer Service</h4>
               <ul class="f_links">
                 <li><a href="#">Payment Methods</a></li>
                  <li><a href="#">Shiping</a></li>
                  <li><a href="terms_and_conditions.php">Terms & Conditions</a></li>
               </ul>
            </div>
            <div class="f4">
               <h4 class="wh">Account</h4>
               <ul class="f_links">
                 <li><a href="cart.php">View Cart</a></li>
                  <li><a href="wishlist.php">View Wishlist</a></li>
                  <li><a href="track.php">Track Orders</a></li>
                  <li><a href="#">Help</a></li>
               </ul>
            </div>
            
         </div>
         <div class="copyright">
            <p class="upper" style="padding-left: 80px;">Copyright&copy;<span class=2024></span> | Andhrameds</p>
         </div>

      </footer>
      <a class="back-to-top flex_ align-items justify-content-center" href="#" id="goTopBtn"><i class="fas fa-angle-up" style="color: #fff;"></i></a>
      <script type="text/javascript">
         function openmenu(a) {console.log(a);
            if(a=="open"){
 $(".mobile-menu").css({"transform":"translateX(0)"});}
             if(a=="close"){
 $(".mobile-menu").css({"transform":"translateX(-100%)"});}

}const goTopBtn = document.getElementById("goTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        goTopBtn.style.display = "block";
    } else {
        goTopBtn.style.display = "none";
    }
};

// Function to scroll to the top when the button is clicked
function scrollToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
}
      </script>