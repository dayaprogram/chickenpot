<!--Start Sub Banner-->
   <div class="sub-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="detail">
						<h1>the menu</h1>
						<span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a class="select">Menu</a></li>
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
		
		<!--Start The Menu-->
		<div class="our-menu">
			<div class="container">
				<div class="row">
				<?php foreach($getitem as $items){?>
					<div class="col-md-4">
						<div class="food-sec">
							<img src="<?php echo $this->Url->build('/food_image/'.$items->image); ?>" alt="">
							<div class="detail">
								<span class="food-time">Rs.<?php echo $items['price']?></span>
                                                                    <input type="text" name="price"  id="price" value="<?php echo $items['price']?>">
                                                                    <input type="text" name="id" id="id" value="<?php echo $items['id']?>">
                                                                     <input type="text" name="name" id="name" value="<?php echo $items['foodname']?>">
                                                                    <input type="text" name="quantity" id="quantity" value="1">
								<span class="small-tit"><a onclick="addtocart(<?php echo $items['id']?>)">ADD TO CART</a></span>
								<a href="<?php echo $this->Url->build(["action" => "details", $items->id]); ?>"><h6><?php echo $items['foodname']?></h6></a>
								<p><?php echo $items['description']?></p>
							</div>
						</div>
					</div>
					<?php }?>
					
					
				</div>
			</div>
		</div>
		<!--End The Menu-->
		
	</div>	
   <!--End Content-->
<script>
function addtocart(id){

var foodprice = $('#price').val();
var foodname = $('#name').val();
var quantity = $('#quantity').val();
var id =  $('#id').val();
$.ajax({
       type: "POST",
       data: {id:id,foodprice:foodprice,foodname:foodname,quantity:quantity},
       dataType:"html",
       url: "<?php echo $this->request->webroot.'resturent/addtokrt'?>", 
       success: function(data){
         
          
       }
    });
}
</script>
	