<!-- for-mobile-apps -->
<!DOCTYPE html>
<html><head>
        <title>Welcome to Pearl</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/pearl-restaurant.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/fonts/pearl-icons.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/default-color.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/dropmenu.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/sticky-header.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/countdown.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/settings.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/extralayers.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/date-pick.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/form-dropdown.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/jquery.mmenu.all.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/cubeportfolio.css" rel="stylesheet" type="text/css"> 
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/Tabs.css" rel="stylesheet" type="text/css"> 
         <link href="<?php echo $this->request->webroot; ?>css/bootstrap.css" rel="stylesheet" type="text/css"> 
         <link href="<?php echo $this->request->webroot; ?>css/style.css" rel="stylesheet" type="text/css"> 



        <!---js----->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.js"></script>

        <!-- SMOOTH SCROLL -->	
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/SmoothScroll.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/scroll-desktop.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/scroll-desktop-smooth.js"></script>

        <!-- START REVOLUTION SLIDER -->

        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.themepunch.revolution.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.themepunch.tools.min.js"></script>

        <!-- Paralllax background -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/parallax.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/countdown.js"></script>

        <!-- Countdown -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/owl.carousel.js"></script>

        <!-- Owl Carousel -->

        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/cart-detail.js"></script>





        <!-- START REVOLUTION SLIDER -->

        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.themepunch.revolution.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.themepunch.tools.min.js"></script>
        <!-- Mobile Menu -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.mmenu.min.all.js"></script>


        <!-- Gallery Portfolio -->	
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.cubeportfolio.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/main.js"></script>


        <!-- All Scripts -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/custom.js"></script> 
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/cart-detail.js"></script> 
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery.mmenu.min.all.js"></script> 
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/tabs.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .text{
               margin: 0 0 0 13px;
            }
        </style>


    </head>
    <body>



        <div id="wrap">

            <!--Start PreLoader-->
            <!--div id="preloader">
                         <div id="status">&nbsp;</div>
                         <div class="loader">
                                 <h1>Loading...</h1>
                                 <span></span>
                                 <span></span>
                                 <span></span>
                         </div>
                 </div-->
            <!--End PreLoader--> 

            <!--Start Header-->

            <header class="header-two">
                <div class="container">
                    <a href="index.html"><img class="logo2" src="images/logo2.png" alt=""></a>
                    <a href="index.html"><img class="logo-dark" src="images/logo-dark.png" alt=""></a>

                    <div class="cont-right">

                        <nav class="menu-5 nav">
                            <ul class="wtf-menu">
                                <li class="select-item"><a href="#.">Home</a>
                                    <ul class="submenu">
                                        <li> <a href="#" class="select">Home 1</a> </li>
                                        <li> <a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "home2"]); ?>">Home 2</a> </li>
                                    </ul>
                                </li>

<!--                                <li><a href="<?php echo $this->request->webroot; ?>resturent/menu">Menu</a>

                                    ul class="submenu">
                                            <li> <a href="menu.html">menu 1</a> </li>
                                            <li> <a href="menu2.html">menu 2</a> </li>
                                            <li> <a href="menu3.html">menu 3</a> </li>
                                    </ul
                                </li>-->

                                <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "ourstory"]); ?>">our story</a></li>


                                <li class="parent"><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "blog"]); ?>">Blog</a>

                                    <!--ul class="submenu">
                    <li><a href="blog.html">blog 1</a></li>
                                            <li><a href="blog2.html">blog 2</a></li>
                                    </ul-->

                                </li>


                                <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "contactus"]); ?>">contact us</a>

                                    <!--ul class="submenu">
                                            <li><a href="contact-us.html">contact-us 1</a></li>
                                            <li><a href="contact-us2.html">contact-us 2</a></li>
                                    </ul-->

                                </li>

                                <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "shop"]); ?>">online order</a></li>
                                
                                 <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Log In</a></li>
                                <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#register">SIGNUP</a></li>
                            </ul>	
                        </nav>

