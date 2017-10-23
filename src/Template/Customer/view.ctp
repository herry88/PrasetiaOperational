<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Customer'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="customer view large-10 medium-9 columns">
    <h2><?= h($customer->ID) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('NAME') ?></h6>
            <p><?= h($customer->NAME) ?></p>
            <h6 class="subheader"><?= __('ROLE') ?></h6>
            <p><?= h($customer->ROLE) ?></p>
            <h6 class="subheader"><?= __('NIP') ?></h6>
            <p><?= h($customer->NIP) ?></p>
            <h6 class="subheader"><?= __('TELP') ?></h6>
            <p><?= h($customer->TELP) ?></p>
            <h6 class="subheader"><?= __('HANDPHONE') ?></h6>
            <p><?= h($customer->HANDPHONE) ?></p>
            <h6 class="subheader"><?= __('EMAIL') ?></h6>
            <p><?= h($customer->EMAIL) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('ID') ?></h6>
            <p><?= $this->Number->format($customer->ID) ?></p>
            <h6 class="subheader"><?= __('USER CREATED') ?></h6>
            <p><?= $this->Number->format($customer->USER_CREATED) ?></p>
            <h6 class="subheader"><?= __('USER MODIFIED') ?></h6>
            <p><?= $this->Number->format($customer->USER_MODIFIED) ?></p>
            <h6 class="subheader"><?= __('CUSTOMER GROUP ID') ?></h6>
            <p><?= $this->Number->format($customer->CUSTOMER_GROUP_ID) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('DATE CREATED') ?></h6>
            <p><?= h($customer->DATE_CREATED) ?></p>
            <h6 class="subheader"><?= __('DATE MODIFIED') ?></h6>
            <p><?= h($customer->DATE_MODIFIED) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('ADDRESS') ?></h6>
            <?= $this->Text->autoParagraph(h($customer->ADDRESS)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Groups') ?></h4>
    <?php if (!empty($customer->groups)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('ID') ?></th>
            <th><?= __('NAME') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($customer->groups as $groups): ?>
        <tr>
            <td><?= h($groups->ID) ?></td>
            <td><?= h($groups->NAME) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->ID]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->ID]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $groups->ID)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
