<!-- for-mobile-apps -->
<!DOCTYPE html>
<html>
    <head>
        <title>Chicken Pot</title>
        <meta name="keywords" content="chickenpot,chicken,pot,Amritsaria Kulcha,Plan Paratha,Sabji,Aloo Paratha ,Curd,Egg Bhurji ,slice Bread,Boil Egg,Puri,Stuff Bread Role">
        <meta name="description" content="Order on 9888529294,9888429294. Order from Chickenpot online in Jalandhar | Home delivery Chickenpot menu.|
              you will be amazed to test the magic of chicken in the clay pot.">
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
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/jquery.mmenu.all.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/cubeportfolio.css" rel="stylesheet" type="text/css"> 
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/Tabs.css" rel="stylesheet" type="text/css"> 
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/bootstrap.css" rel="stylesheet" type="text/css"> 
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/selectbar.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/form-dropdown.css" rel="stylesheet" type="text/css">



        <!--js
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/form-dropdown.js"></script>
        -->

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
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/tabs.js"></script> 
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>chickenpot/js/jquery-ui-1.10.3.custom.js"></script> 


        <!--PreLoader-->
        <link href="<?php echo $this->request->webroot; ?>chickenpot/css/loader.css" rel="stylesheet" type="text/css">   


        <style>
            #snackbar {
                visibility: hidden;
                min-width: 80%;
                background-color: rgba(233, 185, 71,1);
                color: #222;
                text-align: center;
                border-radius: 4px;
                padding: 16px;
                position: fixed;
                z-index:  10001;
                left: 5%;
                right: 5%;
                bottom: 30px;
                font-size: 17px;
            }

            #snackbar.show {
                visibility: visible;
                -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }

            @-webkit-keyframes fadein {
                from {bottom: 0; opacity: 0;} 
                to {bottom: 30px; opacity: 1;}
            }

            @keyframes fadein {
                from {bottom: 0; opacity: 0;}
                to {bottom: 30px; opacity: 1;}
            }

            @-webkit-keyframes fadeout {
                from {bottom: 30px; opacity: 1;} 
                to {bottom: 0; opacity: 0;}
            }

            @keyframes fadeout {
                from {bottom: 30px; opacity: 1;}
                to {bottom: 0; opacity: 0;}
            }
        </style>
    </head>
    <body>
        <div id="wrap">

            <!--Start PreLoader-->

            <div id="preloader">
                <div id="status">&nbsp;</div>
                <div class="loader">
                    <h1>Loading...</h1>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <!--End PreLoader--> 

            <!--Start Header-->

            <header class="header-two">
                <div class="container">
                    <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]); ?>"><img class="logo2" src="<?php echo $this->request->webroot; ?>chickenpot/images/slides/logo2.png" alt="chickenpot logo"></a>
                    <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]); ?>"><img class="logo-dark" src="<?php echo $this->request->webroot; ?>chickenpot/images/slides/logo-dark.png" alt="chickenpot logo"></a>

                    <div class="cont-right">

                        <nav class="menu-5 nav">
                            <ul class="wtf-menu">
                                <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]); ?>">Home</a></li>
                                <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "ourstory"]); ?>">our story</a></li>
                                <!--
                                <li class="parent"><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "blog"]); ?>">Blog</a></li>
                                -->
                                <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "contactus"]); ?>">contact us</a></li>
                                <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "shop"]); ?>"><strong style="color: #90EE90;">online order</strong></a></li>
                                <?php if (!empty($user_details)) { ?>
                                    <li><a href="<?php echo $this->Url->build(["resturent" => "Users", "action" => "logout"]); ?>" type="button" >Log Out</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signin"]); ?>">Log In</a></li>
                                <?php } ?>
                                <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signup"]); ?>" >New User</a></li>
                            </ul>	
                        </nav>
                        <ul class="social-icons">
                            <li><a href="#."><i class="icon-facebook-1"></i></a></li>
                        </ul>

                        <!--          
                            <ul class="social-icons">
                                <li><a href="#."><i class="icon-facebook-1"></i></a></li>
                                <li><a href="#."><i class="icon-twitter-1"></i></a></li>
                                <li><a href="#."><i class="icon-google"></i></a></li>
                            </ul>
                        -->
                        <ul class="shop-bag">
                            <li class="close-bag"><a class="cart-button"><i class="icon-icons163"></i> <span class="num">
                                        <?php echo count($this->request->session()->read('cart_item')); ?></span></a></li>
                            <li class="open-bag" style="display: none;border-radius: 10px;height:400px;overflow-y:scroll">
                                <?php
                                $subtotal = "0.00";
