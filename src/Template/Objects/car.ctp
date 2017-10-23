<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#mobil').DataTable({
            "aLengthMenu": [[9, 10, 20, -1], [9, 10, 20, "All"]],
            "iDisplayLength": 9
        });
    });
</script>

<div class="row">
    <div class="col-md-12"><span class="pull-right">
	<?php if ( $userlog == 1 ){ ?>
	<?= $this->Html->link(__('New Car'), ['action' => 'add'],['class' => 'btn btn-primary']) ?>&nbsp;<?= $this->Html->link(__('Export to Excel'), ['action' => 'exportexcelcar'],['class' => 'btn btn-primary']) ?></span></div>
	<?php } ?>
	<?php if ( $userlog == 2 ){ ?>
	<?= $this->Html->link(__('Export to Excel'), ['action' => 'exportexcelcar'],['class' => 'btn btn-primary']) ?></span></div>
	<?php } ?>
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
			<th>Koordinator</th>
            <th>Status</th>
            <th>Location</th>
            <th>Company</th>
			<th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($cars as $car) : ?>
            <tr>
                <td><?= $car->plat ?></td>
                <td><?= $car->name ?></td>
                <td><?= $car->PIC ?></td>
                <td><?= $car->telp ?></td>
				<td><?= $car->coordinator ?></td>
                <td><?= ($car->state == 1)? 'Active' : 'Non Active' ?></td>
                <td><?= $car->location ?></td>
                <td>
                    <?php 
                        foreach ($companies as $company) : 
                            echo ($company->id == $car->company_id) ? $company->name:'';                   
                        endforeach;
                    ?>
                </td>
                <td><?= $this->Html->link(__('View'), ['controller'=>'reminds','action' => 'index', $car->id]) ?>
                    <!--<//?= $this->Html->link(__('Print'), ['controller'=>'reminds','action' => 'printout', $car->id]) ?>-->
                    <?php if ( $userlog == 1 ){ ?>
					<?= $this->Html->link(__('Edit'), ['action' => 'edit', $car->id]) ?>
					<?php } ?>
				</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">

</script>


