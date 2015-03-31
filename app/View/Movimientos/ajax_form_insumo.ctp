<?php echo $this->Form->create('Aux', array('id' => 'idformajaxinsumo')); ?>
<div class="form-group">
    <div class="col-md-4">
        <label class="control-label">Insumo</label>
        <?php echo $this->Form->select('Aux.insumo_id', $insumos, array('class' => 'form-control', 'id' => 'idselectinsumo', 'required', 'data-parsley-group' => 'ginsumo')); ?>
    </div>
    <?php
    $required_a = '';
    $disabled_a = 'disabled';
    if (!empty($categoria)) {
        if ($categoria['Categoria']['alto']) {
            $required_a = 'required';
            $disabled_a = '';
        }
    }
    $required_precio = '';
    $disabled_precio = 'disabled';
    if (!$sw) {
        $required_precio = 'required';
        $disabled_precio = '';
    }
    ?>
    <div class="col-md-2">
        <label class="control-label">Alto</label>
        <?php echo $this->Form->text('Aux.alto', array('class' => 'form-control', $required_a, 'data-parsley-type' => 'number', 'data-parsley-group' => 'ginsumo', 'id' => 'idinputalto', $disabled_a)); ?>
    </div>
    <div class="col-md-2">
        <label class="control-label">Cantidad kg</label>
        <?php echo $this->Form->text('Aux.cantidad', array('class' => 'form-control', 'required', 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'data-parsley-group' => 'ginsumo', 'id' => 'idinputcantidad')); ?>
    </div>
    <div class="col-md-2">
        <label class="control-label">Precio</label>
        <?php echo $this->Form->text('Aux.precio', array('class' => 'form-control', $required_precio, 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'data-parsley-group' => 'ginsumo', 'id' => 'idinputprecio',$disabled_precio)); ?>
    </div>
    <div class="col-md-2">
        <label class="control-label">&emsp;</label>
        <button class="btn btn-success col-md-12" type="button" onclick="valida_f_insumo();">Add</button>
    </div>
</div>
<?php echo $this->Form->end(); ?>
<script>

    function valida_f_insumo() {
        if ($('#idformajaxinsumo').parsley().validate('ginsumo')) {
            add_a_tabla();
        }
    }
</script>
