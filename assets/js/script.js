$(document).ready(function () {
   const t = document.body,
      s = /\$/g;

   function a(t, s,size='-') {
      $.post("back/add_to_cart.php", {
         action: "add_to_cart",
         p_id: t,
         qty: s,
         size:size
      }, function (t) {
         if(-1 == t){
            ($(".black_layer").show(), $(".my_login_div").animate({
            width: "80%",
            "max-width": "1000px",
            height: "80vh"
         }, 100));
         }else if(t == 0){
            ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Quantity > Stock</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));
         }
           else{
            ($("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));
           } 
      })
   }! function t(a) {
      if (a.nodeType === Node.TEXT_NODE) a.textContent = a.textContent.replace(s, "₹");
      else if (a.nodeType === Node.ELEMENT_NODE)
         for (let s = 0; s < a.childNodes.length; s++) t(a.childNodes[s])
   }(t), $(".toggle-search").click(function () {
      $(".toggle_search").slideToggle(100)
   }), $(".logo,.mob-logo").click(function () {
      window.location.href = "/"
   }), $(".show-single-product-details,.show-single-product-add,.show-single-product-review").click(function () {
      $(".show-single-product-details,.show-single-product-add,.show-single-product-review").css({
         color: "#7a7a7a"
      }), $(".show-single-product-details,.show-single-product-add,.show-single-product-review").removeClass("active-link"), $(this).css({
         color: "#222"
      }), $(".single-product-details,.single-product-add,.single-product-review").hide(50);
      var t = $(this).attr("class");
      $("." + t.slice(5)).css({
         display: "block"
      })
   }), $(".owl-nav .owl-prev").html('<i class="fas fa-angle-left" style="color:#fff;"></i>'), $(".owl-nav .owl-next").html('<i class="fas fa-angle-right" style="color:#fff;"></i>'), $(".show_login").click(function () {
      $(".black_layer").show(), $(".my_login_div").animate({
         width: "80%",
         "max-width": "1000px",
         height: "80vh"
      }, 100)
   }), $(".login_cross").click(function () {
      $(".black_layer").hide(), $(".my_login_div").animate({
         width: "0%",
         "max-width": "0",
         height: "0"
      })
   }), $(".send_otp").click(function () {
      var t = $(".login_email").val();
      $(".send_otp").text("SENDING OTP..."), $.post("back/login.php", {
         action: "send_otp",
         email: t
      }, function (t) {
         1 == t ? ($(".otp_inp").show(), $(".login_btn_hide").show(), $(".send_otp").hide(), $("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : Mail Sent!</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3)) : ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Email not Sent!</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3), $(".send_otp").text("Login"))
      })
   }), $(".all_cat_").click(function () {
      $(".cat_options").slideToggle(100)
   }), $(".login_").click(function () {
      var t = $(".login_email").val(),
         s = $(".otp_login").val();
      $.post("back/login.php", {
         action: "login",
         email: t,
         otp: s
      }, function (t) {
         if(t==200){
($("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span> Success : Login Successful</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));
setTimeout(function() {
   location.reload()
},3000);


}  
else{($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Some error!</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));}
      })
   }), $(".add_to_wish").click(function () {
      var t = $(this).attr("title");
      $.post("back/add_to_cart.php", {
         action: "add_wish",
         id: t
      }, function (t) {
         200 == t ? ($("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : Added to Wishlist</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3)) : ($("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3))
      })
   }), $(".remove_item_cart").click(function () {
      var t = $(this).attr("title");
      $.post("back/add_to_cart.php", {
         action: "delete_cart",
         id: t
      }, function (t) {
         200 == t ? location.reload() : ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3))
      })
   }), $(".remove_item_wish").click(function () {
      var t = $(this).attr("title");
      $.post("back/add_to_cart.php", {
         action: "delete_wish",
         id: t
      }, function (t) {
         200 == t ? location.reload() : ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3))
      })
   }), $(".review_delete").click(function () {
      var t = $(this).attr("title");
      $.post("back/review.php", {
         action: "review_delete",
         id: t
      }, function (t) {
         200 == t ? ($("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : Review Deleted!</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3)) : ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3))
      })
   });
   $(".review_edit").click(function(){
      var p_id=$(this).attr("title");
  
      $(".show_re_edit").show(10);
      $.post("p_sess.php",{action:"p_sess",id:p_id},function(res) {
         
      });
   });$(".show_payment_option").click(function(){
      
      $(".show_re_edit").show(10);
     
   });

   $(".edit_review").click(function () {
    var t = $(".star_count").val(),
        s = $(".review_title").val(),
        a = $(".review_feedback").val();

    if (t !== "" && s !== "" && a !== "") {
        $.post("back/review.php", {
            action: "review_edit",
            star: t,
            title: s,
            rev: a
        }, function (response) {
            if (response ==1) {
                $("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : Review Edited</span></span>');
                setTimeout(function () {
                    $(".toast").fadeOut(100);
                }, 3000); $(".show_re_edit").hide();
            }
            else if(response==0){
$("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Some Error Occured!</span> </span>');
        setTimeout(function () {
            $(".toast").fadeOut(100);
        }, 3000);
            }
            // Handle other response statuses if needed
        });
    }
});
$(".update_rev_close").click(function () {
 $(".show_re_edit").hide();
});
   $(".cart_update").click(function () {
      var t = $(this).attr("title"),
         s = $(this).siblings(".first_des").children().children(".qty_main_div").children().text();
      $.post("back/add_to_cart.php", {
         action: "update_cart_",
         qty: s,
         id: t
      }, function (t) {
         if(t==200){
             location.reload();
         }
         else if(t==0){
            ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Quantity > Stock</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));
         }else{
            ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : '+t+'</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));
         }
      })
   }), $(document).on("click", ".add_to_cart", function () {
      a($(this).data("pid"), $(".qty_increased").text(),$(".size_paste").val())
   }), $(document).on("click", ".add_cart", function () {
      a($(this).data("pid"), 1)
   }), $(document).on("click", ".load_more_prod", function () {
    $.post("back/get-data.php", {}, function (t) {
       for (var s = JSON.parse(t), a = 0; a < s.length; a++) {
    var e = s[a].id,
        n = s[a].name,
        i = s[a].price,
        o = s[a].img1,
        c = s[a].reviews,
        stock = s[a].stock,
        discount = s[a].discount,
        max = s[a].max_price,num = s[a].num,
        discountHtml = '';

    if (discount > 0) {
        discountHtml = '<p class="discount">' + discount + '% OFF</p>';
    }

    var productHtml = '<div class="product"><a href="single-product.php?id=' + e + '"> <div class="product_img"> <img src="prod/' + o + '" class="transform">' + discountHtml + ' <button class="btn-outline-heart"> <img src="assets/images/heart.svg" title="Add to Wishlist"> </button> </div> </a><div class="product_des"> <p class="product_name">' + n + '</p> <div class="flex_ padding st__"> <p class="product_stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p> <p class="product_rev">(' + c + ' Reviews)</p> </div> <div class="flex_ padding margin-bottom-20 margin-top-10 justify-align cart_and_price"> <div>';

    if (stock == 0 || num==0) {
        productHtml += '<button class="btn-outline margin-top-10 p_no_stock" style="color:var(--red);border:1px solid var(--red);">OUT OF STOCK</button>';
    } else {
        productHtml += '<button class="btn-outline margin-top-10 add_cart" data-pid="' + e + '">Add to Cart</button>';
    }

    productHtml += '</div> <p class="product_price">';
    
    if (discount > 0) {
        productHtml += '<span class="pr_dis">₹' + max + '</span>';
    }
    
    productHtml += '₹' + i + '</p> </div> </div> </div>';

    $(".product_page_right").append(productHtml);
}


        var a = $(".product_page_right>.product").width();
        var windowWidth = window.innerWidth;

        // Log the window width to the console
        //console.log("Window width: " + windowWidth + " pixels");

        if (windowWidth <= 600) {
            $(".product_img").css({ 'height': parseInt(a) + 20 + 'px' });
            $(".product_img>img").css({ 'height': parseInt(a) + 20 + 'px', 'width': a + 'px' });
            $(".product_name").each(function () {
                // Check if text length exceeds 40 characters
                if ($(this).text().length > 40) {
                    // Trim the text to 40 characters and add ellipsis
                    var trimmedText = $(this).text().substring(0, 40) + "...";
                    // Set the updated text
                    $(this).text(trimmedText);
                }
            });
            //$(".product_page_right .add_cart").html('<i class="fas fa-cart-arrow-down"></i>');
        }
    });
});
$(document).on("click", ".list_load_more_prod", function () {
    $.post("back/get-data.php", {}, function (t) {
      console.log(t);
       for (var s = JSON.parse(t), a = 0; a < s.length; a++) {
    var e = s[a].id,
        n = s[a].name,
        i = s[a].price,
        o = s[a].img1,
        c = s[a].reviews,
        stock = s[a].stock,
        discount = s[a].discount,shop = s[a].shop,
        max = s[a].max_price,num = s[a].num,short_des = s[a].des_short,
        discountHtml = '';
        if (discount > 0) {
        discountHtml = '<p class="p_dis">' + discount + '% OFF</p>';
    }
    if (stock == 0 || num==0) {
        stock = '<button class="btn-outline margin-top-10 p_no_stock" style="color:var(--red);border:1px solid var(--red);">OUT OF STOCK</button>';
    } else {
        stock = '<button class="btn-outline margin-top-10 add_cart" data-pid="' + e + '">Add to Cart</button>';
    }
        productHtml='<div class="p_list flex_ margin-bottom-10"> <div class="image_and_dis"> <img src="prod/'+o+'">'+discountHtml+' </div> <div class="flex_ align-items justify-content mobile-flex-direction no-align-center" style="width:100%;"> <div class="flex_ flex-direction p_list_p justify-content-center"> <p class="p_list_shop_name">'+shop+'</p> <a class="p_list_p_name margin-top-10" href="single-product.php?id='+e+'">'+n+'</a> <p class="p_list_des margin-top-10">'+short_des+'</p> </div> <div class="p_details flex_ justify-content-center flex-direction"> <p class="product_price" style="transform: translateX(0);"><span class="pr_dis">₹'+max+'</span>₹'+i+'</p> <div class="flex_ margin-top-10"> <p class="product_stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p> &nbsp; <p class="product_rev">(0 Reviews)</p> </div> <div class="flex_ align-items margin-top-10">'+stock+'&nbsp;&nbsp; <button class="p_wish_btn add_to_wish" title="'+e+'"> <img src="assets/images/heart.svg" title="Add to Wishlist"> </button> </div> </div> </div> </div>';

    $(".product_page_right").append(productHtml);
}


        //var a = $(".product_page_right>.product").width();
        //var windowWidth = window.innerWidth;

        // Log the window width to the console
        //console.log("Window width: " + windowWidth + " pixels");

        /*if (windowWidth <= 600) {
            $(".product_img").css({ 'height': parseInt(a) + 20 + 'px' });
            $(".product_img>img").css({ 'height': parseInt(a) + 20 + 'px', 'width': a + 'px' });
            $(".product_name").each(function () {
                // Check if text length exceeds 40 characters
                if ($(this).text().length > 40) {
                    // Trim the text to 40 characters and add ellipsis
                    var trimmedText = $(this).text().substring(0, 40) + "...";
                    // Set the updated text
                    $(this).text(trimmedText);
                }
            });
            //$(".product_page_right .add_cart").html('<i class="fas fa-cart-arrow-down"></i>');
        }*/
    });
}); $(".buy_product_now").click(function () {
      var t = $(this).attr("p-id"),
         s = $(".qty_increased").text(),size = $(".size_paste").val();
      $.post("back/add_to_cart.php", {
         action: "buy_now",
         p_id: t,
         qty: s,size:size
      }, /*function (t) {
         -1 == t ? ($(".black_layer").show(), $(".my_login_div").animate({
            width: "80%",
            "max-width": "1000px",
            height: "80vh"
         }, 100)) : 200 == t ? window.location.href = "checkout.php" : ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3))
      })
   }),*/function (t) {
         if(t==200){
             window.location.href = "checkout.php";
         }
         else if(t==0){
            ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Quantity > Stock</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));
         }else if(t==-1){
            ($(".black_layer").show(), $(".my_login_div").animate({
            width: "80%",
            "max-width": "1000px",
            height: "80vh"
         }, 100));
         }
         else{
            ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : '+t+'</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3));
         }
      })
   }),$(".proceed_payment").click(function() {
        var t = $(this).attr("title"),
            s = $(".fname").val(),
            a = $(".phone").val(),
            e = $(".email").val(),
            n = t;
        if ("" != s && "" != a && "" != e) {
            var i = new Razorpay({
                key: "rzp_test_OXruRqJ6qMIrKK",
                name: "Company Name",
                description: "Payment",
                image: "https://yt3.ggpht.com/ytc/AL5GRJV8C79mjvuZKWalgTdrO7QnpREZNbj66eP1rV9I4g=s240-c-k-c0x00ffffff-no-rj",
                prefill: {
                    name: s,
                    email: e,
                    contact: a
                },
                theme: {
                    color: "#0989ff"
                },
                amount: 100 * n,
                currency: "INR",
                handler: function(t) {
                     window.location.href = "capture.php?amount=" + 100 * parseInt(n) + "&id=" + t.razorpay_payment_id
                },
                modal: {
                    ondismiss: function() {
                        $("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Payment not done!</span> </span>'), setTimeout(function() {
                            $(".toast").fadeOut(100)
                        }, 3e3)
                    }
                }
            });
            i.on("payment.failed", function(t) {
                $("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Payment Failed</span> </span>'), setTimeout(function() {
                    $(".toast").fadeOut(100)
                }, 3e3)
            }), i.open()
        } else $("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error :  Fill all fields</span> </span>'), setTimeout(function() {
            $(".toast").fadeOut(100)
        }, 3e3)
    }), 
