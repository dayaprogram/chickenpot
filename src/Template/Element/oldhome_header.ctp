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
					
					<li><a href="<?php echo $this->request->webroot; ?>resturent/menu">Menu</a>
					
						<!--ul class="submenu">
							<li> <a href="menu.html">menu 1</a> </li>
							<li> <a href="menu2.html">menu 2</a> </li>
							<li> <a href="menu3.html">menu 3</a> </li>
						</ul-->
					</li>
					
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
                </ul>	
            </nav>
            
			<ul class="social-icons">
				<li><a href="#."><i class="icon-facebook-1"></i></a></li>
				<li><a href="#."><i class="icon-twitter-1"></i></a></li>
				<li><a href="#."><i class="icon-google"></i></a></li>
			</ul>
			
			<ul class="shop-bag">
				<li class="close-bag"><a class="cart-button"><i class="icon-icons163"></i> <span class="num">2</span></a></li>
				<li class="open-bag">
					<?php pr($this->Session->read('session'));
                                        foreach($this->Session->read() as $data){
                                            pr($data[0]);
                                            ?>
                                       
					<div class="cart-food">
						<div class="detail">
							<img src="images/cart-food1.jpg" alt="">
							<div class="text">
								<a href="#."><?php echo $data[0]['foodname']?></a>
								<p><?php echo $data[0]['foodprice']?></p>
							</div>
						</div>
					</div>
					<?php }
                                        ?>
					<div class="sub-total">
						<span>SUBTOTAL: <strong>$115.00</strong></span>
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
			
<script>
$('.notify--dismissible').append('<button type="button" class="notify-close">&times;</button>');

$('.notify-close').on('click',function(){
  $(this).closest('.notify').hide();
});
</script>


</body>
</html>
			
	









