<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Orderdetail'), ['action' => 'edit', $orderdetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Orderdetail'), ['action' => 'delete', $orderdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderdetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orderdetails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Orderdetail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderdetails view large-9 medium-8 columns content">
    <h3><?= h($orderdetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Order') ?></th>
            <td><?= $orderdetail->has('order') ? $this->Html->link($orderdetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderdetail->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Product') ?></th>
            <td><?= $orderdetail->has('product') ? $this->Html->link($orderdetail->product->id, ['controller' => 'Products', 'action' => 'view', $orderdetail->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Product Name') ?></th>
            <td><?= h($orderdetail->product_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($orderdetail->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Price') ?></th>
            <td><?= $this->Number->format($orderdetail->product_price) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Qty') ?></th>
            <td><?= $this->Number->format($orderdetail->product_qty) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($orderdetail->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($orderdetail->modified) ?></td>
        </tr>
    </table>
</div>
