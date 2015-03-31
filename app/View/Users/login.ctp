<?php echo $this->Form->create('User',array('name' => 'form-login'));?>
<div class="form-group">
    <div class="form-stack has-icon pull-left">
        <?php echo $this->Form->text('username',array('class' => 'form-control input-lg','placeholder' => 'Usuario','data-parsley-errors-container' => '#error-container','data-parsley-error-message' => 'Por favor ingrese un usuario','data-parsley-required'));?>
        <i class="ico-user2 form-control-icon"></i>
    </div>
    <br>
    
    <div class="form-stack has-icon pull-left">
        <?php echo $this->Form->password('password',array('class' => 'form-control input-lg','placeholder' => 'Password','data-parsley-errors-container' => '#error-container','data-parsley-error-message' => 'Por favor ingrese su password','data-parsley-required'));?>
        <i class="ico-lock2 form-control-icon"></i>
    </div>
</div>

<!-- Error container -->
<div id="error-container"class="mb15"></div>
<!--/ Error container -->
<div class="form-group nm">
    <button type="submit" class="btn btn-block btn-success"><span class="semibold">Ingresar</span></button>
</div>
<?php echo $this->Form->end();?>