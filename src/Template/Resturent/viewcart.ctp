<!--Start Sub Banner-->
<div class="sub-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="detail">
					<h1>order now</h1>
					<span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
					<ul>
						<li>
							<a href="index.html">Home</a>
						</li>
						<li>
							<a class="select">Order Now</a>
						</li>
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

	<!--Start Shop Cart-->
	<div class="shop-cart">
		<div class="container">
			<div class="cart-products">
				<div class="row">
					<div class="col-md-12">

						<div class="titles">
							<div class="pro">
								<span>Product</span>
							</div>
							<div class="price">
								<span>Price</span>
							</div>
							<div class="quantity">
								<span>Quantity</span>
							</div>
							<div class="total">
								<span>Total</span>
							</div>
						</div>
						<?php
							$subtotal = "0.00";
							 if (!empty($this->request->session()->read('cart_item'))) {
								foreach ($this->request->session()->read('cart_item') as $data) {
								 $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']); ?>

							<div class="cart-pro-detail">

								<div class="food-pro">
									<img src="<?php echo $data['image']; ?>" alt="">
									<span>
										<?php echo $data['foodname']; ?>
									</span>
								</div>

								<div class="price">
									<span>
										<?php echo $data['foodprice'];?>
									</span>
								</div>

								<div class="quantity">
									<input name=" " type="text" value="<?php echo $data['quantity']; ?>">
								</div>

								<div class="total">
									<span id="calculatePrice">
										<?php echo ($data['foodprice'] * $data['quantity']); ?>
									</span>
								</div>

								<div class="cancel">
									<a href="javascript:;" onclick="return deleteItem(<?php echo $data['id']; ?>);">
										<i class="icon-cancel"></i>
									</a>
								</div>

							</div>
							<?php }}?>

							<div class="cart-update-sec">

								<div class="apply-coupon">
									<input name=" " type="text" onblur="if(this.value == '') { this.value='Enter Coupon Code'}" onfocus="if (this.value == 'Enter Coupon Code') {this.value=''}"
									 value="Enter Coupon Code">
									<a href="#.">apply coupon</a>
								</div>
								<a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "shop"]); ?>" class="update-cart">update cart</a>
							</div>
					</div>
				</div>
			</div>

			<div class="cash-decide">
				<div class="row">

					<div class="col-md-5">
						<div class="on-delivery">
							<a href="customer-info.html">cash on delivery</a>
						</div>
					</div>

					<div class="col-md-2">
						<div class="or">
							<h5>or</h5>
						</div>
					</div>

					<div class="col-md-5">
						<div class="cart-total">
							<h5>Cart Totals</h5>
							<div class="total-sec">
								<div class="sub-total-sec">
									<span class="left">Cart Subtotal</span>
									<span class="right">
										<span>SUBTOTAL:
											<strong>
												<?= $subtotal ?>
											</strong>
										</span>
									</span>
								</div>
								<div class="sub-total-sec">
									<span class="left">Shipping</span>
									<span class="right">Free Shipping</span>
								</div>
								<div class="order-total">
									<span class="left">Order Total</span>
									<span class="right"><i class="icon-inr"></i>
										<?= $subtotal ?>
									</span>
								</div>
								<?php if(!empty($user_details)){?>

								<a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "checkout"]); ?>" onclick="checkout();">proceed to checkout</a>
								<?php } else{?>
								<a href="<?php echo $this->Url->build(["controller" => "users", "action" => "signin"]); ?>">proceed to checkout</a>
								<?php }?>

							</div>

						</div>
					</div>

				</div>
			</div>


		</div>
	</div>
	<!--End Shop Cart-->

</div>
<!--End Content-->

<script>
	$('.notify--dismissible').append('<button type="button" class="notify-close">&times;</button>');

	$('.notify-close').on('click', function () {
		$(this).closest('.notify').hide();
	});
	function deleteItem(id) {
		if (confirm("Are you sure you want to delete this Item ?")) {
			$.ajax({
				type: "POST",
				data: { id: id },
				dataType: "html",
				url: "<?php echo $this->request->webroot . 'resturent/deletecart' ?>",
				success: function (data) {
					if (data == '1') {
						$('ul li.close-bag').find('span.num').text(parseInt($('ul li.close-bag').find('span.num').text()) - 1);
						var new_price = parseInt($('div.sub-total').find('strong').text().substring('1')) - (parseInt($('div#' + id).find('span#calculatePrice').text()));
						$('div.sub-total').find('strong').text('$' + new_price);
						$('ul.shop-bag li.open-bag div#' + id).remove();
						window.location.reload(true);

					}
				}
			});
		}
	}

	$(document).on('change', '#changeValuePrice', function () {
		var new_price = parseInt($(this).parent().find('span.priceMoney').text()) * parseInt($(this).val());
		console.log(new_price);
		$(this).parent().find('span#calculatePrice').text(new_price);
	});
</script>

<script>
	function checkout() {
		alert('hello');
	}

</script>