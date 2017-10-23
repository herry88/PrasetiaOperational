<div class="objects form large-10 medium-9 columns">
    <section class="content-header">
        <h1>
            ITEM
            <small>Create New</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <?= $this->Form->create($item) ?>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        echo $this->Form->input('name',['class' => 'form-control', 'placeholder' => 'Name...']);
                                        echo $this->Form->input('nremind1',['label' => 'N Remind #1', 'class' => 'form-control', 'placeholder' => 'N Remind #1...']);
                                        echo $this->Form->input('nremind2',['label' => 'N Remind #1', 'class' => 'form-control', 'placeholder' => 'N Remind #2...']);
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