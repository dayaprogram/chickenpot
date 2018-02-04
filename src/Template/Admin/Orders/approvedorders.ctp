<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Orders </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5> Approved Order List</h5>
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
                        <div class="col-sm-12">
                            <div class="row">                               
                                <div class="form-group"> 
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $this->Paginator->sort('Sl No') ?></th>
                                                        <th><?php echo $this->Paginator->sort('Order From') ?></th>
                                                        <th><?php echo $this->Paginator->sort('Transaction Id') ?></th>
                                                        <th><?php echo $this->Paginator->sort('Order Date') ?></th>
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
                                                                <td><?php echo date('d F Y', strtotime($order->date)); ?></td>
                                                                <td class="actions">
                                                                    <a href="<?php echo $this->Url->build(["action" => "view", $order->transaction_id]); ?>"> <button class="btn-btn-info btn-xs"><i class="icon-eye-open"></i> View</button> </a>
                                                                </td>
                                                            </tr>
                                                            <?php $ik++;
                                                        endforeach; ?>
                                                        <?php } else { ?>
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
<!--END PAGE CONTENT -->