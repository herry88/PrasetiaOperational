<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reminds'), ['controller' => 'Reminds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Remind'), ['controller' => 'Reminds', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="items view large-10 medium-9 columns">
    <h2><?= h($item->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($item->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($item->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Nremind1') ?></h6>
            <p><?= h($item->nremind1) ?></p>
            <h6 class="subheader"><?= __('Nremind2') ?></h6>
            <p><?= h($item->nremind2) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Reminds') ?></h4>
    <?php if (!empty($item->reminds)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Deadline') ?></th>
            <th><?= __('Next') ?></th>
            <th><?= __('State') ?></th>
            <th><?= __('Object Id') ?></th>
            <th><?= __('Note') ?></th>
            <th><?= __('Item Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($item->reminds as $reminds): ?>
        <tr>
            <td><?= h($reminds->id) ?></td>
            <td><?= h($reminds->deadline) ?></td>
            <td><?= h($reminds->next) ?></td>
            <td><?= h($reminds->state) ?></td>
            <td><?= h($reminds->object_id) ?></td>
            <td><?= h($reminds->note) ?></td>
            <td><?= h($reminds->item_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Reminds', 'action' => 'view', $reminds->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Reminds', 'action' => 'edit', $reminds->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reminds', 'action' => 'delete', $reminds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reminds->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
