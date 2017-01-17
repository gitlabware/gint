<!-- START row -->
<?php
echo $this->Html->css(array(
    '../plugins/jquery-ui/css/jquery-ui'
), array('block' => 'cssadd'));
?>
<script>
    var total_pagado = 0.00;
</script>
<div class="row">
    <div class="col-md-12">
        <!-- START panel -->
        <?php

        if (!empty($this->request->data['TrabajosCtp']['id'])) {
            $color_panel = "inverse";
        } else {
            $color_panel = "primary";
        }
        ?>

        <div class="panel panel-<?= $color_panel ?>">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span>ORDEN DE TRABAJO
                    CTP</h3>
                <div class="panel-toolbar text-right">
                    <div class="option">
                        <a href="<?php echo $this->Html->url(array('action' => 'trabajos', $cliente['ClientesCtp']['id'])); ?>"
                           class="btn up" type="button" title="Insumos"><b>Trabajos</b> </a>
                    </div>
                </div>
            </div>
            <!--/ panel heading/header -->
            <div class="panel-body">
                <div class="form-horizontal form-striped form-bordered">
                    <?php if (!empty($this->request->data['TrabajosCtp']['id'])): ?>
                        <?php echo $this->Form->create('TrabajosCtp', array('url' => array('controller' => 'TrabajosCtp', 'action' => 'registra_pago'), 'data-parsley-validate')); ?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-sm-2">
                                    <?php echo $this->Form->select('PagosCtp.tipo', ['Efectivo' => 'Efectivo', 'Cheque' => 'Cheque', 'Deposito' => 'Deposito'], array('class' => 'form-control', 'empty' => false, 'required')); ?>
                                </div>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->text('PagosCtp.monto', array('class' => 'form-control', 'placeholder' => 'Monto', 'required', 'type' => 'number', 'step' => 'any')); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php echo $this->Form->text('PagosCtp.descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
                                </div>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->text('PagosCtp.fecha', array('class' => 'form-control', 'placeholder' => 'Fecha', 'required', 'id' => 'fecha_p_2', 'value' => date('Y-m-d'))); ?>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success col-md-12" type="submit">Registrar</button>
                                </div>
                            </div>
                        </div>
                    <?php echo $this->Form->hidden('PagosCtp.trabajos_ctp_id', array('value' => $this->request->data['TrabajosCtp']['id'])); ?>
                    <?php echo $this->Form->end(); ?>
                    <?php if (!empty($pagos)): ?>
                    <?php $total_pagado = 0.00; ?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Insumo</th>
                                        <th>Tipo</th>
                                        <th>Monto</th>
                                        <th>Total</th>
                                        <th>Saldo</th>
                                        <th>Descripcion</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($pagos as $pago): ?>
                                        <?php
                                        $total_pagado = $total_pagado + $pago['PagosCtp']['monto'];
                                        ?>

                                        <tr>
                                            <td><?= $pago['PagosCtp']['fecha'] ?></td>
                                            <td><?= $pago['InsumosCtp']['nombre'] ?></td>
                                            <td><?= $pago['PagosCtp']['tipo'] ?></td>
                                            <td><?= $pago['PagosCtp']['monto'] ?></td>
                                            <td><?= $pago['VentasCtp']['precio_venta'] ?></td>
                                            <td><?= $pago['VentasCtp']['precio_venta'] - $pago[0]['saldo_total'] ?></td>
                                            <td><?= $pago['PagosCtp']['descripcion'] ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-xs" type="button"
                                                        onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar_pago', $pago['PagosCtp']['id'])) ?>', '<?php echo 'Esta seguro de eliminar el pago ??'; ?>');"
                                                        title="Eliminar"><i class="ico-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>TOTAL PAGADO</td>
                                        <td><?= $total_pagado ?></td>
                                        <td>SALDO</td>
                                        <td id="iddsaldo"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                        <div class="col-md-12">
                            <h5 class="semibold text-primary nm text-center">----- TRABAJO -----</h5>
                        </div>
                        <script>
                            total_pagado = <?php echo $total_pagado;?>;
                        </script>
                    <?php endif; ?>

                    <?php echo $this->Form->create('TrabajosCtp', array('data-parsley-validate', 'id' => 'formu-trabajo')); ?>
                    <?php echo $this->Form->hidden('user_id', array('value' => $this->Session->read('Auth.User.id'))); ?>
                    <?php echo $this->Form->hidden('id'); ?>
                    <?php echo $this->Form->hidden('sucursale_id', array('value' => $this->Session->read('Auth.User.sucursale_id'))); ?>
                    <?php echo $this->Form->hidden('clientes_ctp_id', array('value' => $cliente['ClientesCtp']['id'])); ?>
                    <?php //echo $this->Form->hidden('fecha', array('value' => date('Y-m-d'))); ?>

                    <div id="ultimotrabajo-0">
                        <div class="form-group" id="idseleccli">
                            <div class="col-sm-3">
                                <?php
                                if (empty($this->request->data['TrabajosCtp']['fecha'])) {
                                    $this->request->data['TrabajosCtp']['fecha'] = date('Y-m-d');
                                }

                                ?>
                                <?php echo $this->Form->text('fecha', array('class' => 'form-control', 'placeholder' => 'Fecha', 'required', 'id' => 'fecha_p_1')); ?>
                            </div>
                            <label
                                class="col-sm-3 control-label">Cliente: <?= $cliente['ClientesCtp']['nombre'] ?></label>
                            <label class="col-sm-2 control-label">Nro</label>
                            <div class="col-sm-4">
                                <?php echo $this->Form->text('numero', array('class' => 'form-control', 'placeholder' => 'Numero de trabajo', 'type' => 'number', 'required')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Cantidad</th>
                                    <th>Maquina</th>
                                    <th style="width: 12%;">Precio U.</th>
                                    <th>Descripcion</th>
                                    <th>Lineatura</th>
                                    <th style="width: 14%;">Subtotal</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($insumos as $idKey => $insumo): ?>
                                    <?php echo $this->Form->hidden("Insumos.$idKey.insumos_ctp_id", array('value' => $insumo['InsumosCtp']['id'])); ?>
                                    <?php
                                    if (!empty($insumo['VentasCtp']['id'])) {
                                        $this->request->data['Insumos'][$idKey] = $insumo['VentasCtp'];
                                        $this->request->data['Insumos'][$idKey]['precio_venta2'] = $insumo['VentasCtp']['precio_venta'];
                                        echo $this->Form->hidden("Insumos.$idKey.id", array('value' => $insumo['VentasCtp']['id']));
                                        echo $this->Form->hidden("Insumos.$idKey.cantidad_anterior", array('value' => $insumo['VentasCtp']['cantidad']));
                                    } else {
                                        $this->request->data['Insumos'][$idKey]['precio_unitario'] = $insumo['InsumosCtp']['precio_venta_unid'];
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $this->Form->text("Insumos.$idKey.cantidad", array('class' => 'form-control c_cantidad', 'data-id' => $idKey, 'data-precio' => $insumo['InsumosCtp']['precio_venta_unid'], 'placeholder' => 'Cantidad', 'id' => 'idcantidad-' . $idKey)); ?>
                                        </td>
                                        <td><?php echo $insumo['InsumosCtp']['nombre'] ?></td>
                                        <td>
                                            <?php echo $this->Form->text("Insumos.$idKey.precio_unitario", array('class' => 'form-control c_preciouni', 'placeholder' => 'Precio Unitario', 'type' => 'number', 'step' => 'any', 'id' => 'idpreciouni-' . $idKey, 'data-id' => $idKey)); ?>
                                        </td>
                                        <td>
                                            <?php echo $this->Form->text("Insumos.$idKey.descripcion", array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
                                        </td>
                                        <td>
                                            <?php echo $this->Form->checkbox("Insumos.$idKey.couche"); ?> Couche<br>
                                            <?php echo $this->Form->checkbox("Insumos.$idKey.bond"); ?> Bond
                                        </td>
                                        <td>
                                            <?php echo $this->Form->hidden("Insumos.$idKey.precio_venta", array('class' => 'form-control c_subtotal', 'placeholder' => 'Subtotal', 'id' => 'idsubtotal-' . $idKey)); ?>
                                            <?php echo $this->Form->text("Insumos.$idKey.precio_venta2", array('class' => 'form-control c_subtotal2', 'placeholder' => 'Subtotal', 'id' => 'idsubtotal2-' . $idKey, 'type' => 'number', 'any' => 'number', 'disabled')); ?>
                                        </td>
                                        <td class="text-danger"><b><?php echo $insumo['TotalesCTP']['cantidad'] ?></b>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $this->Form->text("total", array('class' => 'form-control', 'placeholder' => 'Total', 'disabled', 'id' => 'idtotal')); ?></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary col-md-12" type="submit">Registrar</button>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>
<!--/ END row -->
<script>
    $('.c_cantidad').keyup(function () {
        var idkey = $(this).attr('data-id');
        var precio = parseFloat($('#idpreciouni-' + idkey).val());
        var cantidad = $(this).val();
        $('#idsubtotal-' + idkey).val(precio * cantidad);
        $('#idsubtotal2-' + idkey).val(precio * cantidad);
        suma_subtotales();
    });

    $('.c_preciouni').keyup(function () {
        var idkey = $(this).attr('data-id');
        var cantidad = parseInt($('#idcantidad-' + idkey).val());
        var precio = $(this).val();
        $('#idsubtotal-' + idkey).val(precio * cantidad);
        $('#idsubtotal2-' + idkey).val(precio * cantidad);
        suma_subtotales();
    });

    function suma_subtotales() {
        var suma_tot = 0.00;
        $('.c_subtotal').each(function (er, elemento) {
            if ($(elemento).val() != '') {
                suma_tot = suma_tot + parseFloat($(elemento).val());
            }
        });

        $('#idtotal').val(suma_tot);
        <?php if (!empty($this->request->data['TrabajosCtp']['id'])):?>
        if (total_pagado >= suma_tot) {
            $('.panel').removeClass('panel-<?= $color_panel ?>').addClass('panel-success');
        } else {
            $('.panel').removeClass('panel-success').addClass('panel-<?= $color_panel ?>');
        }
        <?php endif;?>

        $('#iddsaldo').html(suma_tot - total_pagado);
    }
    $('.c_subtotal').keyup(function () {
        suma_subtotales();
    });
    suma_subtotales();


</script>
<?php
echo $this->Html->script(array(
    'initrabajo.js'
, '../plugins/parsley/js/parsley.js'
), array('block' => 'scriptadd'));
?>

<?php
echo $this->Html->script(array(
        '../plugins/jquery-ui/js/jquery-ui',
        '../plugins/parsley/js/parsley'
    )
);
?>
<script>
    //------------ CAMBIA EL IDIOMA AL DATEPICKER ------------
    $(function ($) {
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
    });
    $('#fecha_p_1').datepicker({dateFormat: 'yy-mm-dd'});
    $('#fecha_p_2').datepicker({dateFormat: 'yy-mm-dd'});


    <?php if (!empty($pagos)): ?>
    $('#formu-trabajo :input').prop('disabled', true);
    <?php endif;?>

</script>