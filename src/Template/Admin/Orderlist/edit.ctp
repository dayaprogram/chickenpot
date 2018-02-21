<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 >View Orderlist</h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5>View Orderlist</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li style="margin-right:15px">
                                    <div class="btn-group"> 

                                    </div>
                                </li>

                            </ul>
                        </div>
                    </header>
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-6">

                            <div class="row">
                                <?php echo $this->Form->create($order, ['class' => 'form-horizontal', 'id' => 'user-validate']); ?>

                                <input type="hidden" name="active" id="active" value="1" />

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Food Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="first_name" name="food_name" class="form-control" value="<?php echo $order['foodname'] ?>" readonly="readonly" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Quantity</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $order['quantity'] ?>" readonly="readonly" />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-lg-4">Food Size</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="food_size" name="food_size" readonly="readonly" class="form-control" value="<?php echo $order['size_variant'] ?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Pot Pack</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="potpack" name="potpack" readonly="readonly" class="form-control" value="<?php echo $order['pot_pack_flg'] ?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Delivery Date</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="date" name="date" readonly="readonly" class="form-control" value="<?php echo $order['delivery_date'] ?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Delivery Time</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="time" readonly="readonly" class="form-control" value="<?php echo $order['delivery_time'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h1>Customer Details</h1>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Customer First Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="name" readonly="readonly" class="form-control" value="<?php echo $customer_details['first_name'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Customer Last Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="lastname" readonly="readonly" class="form-control" value="<?php echo $customer_details['last_name'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Address 1</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="address1" readonly="readonly" class="form-control" value="<?php echo $customer_details['address1'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Address 2</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="address2" readonly="readonly" class="form-control" value="<?php echo $customer_details['address2'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Landmark</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="landmark" readonly="readonly" class="form-control" value="<?php echo $customer_details['landmark'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Address Code</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="code" readonly="readonly" class="form-control" value="<?php echo $customer_details['area_code'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Email</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="email" readonly="readonly" class="form-control" value="<?php echo $customer_details['email'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Email</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="email" readonly="readonly" class="form-control" value="<?php echo $customer_details['contact_no'] ?>"/>
                                    </div>
                                </div>
                                <?php echo $this->Form->create($status, ['class' => 'form-horizontal', 'id' => 'user-validate']); ?>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Status</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="time" name="order_status" class="form-control" value="<?php echo $order['order_status'] ?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-8" style="text-align:left;"> 
                                    <input type="submit" name="submit" value="Edit status" class="btn btn-primary" />
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