$(".save_profile_data").on("submit", function (t) {
      t.preventDefault();
      var s = {
         action: "save_data",
         fname: $(".fname").val(),
         lname: $(".lname").val(),
         company: $(".company").val(),
         phone: $(".phone").val(),
         email: $(".email").val(),
         state: $(".state").val(),
         city: $(".city").val(),
         address1: $(".address1").val(),
         address2: $(".address2").val(),
         pincode: $(".pincode").val(),
         landmark: $(".landmark").val()
      };
      $.post("back/save_profile.php", s, function (t) {
         $("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Error : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3), window.location.href = window.location.href
      })
   }), $(".news_form").on("submit", function (t) {
      t.preventDefault();
      var s = {
         action: "letter",
         email: $(".news__").val()
      };
      $.post("back/news.php", s, function (t) {
         1 == t ? ($("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : Email Saved!</span> </span>'), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3)) : ($("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : ' + t + "</span> </span>"), setTimeout(function () {
            $(".toast").fadeOut(100)
         }, 3e3))
      })
   }), $(".qty_inc").click(function () {
      var t = $(".qty_increased").text(),
         s = parseInt(t);
      $(".qty_increased").text(s + 1)
   }), $(".qty_dec").click(function () {
      var t = $(".qty_increased").text(),
         s = parseInt(t);
      1 != s && $(".qty_increased").text(s - 1)
   }), $(".cart_qty_inc").click(function () {
      var t = $(this).siblings(".qty_main_div").children(".cart_qty_increased").text(),
         s = parseInt(t);
      $(this).siblings(".qty_main_div").children(".cart_qty_increased").text(s + 1)
   }), $(".cart_qty_dec").click(function () {
      var t = $(this).siblings(".qty_main_div").children(".cart_qty_increased").text(),
         s = parseInt(t);
      1 != s && $(this).siblings(".qty_main_div").children(".cart_qty_increased").text(s - 1)
   }), $(".single-product-imgs>img").click(function () {
      var t = $(this).attr("src");
      $(".product-big-image>img").attr("src", t)
   }), $(".feedback_star i").click(function () {
      var t = $(this).attr("title");
      $(".star_count").val(t), $(".feedback_star i").css({
         color: "var(--l)"
      }), $(this).prevAll().css({
         color: "var(--yellow)"
      }), $(this).css({
         color: "var(--yellow)"
      })
   });
    $(".submit_review").click(function () {
    var t = $(".star_count").val(),
        s = $(".review_title").val(),
        a = $(".review_feedback").val();

    if (t !== "" && s !== "" && a !== "") {
        $.post("back/review.php", {
            action: "review",
            star: t,
            title: s,
            rev: a
        }, function (response) {
            if (response == -1) {
                $(".black_layer").show();
                $(".my_login_div").animate({
                    width: "80%",
                    "max-width": "1000px",
                    height: "80vh"
                }, 100);
            }else if(response==-200){
               $("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : The product is not delivered yet!</span> </span>');
        setTimeout(function () {
            $(".toast").fadeOut(100);
        }, 3000); 
            }else if(response==1){
               $("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : Review Added</span></span>');
                setTimeout(function () {
                    $(".toast").fadeOut(100);
                }, 3000);
            }else if(response==0){
               $("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Some Error Occured!</span> </span>');
        setTimeout(function () {
            $(".toast").fadeOut(100);
        }, 3000); 
            }
             /*else {
                $("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : ' + response + "</span> </span>");
                setTimeout(function () {
                    $(".toast").fadeOut(100);
                }, 3000); // 3000 milliseconds = 3 seconds
            }*/
        });
    } else {
        $("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Field not filled</span> </span>');
        setTimeout(function () {
            $(".toast").fadeOut(100);
        }, 3000); // 3000 milliseconds = 3 seconds
    }
});

    $(".search_bar_inp").keyup(function () {
      var t = $(this).siblings(".purpose").val(),
         s = $(this).val();
      $(".show_search").empty(), "0" == t ? $.post("back/search.php", {
         action: "search",
         data: s
      }, function (t) {
        // console.log(t.items.length);
         for (var s = 0; s < t.items.length; s++) $(".show_search").append("<li class='search_anchor'><a href='single-product.php?id=" + t.items[s].id + "'>" + t.items[s].name + "</a><li>")
      }) : $.post("back/search.php", {
         action: "search_shop",
         data: s
      }, function (t) {
        // console.log(t.items.length);
         for (var s = 0; s < t.items.length; s++) $(".show_search").append("<li class='search_anchor'><a href='shop_prod.php?id=" + t.items[s].id + "'>" + t.items[s].name + "</a><li>")
      })
   });
    $(".apply_coupon").click(function() {
       // body...
      $(".c_text_").hide();
      $(".coupon_div form").show();
    });
    $(".form_coupon").on("submit",function(e) {
e.preventDefault();
var code=$(".coupon_").val();
$.post("back/add_to_cart.php",{action:"coupon",code:code},function(res) {//console.log(res);
  if(res==0){
   alert("Invalid Code");
  }
  else if(res==-1){
alert("Offer is not valid for you!");
  }else if(res==-2){
alert("Offer requires a certain cart value!");
  }else{var d=JSON.parse(res);
   if(d[1]=='success'){ alert("Code Applied!");
      var a=parseInt(d[0]);
      $(".coupon_discount").text("₹"+d[0]);
      var am= parseInt($(".t_price").text());
      //console.log(typeof am);console.log(typeof a);
      var total=am-a;
      $(".sub_total_price").text("₹"+total);
      $(".proceed_payment").attr('title',am-a);
   }
  }
   
});
    });
 /* $(".size-button").click(function() {
    // Reset styles for all size buttons
    $(".size-button").css({"background":"#fff","color":"#333"});

    // Highlight the clicked button
    $(this).css({"background":"var(--p)","color":"#fff"});

    // Get and set the value in the input field
    var selectedSize = $(this).text();
    $(".size_paste").val(selectedSize);
});*/
$(".tabs_ span").click(function() {
   $(".tabs_ span").removeClass('active-link-tab');
   $(this).addClass('active-link-tab');
   $(".p-des,.p-specs,.p-rev").fadeOut(100);
   $("."+$(this).attr('title')).fadeIn(100);
});
$(".pc_search_button").click(function() {
   window.location.href="product.php?search="+$(".pc_search_input").val();
});$(".mobile_search_button").click(function() {
   window.location.href="product.php?search="+$(".mobile_search_input").val();
});$(".apply_filters").click(function() {
   $(".product_page_left").slideToggle(500);
});

$(".remove_history").click(function() {
  var id=$(this).attr('title');
  $.post("back/add_to_cart.php",{action:"remove_history",id:id},function(res) {//console.log(res);
  if(res==1){
    $("body").append('<span class="toast succ"> <i class="fas fa-check" style="font-size: 18px;"></i>   <span>Success : History Removed!</span> </span>');
        setTimeout(function () {
            $(".toast").fadeOut(100);
        }, 3000);
  }else{
 $("body").append('<span class="toast error"> <i class="fas fa-times" style="font-size: 18px;"></i>   <span>Error : Unable to delete!</span> </span>');
        setTimeout(function () {
            $(".toast").fadeOut(100);
        }, 3000);
  }
});});

});