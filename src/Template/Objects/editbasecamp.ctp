<div class="objects form large-10 medium-9 columns">
    <section class="content-header">
        <h1>
            HOMEBASE
            <small>Update</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <?= $this->Form->create($object) ?>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <?php 
                                        echo $this->Form->hidden('plat',['value' => '-', 'class' => 'form-control']);
                                        echo $this->Form->input('name',['class' => 'form-control', 'placeholder' => 'Name...']);
                                        $valselected = array(1=>'Active',0=>'Not Active');
                                        echo $this->Form->input('state',['options'=>$valselected,'label' => 'Status', 'class' => 'form-control']);
                                        echo $this->Form->input('type_id',['value' => '4', 'options' => $types, 'class' => 'form-control']);
                                        echo $this->Form->input('PIC',['class' => 'form-control', 'placeholder' => 'PIC...']);
										echo $this->Form->input('company_id',['options' => $companies, 'class' => 'form-control']);
                                       ?>                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('telp',['class' => 'form-control', 'placeholder' => 'Telp...']);
                                            echo $this->Form->input('location',['class' => 'form-control', 'placeholder' => 'Location...']);
                                            echo $this->Form->input('address', ['class' => 'form-control', 'placeholder' => 'Address...']);
                                            echo $this->Form->input('note', ['class' => 'form-control', 'placeholder' => 'Note...']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                            <br/>
                                <span class="pull-right"><?= $this->Form->button(__('Submit')) ?></span>
                                
                            </div>
                            
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>