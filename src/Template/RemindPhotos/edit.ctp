<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RemindPhoto $remindPhoto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $remindPhoto->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $remindPhoto->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Remind Photos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reminds'), ['controller' => 'Reminds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Remind'), ['controller' => 'Reminds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="remindPhotos form large-9 medium-8 columns content">
    <?= $this->Form->create($remindPhoto) ?>
    <fieldset>
        <legend><?= __('Edit Remind Photo') ?></legend>
        <?php
            echo $this->Form->control('remind_id', ['options' => $reminds, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('photo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
