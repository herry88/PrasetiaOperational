<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Object'), ['action' => 'edit', $object->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Object'), ['action' => 'delete', $object->id], ['confirm' => __('Are you sure you want to delete # {0}?', $object->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Objects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Object'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reminds'), ['controller' => 'Reminds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Remind'), ['controller' => 'Reminds', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="objects view large-10 medium-9 columns">
    <h2><?= h($object->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($object->name) ?></p>
            <h6 class="subheader"><?= __('PIC') ?></h6>
            <p><?= h($object->PIC) ?></p>
            <h6 class="subheader"><?= __('State') ?></h6>
            <p><?= h($object->state) ?></p>
            <h6 class="subheader"><?= __('Desc1') ?></h6>
            <p><?= h($object->desc1) ?></p>
            <h6 class="subheader"><?= __('Desc2') ?></h6>
            <p><?= h($object->desc2) ?></p>
            <h6 class="subheader"><?= __('Telp') ?></h6>
            <p><?= h($object->telp) ?></p>
            <h6 class="subheader"><?= __('Type') ?></h6>
            <p><?= $object->has('type') ? $this->Html->link($object->type->name, ['controller' => 'Types', 'action' => 'view', $object->type->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($object->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Next') ?></h6>
            <p><?= h($object->next) ?></p>
            <h6 class="subheader"><?= __('Deadline') ?></h6>
            <p><?= h($object->deadline) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="col-md-10 col-md-offset-2">
    <h4 class="subheader"><?= __('Related Reminds') ?></h4>
    <?php if (!empty($object->reminds)): ?>
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
		<?php //pr($remind); ?>
		<?php //pr($items[0]->name);
			//pr ($object->reminds->item_id);
			//echo $items[0]['name'];
			
		
		?>
        <?php foreach ($object->reminds as $reminds): ?>
        <tr>
			<?php pr($reminds->remind_id); ?>
		   <td><?= h($reminds->id) ?></td>
            <td><?= h($reminds->deadline) ?></td>
            <td><?= h($reminds->next) ?></td>
            <td><?= h($reminds->state) ?></td>
            <td><?= h($reminds->object_id) ?></td>
            <td><?= h($reminds->note) ?></td>
            <td><?= h($reminds->reminds) ?></td>

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
