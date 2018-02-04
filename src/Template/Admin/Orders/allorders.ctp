<?php
//pr($orders);
?>
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Cart </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5> Sales Report</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li style="margin-right:15px">
                                    <div class="btn-group" style=" margin-top: 8px">

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-6">

                            <div class="row">
<!--				  <form method="post" accept-charset="utf-8" class="form-horizontal" id="user-validate" action="/projects/medicinesbymailbox/admin/users/add">-->
                                <?php echo $this->Form->create('Filter', array('class'=>'form-horizontal','type'=>'get'));?>
                                      
                                <input name="active" id="active" value="1" type="hidden">
                                <h2>Search</h2>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Patient</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="user_id">
                                            <option value="">Select Patient</option>
                                            <?php foreach($users as $user)
                                            { ?>
                                            <option value="<?php echo $user['Users']['id']; ?>"
                                                    <?php echo (!empty($_REQUEST['user_id']) && $_REQUEST['user_id']==$user['Users']['id']?'selected':''); ?>><?php echo $user['Users']['first_name'].' '.$user['Users']['last_name']; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Transaction ID</label>
                                    <div class="col-lg-8">
                                        <input id="last_name" name="transaction_id" class="form-control" value="<?php echo (!empty($_REQUEST['transaction_id'])?$_REQUEST['transaction_id']:''); ?>" type="text">
                                        <!--<input type="text" style="direction:rtl;" id="bank_name_arabic" name="last_name" class="form-control" value=""/>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Start Date</label>
                                    <div class="col-lg-8">
                                        <input id="start_date" name="start_date" autocomplete="off" class="form-control" value="<?php echo (!empty($_REQUEST['start_date'])?$_REQUEST['start_date']:''); ?>" type="text">
                                        <!--<input type="text" style="direction:rtl;" id="bank_name_arabic" name="last_name" class="form-control" value=""/>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">End Date</label>
                                    <div class="col-lg-8">
                                        <input id="end_date" name="end_date" autocomplete="off" class="form-control" value="<?php echo (!empty($_REQUEST['end_date'])?$_REQUEST['end_date']:''); ?>" type="text">
                                        <!--<input type="text" style="direction:rtl;" id="bank_name_arabic" name="last_name" class="form-control" value=""/>-->
                                    </div>
                                </div>
 
                                                            
                                
                                
                                <label class="control-label col-lg-4"></label>
                                <div class="col-lg-8" style="text-align:left;"> 
                                    <input name="search" value="Search" class="btn btn-primary" type="submit">
                                    <input name="export" value="Export" class="btn btn-success" type="submit">
                                    <a href="<?php echo $this->Url->build(["action" => "allorders"]); ?>" class="btn btn-danger">Clear Search</a>
                                </div>
                                <?php echo $this->Form->end();?>                           
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-12">
                            <div class="row">                               
                                <div class="form-group"> 
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $this->Paginator->sort('Sl No') ?></th>
                                                        <th><?php echo $this->Paginator->sort('name','Patient') ?></th>
                                                        <th><?php echo $this->Paginator->sort('transaction_id','Transaction Id') ?></th>
                                                        <th>Pills</th>
                                                        <th><?php echo $this->Paginator->sort('amt','Amount') ?>(&pound;)</th>
                                                        <th><?php echo $this->Paginator->sort('Order Date') ?></th>
                                                        <th>Status</th>
                                                        <th class="actions"><?php echo __('Action') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($orders)) { ?>
                                                        <?php $ik = 1;
                                                        foreach ($orders as $order): ?>
                                                            <tr>
                                                                <td><?php echo $ik ?></td>
                                                                <td><?php echo $order->name; ?></td>
                                                                <td><?php echo $order->transaction_id; ?></td>
                                                                <td><?php echo count($order->orderdetails); ?></td>
                                                                <td><?php echo $order->amt; ?></td>
                                                                <td><?php echo date('d F Y', strtotime($order->date)); ?></td>
                                                                <td>
                                                                    <?php
                                                                        if($order->is_reject == 0 && $order->isverified==1)
                                                                        {
                                                                            echo '<span class="label label-success">Approved</span>';
                                                                        }
                                                                        else if($order->is_reject == 1 && $order->isverified==0)
                                                                        {
                                                                            echo '<span class="label label-danger">Rejected</span>';
                                                                        }
                                                                        else if($order->is_reject == 0 && $order->isverified==0)
                                                                        {
                                                                            echo '<span class="label label-primary">Pending</span>';
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="actions">
                                                                    <a href="<?php echo $this->Url->build(["action" => "view", $order->transaction_id]); ?>"> <button class="btn-btn-info btn-xs"><i class="icon-eye-open"></i> View</button> </a>
                                                                </td>
                                                            </tr>
                                                            <?php $ik++;
                                                        endforeach; ?>
                                                        <?php } 
                                                        if($ik==1)
                                                        { ?>
                                                        <tr>
                                                            <td colspan="5"> No Data Exist </td>
                                                        </tr>                       
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                            <div class="paginator">
                                                <ul class="pagination">
                                                    <?php echo $this->Paginator->first(__('<< First', true), array('class' => 'number-first')); ?>
                                                    <?php echo $this->Paginator->numbers(array('class' => 'numbers', 'first' => false, 'last' => false)); ?>
                                                    <?php echo $this->Paginator->last(__('>> Last', true), array('class' => 'number-end')); ?>
                                                </ul>
                                                <p><?php //echo $this->Paginator->counter()  ?></p>
                                            </div>
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
<style>
    .table-condensed
    {
        color:#fff
    }
    .datepicker thead tr:first-child th:hover,.datepicker td.day:hover
    {
        color:#000;
    }
</style>
<script>
    $(function(){
        $('#start_date').datepicker();
        $('#end_date').datepicker();
    })
</script>
<!--END PAGE CONTENT -->