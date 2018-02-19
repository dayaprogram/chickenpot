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


<?php
$clientdata=$this->requestAction('/resturent/menu/'.'clientid');
pr($clientdata);
?>



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


            <!--Start Shipping Address-->

            <div class="row">
                <div class="col-md-12">
                    <div class="cash-delivery">
                        <div class="cash-delivery-detail">
                            <h5>Shipping address</h5>
                            <div class="shipping-address">

                                <div class="shipping-detail">
                                    <div class="adres"><span class="bold">Your Name:</span> <span>john smith</span></div>
                                    <div class="adres"><span class="bold">Email Address:</span> <span>johnsmith@gmail.com</span></div>
                                    <div class="adres"><span class="bold">Shipping Address:</span> <span>Street Name 123 123 45 USA</span></div>
                                    <div class="adres"><span class="bold">City:</span> <span>New York</span></div>
                                    <div class="adres"><span class="bold">Zip Code:</span> <span>54000</span></div>
                                    <div class="adres"><span class="bold">Phone no:</span> <span>+123 55 33 444 888</span></div>
                                    <a class="edit-address" 
                                       href="<?php echo $this->Url->build(["controller" => "resturent", "action" => "customerdetails"]); ?>">
                                        Edit shipping address
                                    </a>
                                </div>


                                <div class="shipping-method">
                                    <h6>Shipping method</h6>
                                    <div class="shipping-across">
                                        <span class="dot"></span>
                                        <span class="across">Free Shipping Across United States</span>
                                        <span class="free">Free</span>
                                    </div>
                                </div>

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
