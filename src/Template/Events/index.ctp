<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="events index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('ID') ?></th>
            <th><?= $this->Paginator->sort('NAME') ?></th>
            <th><?= $this->Paginator->sort('DATE_START') ?></th>
            <th><?= $this->Paginator->sort('DATE_END') ?></th>
            <th><?= $this->Paginator->sort('MIN_PARTICIPANT') ?></th>
            <th><?= $this->Paginator->sort('MAX_PARTICIPANT') ?></th>
            <th><?= $this->Paginator->sort('LOCATION') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($events as $event): ?>
        <tr>
            <td><?= $this->Number->format($event->ID) ?></td>
            <td><?= h($event->NAME) ?></td>
            <td><?= h($event->DATE_START) ?></td>
            <td><?= h($event->DATE_END) ?></td>
            <td><?= $this->Number->format($event->MIN_PARTICIPANT) ?></td>
            <td><?= $this->Number->format($event->MAX_PARTICIPANT) ?></td>
            <td><?= h($event->LOCATION) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $event->ID]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->ID]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $event->ID)]) ?>
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
