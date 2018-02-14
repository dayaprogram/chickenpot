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

                            <div class="quantity">
                                <span>Price * Quantity</span>
                            </div>
                            <div class="total">
                                <span>Pot Pack</span>
                            </div>
                            <div class="total">
                                <span>Total</span>
                            </div>
                        </div>
                        <?php
                        $subtotal = 0.00;
                        $totalpotpackcharge = 0.00;
                        $foodbillAmt = 0.00;
                        if (!empty($this->request->session()->read('cart_item'))) {
                            foreach ($this->request->session()->read('cart_item') as $data) {
                                if ($data['potpackflg'] == 'A') {
                                    $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']) +
                                            ($data['packCharge'] * $data['quantity']);
                                } else {
                                    $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']);
                                }
                                $foodbillAmt = $foodbillAmt + ($data['foodprice'] * $data['quantity']);
                                ?>

                                <div class="cart-pro-detail">

                                    <div class="food-pro">
                                        <img src="<?php echo $data['image']; ?>" alt="">
                                        <span>
                                            <?php echo $data['foodname']; ?>
                                        </span>
                                    </div>

                                    <div class="quantity">
                                        <p>
                                            <i class="icon-inr"></i> <span id="basePrice_<?php echo $data['id']; ?>"><?php echo $data['foodprice']; ?> </span><strong>X</strong>
                                        </p> 
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field=""
                                                        onClick="viewCartUpdate(<?php echo $data['id']; ?>)">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="number" id="quantity_<?php echo $data['id']; ?>" name="quantity" class="form-control input-number"
                                                   value="<?php echo $data['quantity']; ?>" min="1" max="100" readonly="true" style="text-align: center;">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field=""
                                                        onClick="viewCartUpdate(<?php echo $data['id']; ?>, true)">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                        <p> =<strong id="foodPriceTotal_<?php echo $data['id']; ?>" class="foodPriceTotal_<?php echo $data['id']; ?>">
                                                <?php echo ($data['foodprice'] * $data['quantity']); ?>
                                            </strong>
                                        </p>
                                    </div>

                                    <div class="total">
                                        <div class="checkout" style="margin: 20px 0 0 0;">
                                            <input type="checkbox" name="potpackflg" 
                                                   id="potpackflg_<?php echo $data['id']; ?>" 
                                                   class="css-checkbox" <?php
                                                   if ($data['potpackflg'] == 'A') {
                                                       echo 'checked';
                                                   } else {
                                                       echo '';
                                                   };
                                                   ?>
                                                   onchange="potPackFlgHandle(<?php echo $data['id']; ?>)">
                                            <label for="potpackflg_<?php echo $data['id']; ?>" 
                                                   class="css-label">
                                                <i class="icon-inr"></i>
                                                <strong>
                                                    <?php
                                                    echo ($data['packCharge'] * $data['quantity']);
                                                    $potPackCharge = ($data['packCharge'] * $data['quantity']);
                                                    ?>
                                                </strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="total">
                                        <i class="icon-inr"></i>
                                        <span id="calculatePrice" class="foodPriceTotal_<?php echo $data['id']; ?>">
                                            <?php
                                            if ($data['potpackflg'] == 'A') {
                                                echo (($data['foodprice'] * $data['quantity']) + ($potPackCharge));
                                            } else {
                                                echo (($data['foodprice'] * $data['quantity']));
                                            };
                                            ?>
                                        </span>
                                    </div>

                                    <div class="cancel">
                                        <a href="javascript:;" onclick="return deleteItem(<?php echo $data['id']; ?>);">
                                            <i class="icon-cancel"></i>
                                        </a>
                                    </div>

                                </div>
                                <?php
                            }
                        }
                        ?>

                        <div class="cart-update-sec">

                            <div class="apply-coupon">
                                <input name="couponcode" id="couponcode" type="text" onblur="if (this.value === '') {
                                            this.value = 'Enter Coupon Code';
                                        }" onfocus="if (this.value === 'Enter Coupon Code') {
                                                    this.value = '';
                                                }"
                                       value="Enter Coupon Code">
                                <a href="#." onclick="validateAndApplyCouponCode(<?= $foodbillAmt ?>)">apply coupon</a>
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
                                            <span>SUBTOTAL:<i class="icon-inr"></i>
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
                                    <div class="sub-total-sec">
                                        <span class="left">Coupon Discount</span>
                                        <span class="right"><span class="right"><i class="icon-inr"></i>
                                                0
                                            </span></span>
                                    </div>
                                    <div class="order-total">
                                        <span class="left">Order Total</span>
                                        <span class="right"><i class="icon-inr"></i>
                                            <?= $subtotal ?>
                                        </span>
                                    </div>
                                    <?php if (!empty($user_details)) { ?>

                                        <a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "customerdetails"]); ?>">proceed to checkout</a>
                                    <?php } else { ?>
                                        <a href="<?php echo $this->Url->build(["controller" => "users", "action" => "signin"]); ?>">proceed to checkout</a>
                                    <?php } ?>

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
                    data: {id: id},
                    dataType: "html",
                    url: "<?php echo $this->request->webroot . 'resturent/deletecart' ?>",
                    success: function (data) {
                        if (data === '1') {
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

        function potPackFlgHandle(id) {
            // Get the checkbox
            var potPackFlg = document.getElementById("potpackflg_" + id);
            // If the checkbox is checked, display the output text
            var flag = "";
            if (potPackFlg.checked === true) {
                flag = "A";
            } else {
                flag = "N";
            }
            $.ajax({
                type: "POST",
                data: {id: id, value: flag},
                dataType: "html",
                url: "<?php echo $this->request->webroot . 'resturent/updatePotPackFlag' ?>",
                success: function (data) {
                    data = $.parseJSON(data);
                    if (data.code === '1') {
                        snackMessage(data.msg);
                        window.location.reload(true);
                    }
                }
            });
        }

        function viewCartUpdate(id, val) {
            var quantity = parseInt($('#quantity_' + id).val());
            if (quantity > 0) {
                if (val)
                    var newQuantity = quantity + 1;
                else
                    var newQuantity = quantity - 1;

                $.ajax({
                    type: "POST",
                    data: {id: id, value: newQuantity},
                    dataType: "html",
                    url: "<?php echo $this->request->webroot . 'resturent/updateQcart' ?>",
                    success: function (data) {
                        data = $.parseJSON(data);
                        if (data.code === '1') {
                            $('#quantity_' + id).val(newQuantity);
                            var base_price = parseInt($('span#basePrice_' + id).text());
                            var newFoodPrice = base_price * newQuantity;
                            $('.foodPriceTotal_' + id).text(' ' + newFoodPrice);
                        }
                        window.location = "";
                    }
                });
            }
        }


        function validateAndApplyCouponCode(billamt) {
            var couponcode = $("#couponcode").val();
            $.ajax({
                type: "POST",
                data: {couponcode: couponcode, billamount: billamt},
                dataType: "html",
                url: "<?php echo $this->request->webroot . 'resturent/getValidCouponDtl' ?>",
                success: function (data) {
                    alert(data);
                }
            });
        }
    </script>
    <style>
        .shop-cart .cart-pro-detail .quantity input[type=text] {
            text-align: center;
            width: 57px;
            height: 60px;
            border-radius: 5px;
            border: solid 1px #e0e0e0;
            font-size: 18px;
            margin: 5px 0px 0px 10px;
        }
    </style>