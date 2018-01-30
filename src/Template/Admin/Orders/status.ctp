<?php //pr($order->toarray()); exit; ?>
<div id="content">
    <div class="inner">
      <div class="row">
        <div class="col-lg-12">
         
          
         
        </div>
      </div>
      <hr />
       <div class="table-responsive">
            <div class="runs view large-9 medium-8 columns content">
			    <h3>Detail of <?= h($order->ordno) ?></h3>
			    <table class="vertical-table">
			        <tr>
			            <th><?= __('Customer') ?></th>
			            <td><?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
			        </tr>
			        <tr>
			            <th><?= __('Address Name') ?></th>
			            <td><?= h($order->address_name) ?></td>
			        </tr>
			        <tr>
			            <th><?= __('Run Name') ?></th>
			            <td><?= h($order->run_name) ?></td>
			        </tr>
			        <tr>
			            <th><?= __('Payment Status') ?></th>
			            <td><?= h($order->payment_status) ?></td>
			        </tr>
			        <tr>
			            <th><?= __('Order Date') ?></th>
			            <td><?= h($order->order_date) ?></td>
			        </tr>
			        <tr>
			            <th><?= __('Delivery Date') ?></th>
			            <td><?= h($order->delivery_date) ?></td>
			        </tr>
			    </table>
            </div>
        </div>
       
       <!--
       <div class="table-responsive">
            <div class="runs view large-12 medium-12 columns content">
		        <h4><?= __('Comment') ?></h4>
		        <?= $this->Text->autoParagraph(h($order->comment)); ?>
            </div>
        </div>        
		-->
		
        <div class="table-responsive">
            <div class="runs view large-9 medium-8 columns content">
        <h4><?= __('Related Orderdetails') ?></h4>
        <?php if (!empty($order->orderdetails)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Product Name') ?></th>
                <th><?= __('Product Price') ?></th>
                <th><?= __('Product Qty') ?></th>
                <!--<th class="actions"><?= __('Actions') ?></th>-->
            </tr>
            <?php foreach ($order->orderdetails as $orderdetails): ?>
            <tr>
                <td><?= h($orderdetails->id) ?></td>
                <td><?= h($orderdetails->product_name) ?></td>
                <td><?= h($orderdetails->product_price) ?></td>
                <td><?= h($orderdetails->product_qty) ?></td>
                <!--<td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Orderdetails', 'action' => 'view', $orderdetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Orderdetails', 'action' => 'edit', $orderdetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Orderdetails', 'action' => 'delete', $orderdetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderdetails->id)]) ?>
                </td>-->
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
            </div>
        </div>   
        
 
        <div class="table-responsive">
            <div class="runs view large-9 medium-8 columns content">
             <h4><?= __('Order Status') ?></h4>
				    
				    <?=$this->Form->create($order) ?>
				    
				    <fieldset>
						<div class="form-group">
							<div class="input">
								<div id="valOrder" >  
									<div class="form-group">
									<select class="form-control" name="payment_status" id="payment_status">
									  <?php if($order->payment_status =="yes"){ ?>
									  <option value="">Select Payment Status</option>
									  <option value="yes" selected="selected">Yes</option>
									  <option value="no">No</option>									  	
									  <?php } else if($order->payment_status =="no"){ ?>
									  <option value="">Select Payment Status</option>
									  <option value="yes">Yes</option>
									  <option value="no" selected="selected">No</option>									  	
									  <?php } else { ?>
									  <option value="">Select Payment Status</option>
									  <option value="yes">Yes</option>
									  <option value="no">No</option>										
									 <?php } ?>
									</select>
									</div>
									
									

							</div>
						</div>
				        
						<div class="form-group" id="location">
							<div class="input">
								<label class="form-group">Comment : </label> <textarea name="comment" id="comment" rows="4" cols="40"><?=$order->comment?></textarea>  </div>
							</div>
						</div>
				   </fieldset>
				   <?= $this->Form->button(__('Save Status')) ?>
            </div>
        </div>
 
 
 
 
        
        
       
</div>
</div>
