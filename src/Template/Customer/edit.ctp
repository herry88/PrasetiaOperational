<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customer->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customer->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Customer'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="customer form large-10 medium-9 columns">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Edit Customer') ?></legend>
        <?php
            echo $this->Form->input('NAME');
            echo $this->Form->input('ROLE');
            echo $this->Form->input('NIP');
            echo $this->Form->input('TELP');
            echo $this->Form->input('HANDPHONE');
            echo $this->Form->input('EMAIL');
            echo $this->Form->input('ADDRESS');
            echo $this->Form->input('USER_CREATED');
            echo $this->Form->input('USER_MODIFIED');
            echo $this->Form->input('DATE_CREATED');
            echo $this->Form->input('DATE_MODIFIED');
            echo $this->Form->input('CUSTOMER_GROUP_ID');
            echo $this->Form->input('groups._ids', ['options' => $groups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
