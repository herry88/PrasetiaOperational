<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#office').DataTable({
            "aLengthMenu": [[9, 10, 20, -1], [9, 10, 20, "All"]],
            "iDisplayLength": 9
        });
    });
</script>

<div class="row">
    <div class="col-md-12"><span class="pull-right"><?= $this->Html->link(__('New Office'), ['action' => 'addoffice'],['class' => 'btn btn-primary']) ?>&nbsp;<?= $this->Html->link(__('Export to Excel'), ['action' => 'exportexceloffice'],['class' => 'btn btn-primary']) ?></span></div>
</div>
<br/>
<div class="objects index large-10 medium-9 columns">
    <table id="office" class="display" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th>Name</th>
	                <th>PIC</th>
	                <th>Telp</th>
	                <th>Status</th>
	                <th>Location</th>
					<th>Company</th>
	                <th>Address</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	 
	        <tbody>
	        	<?php foreach ($offices as $office) : ?>
	            <tr>
	                <td><?= $office->name ?></td>
	                <td><?= $office->PIC ?></td>
	                <td><?= $office->telp ?></td>
	                <td><?= ($office->state == 1)? 'Active' : 'Non Active' ?></td>
	                <td><?= $office->location ?></td>
					<td>
						<?php 
							foreach ($companies as $company) : 
								echo ($company->id == $office->company_id) ? $company->name:'';                   
							endforeach;
						?>
					</td>
	                <td><?= $office->address ?></td>
	                <td><?= $this->Html->link(__('View'), ['controller'=>'reminds','action' => 'index', $office->id]) ?>
						<!-- <?= $this->Html->link(__('Print'), ['action' => 'print', $office->id]) ?> -->
						<?= $this->Html->link(__('Edit'), ['action' => 'editoffice', $office->id]) ?>
					</td>
	            </tr>		            
	        	<?php endforeach; ?>
	        </tbody>
	    </table>
</div>

<script type="text/javascript">

</script>


