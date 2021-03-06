<!--Start Sub Banner-->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail">
                    <h1>Log in</h1>
                    <span></span>
                    <ul>
                        <li><a href="<?php echo $this->Url->build(["controller" => "users", "action" => "index"]); ?>">Home</a></li>
                        <li><a class="select">Log in</a></li>
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
                            <h5>Login</h5>
                            <form class="form-signup login-form" method="post" >
                                <div class="form">
                                    <input type="text" name="phone" id="phone" 
                                           class="form-control"  maxlength="15" 
                                           placeholder="Enter your mobile no" required>
                                    <input type="password" name="password" 
                                           id="password" class="form-control" 
                                           placeholder="Enter your password" required>
                                    <button type="submit" class="btn btn-primary btn-md btn-block next-step">Log In</button>
                                </div>
                            </form>

                            <div class="already-account">
                                <span>Don't have an account? Please 
                                    <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signup"]); ?>">Sign Up</a></span>
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






