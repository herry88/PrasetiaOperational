<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#motor').DataTable({
            "aLengthMenu": [[9, 10, 20, -1], [9, 10, 20, "All"]],
            "iDisplayLength": 9
        });
    });
</script>

<div class="row">
    <div class="col-md-12"><span class="pull-right">
	<?php if ( $userlog == 1 ){ ?>
	<?= $this->Html->link(__('New MotorCycle'), ['action' => 'addmotorcycle'],['class' => 'btn btn-primary']) ?>&nbsp;<?= $this->Html->link(__('Export to Excel'), ['action' => 'exportexcelmotorcycle'],['class' => 'btn btn-primary']) ?></span></div>
	<?php } ?>
	<?php if ( $userlog == 2 ){ ?>
	<?= $this->Html->link(__('Export to Excel'), ['action' => 'exportexcelmotorcycle'],['class' => 'btn btn-primary']) ?></span></div>
	<?php } ?>
	</div>
<br/>
<div class="objects index large-10 medium-9 columns">
    <table id="motor" class="display" cellspacing="0" width="100%">
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
        <?php foreach ($motorcycles as $motorcycle) : ?>
            <tr>
                <td><?= $motorcycle->plat ?></td>
                <td><?= $motorcycle->name ?></td>
                <td><?= $motorcycle->PIC ?></td>
                <td><?= $motorcycle->telp ?></td>
				<td><?= $motorcycle->coordinator ?></td>
                <td><?= ($motorcycle->state == 1)? 'Active' : 'Non Active' ?></td>
                <td><?= $motorcycle->location ?></td>
                <td>
                    <?php 
                        foreach ($companies as $company) : 
                            echo ($company->id == $motorcycle->company_id) ? $company->name:'';                   
                        endforeach;
                    ?>
                </td>
                <td><?= $this->Html->link(__('View'), ['controller'=>'reminds','action' => 'index', $motorcycle->id]) ?>
                    <!-- <?= $this->Html->link(__('Print'), ['action' => 'print', $motorcycle->id]) ?> -->
                    <?php if ( $userlog == 1 ){ ?>
					<?= $this->Html->link(__('Edit'), ['action' => 'editmotorcycle', $motorcycle->id]) ?>
					<?php } ?>
				</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">

</script>


