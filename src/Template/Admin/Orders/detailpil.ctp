<?php echo $this->Html->script('/plugins/dataTables/jquery.dataTables.js') ?>
<?php echo $this->Html->script('/plugins/dataTables/dataTables.bootstrap.js') ?>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script language="javascript" type="text/javascript">
    function deleteConfirm(){
        var x = window.confirm("Are you sure you want to delete this?")
        if (x){
            return true;
        } else {
            return false;
        }
        return false;
    }
</script>
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Pil Order List </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5> Pil Order List</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li style="margin-right:15px">
                                    <div class="btn-group" style=" margin-top: 2px">
                                        <a href="javascript:history.back()" class="btn btn-primary"> Go Back </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-12">
                            <div class="row">                               
                                <div class="form-group"> 
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                       <th>#</th>
                                                        <th>Name</th>
                                                        <th>Qty</th>
                                                        <th>Amount(&pound;)</th>
                                                        <th>Order Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php $i = 1;
                                                        foreach ($orderDetails as $details): 
                                                         $date=date('Y-m-d H:i',strtotime($details->order->date));   
                                                         ?>
                                                        <tr>
                                                            <td><?php echo $this->Number->format($i) ?></td>
                                                            <td><?php echo h($details->order->name) ?></td>
                                                            <td>1</td>
                                                            <td><?php echo number_format((float)$details->pil_price,2,'.',',') ?></td>
                                                            <td><?php echo $this->requestAction('/admin/users/change_datetimeformat/'.$date); ?></td>
                                                        </tr>
                                                        <?php $i++;
                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                           
                                        </div>  
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!--END PAGE CONTENT -->