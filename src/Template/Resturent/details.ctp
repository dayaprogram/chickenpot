<!--Start Sub Banner-->
   <div class="sub-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="detail">
						<h1>order now</h1>
						<span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a class="select">Order Now</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-img"></div>
   </div>
   <div class="wave"></div>
   
   <!--End Sub Banner-->

				

   
   
   <!--Start Content-->
	<div class="content">
		
		<!--Start Shop Detail-->
			<div class="shop-detail">
				<div class="container">
					
					<div class="row">
						<div class="col-md-12">
							<div class="after-cart">
								
								<div class="text">
									<i class="icon-check2"></i>
									<span>"Blanched Garlic" was Successfully added to your Cart.</span>
								</div>
								<a href="shop-cart.html">view cart</a>
								
							</div>
						</div>
					</div>
					
					
					
					<div class="product-detail">
						<div class="row">
							
							<div class="col-md-6">
								<div class="pro-image"><img src="<?php echo $this->Url->build('/food_image/'.$getitem->image); ?>" alt=""></div>
							</div>
							
							<div class="col-md-6">
								<div class="pro-detail">
									
									<h3><?php echo $getitem['foodname']?></h3>
                                                                       <input type="text" id="foodname" value="<?php echo $getitem['foodname']?>">
																	   <input type="text" id="id" value="<?php echo $getitem['id']?>">
									<div class="review">
										<i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i> <span>(3 customer reviews)</span>
									</div>
									<span class="price">RS.<?php echo $getitem['price']?></span>
                                                                        <input type="text" id="price" value="<?php echo $getitem['price']?>">
									<p><?php echo $getitem['description']?></p>
                                                                            <div>
									<div class="pro-cart" style="float:left;">
										<div class="input-group">
                                                                                    <span class="input-group-btn">
                                                                          <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                                                          <span class="glyphicon glyphicon-minus"></span>
                                                                          </button>
                                                                        </span>
                                                                      <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
                                                                        <span class="input-group-btn">
                                                                           <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                                         <span class="glyphicon glyphicon-plus"></span>
                                                                             </button>
                                                                                      </span>
                                                                                         </div>
                                                                                          </div>
                                                                                      <div class="pro-cart">
										<a class="cart" onclick="order(<?php echo $getitem['id']?>);">add to cart</a>
									</div>
                                                                          </div>
									<span class="categories"><strong>Categories:</strong>   Food booth, Restaurant</span>
									
									<div class="social-icons">
										<ul>
											<li><a href="#." class="fb"><i class="icon-facebook-1"></i> <span>Share On Facebook</span></a></li>
											<li><a href="#." class="tw"><i class="icon-twitter-1"></i> <span>Tweet This Product</span></a></li>
											<li><a href="#." class="pi"><i class="icon-pinterest-p"></i> <span>Pin This Product</span></a></li>
										</ul>
									</div>
									
								</div>
							</div>
							
						</div>
					</div>
					
					
					<div class='openTabby' id='tabs1'>
    <div class='openTabby--slidesContainer'>

      <article id='1' data-tab-name='Description' class='openTabby--slide'>
       <div class="description-text">
       		<h3>Description</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac tortor at tellus feugiat congue quis ut nunc. Semper ac dolor vitae accumsan. interdum hendrerit lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae ultricies eget.</p>
       </div>
      </article>

      <article id='2' data-tab-name='reviews ( 3 )' class='openTabby--slide'>
        
        <div class="all-reviews">
        	<h6>3 Reviews for Pearl</h6>
            
            <div class="review-sec">
            	
                <div class="reviewer-name"><img src="images/review.jpg" alt=""></div>
                
                <div class="review-detail">
                	
                    <div class="reviewer">
                    	<span class="name">Maria</span>
                        <span class="date">April 7, 2016</span>
                    </div>
                    
                    <div class="rating">
                    	<i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                    </div>
                    
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 	 	 				text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                    
                </div>
                
            </div>
            <div class="review-sec">
            	
                <div class="reviewer-name"><img src="images/review.jpg" alt=""></div>
                
                <div class="review-detail">
                	
                    <div class="reviewer">
                    	<span class="name">Maria</span>
                        <span class="date">April 7, 2016</span>
                    </div>
                    
                    <div class="rating">
                    	<i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                    </div>
                    
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 	 	 				text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                    
                </div>
                
            </div>
            <div class="review-sec">
            	
                <div class="reviewer-name"><img src="images/review.jpg" alt=""></div>
                
                <div class="review-detail">
                	
                    <div class="reviewer">
                    	<span class="name">Maria</span>
                        <span class="date">April 7, 2016</span>
                    </div>
                    
                    <div class="rating">
                    	<i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                        <i class="icon-star-full"></i>
                    </div>
                    
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 	 	 				text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                    
                </div>
                
            </div>
            
            
            <div class="add-review">
            	<h6>Add a Review</h6>
                <div class="form">
                	<input name=" " type="text" value="Your Name">
                    <input name=" " type="text" value="Email Address">
                	
                    	<div class="rating">
                            <a href="#1" title="Give 1 stars"><i class="icon-star-full"></i></a>
                            <a href="#2" title="Give 2 stars"><i class="icon-star-full"></i></a>
                            <a href="#3" title="Give 3 stars"><i class="icon-star-full"></i></a>
                            <a href="#4" title="Give 4 stars"><i class="icon-star-full"></i></a>
                            <a href="#5" title="Give 5 star"><i class="icon-star-full"></i></a>
                        </div>
                        <div class="clear"></div>
                        <textarea name=" " cols="1" rows="1">Your Feedback</textarea>
                        <input name=" " type="submit" value="Submit">
    
                </div>
            </div>
            
        </div>
        
      </article>



    </div>
  </div>
					
					<div class="related-products">
					
					<div class="row">
						<div class="col-md-12">
							<div class="main-title">
								<span>Related Products</span>
								<h1>similar foods</h1>
							</div>
						</div>
					</div>
				
					<div  class="shop-gallery">
						<div class="row">
							
							<div class="col-md-4">
								<div class="cbp-item mains salads">
					
									<a href="shop-detail.html">
										<img src="images/menu/dish-img5.jpg" alt="">
										<div class="detail">
											<h6>Spicy Blanched Garlic</h6>
											<span>Fresh<span class="dot">.</span> light<span class="dot">.</span> Mexican</span>
												
												<div class="price-cart">
													<a href="#."><span class="price">$12.25</span></a>
													<a href="#."><span class="cart">add to cart</span></a>
												</div>
												
										</div>
									</a>
				
								</div>
							</div>
							
							
							<div class="col-md-4">
								<div class="cbp-item mains salads">
					
									<a href="shop-detail.html">
										<img src="images/menu/dish-img4.jpg" alt="">
										<div class="detail">
											<h6>Spicy Blanched Garlic</h6>
											<span>Fresh<span class="dot">.</span> light<span class="dot">.</span> Mexican</span>
												
												<div class="price-cart">
												<a href="#."><span class="price">$12.25</span></a>
												<a href="#."><span class="cart">add to cart</span></a>
												</div>
												
										</div>
									</a>
				
								</div>
							</div>
							
							
							<div class="col-md-4">
								<div class="cbp-item mains salads">
					
									<a href="shop-detail.html">
										<img src="images/menu/dish-img6.jpg" alt="">
										<div class="detail">
											<h6>Spicy Blanched Garlic</h6>
											<span>Fresh<span class="dot">.</span> light<span class="dot">.</span> Mexican</span>
												
												<div class="price-cart">
												<a href="#."><span class="price">$12.25</span></a>
												<a href="#."><span class="cart">add to cart</span></a>
												</div>
												
										</div>
									</a>
				
								</div>
							</div>
								
								
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
		<!--End Shop Detail-->
   
   </div>
   <!--End Content-->
<script>
function order(id){
var foodprice = $('#price').val();
var foodname = $('#foodname').val();
var quantity = $('#quantity').val();
var id =  $('#id').val();
$.ajax({
       type: "POST",
       data: {id:id,foodprice:foodprice,foodname:foodname,quantity:quantity},
       dataType:"html",
       url: "<?php echo $this->request->webroot.'resturent/addorder'?>", 
       success: function(data){
          //console.log(data.foodname);
          
       }
    });
}
</script>
<script>
$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});
</script>

<style>
.input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group {
    z-index: 2;
    margin-left: -345px;
}
//.shop-detail .product-detail .pro-cart a {
    
 //   margin-left: -285px;
//    margin-top: 33px;

    
//}
</style>
	