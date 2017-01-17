<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class=" ico-user7 mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Usuario</h3></div>
    
</div>
<?php echo $this->Form->create('User',array('action' => 'guardarusuario','data-parsley-validate'));?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Nombre</label>
                <?php echo $this->Form->hidden('id');?>
                <?php echo $this->Form->text('nombre',array('class' => 'form-control','required','placeholder' => 'Ingrese el nombre del usuario'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-5">
                <label class="control-label">C.I.</label>
                <?php echo $this->Form->text('nit',array('class' => 'form-control','placeholder' => 'Ingrese el C.I. del usuario','type' => 'number'));?>
            </div>
            <div class="col-sm-7">
                <label class="control-label">Correo/email</label>
                <?php echo $this->Form->text('correo',array('class' => 'form-control','placeholder' => 'Ingrese el correo electronico del usuario'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Usuario</label>
                <?php echo $this->Form->text('username',array('class' => 'form-control','placeholder' => 'Ingrese el Usuario','required'));?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Password</label>
                <?php echo $this->Form->password('password',array('class' => 'form-control','placeholder' => 'Ingrese un password','required','value' => ''));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Tipo</label>
                <?php echo $this->Form->select('role',$roles,array('class' => 'form-control','required'));?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Sucursal</label>
                <?php echo $this->Form->select('sucursale_id',$sucursales,array('class' => 'form-control','required'));?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Registrar</button>
</div>
<?php echo $this->Form->end();?>

<?php echo $this->Html->script(array(
    '../plugins/parsley/js/parsley.js'
    )); ?>