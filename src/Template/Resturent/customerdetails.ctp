<!--Start Sub Banner-->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail">
                    <h1>CUSTOMER INFORMATION</h1>
                    <span></span>
                    <ul>
                        <li><a href="<?php echo $this->Url->build(["controller" => "users", "action" => "index"]); ?>">Home</a></li>
                        <li><a class="select">Cust info</a></li>
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

                                    <input type="text" name="first_name" id="first_name" 
                                           value="<?php echo $userdetails['firstname'] ?>" class="form-control" placeholder="Enter your first name" required>
                                    <input type="text" name="last_name" id="last_name" class="form-control" 
                                           value="<?php echo $userdetails['lastname'] ?>" placeholder="Enter your last name" required>
                                    <input type="email" name="email" id="email" class="form-control" 
                                           value="<?php echo $userdetails['email'] ?>" placeholder="Enter your email id" required>
                                    <input type="text" name="contact_no" id="contact_no" class="form-control" 
                                           value="<?php echo $userdetails['phone'] ?>" maxlength="10" 
                                           placeholder="Enter your mobile no" required readonly="true">
                                    <p>Fill your address</p>
                                    <textarea name="address1" id="address1" class="form-control" placeholder="Enter your address 1"  required></textarea>
                                    <textarea name="address2" id="address2" class="form-control" placeholder="Enter your address 2" required></textarea>
                                    <textarea name="landmark" id="landmark" class="form-control" placeholder="Enter your landmark" required></textarea>
                                    <?php if ($loc['chooselocation'] == 'rloc') { ?>
                                    <input type="radio" name="trackloc" value="rloc" id="plocation" checked hidden>
                                    <?php } else { ?>
                                        <input type="radio" name="trackloc" value="rloc" id="plocation" hidden>
                                    <?php } ?>

                                    <div class="input-group">
                                        <span class="input-group-addon">Jalandhar</span>
                                        <select class="form-control" id="area_code" name="area_code" onchange="selectloc();" required="true">
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

                                    <?php if ($loc['chooselocation'] == 'ploc') { ?>
                                        <input type="radio" name="trackloc" value="ploc" id="pickshop" checked hidden>
                                    <?php } else { ?>
                                        <input type="radio" name="trackloc" value="ploc" id="pickshop" hidden>
                                    <?php } ?>

                                    <div class="input-group">
                                        <button type="button" class="btn btn-success" id="disablepick" style="display:none;">Pick From Shop</button>
                                        <button type="button" class="btn btn-danger" id="ablepick" style="display:none;">Pick From Shop</button>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="datespn"   style="font-size:15px">Delivery Date</span>
                                        <?php
                                        if (!empty($loc['date'])) {
                                            $date = $loc['date'];
                                        } else {
                                            $date = date("Y-m-d");
                                        }
                                        ?>
                                        <input type="text" class="form-control" name="selectdate" value="<?php echo $date ?>" id="datepicker" required="true">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"  id="datespn" style="font-size:15px"> Delivery Time</span>
                                        <?php
                                        if (!empty($loc['time'])) {
                                            $time = $loc['time'];
                                        }
                                        $time = '';
                                        ?>
                                        <input type="text" class="form-control" name="selecttime" id="time" value="<?php echo $time ?>" required="true">
                                    </div>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
                                            $(function () {

                                                $("#datepicker").datepicker({dateFormat: "yy-mm-dd",
                                                    //setDate: new Date(),
                                                    minDate: new Date(),
                                                    maxDate: '+4D', }).val();
                                            });
</script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
                                            $(document).ready(function () {
                                                $('#time').timepicker({
                                                    timeFormat: 'h:mm p',
                                                    interval: 30,
                                                    minTime: '10',
                                                    maxTime: '11:00pm',
                                                    defaultTime: new Date(),
                                                    startTime: '10:00am',
                                                    dynamic: false,
                                                    dropdown: true,
                                                    scrollbar: true
                                                });
                                            });
</script>

<script>

    $("#sel1").change(function () {
        var selectedValue = $(this).text();
        // alert(selectedValue);
        $("#txtBox").val($(this).find("option:selected").attr("value"))
    });

</script>

<script>
    $("#pickshop").click(function () {
        $("#disablepick").show();
        $("#ablepick").hide();
        $('select[name=IMEI]').prop('disabled', false);
        $('#shell').attr('disabled', true);
    });


    $("#plocation").click(function () {
        $("#ablepick").show();
        $("#disablepick").hide();

    });

    $('#area_code').val("<?php echo $loc['location'] ?>");
</script>
<style>
    .input-group .form-control {
        position: relative;
        z-index: 2;
        float: left;
        width: 100%;
        margin-bottom: 0;
        height: 50px;
    }
</style>



