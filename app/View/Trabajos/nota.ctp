<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span><?php echo strtoupper($tipo); ?> #<?php echo $numero; ?></h3>
            </div>
            <!--/ panel heading/header -->
            <div class="panel-body">
                <div class="form-horizontal form-bordered">
                    <?php echo $this->Form->create('Trabajo', array('action' => 'registra_nota/' . $trabajo['Trabajo']['id'], 'data-parsley-validate')); ?>
                    <?php echo $this->Form->hidden('Nota.id'); ?>
                    <?php echo $this->Form->hidden('Nota.tipo'); ?>
                    <?php echo $this->Form->hidden('Nota.trabajo_id', array('value' => $trabajo['Trabajo']['id'])); ?>
                    <?php echo $this->Form->hidden('Nota.numero', array('value' => $numero)); ?>
                    <?php echo $this->Form->hidden('Nota.sucursale_id', array('value' => $trabajo['Trabajo']['sucursale_id'])) ?>
                    <?php echo $this->Form->hidden('Nota.user_id', array('value' => $this->Session->read('Auth.User.id'))) ?>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Observacion: </label>
                            <?php echo $this->Form->textarea('Nota.observaciones', array('class' => 'form-control disabled', 'placeholder' => 'Ingrese una observacion de la nota')) ?>
                        </div>
                        <?php if ($tipo == 'Nota de remision'): ?>
                            <div class="col-md-6">
                                <label class="control-label">Numero de Factura: </label>
                                <?php echo $this->Form->text('Nota.numero_factura', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el numero de factura')); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3">
                            <label class="control-label col-md-12">Costo Total: </label>
                            <label class="col-md-12 text-success control-label"><?php echo $total; ?></label>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Forma de Pago</label>
                            <?php echo $this->Form->select('Nota.tipo_pago', array('Credito' => 'Credito', 'Contado' => 'Contado'), array('class' => 'form-control', 'required', 'id' => 'idselectpago', 'onchange' => 'cambia_pago();')) ?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Monto Cancelado</label>
                            <?php
                            $readonly = 'readonly';
                            if (!empty($this->request->data['Nota']['tipo_pago'])) {
                                if ($this->request->data['Nota']['tipo_pago'] == 'Credito') {
                                    $readonly = '';
                                }
                            }
                            ?>
                            <?php echo $this->Form->text('Nota.total_pagado', array('class' => 'form-control', 'required', $readonly, 'id' => 'idtotal_pagado', 'data-parsley-type' => 'number', 'onkeyup' => 'calcula_saldo();', 'data-parsley-max' => $total)); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Monto Saldo</label>
                            <?php echo $this->Form->text('Nota.saldo', array('class' => 'form-control', 'required', 'readonly', 'id' => 'idsaldo')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-primary col-md-12" type="submit">Registrar</button>
                        </div>
                    </div>
                    <?php //echo $this->Form->hidden('Nota.total_pagado', array('id' => 'htotal_pagado')); ?>
                    <?php //echo $this->Form->hidden('Nota.saldo', array('id' => 'hsaldo')); ?>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script(array('../plugins/parsley/js/parsley.js'
        ), array('block' => 'scriptadd'));
?>
<script>
    var valor_total = <?php echo $total; ?>;
    function cambia_pago() {
        if ($('#idselectpago').val() == 'Contado') {
            $('#idtotal_pagado').attr('readonly', true);
            $('#idsaldo').attr('readonly', true);
            $('#idtotal_pagado').val(valor_total);
            $('#idsaldo').val(0);
        }
        if ($('#idselectpago').val() == 'Credito') {
            $('#idtotal_pagado').attr('readonly', false);
            $('#idsaldo').attr('readonly', true);
        }
        if ($('#idselectpago').val() == '') {
            $('#idtotal_pagado').attr('readonly', true);
            $('#idsaldo').attr('readonly', true);
            $('#idtotal_pagado').val(valor_total);
            $('#idsaldo').val(0);
        }
    }
    function calcula_saldo() {
        $('#idsaldo').val((valor_total - $('#idtotal_pagado').val()).toFixed(2));
    }

</script>