<?= $this->Html->script('jquery.number.min'); ?>
<?php
    // echo $this->Html->css('/bootstrap/css/bootstrap-datetimepicker.min');
    // echo $this->Html->script('/bootstrap/js/bootstrap.min');
    echo $this->Html->script('/plugins/input-mask/jquery.inputmask');
    echo $this->Html->script('/plugins/input-mask/jquery.inputmask.date.extensions');
    echo $this->Html->script('/plugins/input-mask/jquery.inputmask.extensions');
?>

<script type="text/javascript">
    $(document).ready(function(){
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();
    });
</script>

<div class="objects form large-10 medium-9 columns">
    <section class="content-header">
        <h1>
            REMINDER
            <small>Update</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <?= $this->Form->create($remind) ?>
                            <div class="col-md-12">
                                <?php echo "<h1>".$object_selects->plat." - ".$object_selects->name."</br></br></h1>"; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        echo $this->Form->input('item_id',['class' => 'form-control', 'options' => $items]);
                                        echo $this->Form->input('deadline',['class' => 'form-control','type'=>'text', 'data-inputmask'=>"'alias': 'dd/mm/yyyy'",'data-mask'=>'true']);
                                        echo $this->Form->input('next',['class' => 'form-control','type'=>'text', 'data-inputmask'=>"'alias': 'dd/mm/yyyy'",'data-mask'=>'true']);
                                        $valselected = array(0=>'Not Yet',1=>'Done');
                                        echo $this->Form->input('state',['class' => 'form-control', 'options'=>$valselected, 'label' => 'Status']);
                                        echo $this->Form->input('price_est', ['class' => 'form-control', 'label' => 'Budget', 'type' => 'text']);
                                        echo $this->Form->input('price_act', ['class' => 'form-control', 'label' => 'Real', 'type' => 'text']);
                                       ?>                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo $this->Form->input('km_actual', ['class' => 'form-control', 'label' => 'KM Actual']);
                                        echo $this->Form->input('km_service', ['class' => 'form-control', 'label' => 'KM Service']);
                                        echo $this->Form->input('sebelum_service', ['class' => 'form-control', 'label' => 'Problem']);
                                        echo $this->Form->input('tindakan_service', ['class' => 'form-control', 'label' => 'Counter Measure']);
                                        echo $this->Form->input('nama_bengkel', ['class' => 'form-control', 'label' => 'Service Location']);
										echo $this->Form->input('vendor', ['class' => 'form-control', 'label' => 'Vendor']);
                                        // echo $this->Form->input('Note',['class' => 'form-control']);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input text">
                                        <label for="Note">Note & History Service</label>
                                        <?php
                                            echo $this->Form->textarea('note',['class' => 'form-control', 'rows' => '5']);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br/>
                                    <span class="pull-right"><?= $this->Form->button(__('Submit')) ?></span>
                                    
                                </div>
                            </div>
                            
                            
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$( "#item-id" )
  .change(function() {
    var str = "";
    $( "#item-id option:selected" ).each(function() {
      str += $( this ).text() + " ";
    });
  })
  .trigger( "change" );

$('[name="price_est"]').number(true,2);
$('[name="price_act"]').number(true,2);
</script>