<!--Start Sub Banner-->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail">
                    <h1>shipping details</h1>
                    <span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
                    <ul>
                        <li><a href="<?php echo $this->Url->build(["controller" => "users", "action" => "index"]); ?>">Home</a></li>
                        <li><a class="select">Shipping</a></li>
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

    <!--Start Cash Billing-->


    <div class="cash-payment">
        <div class="container">



            <!--Start Bread Crumb-->

            <div class="bread-crumb">
                <div class="row">
                    <div class="col-md-12">

                        <div class="bread-crumb-sec">
                            <a href="shop-cart.html">
                                <span class="number">1</span>
                                <div class="clear"></div>
                                <span class="text">Shop Cart</span>
                            </a>
                        </div>

                        <div class="bread-crumb-sec">
                            <a >
                                <span class="number">2</span>
                                <div class="clear"></div>
                                <span class="text">Customer Info</span>
                            </a>
                        </div>

                        <div class="bread-crumb-sec">
                            <a class="selected">
                                <span class="number">3</span>
                                <div class="clear"></div>
                                <span class="text">Shipping Method</span>
                            </a>
                        </div>

                        <div class="bread-crumb-sec">
                            <a>
                                <span class="number">4</span>
                                <div class="clear"></div>
                                <span class="text">Payment Method</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!--End Bread Crumb-->

            <?php
            // $areaDetail;

            $shippindAddDtl = $this->request->session()->read('shippindAddDtl');
            ?>
            <!--Start Shipping Address-->

            <div class="row">
                <div class="col-md-12">
                    <div class="cash-delivery">
                        <div class="cash-delivery-detail">
                            <h5>Shipping address</h5>
                            <div class="shipping-address">

                                <div class="shipping-detail">
                                    <div class="adres"><span class="bold">Your Name:</span> <span><?php echo $shippindAddDtl['first_name']; ?></span>&nbsp;<span><?php echo $shippindAddDtl['last_name']; ?></span></div>
                                    <div class="adres"><span class="bold">Email Address:</span> <span><?php echo $shippindAddDtl['email']; ?></span></div>
                                    <div class="adres"><span class="bold">Shipping Address:</span> <span><?php echo $shippindAddDtl['address1']; ?></span>
                                        <span><?php echo $shippindAddDtl['address2']; ?></span>
                                        <span><?php echo $shippindAddDtl['landmark']; ?></span>
                                    </div>
                                    <div class="adres"><span class="bold">City:</span> <span><?php echo $areaDetail['area_name']; ?></span></div>
                                    <div class="adres"><span class="bold">Zip Code:</span> <span><?php echo $areaDetail['pincode']; ?></span></div>
                                    <div class="adres"><span class="bold">Phone no:</span> <span><?php echo $shippindAddDtl['contact_no']; ?></span></div>
                                    <a class="edit-address" 
                                       href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "customerdetails"]); ?>">
                                        Edit shipping address
                                    </a>
                                </div>

                                <!--
                                                                <div class="shipping-method">
                                                                    <h6>Shipping method</h6>
                                                                    <div class="shipping-across">
                                                                        <span class="dot"></span>
                                                                        <span class="across">Free Shipping Across United States</span>
                                                                        <span class="free">Free</span>
                                                                    </div>
                                                                </div>
                                -->
                                <a href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "paymetprocessdtl"]); ?>" class="next-step">Continue to payment method</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--End Shipping Address-->



        </div>
    </div>
    <!--End Cash Billing-->

</div>
<!--End Content-->
