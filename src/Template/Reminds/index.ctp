<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">
<style type="text/css">
	.hide{
		visibility: hidden;
	}

	@media print
    {
    	div { display: block;width:2048px !important; }
    }
</style>


<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

 <?= $this->Html->script('http://www.jqueryscript.net/demo/jQuery-Plugin-To-Print-Any-Part-Of-Your-Page-Print/jQuery.print.js'); ?>

 <script type="text/javascript">
 	$('document').ready(function(){
 		$('.print').click(function(){
 			$('.content').print({
 				stylesheet : 'http://192.168.0.137:8008/webroot/bootstrap/css/bootstrap.min.css',
 				noPrintSelector : ".no-print",
 				globalStyles : false,
 			});
 		});
 	});
 </script>

<div class="objects form large-10 medium-9 columns">
    <section class="content-header">
        <h1>
            REMINDER
            <small class='no-print'>Create New</small>       
            <span class="pull-right">
            	<?php if($object->type->id == 1): ?>
            		<?= $this->Html->link(__('Export to Excel'), ['action' => 'printdetail', $object->id], ['class' => 'btn btn-primary']) ?>
            	<?php endif;?>
            	<?php if($object->type->id == 2): ?>
            		<?= $this->Html->link(__('Export to Excel'), ['action' => 'printdetailmotor', $object->id], ['class' => 'btn btn-primary']) ?>
            	<?php endif;?>
            	<?php if($object->type->id == 4): ?>
            		<?= $this->Html->link(__('Export to Excel'), ['action' => 'printdetailbasecamp', $object->id], ['class' => 'btn btn-primary']) ?>
            	<?php endif;?>
            	<?php if($object->type->id == 5): ?>
            		<?= $this->Html->link(__('Export to Excel'), ['action' => 'printdetailoffice', $object->id], ['class' => 'btn btn-primary']) ?>
            	<?php endif;?>
        	</span>
        </h1>
    </section>

	<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<?=	$this->Form->input('plat',['class' => 'form-control', 'value' => $object->plat, 'disabled' => 'true']); ?>
                                    	<?=	$this->Form->input('name',['class' => 'form-control', 'value' => $object->name, 'disabled' => 'true']); ?>                                    	
                                    	<?=	$this->Form->input('state',['options'=>[1=>'Active',0=>'Not Active'], 'class' => 'form-control', 'default' => $object->state, 'disabled' => 'true']); ?>
                                    	<?=	$this->Form->input('PIC',['class' => 'form-control', 'value' => $object->PIC, 'disabled' => 'true']); ?>
                                    	<?=	$this->Form->input('telp',['class' => 'form-control', 'value' => $object->telp, 'disabled' => 'true']); ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<?=	$this->Form->input('coordinator',['class' => 'form-control', 'value' => $object->coordinator, 'disabled' => 'true']); ?>
                                    	<?=	$this->Form->input('location',['class' => 'form-control', 'value' => $object->location, 'disabled' => 'true']); ?>
                                    	<?=	$this->Form->input('address',['class' => 'form-control', 'value' => $object->address, 'disabled' => 'true']); ?>
                                    	<?=	$this->Form->input('Note & History Service',['class' => 'form-control', 'value' => $object->note, 'disabled' => 'true']); ?>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
								<hr>
                            	<div class="row">
									
	    							<div class="col-md-12"><span class="pull-right">
									<?php if ( $userlog == 1 ){ ?>
									<?= $this->Html->link(__('New Reminds'), ['action' => 'add',$object->id],['class' => 'btn btn-primary no-print']) ?></span>
	    							<?php } ?>
									</div>
								</div>
								</br>
                           		<table id="remind" class="display compact" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Deadline</th>
											<th>Next Schedule</th>
											<th>Progres</th>
											<th>Item</th>
											<th>Budget</th>
											<th>Real</th>
											<?php if($object->type->id <= 2): ?>
											<th>KM Actual</th>
											<th>KM Service</th>
											<th>Problem</th>
											<th>Counter Measure</th>
											<th>Location Service</th>
											<?php endif;?>
											<?php if($object->type->id != 4): ?>
											<th>Vendor</th>
											<?php endif;?>
											<th>Note</th>
											<th class='no-print'>Action</th>
										</tr>
									</thead>								
									<tbody>
									<?php
									$totalreal = 0
									?>
							        	<?php foreach ($reminds as $remind) : ?>
							            <tr>
							                <td data-order="<?= date_timestamp_get($remind->deadline) ?>"><?= date_format($remind->deadline,'d M Y') ?></td>
							                <td data-order="<?= @date_timestamp_get($remind->next) ?>"><?= @date_format($remind->next,'d M Y') ?></td>
							                <td><?= ($remind->state == 1)? 'Done' : 'Not Yet' ?></td>
											<td><?= ($remind->item->name)?></td>
							                <td><?= number_format($remind->price_est,2) ?></td>
											<td><?= number_format($remind->price_act,2) ?></td>	
											<?php if($object->type->id <= 2): ?>		
											<td><?= $remind->km_actual ?></td>
											<td><?= $remind->km_service ?></td>
											<td><?= $remind->sebelum_service ?></td>
											<td><?= $remind->tindakan_service ?></td>
											<td><?= $remind->nama_bengkel ?></td>
											<?php endif; ?>
											<?php if($object->type->id != 4): ?>
											<td><?= $remind->vendor ?></td>
											<?php endif; ?>
											<td><?= $remind->note ?></td>
											<td><?= $this->Html->link(__('Detail'), ['action' => 'view', $remind->id],['class' => 'no-print']) ?>
												<?php if ( $userlog == 1 ){ ?>
												<?= $this->Html->link(__('Edit'), ['action' => 'edit', $remind->id, $object->id],['class' => 'no-print']) ?></td>
												<?php } ?>
										</tr>
										<?PHP
										$totalreal = $totalreal + $remind->price_act;
										?>
							        	<?php endforeach; ?>
								    </tbody>							
								</table>
								<?php
								echo 'TOTAL REAL  :  ';
								echo number_format ($totalreal) ;
									 ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
</div>

<script type="text/javascript">
	$('#remind').DataTable({
		"scrollX": true,
		// "scrollCollapse": true,
	});
</script>