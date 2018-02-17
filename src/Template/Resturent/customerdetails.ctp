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
                            <a class="selected">
                                <span class="number">2</span>
                                <div class="clear"></div>
                                <span class="text">Customer Info</span>
                            </a>
                        </div>

                        <div class="bread-crumb-sec">
                            <a>
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


            <div class="row">
                <div class="col-md-12">
                    <div class="cash-delivery">
                        <div class="cash-delivery-detail">
                            <h5>Customer information</h5>
                            <div class="form">

                                <?php echo $this->Form->create('', ['enctype' => "multipart/form-data", 'class' => 'form-horizontal', 'id' => 'user-validate']); ?>
                                <div class="form">
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter your first name" required>
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter your last name" required>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email id" required>
                                    <input type="text" name="contact_no" id="contact_no" class="form-control"  maxlength="10" placeholder="Enter your mobile no" required>
                                    <p>Fill your address</p>
                                    <textarea name="address1" id="address1" class="form-control" placeholder="Enter your address 1" required></textarea>
                                    <textarea name="address2" id="address2" class="form-control" placeholder="Enter your address 2" required></textarea>
                                    <textarea name="landmark" id="landmark" class="form-control" placeholder="Enter your landmark" required></textarea>
                                    <div class="input-group">
                                        <span class="input-group-addon">Jalandhar</span>
                                        <select class="form-control" id="area_code" name="area_code" onchange="selectloc();">
                                            <option value="">Choose your location</option>
                                            <?php
                                            foreach ($select_location as $location) {
                                                ?>
                                                <option value="<?php echo $location['area_code'] ?>">
                                                    <?php echo $location['area_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-md btn-block next-step">Continue Payment Method</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Cash Billing-->

</div>
<!--End Content-->
