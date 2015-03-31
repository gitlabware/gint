<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class=" ico-user-plus mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Cliente</h3></div>
    
</div>
<?php echo $this->Form->create('Cliente')?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Nombre</label>
                <?php echo $this->Form->text('nombre',array('class' => 'form-control','required','placeholder' => 'Ingrese el nombre del usuario'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-5">
                <label class="control-label">Telefono</label>
                <?php echo $this->Form->text('telefono',array('class' => 'form-control','placeholder' => 'Ingrese el numero telefonico','type' => 'number'));?>
            </div>
            <div class="col-sm-7">
                <label class="control-label">Nit.</label>
                <?php echo $this->Form->text('nit',array('class' => 'form-control','placeholder' => 'Ingrese el nit','type'=>'number','required'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Email</label>
                <?php echo $this->Form->text('correo',array('class' => 'form-control','placeholder' => 'Ingrese el email','required'));?>
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
