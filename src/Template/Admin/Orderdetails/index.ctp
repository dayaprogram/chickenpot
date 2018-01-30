<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Orderdetail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderdetails index large-9 medium-8 columns content">
    <h3><?= __('Orderdetails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('order_id') ?></th>
                <th><?= $this->Paginator->sort('product_id') ?></th>
                <th><?= $this->Paginator->sort('product_name') ?></th>
                <th><?= $this->Paginator->sort('product_price') ?></th>
                <th><?= $this->Paginator->sort('product_qty') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderdetails as $orderdetail): ?>
            <tr>
                <td><?= $this->Number->format($orderdetail->id) ?></td>
                <td><?= $orderdetail->has('order') ? $this->Html->link($orderdetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderdetail->order->id]) : '' ?></td>
                <td><?= $orderdetail->has('product') ? $this->Html->link($orderdetail->product->id, ['controller' => 'Products', 'action' => 'view', $orderdetail->product->id]) : '' ?></td>
                <td><?= h($orderdetail->product_name) ?></td>
                <td><?= $this->Number->format($orderdetail->product_price) ?></td>
                <td><?= $this->Number->format($orderdetail->product_qty) ?></td>
                <td><?= h($orderdetail->created) ?></td>
                <td><?= h($orderdetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderdetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderdetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderdetail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
