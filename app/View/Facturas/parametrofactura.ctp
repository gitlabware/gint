
<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class="ico-certificate mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Formulario de Docificacion</h3></div>

</div>
<?php echo $this->Form->create('Factura', array('action' => 'guardaparametro', 'data-parsley-validate')); ?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">NIT de la Empresa</label>
                <?php echo $this->Form->hidden('Parametrosfactura.id'); ?>
                <?php echo $this->Form->text('Parametrosfactura.nit', array('required', 'class' => 'form-control','data-parsley-type' => 'integer')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Numero de Autorizacion</label>
                <?php echo $this->Form->text('Parametrosfactura.numero_autorizacion', array('class' => 'form-control', 'required','data-parsley-type' => 'integer')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Llave de dosificacion</label>
                <?php echo $this->Form->text('Parametrosfactura.llave', array('class' => 'form-control', 'required')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Fecha Limite</label>
                <?php echo $this->Form->text('Parametrosfactura.fechalimite', array('class' => 'form-control', 'required', 'id' => 'idfechalimite','data-mask' => '9999-99-99')); ?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Numero Inicial</label>
                <?php echo $this->Form->text('Parametrosfactura.numero_ref', array('class' => 'form-control', 'required','data-parsley-type' => 'integer')); ?>
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
    '../plugins/parsley/js/parsley.js',
    '../plugins/inputmask/js/inputmask.js'
));
?>
<script>
    //$('#idfechalimite').datepicker();
</script>