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

	<!--Start Shop-->
	<div class="shop">

		<!--Start Foods-->
		<div class="cbp-panel" style="max-width:1170px;">

			<div id="filters-container" class="cbp-l-filters-list ">
				<div data-filter="*" class="cbp-filter-item-active cbp-filter-item cbp-l-filters-list-first">ALL PRODUCTS</div>
				<div data-filter=".starters" class="cbp-filter-item">STARTERS</div>
				<div data-filter=".mains" class="cbp-filter-item">MAINS</div>
				<div data-filter=".salads" class="cbp-filter-item cbp-l-filters-list-last">SALADS</div>
			</div>

			<div id="grid-container" class="cbp shop-gallery">
				<?php foreach($getitem as $items){?>
					<div class="cbp-item <?php echo $items['food_category']?>">
						<a href="<?php echo $this->Url->build(["action" => "details", $items->id]); ?>">
							<img src="<?php echo $this->Url->build('/food_image/'.$items->image); ?>"
							 alt="<?php echo $items['foodname']?>">
							<div class="detail">
								<h6><?php echo $items['foodname']?></h6>
								<span><?php echo $items['description']?></span>
								<div class="price-cart">
									<span class="price hidden"><?php echo $items['price']?></span>
                                	<span class="item_<?php echo $items['id']?> hidden"></span>
                                	<span class="name hidden"><?php echo $items['foodname']?></span>
									<a href="#">
										<span class="price">Rs.:<?php echo $items['price']?></span>
									</a>
									<a href="#">
										<span class="cart">Rs.:<?php echo $items['price']?></span>
									</a>
								</div>
								<span class="small-tit"><a href="javascript:;" class="btn btn-success" 
									onclick="addtocart(<?php echo $items['id']?>)">ADD TO CART</a></span>
							</div>
						</a>
					</div>
				<?php }?>
			</div>

		</div>
		<!--End Foods-->
	</div>
	<!--End Shop-->
</div>
<!--End Content-->
	

<script>
function addtocart(id){
var foodprice = $('span.item_'+id).parent().find('span.price').text();
var foodname = $('span.item_'+id).parent().find('span.name').text();
var quantity = $('span.item_'+id).parent().find('input.quantity').val();
var image = $('span.item_'+id).parent().parent().find('img').attr('src');
$.ajax({
       type: "POST",
       data: {id:id,foodprice:foodprice,foodname:foodname,quantity:quantity,img:image},
       dataType:"html",
       url: "<?php echo $this->request->webroot.'resturent/addtokrt'?>", 
       beforeSend: function(){
            $('.modal-ax').css('display','block');
       },
       success: function(data){
        data=$.parseJSON(data);
         if(data.code=='1'){
            //var htmlView='<div class="cart-food" id="'+id+'"><div class="detail"><a href="javascript:;" class="btn btn-danger pull-right" onclick="return deleteItem('+id+');"><i class="icon-icons163"></i></a><img src="'+image+'" alt=""><div class="text"><a href="javascript:;">'+foodname+'</a><p><span class="priceMoney hidden">'+foodprice+'</span>'+foodprice+' x '+ quantity+' = <span id="calculatePrice">'+(foodprice * quantity)+'</span></p></div></div></div>';
            //console.log(htmlView);
            $('ul li.open-bag').html(data.cartvalue);
            $('ul li.close-bag').find('span.num').text(parseInt($('ul li.close-bag').find('span.num').text())+1);
            //var new_price=parseInt($('div.sub-total').find('strong').text().substring('1'))+(foodprice*quantity);
            //$('div.sub-total').find('strong').text('$'+new_price);
            //$('ul.shop-bag li.open-bag div.sub-total').before(htmlView);
           // alert(data.msg);
         }else{
            //alert(data.msg);
         }
        $('.modal-ax').css('display','none');
       }
    });
}
</script>
            
