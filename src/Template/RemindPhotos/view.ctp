<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RemindPhoto $remindPhoto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Remind Photo'), ['action' => 'edit', $remindPhoto->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Remind Photo'), ['action' => 'delete', $remindPhoto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $remindPhoto->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Remind Photos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Remind Photo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reminds'), ['controller' => 'Reminds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Remind'), ['controller' => 'Reminds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="remindPhotos view large-9 medium-8 columns content">
    <h3><?= h($remindPhoto->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Remind') ?></th>
            <td><?= $remindPhoto->has('remind') ? $this->Html->link($remindPhoto->remind->id, ['controller' => 'Reminds', 'action' => 'view', $remindPhoto->remind->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($remindPhoto->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= h($remindPhoto->photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($remindPhoto->id) ?></td>
        </tr>
    </table>
</div>
