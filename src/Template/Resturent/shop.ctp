<!--Start Sub Banner-->
<div class="sub-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="detail">
                    <h1>the menu</h1>
                    <span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a class="select">Menu</a></li>
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

    <!--Start The Menu-->
    <div class="our-menu">
        <div id="filters-container" class="cbp-l-filters-list ">
            <div data-filter="*" class="cbp-filter-item-active cbp-filter-item cbp-l-filters-list-first">
                <a href="<?php echo $this->Url->build(["action" => "shop", 'ALL']); ?>">ALL PRODUCTS</a></div>
            <div data-filter=".starters" class="cbp-filter-item"><a href="<?php echo $this->Url->build(["action" => "shop", 'a']); ?>">Prince</a></div>
            <div data-filter=".mains" class="cbp-filter-item">MAINS</div>
            <div data-filter=".BREAKFAST" class="cbp-filter-item cbp-l-filters-list-last">BREAKFAST</div>
            <div data-filter=".starters" class="cbp-filter-item">STARTERS</div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($getitem as $items) { ?>
                    <div class="col-md-4">
                        <div class="food-sec <?php echo $items['food_category'] ?>">
                            <img src="<?php echo $this->Url->build('/food_image/' . $items->image); ?>" alt="">
                            <div class="detail">
                                <a href="<?php echo $this->Url->build(["action" => "details", $items->id]); ?>">
                                    <p style="font-weight: 600;font-size: 25px;"><?php echo $items['foodname'] ?></p></a>
                                <p><?php echo $items['description'] ?></p>
                                <span class="addtokrt"></span>
                                <span class="price hidden"><?php echo $items['price'] ?></span>
                                <span class="item_<?php echo $items['id'] ?> hidden"></span>
                                <span class="name hidden"><?php echo $items['foodname'] ?></span>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="small-tit" style="color: #dc4e20;"><strong> <i class="icon-inr"></i>&nbsp;&nbsp;<?php echo $items['price'] ?></strong></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="small-tit" style="color: #dc4e20;">
                                            <div class="input-group">
                                                <span class="input-group-addon"><strong>Qnt</strong></span>
                                                <input id="quantity_<?php echo $items['id'] ?>" type="number" class="form-control" name="quantity" class="quantity" value="1" min="1">
                                            </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="small-tit"><a href="javascript:;" class="btn btn-success" 
                                                                   onclick="addtocart(<?php echo $items['id'] ?>,<?php echo $items['packing_charge'] ?>)">ADD TO CART</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--End The Menu-->

</div>	
<!--End Content-->

<!-- Notification Bar -->
<script>
    $('.notify--dismissible').append('<button type="button" class="notify-close">&times;</button>');

    $('.notify-close').on('click', function () {
        $(this).closest('.notify').hide();
    });
</script>

<script>
    function addtocart(id, packCharge) {
        var foodprice = $('span.item_' + id).parent().find('span.price').text();
        var foodname = $('span.item_' + id).parent().find('span.name').text();
        var quantity = $('#quantity_' + id).val();
        var image = $('span.item_' + id).parent().parent().find('img').attr('src');
        $.ajax({
            type: "POST",
            data: {id: id, foodprice: foodprice, foodname: foodname, quantity: quantity, img: image, packCharge: packCharge, potpackflg: "N"},
            dataType: "html",
            url: "<?php echo $this->request->webroot . 'resturent/addtokrt' ?>",
            success: function (data) {
                data = $.parseJSON(data);
                alert(data.code);
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

