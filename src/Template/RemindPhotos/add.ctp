<div class="objects form large-10 medium-9 colums">
    <section class="content-header">
        <h1>Images ADD
            <small>Create New</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                         <?= $this->Form->create($remind_photo,array('type'=>'file')) ?>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->hidden('remind_id',['default' => $remind_id]);
                                        echo $this->Form->input('name',array('class'=>'form-control','placeholder'=>'Isikan Nama'));
                                        echo $this->Form->input('photo',['type'=>'file']);
                                    ?>
                                    
                                </div> 
                            </div>  
                        </div>
                        <br>
                             
                            <span class="pull-right"><?= $this->Form->button(__('Upload Data'),['class'=>'btn btn-info']) ?></span>
                            <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>