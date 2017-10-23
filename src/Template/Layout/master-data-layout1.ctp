<?php  $this->extend('master-layout'); ?>

<?php

$this->start('top-menu');
?>

<?php
$this->end();

$this->start('side-menu');
?>
<ul class="sidebar-menu">
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Master Data</span>
            <i class="fa pull-right fa-angle-left"></i>
        </a>
        <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= $this->url->build('/') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Dashboard</a></li>
            <li><a href="<?= $this->url->build('/objects/index') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Object</a></li>
            <li><a href="<?= $this->url->build('/types/maintain') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Type</a></li>
            <li><a href="<?= $this->url->build('/items/index') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Item</a></li>
            <li><a href="<?= $this->url->build('/') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Logout</a></li>
        </ul>
    </li>
</ul>
<?php
$this->end();

$this->start('contents');
    echo $this->Flash->render();
    echo $this->fetch('content');
$this->end();
?>
