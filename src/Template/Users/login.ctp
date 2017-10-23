<!-- File: src/Template/Users/login.ctp -->


	<div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Remind</b>me</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in</p>
        <?= $this->Flash->render('auth') ?>
		<?= $this->Form->create() ?>
          <div class="form-group has-feedback">  
			<?= $this->Form->input('username',['class' => 'form-control', 'placeholder' => 'Username']) ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
			<?= $this->Form->input('password',['class' => 'form-control', 'placeholder' => 'Password']) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
          
            <div class="col-xs-4">
              <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
			  <?= $this->Form->button(__('Login'),['class' => 'btn btn-primary btn-block btn-flat']); ?>

            </div><!-- /.col -->
          </div>
        <?= $this->Form->end() ?>


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

