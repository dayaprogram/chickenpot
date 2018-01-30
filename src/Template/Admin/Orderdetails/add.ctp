<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Orderdetails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderdetails form large-9 medium-8 columns content">
    <?= $this->Form->create($orderdetail) ?>
    <fieldset>
        <legend><?= __('Add Orderdetail') ?></legend>
        <?php
            echo $this->Form->input('order_id', ['options' => $orders, 'empty' => true]);
            echo $this->Form->input('product_id', ['options' => $products, 'empty' => true]);
            echo $this->Form->input('product_name');
            echo $this->Form->input('product_price');
            echo $this->Form->input('product_qty');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
