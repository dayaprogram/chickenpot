<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Order List </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5> Order List</h5>
                        <div class="toolbar">
                            <ul class="nav">
                               
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
                                                        <th><?php echo $this->Paginator->sort('id') ?></th>
                                                        <th><?php echo $this->Paginator->sort('foodname') ?></th>
                                                        <th><?php echo $this->Paginator->sort('quantity') ?></th>
                                                        <th><?php echo $this->Paginator->sort('food_size') ?></th>
                                                        <th><?php echo $this->Paginator->sort('pot pack') ?></th>
                                                        <th><?php echo $this->Paginator->sort('	delivery_date') ?></th>
                                                        <th><?php echo $this->Paginator->sort('delivery_time') ?></th>
                                                         <th><?php echo $this->Paginator->sort('order status') ?></th>
                                                        <th class="actions"><?php echo __('Actions') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php $i =1; foreach ($orders as $order): ?>
                                                    <tr>
                                                        <td><?php echo $this->Number->format($i) ?></td>
                                                        <td><?php echo h($order->foodname) ?></td>
                                                        <td><?php echo h($order->quantity) ?></td>
                                                        <td><?php echo h($order->size_variant) ?></td>
                                                        <td><?php echo h($order->pot_pack_flg) ?></td>
                                                        <td><?php echo h($order->delivery_date)?></td>
                                                         <td><?php echo h($order->delivery_time)?></td>
                                                         <td><?php echo h($order->order_status) ?></td>
<!--                                                        <th><?php echo (!empty($doct->status)?'Active':'Inactive'); ?></th>-->
                                                        <td class="actions">
                                                     <a href="<?php echo $this->Url->build(["action" => "edit", $order->id]); ?>"> <button class="btn btn-primary btn-xs"><i class="icon-pencil icon-white"></i> Edit</button>  </a>
                                                        </td>                
                                                    </tr>
                                            <?php $i++; endforeach; ?>
                                                </tbody>
                                            </table>
                                            <div class="paginator">
                                                <ul class="pagination"> 
                                            <?php echo $this->Paginator->prev('< ' . __('previous')) ?>
                                            <?php echo $this->Paginator->numbers() ?>
                                            <?php echo $this->Paginator->next(__('next') . ' >') ?>
                                                </ul>
                                                <p><?php //echo $this->Paginator->counter() ?></p>
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