<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class="ico-download-alt mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">ADICIONAR A <?php echo strtoupper($insumo['Insumo']['nombre']); ?></h3></div>
</div>
<?php echo $this->Form->create('Insumo', array('action' => 'registra_adicion/'.$insumo['Insumo']['categoria_id'], 'data-parsley-validate')); ?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Cantidad en Kilos</label>
                <?php echo $this->Form->hidden('Inventario.tipo',array('value' => 'Ingreso'))?>
                <?php echo $this->Form->hidden('Inventario.insumo_id')?>
                <?php echo $this->Form->text('Inventario.cantidad', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese la cantidad a adicionar', 'data-parsley-type' => 'number', 'data-parsley-min' => 0)); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Observacion</label>
                <?php echo $this->Form->textarea('Inventario.observacion', array('class' => 'form-control', 'placeholder' => 'Ingrese alguna onservacion')); ?>
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