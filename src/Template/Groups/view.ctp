<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $group->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customer'), ['controller' => 'Customer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="groups view large-10 medium-9 columns">
    <h2><?= h($group->ID) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('NAME') ?></h6>
            <p><?= h($group->NAME) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('ID') ?></h6>
            <p><?= $this->Number->format($group->ID) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Customer') ?></h4>
    <?php if (!empty($group->customer)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('ID') ?></th>
            <th><?= __('NAME') ?></th>
            <th><?= __('ROLE') ?></th>
            <th><?= __('NIP') ?></th>
            <th><?= __('TELP') ?></th>
            <th><?= __('HANDPHONE') ?></th>
            <th><?= __('EMAIL') ?></th>
            <th><?= __('ADDRESS') ?></th>
            <th><?= __('USER CREATED') ?></th>
            <th><?= __('USER MODIFIED') ?></th>
            <th><?= __('DATE CREATED') ?></th>
            <th><?= __('DATE MODIFIED') ?></th>
            <th><?= __('CUSTOMER GROUP ID') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($group->customer as $customer): ?>
        <tr>
            <td><?= h($customer->ID) ?></td>
            <td><?= h($customer->NAME) ?></td>
            <td><?= h($customer->ROLE) ?></td>
            <td><?= h($customer->NIP) ?></td>
            <td><?= h($customer->TELP) ?></td>
            <td><?= h($customer->HANDPHONE) ?></td>
            <td><?= h($customer->EMAIL) ?></td>
            <td><?= h($customer->ADDRESS) ?></td>
            <td><?= h($customer->USER_CREATED) ?></td>
            <td><?= h($customer->USER_MODIFIED) ?></td>
            <td><?= h($customer->DATE_CREATED) ?></td>
            <td><?= h($customer->DATE_MODIFIED) ?></td>
            <td><?= h($customer->CUSTOMER_GROUP_ID) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Customer', 'action' => 'view', $customer->ID]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Customer', 'action' => 'edit', $customer->ID]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Customer', 'action' => 'delete', $customer->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->ID)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
