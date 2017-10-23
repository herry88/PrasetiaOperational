<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?= $this->Html->css('https://code.jquery.com/ui/1.11.4/themes/cupertino/jquery-ui.css'); ?>
        <?= $this->Html->css('/bootstrap/css/bootstrap.min'); ?>
        <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'); ?>
        <?= $this->Html->css('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'); ?>
        <?= $this->Html->css('/dist/css/AdminLTE.min'); ?>
        <?= $this->Html->css('/dist/css/skins/_all-skins.min'); ?>
        <?= $this->Html->css('/plugins/iCheck/flat/blue'); ?>
        <?= $this->Html->css('/plugins/morris/morris'); ?>
        <?= $this->Html->css('/plugins/datepicker/datepicker3'); ?>
        <?= $this->Html->css('/plugins/daterangepicker/daterangepicker-bs3'); ?>
        <?= $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?= $this->Html->script('/plugins/jQuery/jQuery-2.1.4.min'); ?>
        <?= $this->Html->script('http://code.jquery.com/ui/1.11.2/jquery-ui.min.js'); ?>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <?= $this->Html->script('/bootstrap/js/bootstrap.min'); ?>
        <?= $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'); ?>
        <?= $this->Html->script('/plugins/morris/morris.min'); ?>
        <?= $this->Html->script('/plugins/sparkline/jquery.sparkline.min'); ?>
        <?= $this->Html->script('/plugins/jvectormap/jquery-jvectormap-1.2.2.min'); ?>
        <?= $this->Html->script('/plugins/jvectormap/jquery-jvectormap-world-mill-en'); ?>
        <?= $this->Html->script('/plugins/knob/jquery.knob'); ?>
        <?= $this->Html->script('/plugins/daterangepicker/daterangepicker'); ?>
        <?= $this->Html->script('/plugins/datepicker/bootstrap-datepicker'); ?>
        <?= $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min'); ?>
        <?= $this->Html->script('/plugins/iCheck/icheck.min'); ?>
        <?= $this->Html->script('/plugins/slimScroll/jquery.slimscroll.min'); ?>
        <?= $this->Html->script('/plugins/fastclick/fastclick.min'); ?>
        <?= $this->Html->script('/dist/js/app.min'); ?>
    </head>


<body class="hold-transition login-page">
   
	 <?= $this->fetch('content') ?>

</body>
</html>

