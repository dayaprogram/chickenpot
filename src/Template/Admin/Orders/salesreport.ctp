<?php
//pr($orders);
       // pr($pills);exit;

?>
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Medicines Sales </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5> Medicines Sales Report</h5>
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
<!--                                <div class="form-group">
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
                                </div>-->
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Pill Name</label>
                                    <div class="col-lg-8">
                                        <input id="last_name" name="title" class="form-control" value="<?php echo (!empty($_REQUEST['title'])?$_REQUEST['title']:''); ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Start Date</label>
                                    <div class="col-lg-8">
                                        <input id="start_date" name="start_date" autocomplete="off" class="form-control" value="<?php echo (!empty($_REQUEST['start_date'])?$_REQUEST['start_date']:''); ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">End Date</label>
                                    <div class="col-lg-8">
                                        <input id="end_date" name="end_date" autocomplete="off" class="form-control" value="<?php echo (!empty($_REQUEST['end_date'])?$_REQUEST['end_date']:''); ?>" type="text">
                                    </div>
                                </div>
 
                                                            
                                
                                
                                <label class="control-label col-lg-4"></label>
                                <div class="col-lg-8" style="text-align:left;"> 
                                    <input name="search" value="Search" class="btn btn-primary" type="submit">
                                    <input name="export" value="Export" class="btn btn-success" type="submit">
                                    <a href="<?php echo $this->Url->build(["action" => "salesreport"]); ?>" class="btn btn-danger">Clear Search</a>
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
                                                        <th><?php echo $this->Paginator->sort('title','Pill') ?></th>
                                                        <th><?php echo $this->Paginator->sort('title','Medicine') ?></th>
                                                        
                                                        <th>Qty</th>
                                                        <th><?php echo $this->Paginator->sort('amt','Amount') ?>(&pound;)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($pills)) { ?>
                                                        <?php $ik = 1;
                                                        foreach ($pills as $pill): 
                                                          
                                                            $priceqty=$this->requestAction('/admin/orders/business/'.$pill->pil_id);
                                                            $price=explode("-",$priceqty);
                                                            
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $ik ?></td>
                                                                <td><?php echo $pill->pil_name; ?></td>
                                                                <td><?php echo $pill->medicine->title; ?></td>
                                                                <td><?php echo $price[0];?></td>
                                                                <td><?php echo number_format((float)$price[1],2,'.',',');?></td>
                                                                <td><a href="<?php echo $this->request->webroot?>admin/orders/detailpil/<?php echo $pill->pil_id ?>"> <button class='btn-btn-info btn-xs'><i class='icon-eye-open'></i> View</button> </a></td>
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