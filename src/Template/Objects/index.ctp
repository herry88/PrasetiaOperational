<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">


<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

<div class="row">
    <div class="col-md-12"><span class="pull-right"><?= $this->Html->link(__('New Vehicle'), ['action' => 'add'],['class' => 'btn btn-primary']) ?></span></div>
</div>
<br/>
<div class="objects index large-10 medium-9 columns">
    <table id="mobil" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Plat</th>
            <th>Name</th>
            <th>PIC</th>
            <th>Telp</th>
            <th>Status</th>
            <th>Location</th>
            <th>Action</th>
        </tr>r
        </thead>

        <tbody>
        <?php foreach ($cars as $car) : ?>
            <tr>
                <td><?= $car->plat ?></td>
                <td><?= $car->name ?></td>
                <td><?= $car->PIC ?></td>
                <td><?= $car->telp ?></td>
                <td><?= ($car->state == 1)? 'Active' : 'Non Active' ?></td>
                <td><?= $car->location ?></td>
                <td><?= $this->Html->link(__('View'), ['controller'=>'reminds','action' => 'index', $car->id]) ?>
                    <?= $this->Html->link(__('Print'), ['action' => 'print', $car->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $car->id]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
	$('#mobil').DataTable({
        "aLengthMenu": [[9, 10, 20, -1], [9, 10, 20, "All"]],
        "iDisplayLength": 9
    });
</script>


