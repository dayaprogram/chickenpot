<?php ?>
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
                        <header class="main-content-header">
                            <h2 class="my-orders"> New Prescription Detail </h2>
                        </header>
                        <div class="order-conteainer">
                            <div class="order-detail-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <td><b>Patient Name:</b></td>
                                                <td> <?php echo $order['name'] ?> </td>
                                            </tr>
                                            <tr>
                                                <td><b>Patient Email:</b></td>
                                                <td><a href="#"> <?php echo $order['email'] ?> </a></td>
                                            </tr>
                                            <tr>
                                                <td><b>Patient Contact:</b></td>
                                                <td> <?php echo $order['contact'] ?> </td>
                                            </tr>
                                            <tr>
                                                <td><b>Patient Address:</b></td>
                                                <td> <?php echo $order['shipping_address'] ?> </td>
                                            </tr>
                                            <tr>
                                                <td><b>Patient City:</b></td>
                                                <td><a href="#"> <?php echo $order['shipping_city'] ?> </a></td>
                                            </tr>
                                            <tr>
                                                <td><b>Patient Country:</b></td>
                                                <td><a href="#"> <?php echo $order['shipping_country'] ?> </a></td>
                                            </tr>
                                             <tr>
                                                <td><b>Order Date:</b></td>
                                                <td> <?php echo date('d F Y', strtotime($order['date'])); ?> </td>
                                            </tr>
                                           
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="my-order-tab">
                                
                                <div class="order-conteainer">
                                    <div class="order-body-content">
                                           
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="order-list-content table-responsive">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th><b>Medicine</b></th>
                                                                        <th><b>Pill Name</b></th>
                                                                        <th><b>Price</b></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($order['orderdetails'] as $appDet) { ?>
                                                                        <tr>
                                                                            <th scope="row"> <?php echo $appDet['medicine']['title'] ?> </th>
                                                                            <td> <?php echo $appDet['pil_name'] ?> </td>
                                                                            <td> £<?php echo sprintf('%0.2f', $appDet['pil_price']) ?> </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                          <div class="patient-detail detail-btn-part"><a href="javascript:history.back()" class="btn btn-primary"> Go Back </a></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
<style>
    .inner{
      min-height:1112px !important;   
    }
</style>


<script>
    function rejectNow() {
        $('#rejectPresc').css('display', 'block');
    }
</script>