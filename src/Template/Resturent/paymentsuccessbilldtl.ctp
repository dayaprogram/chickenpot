<!--Start Sub Banner-->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail">
                    <h1>Thank You</h1>
                    <span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a class="select">Our Story</a></li>
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
$status = $_POST["status"];
$firstname = $_POST["firstname"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$salt = "qKF9WHhimi";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
    $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}
$hash = hash("sha512", $retHashSeq);
if ($hash != $posted_hash) {
    echo "Invalid Transaction. Please try again";
} else {
    echo "<h3>Thank You. Your order status is " . $status . ".</h3>";
    echo "<h4>Your Transaction ID for this transaction is " . $txnid . ".</h4>";
    echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
}
?>	

<!--Start Content-->
<div class="content">

    <!--Start Cash Billing-->
    <div class="cash-payment">
        <div class="container">
            <!--Start Shipping Address-->
            <div class="row">
                <div class="col-md-12">
                    <div class="cash-delivery thanks-message">
                        <div class="cash-delivery-detail">
                            <i class="icon-checkmark3"></i>

                            <h5>Thank you for your Shopping!</h5>
                            <span class="order-num">Order 39036</span>
                            <p>A confirmation email has been sent to johnsmith@gmail.com</p>

                            <p class="delivered-text">Your order would be delivered via Delivery Boy at your mentioned address. The Delivery  	 	 	 							Boy who delivers the package collects the invoice value at the time of delivery. Delivery takes between 1/2 to 2  	 								Hours.</p>

                            <div class="delivered-detail">

                                <div class="delivered-sec">
                                    <span class="title">Shipping Address</span>
                                    <ul>
                                        <li><span>john smith</span></li>
                                        <li><span>johnsmith@gmail.com</span></li>
                                        <li><span>Street Name 123 123 45 USA</span></li>
                                        <li><span>New York</span></li>
                                        <li><span>54000</span></li>
                                        <li><span>+123 55 33 444 888</span></li>
                                    </ul>
                                </div>

                                <div class="delivered-sec right">
                                    <span class="title">Billing Address</span>
                                    <ul>
                                        <li><span>john smith</span></li>
                                        <li><span>johnsmith@gmail.com</span></li>
                                        <li><span>Street Name 123 123 45 USA</span></li>
                                        <li><span>New York</span></li>
                                        <li><span>54000</span></li>
                                        <li><span>+123 55 33 444 888</span></li>
                                    </ul>
                                </div>

                                <div class="delivered-sec">
                                    <span class="title">Shipping Method</span>
                                    <p>Free Shipping Across America</p>
                                </div>

                                <div class="delivered-sec right">
                                    <span class="title">Shipping Method</span>
                                    <img class="card" src="images/cod-card.jpg" alt=""><p>Cash on Delivery (COD) - $145.00</p>
                                </div>
                            </div>

                            <div class="clear"></div>
                            <a class="return-stor" href="shop.html">return to store</a>

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
