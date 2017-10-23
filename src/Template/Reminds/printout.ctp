		<?= $this->Html->css('https://code.jquery.com/ui/1.11.4/themes/cupertino/jquery-ui.css'); ?>
        <?= $this->Html->css('/bootstrap/css/bootstrap.min'); ?>
        <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'); ?>
        <?= $this->Html->css('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'); ?>
        <?= $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?= $this->Html->script('/webroot/plugins/jQuery/jQuery-2.1.4.min'); ?>
        <?= $this->Html->script('http://code.jquery.com/ui/1.11.2/jquery-ui.min.js'); ?>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <?= $this->Html->script('/bootstrap/js/bootstrap.min'); ?>
        <?= $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min'); ?>
<div class="container">
	<div class="page-content">
		<section class="content">    
	    	<div class="row">
			    <div class="col-xs-12">
			    	<h1>
				        REPORT				        
				        <small>Reminder</small>
				    </h1>
			    </div>
			</div>
			<div class="row">
			    <div class="col-xs-12">
			        <div class="box box-primary">
			            <div class="box-body">
			            	<div class="col-md-12">
			                    <div class="col-md-6">
			                        <div class="form-group">
			                        	<li>Type: <?php echo $objects->type_id; ?></li>
			                        	<li>Plat: <?php echo $objects->plat; ?></li>
										<li>Name: <?php echo $objects->name; ?></li>
										<li>Status: <?= ($objects->state == 1)? 'Active' : 'Non Active' ?></li>
										<li>PIC: <?php echo $objects->PIC; ?></li>
										
			                        </div>
			                    </div>
			                    <div class="col-md-6">
			                        <div class="form-group">
			                        	<li>Telp: <?php echo $objects->telp; ?></li>
			                        	<li>Coordinator: <?php echo $objects->coordinator; ?></li>
										<li>Location: <?php echo $objects->location; ?></li>
										<li>Address: <?php echo $objects->address; ?></li>
										<li>Note & History Service: <?php echo $objects->note; ?></li>
			                    	</div>
			                	</div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
	    </section>
	    <table cellspacing="0" width="100%">
			<tr>
				<th>Deadline</th>
				<th>Next Schedule</th>
				<th>Status</th>
				<th>Item</th>
				<th>Budget</th>
				<th>Real</th>
				<?php if($objects->type_id!=4) : ?>
				<th>KM Actual</th>
				<th>KM Service</th>
				<?php endif; ?>
				<?php if($objects->type_id!=5) : ?>
				<th>Vendor</th>
				<?php endif; ?>
				<?php if($objects->type_id!=4) : ?>
				<th>Problem</th>
				<th>Counter Measure</th>
				<th>Location Service</th>
				<?php endif; ?>
				<th>Note</th>				
			</tr>
											
										
			<?php foreach ($reminds as $remind) : ?>
			<tr>
				<td><?= date_format($remind->deadline,'d/m/Y') ?></td>
				<td><?= date_format($remind->next,'d/m/Y') ?></td>
				<td><?= ($remind->state == 1)? 'Done' : 'Not Yet' ?></td>
				<td><?php 
					foreach ($items as $item): 
						echo($item->id == $remind->item_id) ? $item->name : "";
					endforeach; 
					?>
				</td>
				<td><?= number_format($remind->price_est,2) ?></td>
				<td><?= number_format($remind->price_act,2) ?></td>
				<?php if($objects->type_id!=4) : ?>
				<td><?= $remind->km_actual ?></td>
				<td><?= $remind->km_service ?></td>
				<?php endif; ?>
				<?php if($objects->type_id!=5) : ?>
				<td><?= $remind->vendor ?></td>
				<?php endif; ?>
				<?php if($objects->type_id!=4) : ?>
				<td><?= $remind->sebelum_service ?></td>
				<td><?= $remind->tindakan_service ?></td>
				<td><?= $remind->nama_bengkel ?></td>
				<?php endif; ?>
				<td><?= $remind->note ?></td>
			</tr>		            
			<?php endforeach; ?>
		</table>
    </div>
</div>    