<!--                        <ul class="social-icons">
                            <li><a href="#."><i class="icon-facebook-1"></i></a></li>
                            <li><a href="#."><i class="icon-twitter-1"></i></a></li>
                            <li><a href="#."><i class="icon-google"></i></a></li>
                        </ul>-->

                        <ul class="shop-bag">
                            <li class="close-bag"><a class="cart-button"><i class="icon-icons163"></i> <span class="num"><?php echo count($this->request->session()->read('cart_item'));?></span></a></li>
                            <li class="open-bag" style="display: none;background-color: slategrey;border-radius: 10px;">
                                <?php
                                $subtotal = "0.00";
//                                echo '<pre>'; print_r($this->request->session()->read('cart_item'));   die;
                                if (!empty($this->request->session()->read('cart_item'))) {
                                    foreach ($this->request->session()->read('cart_item') as $data) {
//                                        pr($data); 
                                        ?>

                                        <div class="cart-food" id="<?php echo $data['id']; ?>">
                                            <div class="detail">
                                                <a href="javascript:;" class="btn btn-danger pull-right" onclick="return deleteItem(<?php echo $data['id']; ?>);"><i class="icon-icons163"></i></a>
                                                <img src="<?php echo $data['image']; ?>" alt="">
                                                <div class="text">
                                                    <?php $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']); ?>
                                                    <a href="#."><?php echo $data['foodname']; ?></a>
                                                    <p><span class="priceMoney hidden"><?php echo $data['foodprice'];?></span>
                                                        <?php echo $data['foodprice'] . ' x '.$data['quantity']; ?>
                                                        <input type="number" style="width:40px;" value="<?php echo $data['quantity']; ?>" id="changeValuePrice">
                                                        = <span id="calculatePrice"><?php echo ($data['foodprice'] * $data['quantity']); ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                
                                    <?php }
                                } else {
                                    ?>
                                    <h7>No Card added to your account.</h7>
                                <?php }
                                ?>
                                <div class="sub-total">
                                    
                                    <span>SUBTOTAL: <strong>$<?= $subtotal ?></strong></span>
                                    <span id="newtotal"></span>
                                    <div class="buttons">
                                        <a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "viewcart"]); ?>" class="view-cart">view cart</a>
                                        <a href="#." class="check-out">Check Out</a>
                                    </div>
                                </div>


                            </li>
                        </ul>

                        <ul class="get-touch">
                            <li class="contact-no"><a><i class="icon-telephone-receiver"></i> <span>+123 55 33 444</span></a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <!--End Header-->
            <!-- Mobile Menu Start -->
            <div class="container">
                <div id="page">
                    <header class="header">
                        <a href="#menu"></a>

                    </header>

                    <nav id="menu">
                        <ul>
                            <li class="select"><a href="#.">Home</a>
                                <ul>
                                    <li class="select"> <a href="index.html">Home Page 1</a> </li>
                                    <li> <a href="index2.html">Home Page 2</a> </li>
                                </ul>
                            </li>
                            <li><a href="#.">Fresh Menu</a>
                                <ul>
                                    <li> <a href="menu.html">Menu 1</a> </li>
                                    <li> <a href="menu2.html">Menu 2</a> </li>
                                    <li> <a href="menu3.html">Menu 3</a> </li>
                                </ul>
                            </li>

                            <li><a href="our-story.html">Our Story</a></li>


                            <li><a href="#.">Blog</a>
                                <ul>
                                    <li> <a href="blog.html">Blog 1</a> </li>
                                    <li> <a href="blog2.html">Blog 2</a> </li>
                                </ul>
                            </li>

                            <li><a href="#.">Contact Us</a>
                                <ul>
                                    <li> <a href="contact-us.html">Contact-us 1</a> </li>
                                    <li> <a href="contact-us2.html">Contact-us 2</a> </li>
                                </ul>
                            </li>

                            <li><a href="shop.html">Order Online</a></li>
                            <li><a href="#book-table">Book a Table</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Mobile Menu End -->
            
             <!-- Modal -->
<div class="modal fade loginModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <h3 class="text-center text-white MB15">Sign In</h3>
        <form method='post' onsubmit='return login();'>
          <div class="input-group MB15">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="email" type="email" class="form-control" required name="email" placeholder="Enter your email">
          </div>
          <div class="input-group MB15">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" required class="form-control" name="Password" placeholder="Password">
          </div>
          <div class="MB15 clearfix">
            <a href="javascript:void(0)" class="pull-left text-theme"  data-toggle="modal"  type="button" data-target="#forgotpass" data-dismiss="modal">Forget Password</a>
            <a href="javascript:void(0)" class="pull-right text-theme"  data-toggle="modal"  type="button" data-target="#register" data-dismiss="modal">Create an account</a>
          </div>
          <div class="text-center">
            <button type="submit" name="button" class="btn btn-theme" >Log In</button> 
           
          </div>
        </form>
      </div>
     </div>
  </div>
