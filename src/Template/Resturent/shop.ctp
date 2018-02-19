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
            <?php
            foreach ($foodcatagoryList as $foodcatagory) {
                ?>    
                <div data-filter=".starters" class="cbp-filter-item">
                    <a href="<?php echo $this->Url->build(["action" => "shop", $foodcatagory['ref_code']]); ?>">
                        <?php echo $foodcatagory['ref_desc'] ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="container">
            <div class="row">
                <?php
                foreach ($getitem as $items) {
                    // $currfoodid=$items->id;
                    $foodVar = array_filter($itemveriant, function($v)use(&$items) {
                        return $v['id'] === $items['id'];
                    });
                    // var_dump($foodVar);
                    ?>
                    <div class="col-md-4 col-sm-12">
                        <div class="food-sec <?php echo $items['food_category'] ?>">
                            <img src="<?php echo $this->Url->build('/food_image/' . $items->image); ?>" alt="">
                            <div class="detail">
                                <!--  <a href="<?php echo $this->Url->build(["action" => "details", $items->id]); ?>">
                                this link goes to active if detail page get modified for item size variants
                                -->
                                <a href="#">
                                    <p style="font-weight: 600;font-size: 25px;"><?php echo $items['foodname'] ?></p>
                                </a>
                                <p><?php echo $items['description'] ?></p>
                                <span class="addtokrt"></span>
                                <span class="price hidden"><?php echo $items['price'] ?></span>
                                <span class="item_<?php echo $items['id'] ?> hidden"></span>
                                <span class="name hidden"><?php echo $items['foodname'] ?></span>
                                <div class="row">
                                    <?php
                                    if (sizeof($foodVar) == 1) {
                                        foreach ($foodVar as $first) {
                                            echo('<div class="col-md-5 col-sm-5">
                                                <span class="small-tit" style="color: #dc4e20;">
                                            <strong> <i class="icon-inr"></i>&nbsp;&nbsp;');
                                            echo(' <span class="singleItm_price_' . $items['id'] . ' hidden">' . $first['price'] . '</span>');
                                            echo(' <span class="singleItm_sizevar_' . $items['id'] . ' hidden">' . $first['size_variant'] . '</span>');
                                            echo(' <span class="singleItm_potpackchg_' . $items['id'] . ' hidden">' . $first['packing_charge'] . '</span>');
                                            echo $first['price'];
                                            echo('</strong>
                                                </span>
                                            </div>');
                                            break;
                                        }
                                    } else {
                                        echo('<div class="col-md-5 col-sm-5">
                                            <div class="form-group">
                                                <label for="sel1">Select list:</label>
                                                <select class="form-control" id="multivarItm_' . $items['id'] . '" style="color: #dc4e20;font-size: 15px;font-weight: bold;">');
                                        foreach ($foodVar as $first) {
                                            echo('<option value="' . $first['size_variant'] . '_' . $first['price'] . '_' . $first['packing_charge'] . '" style="color: #dc4e20;font-size: 15px;font-weight: bold;">' . $first['size_variant'] . '&nbsp;' . $first['price'] . '</option>');
                                        }
                                        echo('</select>
                                            </div>
                                            </div>');
                                    }
                                    ?>

                                    <div class="col-md-4 col-sm-6">
                                        <span class="small-tit" style="color: #dc4e20;">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="background-color: #e6c16c;"><strong>Qn</strong></span>
                                                <input id="quantity_<?php echo $items['id'] ?>" type="number" class="form-control" name="quantity" class="quantity" value="1" min="1">
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <?php
                                        $foodType = 'btn-success';
                                        if ($items['food_type'] !== 'V') {
                                            $foodType = 'btn-danger';
                                        }
                                        ?>
                                        <span class="small-tit">
                                            <a href="javascript:;" class="btn <?php echo $foodType ?>" 
                                               onclick="addtocart(<?php echo $items['id'] ?>,<?php echo sizeof($foodVar) ?>)">
                                                <strong>
                                                    Add <i class="icon-mail-forward"></i><i class="icon-cart-plus"></i>
                                                </strong>
                                            </a>
                                        </span>
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
    function addtocart(id, itemvarsize) {
        var foodname = $('span.item_' + id).parent().find('span.name').text();
        var quantity = $('#quantity_' + id).val();
        var image = $('span.item_' + id).parent().parent().find('img').attr('src');
        var foodprice = 0.00;
        var potpackcharge = 0.00;
        var foodsize = '';
        if (itemvarsize === 1) {
            foodprice = $('span.singleItm_price_' + id).text();
            potpackcharge = $('span.singleItm_potpackchg_' + id).text();
            foodsize = $('span.singleItm_sizevar_' + id).text();
        } else {
//               
            var vardetail = $("#multivarItm_" + id).val();
            foodsize = vardetail.split("_")[0].toString();
            foodprice = vardetail.split("_")[1];
            potpackcharge = vardetail.split("_")[2];
        }
        $.ajax({
            type: "POST",
            data: {id: id, foodprice: foodprice, foodname: foodname, quantity: quantity, img: image,
                packCharge: potpackcharge, potpackflg: "N", foodsize: foodsize},
            dataType: "html",
            url: "<?php echo $this->request->webroot . 'resturent/addtokrt' ?>",
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data);
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

