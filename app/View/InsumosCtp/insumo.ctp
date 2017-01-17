<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class="ico-cube2 mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Insumo</h3></div>

</div>
<?php echo $this->Form->create('InsumosCtp',array('data-parsley-validate'));?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Nombre</label>
                <?php echo $this->Form->hidden('id');?>
                <?php echo $this->Form->text('nombre',array('class' => 'form-control','required','placeholder' => 'Ingrese el nombre del insumo'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-5">
                <label class="control-label">Precio venta x unidad</label>
                <?php echo $this->Form->text('precio_venta_unid',array('class' => 'form-control','placeholder' => 'Ingrese el precio del insumo por unidad','type' => 'number','step' => 'any','required'));?>
            </div>
            <div class="col-sm-7">
                <label class="control-label">Unidades x caja</label>
                <?php echo $this->Form->text('unid_x_caja',array('class' => 'form-control','placeholder' => 'Ingrese las unidades x caja','type' => 'number','required'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Descripcion</label>
                <?php echo $this->Form->textarea('descripcion',array('class' => 'form-control','placeholder' => 'Ingrese la descripcion del insumo'));?>
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