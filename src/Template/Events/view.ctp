<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $event->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="events view large-10 medium-9 columns">
    <h2><?= h($event->ID) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('NAME') ?></h6>
            <p><?= h($event->NAME) ?></p>
            <h6 class="subheader"><?= __('LOCATION') ?></h6>
            <p><?= h($event->LOCATION) ?></p>
            <h6 class="subheader"><?= __('TUTOR') ?></h6>
            <p><?= h($event->TUTOR) ?></p>
            <h6 class="subheader"><?= __('PHONE') ?></h6>
            <p><?= h($event->PHONE) ?></p>
            <h6 class="subheader"><?= __('EMAIL') ?></h6>
            <p><?= h($event->EMAIL) ?></p>
            <h6 class="subheader"><?= __('DOCUMENT NAME') ?></h6>
            <p><?= h($event->DOCUMENT_NAME) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('ID') ?></h6>
            <p><?= $this->Number->format($event->ID) ?></p>
            <h6 class="subheader"><?= __('MIN PARTICIPANT') ?></h6>
            <p><?= $this->Number->format($event->MIN_PARTICIPANT) ?></p>
            <h6 class="subheader"><?= __('MAX PARTICIPANT') ?></h6>
            <p><?= $this->Number->format($event->MAX_PARTICIPANT) ?></p>
            <h6 class="subheader"><?= __('REGISTRATION FEE') ?></h6>
            <p><?= $this->Number->format($event->REGISTRATION_FEE) ?></p>
            <h6 class="subheader"><?= __('PRICE') ?></h6>
            <p><?= $this->Number->format($event->PRICE) ?></p>
            <h6 class="subheader"><?= __('EVENT STATUS ID') ?></h6>
            <p><?= $this->Number->format($event->EVENT_STATUS_ID) ?></p>
            <h6 class="subheader"><?= __('USER CREATED') ?></h6>
            <p><?= $this->Number->format($event->USER_CREATED) ?></p>
            <h6 class="subheader"><?= __('USER MODIFIED') ?></h6>
            <p><?= $this->Number->format($event->USER_MODIFIED) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('DATE START') ?></h6>
            <p><?= h($event->DATE_START) ?></p>
            <h6 class="subheader"><?= __('DATE END') ?></h6>
            <p><?= h($event->DATE_END) ?></p>
            <h6 class="subheader"><?= __('DATE CREATED') ?></h6>
            <p><?= h($event->DATE_CREATED) ?></p>
            <h6 class="subheader"><?= __('DATE MODIFIED') ?></h6>
            <p><?= h($event->DATE_MODIFIED) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('REMARK') ?></h6>
            <?= $this->Text->autoParagraph(h($event->REMARK)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('LOCATION ADDRESS') ?></h6>
            <?= $this->Text->autoParagraph(h($event->LOCATION_ADDRESS)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('FACILITY') ?></h6>
            <?= $this->Text->autoParagraph(h($event->FACILITY)) ?>
        </div>
    </div>
</div>
