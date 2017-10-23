<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">


<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.8/sorting/date-uk.js"></script>


<div class="objects form large-10 medium-9 columns">
    <section class="content-header">
  <!-- Dashboarnya di hide --><?php if ( $userlog == 1 ){ ?>
		<h1>
            Dashboard
           
        </h1>
    </section>

	<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">

                        <div class="col-md-4">
                            <!-- DONUT CHART -->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Donut Chart</h3>
                                </div>
                                <div class="box-body chart-responsive" >
                                    <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div><!-- /.col (LEFT) -->

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-8">
                            <!-- BAR CHART -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Bar Chart</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div><!-- /.col (RIGHT) -->
						<?php } ?>

                        <div class="col-md-12">
								
                            	<h4>Deadline Reminder Annualy</h4>
								</br>
                           		<table id="remind" class="display" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Type</th>
											<th>Name</th>
											<th>Plat</th>
											<th>Location</th>
											<th>Deadline</th>
											<th>Next Schedule</th>
											<th>Status</th>
											<th>Item</th>
											<!-- <th>Budget</th>
											<th>Real</th> 										
											<th>KM Actual</th>
											<th>KM Service</th> -->

										</tr>
									</thead>								
									<tbody>
							        	<?php foreach ($reminds as $remind) : ?>
							            <tr>
							            	<td>
							            		<?php 
							            			foreach ($objects as $object) : 
							            				if($object->id == $remind->object_id)
							            				{
							            					foreach ($types as $type):
																echo ($type->id == $object->type_id) ? $type->name:'';
									            			endforeach;
							            				}								            			
							            			endforeach;
							            		?>
											</td>
							                <td>
							                	<?php 
												foreach ($objects as $object): 
													if($object->id == $remind->object_id){
														$oname = $object->name;
														$oplat = $object->plat;
														$oloc = $object->location;
													} 
												endforeach; 
												
												echo $oname;
												?>
											</td>
											<td><?php echo $oplat; ?></td>
											<td><?php echo $oloc; ?></td>
											<td data-order="<?= date_timestamp_get($remind->deadline) ?>"><?= date_format($remind->deadline,'d/m/Y') ?></td>
							                <td data-order="<?= date_timestamp_get($remind->next) ?>"><?= date_format($remind->next,'d/m/Y') ?></td>
							                <td><?= ($remind->state == 1)? 'Done' : 'Not Yet' ?></td>
											<td><?php 
												foreach ($items as $item): 
													echo($item->id == $remind->item_id) ? $item->name : "";
												endforeach; 
												?>
											</td>
							                <!-- <td><?php //number_format($remind->price_est,2) ?></td>
											<td><?php //number_format($remind->price_act,2) ?></td> 
											
											<td><?= $remind->km_actual ?></td>
											<td><?= $remind->km_service ?></td> -->
											
											
											
							            </tr>		            
							        	<?php endforeach; ?>
								    </tbody>							
								</table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
</div>

<script type="text/javascript">
	$('#remind').DataTable({
		"order" : [[4,"asc"]]
		// "columnDefs": [
  //           { "type": "date-uk", targets: 4 }
  //       ]
	});
</script>

<script type="text/javascript">
    $(function() {
        "use strict";
        //DONUT CHART
        var donut = new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: ["blue", "lightgreen", "yellow","magenta", "cyan", "orange"],
            data: [
                <?php
                    foreach ($donuts as $item):
                    ?>
                        {label:"<?= $item->item->name ?>",value:<?= $item->total ?>},
                    <?php
                    endforeach;                 
                ?>
            ],
            hideHover: 'auto'
        });
        //BAR CHART
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: [
                <?php 
                foreach ($barGroups as $key => $bar) {
                    $groupName = '';
                    foreach ($types as $type):
                        $groupName = ($type->id == $key) ? $type->name:$groupName;
                    endforeach;
                ?>
                {y:'<?= $groupName ?>',a:<?= isset($bar[1])?$bar[1]:0; ?>,b:<?= isset($bar[2])?$bar[2]:0; ?>,c:<?= isset($bar[3])?$bar[3]:0; ?>,d:<?= isset($bar[4])?$bar[4]:0; ?>,e:<?= isset($bar[5])?$bar[5]:0; ?>,f:<?= isset($bar[7])?$bar[7]:0; ?>
                },
                <?php
                }
                 ?>
            ],
            barColors: ['yellow', 'magenta', 'cyan','orange', 'blue', 'lightgreen'],
            xkey: 'y',
            ykeys: ['a', 'b', 'c', 'd', 'e', 'f'],
            labels: ['Service', 'Perpanjang STNK', 'Perpanjang KIR', 'Perpanjang Izin Trayek', 'Penyewaan Basecamp', 'Insurance'],
            hideHover: 'auto'
        });
    });
</script>