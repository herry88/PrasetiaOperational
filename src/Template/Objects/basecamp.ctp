<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#basecamp').DataTable({
            "aLengthMenu": [[9, 10, 20, -1], [9, 10, 20, "All"]],
            "iDisplayLength": 9
        });
    });
</script>

<div class="row">
    <div class="col-md-12"><span class="pull-right">
	<?php if ( $userlog == 1 ){ ?>
	<?= $this->Html->link(__('New Homebase'), ['action' => 'addbasecamp'],['class' => 'btn btn-primary']) ?>&nbsp;<?= $this->Html->link(__('Export to Excel'), ['action' => 'exportexcelbasecamp'],['class' => 'btn btn-primary']) ?></span></div>
	<?php } ?>
	<?php if ( $userlog == 2 ){ ?>
	<?= $this->Html->link(__('Export to Excel'), ['action' => 'exportexcelbasecamp'],['class' => 'btn btn-primary']) ?></span></div>
	<?php } ?>
</div>
<br/>
<div class="objects index large-10 medium-9 columns">
    <table id="basecamp" class="display" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th>Name</th>
					<th>Deadline</th>
					<th>Next Schedule</th>
	                <th>Status</th>
	                <th>Location</th>
					<th>Company</th>
	                <th>Address</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	 
	        <tbody>
	        	<?php foreach ($basecamps as $basecamp) : ?>
	            <tr>
	                <td><?= $basecamp->name ?></td>
					
					
					
					<?php
						$last_date = null;
						foreach($basecamp->reminds as $remind){
							$last_date = $remind->deadline;							
						}												
					?>	
					<?php 
						if($last_date==null){?>
							<td> - </td>
					<?php }else{?>
					<td data-order="<?= date_timestamp_get($last_date) ?>"><?= date_format($last_date,'d M Y') ?></td>					
					<?php 
					}
					?>
					
					
					
					
					<?php
						$last_date = null;
						foreach($basecamp->reminds as $remind){
							$last_date = $remind->next;
						}						
					?>
					<?php 
						if($last_date==null){?>
							<td> - </td>
					<?php }else{?>
						<td data-order="<?= date_timestamp_get($last_date) ?>"><?= date_format($last_date,'d M Y') ?></td>
					<?php 
					}
					?>
					
					
					
					
					
	                <!--<td><?= $basecamp->telp ?></td>-->
	                <td><?= ($basecamp->state == 1)? 'Active' : 'Non Active' ?></td>
	                <td><?= $basecamp->location ?></td>
					
					<td>
						<?php 
							foreach ($companies as $company) : 
								echo ($company->id == $basecamp->company_id) ? $company->name:'';                   
							endforeach;
						?>
					</td>
	                <td><?= $basecamp->address ?></td>
	                <td><?= $this->Html->link(__('View'), ['controller'=>'reminds','action' => 'index', $basecamp->id]) ?>
						<!--<// ?= $this->Html->link(__('Print'), ['action' => 'print', $basecamp->id]) ?>-->
						<!--<// ?= $this->Html->link(__('Edit'), ['action' => 'editbasecamp', $basecamp->id]) ?>--> 
						
						 <?php if ( $userlog == 1 ){ ?>
						 <?= $this->Html->link(__('Edit'), ['action' => 'editbasecamp', $basecamp->id]) ?>
						 <?php } ?>
					</td>
	            </tr>		            
	        	<?php endforeach; ?>
	        </tbody>
	    </table>
</div>

<script type="text/javascript">

</script>

