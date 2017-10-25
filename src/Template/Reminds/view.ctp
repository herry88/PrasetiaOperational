<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.css">


<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.7/integration/jqueryui/dataTables.jqueryui.js"></script>

<div class="objects form large-10 medium-9 columns">
    <section class="content-header">
        <h1>
            REMINDER
            <small>Detail</small>
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
                                    <?= $this->Form->input('name',['label' => 'Item', 'class' => 'form-control', 'value' => $remind->item->name, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('plat',['class' => 'form-control', 'value' => $remind->object->plat, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('name',['class' => 'form-control', 'value' => $remind->object->name, 'disabled' => 'true']); ?>                                     
                                    <?= $this->Form->input('state',['options'=>[1=>'Done',0=>'Not Yet'], 'class' => 'form-control', 'default' => $remind->state, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('deadline',['class' => 'form-control', 'value' => date_format($remind->deadline,'d M Y'), 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('next',['label' => 'Next Schedule', 'class' => 'form-control', 'value' => date_format($remind->next,'d M Y'), 'disabled' => 'true']); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $this->Form->input('price_est',['label' => 'Budget', 'class' => 'form-control', 'value' => number_format($remind->price_est,2), 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('price_act',['label' => 'Real', 'class' => 'form-control', 'value' => number_format($remind->price_act,2), 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('km_actual',['label' => 'KM Actual', 'class' => 'form-control', 'value' => $remind->km_actual, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('km_service',['label' => 'KM Service', 'class' => 'form-control', 'value' => $remind->km_service, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('sebelum_service',['label' => 'Problem', 'class' => 'form-control', 'value' => $remind->sebelum_service, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('tindakan_service',['label' => 'Counter Measure', 'class' => 'form-control', 'value' => $remind->tindakan_service, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('nama_bengkel',['label' => 'Service Location', 'class' => 'form-control', 'value' => $remind->nama_bengkel, 'disabled' => 'true']); ?>
                                    <?= $this->Form->input('vendor',['label' => 'Vendor', 'class' => 'form-control', 'value' => $remind->vendor, 'disabled' => 'true']); ?>
                                </div>
                            </div>                 
                        </div>
                        <!-- List Images -->
                        <div class="col-md-12">
                            <div class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">List View</div>

                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <?= $this->Html->link(__('Upload'),['controller'=>'RemindPhotos/Add/'.$remind_id],['class'=>'btn btn-success','right']) ?>
                                                <br/><br/>
                                            </div>

                                            <div class="row">
                                                <?php foreach ($remind_photo as $image): ?>
                                                <div class="col-md-4">   
                                                    <?= $this->Html->image('/uploads/files/'.$remind_id.'/'.$image->photo, array('width'=>'200px')) ?>
                                                    <div class="row button">
                                                          <?= $this->Form->postLink(__('Delete'), 
                                                                                  ['controller' => 'RemindPhotos', 
                                                                                      'action' => 'delete', 
                                                                                      $image->id, $remind_id],
                                                                                  ['confirm' => __('Are you sure you want to delete # {0}?', $image->id),
                                                                                    'class'=>'btn btn-danger'
                                                                                  ]) 
                                                          ?>
                                                    </div>
                                                    <br/><br/>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <!--End List View-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



