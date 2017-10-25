<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RemindPhoto[]|\Cake\Collection\CollectionInterface $remindPhotos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Remind Photo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reminds'), ['controller' => 'Reminds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Remind'), ['controller' => 'Reminds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="remindPhotos index large-9 medium-8 columns content">
    <h3><?= __('Remind Photos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remind_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('photo') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($remindPhotos as $remindPhoto): ?>
            <tr>
                <td><?= $this->Number->format($remindPhoto->id) ?></td>
                <td><?= $remindPhoto->has('remind') ? $this->Html->link($remindPhoto->remind->id, ['controller' => 'Reminds', 'action' => 'view', $remindPhoto->remind->id]) : '' ?></td>
                <td><?= h($remindPhoto->name) ?></td>
                <td><?= h($remindPhoto->photo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $remindPhoto->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $remindPhoto->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $remindPhoto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $remindPhoto->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
