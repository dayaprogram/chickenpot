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
                                            <?php echo $data['foodsize']; ?>  &rightarrowtail;&nbsp;  <i class="icon-inr"></i> <span id="basePrice_<?php echo $data['id'] . "_" . $data['foodsize']; ?>"><?php echo $data['foodprice']; ?> </span><strong>X</strong>
                                        </p> 
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field=""
                                                        onClick="viewCartUpdate(<?php echo $data['id']; ?>,<?php echo "'" . $data['foodsize'] . "'"; ?>)">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="number" id="quantity_<?php echo $data['id'] . "_" . $data['foodsize']; ?>" name="quantity" class="form-control input-number"
                                                   value="<?php echo $data['quantity']; ?>" min="1" max="100" readonly="true" style="text-align: center;">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field=""
                                                        onClick="viewCartUpdate(<?php echo $data['id']; ?>,<?php echo "'" . $data['foodsize'] . "'"; ?>, true)">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                        <p> =<strong id="foodPriceTotal_<?php echo $data['id'] . "_" . $data['foodsize']; ?>" class="foodPriceTotal_<?php echo $data['id']; ?>">
                                                <?php echo ($data['foodprice'] * $data['quantity']); ?>
                                            </strong>
                                        </p>
                                    </div>

                                    <div class="total">
                                        <div class="checkout" style="margin: 20px 0 0 0;">
                                            <input type="checkbox" name="potpackflg" 
                                                   id="potpackflg_<?php echo $data['id'] . "_" . $data['foodsize']; ?>" 
                                                   class="css-checkbox" <?php
                                                   if ($data['potpackflg'] == 'A') {
                                                       echo 'checked';
                                                   } else {
                                                       echo '';
                                                   };
                                                   ?>
                                                   onchange="potPackFlgHandle(<?php echo $data['id']; ?>,<?php echo "'" . $data['foodsize'] . "'"; ?>)">
                                            <label for="potpackflg_<?php echo $data['id'] . "_" . $data['foodsize']; ?>" 
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
                                        <a href="javascript:;" onclick="return deleteItem(<?php echo $data['id']; ?>,<?php echo"'" . $data['foodsize'] . "'"; ?>);">
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
                                <a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "blog"]); ?>">cash on delivery</a>
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
                                        <button onclick="document.getElementById('id01').style.display = 'block'" style="width:auto;">Loginkkkkk</button>
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

    <div id="id01" class="modal">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display = 'none'" class="close" title="Close Modal">&times;</span>
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>
        <label for="phone"><b>Mobile</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" id="phone" required></br>
        <label for="pass"><b> Password</b></label>
        <input type="text" placeholder="Enter Phone" name="pass" id="pass" required>
        <input type="button" value="login" onclick='prooceedtologin();'>
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
    </div>
</div>
</div>
</div>

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

    function potPackFlgHandle(id, foodsize) {
        // Get the checkbox
        var potPackFlg = document.getElementById("potpackflg_" + id + "_" + foodsize);
        // If the checkbox is checked, display the output text
        var flag = "";
        if (potPackFlg.checked === true) {
            flag = "A";
        } else {
            flag = "N";
        }
        $.ajax({
            type: "POST",
            data: {id: id, value: flag, foodsize: foodsize},
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

    function viewCartUpdate(id, foodsize, val) {
        var quantity = parseInt($('#quantity_' + id + '_' + foodsize).val());
        if (quantity > 0) {
            if (val)
                var newQuantity = quantity + 1;
            else
                var newQuantity = quantity - 1;

            $.ajax({
                type: "POST",
                data: {id: id, value: newQuantity, foodsize: foodsize},
                dataType: "html",
                url: "<?php echo $this->request->webroot . 'resturent/updateQcart' ?>",
                success: function (data) {
                    data = $.parseJSON(data);
                    if (data.code === '1') {
                        $('#quantity_' + id + '_' + foodsize).val(newQuantity);
                        var base_price = parseInt($('span#basePrice_' + id + '_' + foodsize).text());
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


<style>

    button:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)} 
        to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
        from {transform: scale(0)} 
        to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }
</style>

<script>
// Get the modal
    var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    function prooceedtologin() {
        var phone = $('#phone').val();
        var password = $('#pass').val();
        alert(phone);
        $.ajax({
            type: "POST",
            data: {phone: phone, password: password},
            dataType: "json",
            url: "<?php echo $this->request->webroot . 'resturent/login' ?>",
            success: function (data) {
                //alert(data);
                window.location = "";
            }
        });
    }
</script>