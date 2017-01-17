<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class="ico-upload-alt mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Ingresar</h3></div>
    <h4>"<?php echo $insumo['InsumosCtp']['nombre']?>"
    <?php
    if(!empty($insumo['TotalesCTP']['cantidad'])){
        echo $insumo['TotalesCTP']['cantidad']." uds";
    }else{
        echo "0 uds";
    }
    ?></h4>
</div>
<?php echo $this->Form->create('InsumosCtp',array('data-parsley-validate'));?>
<div class="modal-body">


    <div class="form-group">

        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Unidad</label>
                <?php echo $this->Form->select('MovimientosCtp.unidad',['Caja' => 'Caja','Unidad' => 'Unidad'],array('class' => 'form-control','empty' => false,'required'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Cantidad</label>
                <?php echo $this->Form->text('MovimientosCtp.cantidad',array('class' => 'form-control','placeholder' => 'Ingrese la cantidad a ingresar','type' => 'number','required'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Fecha</label>
                <?php echo $this->Form->text('MovimientosCtp.fecha', array('class' => 'form-control', 'placeholder' => 'Fecha', 'required', 'id' => 'fecha_p_2', 'value' => date('Y-m-d'))); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Descripcion</label>
                <?php echo $this->Form->textarea('MovimientosCtp.descripcion',array('class' => 'form-control','placeholder' => 'Ingrese la descripcion'));?>
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

<script>
    $('#fecha_p_2').datepicker({dateFormat: 'yy-mm-dd'});
</script>
