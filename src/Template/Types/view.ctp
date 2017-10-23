<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Type'), ['action' => 'edit', $type->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Type'), ['action' => 'delete', $type->id], ['confirm' => __('Are you sure you want to delete # {0}?', $type->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Objects'), ['controller' => 'Objects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Object'), ['controller' => 'Objects', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="types view large-10 medium-9 columns">
    <h2><?= h($type->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($type->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($type->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Objects') ?></h4>
    <?php if (!empty($type->objects)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('PIC') ?></th>
            <th><?= __('State') ?></th>
            <th><?= __('Next') ?></th>
            <th><?= __('Deadline') ?></th>
            <th><?= __('Desc1') ?></th>
            <th><?= __('Desc2') ?></th>
            <th><?= __('Telp') ?></th>
            <th><?= __('Type Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($type->objects as $objects): ?>
        <tr>
            <td><?= h($objects->id) ?></td>
            <td><?= h($objects->name) ?></td>
            <td><?= h($objects->PIC) ?></td>
            <td><?= h($objects->state) ?></td>
            <td><?= h($objects->next) ?></td>
            <td><?= h($objects->deadline) ?></td>
            <td><?= h($objects->desc1) ?></td>
            <td><?= h($objects->desc2) ?></td>
            <td><?= h($objects->telp) ?></td>
            <td><?= h($objects->type_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Objects', 'action' => 'view', $objects->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Objects', 'action' => 'edit', $objects->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Objects', 'action' => 'delete', $objects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $objects->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
