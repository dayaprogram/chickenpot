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
$MERCHANT_KEY = "GlmxtHX5";
$SALT = "qKF9WHhimi";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";  // For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if (!empty($_POST)) {
    //print_r($_POST);
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}

$formError = 0;

if (empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
    if (
            empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['service_provider'])
    ) {
        $formError = 1;
    } else {
        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $SALT;


        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    }
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?>

<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
        if (hash === '') {
            return;
        }
        var payuForm = document.forms.payuForm;
        payuForm.submit();
    }
</script>
<br/>
<?php if ($formError) { ?>

    <span style="color:red">Please fill all mandatory fields.</span>
    <br/>
    <br/>
<?php } ?>


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
                            <a href="#">
                                <span class="number">1</span>
                                <div class="clear"></div>
                                <span class="text">Shop Cart Detail</span>
                            </a>
                        </div>

                        <div class="bread-crumb-sec">
                            <a href="#">
                                <span class="number">2</span>
                                <div class="clear"></div>
                                <span class="text">Customer information</span>
                            </a>
                        </div>

                        <div class="bread-crumb-sec">
                            <a href="#">
                                <span class="number">3</span>
                                <div class="clear"></div>
                                <span class="text">Shipping Method</span>
                            </a>
                        </div>

                        <div class="bread-crumb-sec">
                            <a class="selected">
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
                            <h5>Payment method</h5>
                            <p>All transactions are secure and encrypted. Credit card information is never stored.</p>

                            <div class="shipping-address payment-method">


                                <div class="shipping-method">
                                    <div class="shipping-across">
                                        <span class="across">PayUmony</span>
                                    </div>
                                </div>

                                <div class="shipping-method">
                                    <h6>Billing address</h6>
                                    <div class="shipping-across">
                                        <span class="dot"></span> <span class="across">Same as shipping address</span>
                                    </div>
                                </div>

                                <form action="<?php echo $action; ?>" method="post" name="payuForm" >
                                    <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                                    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                                    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                                    <input type="hidden"name="amount" value="<?php echo (empty($posted['amount'])) ? '200' : $posted['amount'] ?>" />
                                    <input type="hidden"name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? 'rajiv' : $posted['firstname']; ?>" />
                                    <input type="hidden"name="email" id="email" value="<?php echo (empty($posted['email'])) ? 'daya@gmail.com' : $posted['email']; ?>" />
                                    <input type="hidden"name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
                                    <textarea hidden="true" name="productinfo"><?php echo (empty($posted['productinfo'])) ? 'food' : $posted['productinfo'] ?></textarea>
                                    <input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? 'http://www.chickenpot.in/resturent/paymentsuccessbilldtl' : $posted['surl'] ?>" size="64" />
                                    <input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? 'http://www.chickenpot.in/resturent/paymentfailuredtl' : $posted['furl'] ?>" size="64" />
                                    <input type="hidden" type="hidden" name="service_provider" value="payu_paisa" size="64" />
                                    <b hidden="true">Optional Parameters</b>
                                    <input type="hidden" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" />
                                    <input type="hidden" name="curl" value="" />
                                    <input type="hidden" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" />
                                    <input type="hidden" name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" />
                                    <input type="hidden" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
                                    <input type="hidden" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
                                    <input type="hidden" name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" />
                                    <input type="hidden" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
                                    <input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
                                    <input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
                                    <input type="hidden" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
                                    <input type="hidden" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
                                    <input type="hidden" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
                                    <input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />

                                    <?php if (!$hash) { ?>
                                        <input class="next-step" type="submit" value="Proceed To Payment" />

                                    <?php } ?>
                                </form>
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


