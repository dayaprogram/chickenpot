<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Order Detail </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="my-order-tab">
                        <header class="main-content-header" style="padding-left: 10px">
                            <h2 class="my-orders"> Order Detail </h2>
                        </header>
                        <div class="order-conteainer">
                            <div class="order-detail-content">
                                
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <td><b>First Name:</b></td>
                                                <td> <?php echo $order->user->first_name ?> </td>
                                            </tr>
                                            <tr>
                                                <td><b>Last Name:</b></td>
                                                <td> <?php echo $order->user->last_name ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Email:</b></td>
                                                <td> <?php echo $order->user->email ?> </td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone:</b></td>
                                                <td> <?php echo $order->user->phone ?> </td>
                                            </tr>
                                            <tr>
                                                <td><b>Address1(Billing):</b></td>
                                                <td><?php echo $order->billing->billing_address1 ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address2(Billing):</b></td>
                                                <td><?php echo $order->billing->billing_address2 ?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td><b>City(Billing):</b></td>
                                                <td><?php echo $order->billing->billing_city ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>ZIP(Billing):</b></td>
                                                <td><?php echo $order->billing->billing_zip ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address1(Shipping):</b></td>
                                                <td><?php echo $order->billing->shipping_address1 ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address2(Shipping):</b></td>
                                                <td><?php echo $order->billing->shipping_address2 ?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td><b>City(Shipping):</b></td>
                                                <td><?php echo $order->billing->shipping_city ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>ZIP(Shipping):</b></td>
                                                <td><?php echo $order->billing->shipping_zip ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>Transaction ID:</b></td>
                                                <td><?php echo $order->transaction_id ?></td>
                                            </tr>
                                             <tr>
                                                <td><b>Order Date:</b></td>
                                                <td> <?php echo date('d F Y', strtotime($order->date)); ?> </td>
                                            </tr> 
                                            
                                            <tr>
                                                <td><b>Payment Status:</b></td>
                                                <td><?php echo $order->is_paid==1?"Success":"Failure" ?></td>
                                            </tr>
                                         
                                        </table>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!--END PAGE CONTENT -->


<script>
    function rejectNow() {
        $('#rejectPresc').css('display', 'block');
    }
</script>