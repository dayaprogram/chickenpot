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
    echo "<h3>Your order status is " . $status . ".</h3>";
    echo "<h4>Your transaction id for this transaction is " . $txnid . ". You may try making the payment by clicking the link below.</h4>";
}
?>