//                                echo '<pre>'; print_r($this->request->session()->read('cart_item'));   die;
                                if (!empty($this->request->session()->read('cart_item'))) {
                                    foreach ($this->request->session()->read('cart_item') as $data) {
//                                        pr($data); 
                                        ?>

                                        <div class="cart-food" id="<?php echo $data['id']; ?>">
                                            <div class="detail">
                                                <a href="javascript:;" class="btn btn-danger pull-right" onclick="return deleteItem(<?php echo $data['id']; ?>,<?php echo"'". $data['foodsize']."'"; ?>);">
                                                    <i class="icon-icons163"></i></a>

                                                <img src="<?php echo $data['image']; ?>" alt="">
                                                <div class="text">
                                                    <?php $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']); ?>
                                                    <a href="#."><?php echo $data['foodname']; ?></a>
                                                    <p><span class="priceMoney hidden"><?php echo $data['foodprice']; ?></span>
                                                        <?php echo $data['foodsize']; ?>  &rightarrowtail;&nbsp;<?php echo $data['foodprice'] . ' x '; ?>
                                                        <input type="number" style="width:40px;" value="<?php echo $data['quantity']; ?>" id="changeValuePrice" min="1">
                                                        = <span id="calculatePrice"><?php echo ($data['foodprice'] * $data['quantity']); ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <h7>No food added in your cart.</h7>
                            <?php }
                            ?>
                            <div class="sub-total">

                                <span>SUBTOTAL: <i class="icon-inr"></i><strong><?= $subtotal ?></strong></span>
                                <span id="newtotal"></span>
                                <div class="buttons">
                                    <a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "shop"]); ?>" class="view-cart">More Food</a>
                                    <a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "viewcart"]); ?>" class="check-out">Check Out</a>
                                </div>
                            </div>
                            </li>
                        </ul>

                        <ul class="get-touch">
                            <li class="contact-no"><a><i class="icon-telephone-receiver"></i>
                                    <span>+91-9888529294</span></a></li>
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
                            <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]); ?>">Home</a></li>
                            <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "ourstory"]); ?>">OurStory</a></li>
                            <!--
                                <li class="parent"><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "blog"]); ?>">Blog</a></li>
                            -->
                            <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "contactus"]); ?>">Contact Us</a></li>
                            <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "shop"]); ?>"><strong style="color: #90EE90;">Online Order</strong></a></li>
                            <?php if (!empty($user_details)) { ?>
                                <li><a href="<?php echo $this->Url->build(["resturent" => "Users", "action" => "logout"]); ?>"  type="button" >Log Out</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo $this->Url->build(["controller" => "users", "action" => "signin"]); ?>">Log In</a></li>
                            <?php } ?>
                            <li><a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "signup"]); ?>" >New User</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Mobile Menu End -->

            <a href="#0" class="cd-top"></a>
        </div>

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

        <!--Register-->
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

        <!--End Register-->


        <script>
            $('.notify--dismissible').append('<button type="button" class="notify-close">&times;</button>');

            $('.notify-close').on('click', function () {
                $(this).closest('.notify').hide();
            });
            function deleteItem(id, foodsize) {
                if (confirm("Are you sure you want to delete this Item ?")) {
                    $.ajax({
                        type: "POST",
                        data: {id: id, foodsize: foodsize},
                        dataType: "html",
                        url: "<?php echo $this->request->webroot . 'resturent/deletecart' ?>",
                        success: function (data) {
                            if (data === '1') {
                                $('ul li.close-bag').find('span.num').text(parseInt($('ul li.close-bag').find('span.num').text()) - 1);
                                var new_price = parseInt($('div.sub-total').find('strong').text())
                                        - (parseInt($('div#' + id).find('span#calculatePrice').text()));
                                $('div.sub-total').find('strong').text(new_price);
                                $('ul.shop-bag li.open-bag div#' + id).remove();
                            }
                        }
                    });
                }
            }

            $(document).on('change', '#changeValuePrice', function () {
                var id = parseInt($('#changeValuePrice').parents('.cart-food').attr('id'));
                var value = parseInt($('#changeValuePrice').val());
                $.ajax({
                    type: "POST",
                    data: {id: id, value: value},
                    dataType: "html",
                    url: "<?php echo $this->request->webroot . 'resturent/updateQcart' ?>",
                    success: function (data) {
                        data = $.parseJSON(data);
                        if (data.code === '1') {
                            $('ul li.open-bag').html(data.cartvalue);
                        }
                    }
                });
            });
        </script>
        <div id="snackbar"></div>

    </body>
</html>


<script>
    function snackMessage(msg) {
        var x = document.getElementById("snackbar");
        x.innerHTML = msg;
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 5000);
    }
</script>
<style>
    .header-two .get-touch li.contact-no a {
        font-size: 20px;
        color: #337ab7;
    }
    .header-two .cart-button i {
        color:  #337ab7;
        font-size: 28px;
        line-height: 98px;
    }
    .header-two .social-icons li a {
        color: #337ab7;
        font-size: 20px;
    }
</style>


















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
    function register() {
        //alert('hello')

        var name = $('#name').val();
        var email = $('#regemail').val();
        var password = $('#regpassword').val();
        //alert
        //alert(name);
        $.ajax({
            type: "POST",
            data: {name: name, email: email, password: password},
            dataType: "json",
            url: "<?php echo $this->request->webroot . 'resturent/signup'; ?>",

            success: function (data) {
                if (data) {
                    // alert('something went wrong');
                    alert('you are successfully registered');
                    $.notify(data.msg, "success");
                } else {
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
    function login() {
        var email = $('#email').val();
        var pass = $('#password').val();
        $.ajax({
            type: "POST",
            data: {email: email, password: pass},
            dataType: "json",
            url: "<?php echo $this->request->webroot . 'resturent/signin'; ?>",
            success: function (data) {
                if (data.Ack == '1') {
                    //alert('kk');
                    //  window.location.href = "<?php echo $this->request->webroot . 'Users/dashboard'; ?>";
                    window.location.href = "";
                } else {
                    alert('Incorrect Password or Email');
                    //  $.notify('Incorrect Password or Email', "success");
                }
                //console.log(data);
            }
        });
        return(false);
    }

</script>