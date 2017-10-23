<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#type').DataTable({
            "aLengthMenu": [[9, 10, 20, -1], [9, 10, 20, "All"]],
            "iDisplayLength": 9
        });
    });
</script>

<div class="row">
    <div class="col-md-12"><span class="pull-right"><?= $this->Html->link(__('New Type'), ['action' => 'add'],['class' => 'btn btn-primary']) ?><?= $this->Html->link(__('List Objects'), ['controller' => 'Objects', 'action' => 'index'],['class' => 'btn btn-primary']) ?><?= $this->Html->link(__('New Object'), ['controller' => 'Objects', 'action' => 'add'],['class' => 'btn btn-primary']) ?>
        </span></div>
</div>
<br/>

<div class="types index large-10 medium-9 columns">
    <table id="type" cellpadding="0" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($types as $type): ?>
        <tr>
            <td><?= $type->id ?></td>
            <td><?= $type->name ?></td>
            <td>
                <?= $this->Html->link(__('View'), ['action' => 'view', $type->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $type->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $type->id], ['confirm' => __('Are you sure you want to delete # {0}?', $type->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
</div>
