<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $event->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $event->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="events form large-10 medium-9 columns">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Edit Event') ?></legend>
        <?php
            echo $this->Form->input('NAME');
            echo $this->Form->input('DATE_START', ['empty' => true, 'default' => '']);
            echo $this->Form->input('DATE_END', ['empty' => true, 'default' => '']);
            echo $this->Form->input('REMARK');
            echo $this->Form->input('MIN_PARTICIPANT');
            echo $this->Form->input('MAX_PARTICIPANT');
            echo $this->Form->input('LOCATION');
            echo $this->Form->input('LOCATION_ADDRESS');
            echo $this->Form->input('TUTOR');
            echo $this->Form->input('PHONE');
            echo $this->Form->input('EMAIL');
            echo $this->Form->input('REGISTRATION_FEE');
            echo $this->Form->input('PRICE');
            echo $this->Form->input('FACILITY');
            echo $this->Form->input('EVENT_STATUS_ID');
            echo $this->Form->input('DOCUMENT_NAME');
            echo $this->Form->input('USER_CREATED');
            echo $this->Form->input('USER_MODIFIED');
            echo $this->Form->input('DATE_CREATED');
            echo $this->Form->input('DATE_MODIFIED');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
