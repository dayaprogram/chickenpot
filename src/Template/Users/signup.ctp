<!--Start Sub Banner-->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail">
                    <h1>Sign up</h1>
                    <span></span>
                    <ul>
                        <li><a href="<?php echo $this->Url->build(["controller" => "users", "action" => "index"]); ?>">Home</a></li>
                        <li><a class="select">Sign up</a></li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="cash-delivery">
                        <div class="cash-delivery-detail">
                            <h5>Sign Up</h5>
                            <form class="form-signup login-form" method="post" name="user">
                                <div class="form">
                                    <input type="text" name="first_name" id="fname" class="form-control" placeholder="Enter your first name" required>
                                    <input type="text" name="last_name" id="lname" class="form-control" placeholder="Enter your last name" required>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email id" required>
                                    <input type="tel" name="phone" id="contact_no" class="form-control" minlength="10" maxlength="10" placeholder="Enter your mobile no" required>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" minlength="6" required>
                                    <input type="password" name="cpassword" id="password" class="form-control" placeholder="Confirm password" minlength="6" required>
                                   <!-- <textarea hidden  name="address" id="address" class="form-control" placeholder="Enter your address" required>no address</textarea> -->
                                    <button type="submit" class="btn btn-primary btn-md btn-block next-step">Sign Up</button>
                                </div>
                            </form>

                            <div class="already-account">
                                <span>Already have an account with us? <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signin"]); ?>">Login</a></span>
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