</div>
            
            <!---Register---->
<div class="modal fade loginModal" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <h3 class="text-center text-white MB15">Create New Account</h3>
       <div class="msg" style="color:white;"></div>
        <form method='post' onsubmit='return register();'>
         <div class="input-group MB15">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="name" type="text" class="form-control" required name="name" placeholder="Enter your name">
          </div>
          <div class="input-group MB15">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="regemail" type="email" class="form-control" required name="email" placeholder="Enter your email">
          </div>
          <div class="input-group MB15">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="regpassword" type="password" required class="form-control" name="Password" placeholder="Password">
          </div>
          <div class="text-center">
            <button type="submit" name="button" class="btn btn-theme" >Signup</button> 
           
          </div>
        </form>
      </div>
     </div>
  </div>
</div>

<!-----End Register----->


            <script>
                $('.notify--dismissible').append('<button type="button" class="notify-close">&times;</button>');

                $('.notify-close').on('click',function(){
                    $(this).closest('.notify').hide();
                });
                function deleteItem(id){
                    if(confirm("Are you sure you want to delete this Item ?")){
                        $.ajax({
                            type: "POST",
                            data: {id:id},
                            dataType:"html",
                            url: "<?php echo $this->request->webroot . 'resturent/deletecart' ?>", 
                            success: function(data){
                                if(data=='1'){
                                    $('ul li.close-bag').find('span.num').text(parseInt($('ul li.close-bag').find('span.num').text())-1);
                                    var new_price=parseInt($('div.sub-total').find('strong').text().substring('1'))-(parseInt($('div#'+id).find('span#calculatePrice').text()));
                                    $('div.sub-total').find('strong').text('$'+new_price);
                                    $('ul.shop-bag li.open-bag div#'+id).remove();
                                }
                            }
                        });
                    }
                }
                
                $(document).on('change','#changeValuePrice',function(){
                    var new_price=parseInt($(this).parent().find('span.priceMoney').text()) * parseInt($(this).val());
                    console.log(new_price);
                    $(this).parent().find('span#calculatePrice').text(new_price);
                    
                });
            </script>
            
    </body>
</html>



 <!-- <script>
$.ajax({url:"/Users/signin",type:"POST", data:$('#formLogin').serialize(), dataType:"json", success:responseLogin, context:this});

 function responseLogin(response)
 {
     //here is the object returned by cakephp
     if(!response.success)
        //do something the user don't login
     else
       //do something the user pass the login
 }
</script> -->
<!----scriptt----->
<script>
    function register(){
	//alert('hello')

      var name = $('#name').val();
      var email = $('#regemail').val();
      var password = $('#regpassword').val();
      //alert
      //alert(name);
      $.ajax({
       type: "POST",
       data: {name:name, email:email, password:password},
       dataType:"json",
       url: "<?php echo $this->request->webroot . 'resturent/signup'; ?>",

       success: function(data){
          if(data){
		 // alert('something went wrong');
		 alert('you are successfully registered');
		 $.notify(data.msg, "success");
       }
       else{
	    alert('something went wrong');
      // $.notify(data.msg, "success");
       }
    }
 });
      window.opener.location.reload();
      return(false);
    }

  </script>
  <!---------------->
  
  <script>
    function login(){
      var email = $('#email').val();
      var pass = $('#password').val();
      $.ajax({
       type: "POST",
       data: {email:email, password:pass},
       dataType:"json",
       url: "<?php echo $this->request->webroot . 'resturent/signin'; ?>",
       success: function(data){
        if(data.Ack =='1'){
          //alert('kk');
          //  window.location.href = "<?php echo $this->request->webroot . 'Users/dashboard'; ?>";
             window.location.href = "";
        }
        else{
            alert('Incorrect Password or Email');
         //  $.notify('Incorrect Password or Email', "success");
        }
       //console.log(data);
   }
});
      return(false);
    }

  </script>
  











