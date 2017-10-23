<?php  $this->extend('master-layout'); ?>

<?php

$this->start('top-menu');
?>

<?php
$this->end();

$this->start('side-menu');
?>
    <ul class="sidebar-menu">

        <li><a href="<?= $this->url->build('/reminds/dashboard') ; ?>"><i class="fa  fa-dashboard"></i> Dashboard</a></li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-car"></i>
                <span>Vehicle</span>
                <i class="fa pull-right fa-angle-left"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="<?= $this->url->build('/objects/car') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Cars</a></li>
                <li><a href="<?= $this->url->build('/objects/motorcycle') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Motorcycles</a></li>
            </ul>
        </li>
		<li class="treeview">
            <a href="#">
                <i class="fa fa-home"></i>
                <span>Building</span>
                <i class="fa pull-right fa-angle-left"></i>
            </a>
        <ul class="treeview-menu" style="display: none;">
                <li><a href="<?= $this->url->build('/objects/basecamp') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Homebase</a></li>
               <?php if ( $userlog == 1 ){ ?>
			   <li><a href="<?= $this->url->build('/objects/office') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Office</a></li>
            <?php } ?>
			</ul>
		</li>
		<?php if ( $userlog == 1 ){ ?>
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-wrench"></i>
                <span>Configuration</span>
                <i class="fa pull-right fa-angle-left"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="<?= $this->url->build('/types') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Type</a></li>
                <li><a href="<?= $this->url->build('/items/index') ; ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Item</a></li>

            </ul>
        </li>
		<?php } ?>
        <li><a href="<?= $this->url->build('/users/logout') ; ?>" style=""><i class="glyphicon glyphicon-off"></i> Logout</a></li>
    </ul>
    <ul class="sidebar-menu">

    </ul>
<?php
$this->end();

$this->start('main-contents');
?>
    <?= $this->fetch('content'); ?>
<?php
$this->end();
?>
