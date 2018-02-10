<!--Start Sub Banner-->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail">
                    <h1>order now</h1>
                    <span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a class="select">Order Now</a>
                        </li>
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

    <!--Start Shop Detail-->
    <div class="shop-detail">
        <div class="container">

            <div class="product-detail">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pro-image">
                            <img id="foodimage" src="<?php echo $this->Url->build('/food_image/' . $getitem->image); ?>" alt="">
                        </div>
                        <p>
                            <?php echo $getitem['description'] ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="pro-detail">
                            <h3>
                                <?php echo $getitem['foodname'] ?>
                            </h3>
                            <input type="text" id="foodname" value="<?php echo $getitem['foodname'] ?>" hidden>
                            <input type="text" id="id" value="<?php echo $getitem['id'] ?>" hidden>
                            <div class="review">
                                <i class="icon-star-full"></i>
                                <i class="icon-star-full"></i>
                                <i class="icon-star-full"></i>
                                <i class="icon-star-full"></i>
                                <i class="icon-star-full"></i>
                                <span>(5 customer reviews)</span>
                            </div>
                            <span class="price"><i class="icon-inr"></i>
                                <?php echo $getitem['price'] ?>
                            </span>
                            <input type="text" id="price" value="<?php echo $getitem['price'] ?>" hidden>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="pro-cart">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="pro-cart">
                                        <a class="cart" onclick="addtorder(<?php echo $getitem['id'] ?>,<?php echo $getitem['packing_charge'] ?>);">add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <span class="categories" style="text-transform: capitalize;">
                                <strong>Categories:</strong> <?php echo $getitem['food_category'] ?></span>

                            <div class="social-icons">
                                <ul>
                                    <li>
                                        <a href="#." class="fb">
                                            <i class="icon-facebook-1"></i>
                                            <span>Share On Facebook</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#." class="tw">
                                            <i class="icon-twitter-1"></i>
                                            <span>Tweet This Product</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#." class="pi">
                                            <i class="icon-pinterest-p"></i>
                                            <span>Pin This Product</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--End Shop Detail-->

</div>
<!--End Content-->
<script>
    function order(id) {
        var foodprice = $('#price').val();
        var foodname = $('#foodname').val();
        var quantity = $('#quantity').val();
        var id = $('#id').val();
        $.ajax({
            type: "POST",
            data: {id: id, foodprice: foodprice, foodname: foodname, quantity: quantity},
            dataType: "html",
            url: "<?php echo $this->request->webroot . 'resturent/addorder' ?>",
            success: function (data) {
                //console.log(data.foodname);

            }
        });
    }

    function addtorder(id, packCharge) {
        var foodprice = $('#price').val();
        var foodname = $('#foodname').val();
        var quantity = $('#quantity').val();
        var image = $('#foodimage').attr('src');
        $.ajax({
            type: "POST",
            data: {id: id, foodprice: foodprice, foodname: foodname, quantity: quantity, img: image, packCharge: packCharge, potpackflg: "N"},
            dataType: "html",
            url: "<?php echo $this->request->webroot . 'resturent/addtokrt' ?>",
            success: function (data) {
                data = $.parseJSON(data);
                if (data.code === '1') {
                    $('ul li.open-bag').html(data.cartvalue);
                    $('ul li.close-bag').find('span.num').text(parseInt($('ul li.close-bag').find('span.num').text()) + 1);
                    snackMessage(data.msg);
                } else {
                    snackMessage(data.msg);
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        var quantitiy = 1;
        $('.quantity-right-plus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            // If is not undefined
            // Increment
            $('#quantity').val(quantity + 1);

        });
        $('.quantity-left-minus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            // If is not undefined
            // Increment
            if (quantity > 1) {
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>

<style>
    .input-group-btn:last-child>.btn,
    .input-group-btn:last-child>.btn-group {
        z-index: 2;
        margin-left: 0px;
    }
</style>