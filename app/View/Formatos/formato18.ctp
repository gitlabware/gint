<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class=" ico-calculate2 mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Linea de agua</h3></div>

</div>
<?php echo $this->Form->create('Formato', array('action' => 'guardarformato', 'data-parsley-validate')); ?>
<div class="modal-body">
    <?php echo $this->Form->hidden('id'); ?>
<?php echo $this->Form->hidden('url', array('value'=>'lista18')); ?>
    <?php echo $this->Form->hidden('tipotrabajo_id', array('value'=>18)); ?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Cantidad Inicial</label>
                <?php echo $this->Form->text('cantidadinicial', array('class' => 'form-control', 'placeholder' => 'Ingrese', 'data-parsley-type'=>'number','required')); ?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Cantidad Final</label>
                <?php echo $this->Form->text('cantidadfinal', array('class' => 'form-control', 'placeholder' => 'Ingrese', 'data-parsley-type'=>'number','required')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Numero de lineas</label>
                <?php echo $this->Form->text('numero_lineas', array('class' => 'form-control', 'placeholder' => 'Ingrese', 'data-parsley-type'=>'number','required')); ?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Precio</label>
                <?php echo $this->Form->text('precio', array('class' => 'form-control', 'placeholder' => 'Ingrese', 'data-parsley-type'=>'number','required')); ?>
            </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Registrar</button>
</div>
<?php echo $this->Form->end(); ?>

<?php
echo $this->Html->script(array(
    '../plugins/parsley/js/parsley.js'
));
?>

