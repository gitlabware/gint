<?php
echo $this->Html->css(array(
    '../plugins/jquery-ui/css/jquery-ui'
), array('block' => 'cssadd'));
?>
<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Registro de Material</h3>
                <div class="panel-toolbar text-right">
                    <!-- option -->
                    <div class="option">
                        <button class="btn down" data-toggle="panelcollapse"><i class="arrow"></i></button>
                    </div>
                    <!--/ option -->
                </div>
            </div>
            <div class="panel-collapse pull in">
                <div class="panel-body">
                    <div class="form-horizontal form-striped form-bordered">
                        <?php echo $this->Form->create(NULL, array('data-parsley-validate', 'url' => ['controller' => 'InsumosCtp', 'action' => 'guarda_registro_material'])); ?>
                        <?php echo $this->Form->hidden('RegistrosCtp.user_id', array('value' => $this->Session->read('Auth.User.id'))); ?>
                        <?php echo $this->Form->hidden('RegistrosCtp.sucursale_id', array('value' => $this->Session->read('Auth.User.sucursale_id'))); ?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label">Proveedor:</label>
                                <div class="col-sm-4">
                                    <?php echo $this->Form->text('RegistrosCtp.proveedor', array('class' => 'form-control', 'placeholder' => 'Proveedor', 'required')); ?>
                                </div>
                                <label class="col-sm-2 control-label">Fecha:</label>
                                <div class="col-sm-4">
                                    <?php echo $this->Form->text('RegistrosCtp.fecha', array('class' => 'form-control', 'placeholder' => 'Fecha', 'required', 'id' => 'fecha_p_1', 'value' => date('Y-m-d'))); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label">Nro Orden Nota:</label>
                                <div class="col-sm-4">
                                    <?php echo $this->Form->text('RegistrosCtp.nro_orden_nota', array('class' => 'form-control', 'placeholder' => 'Numero de nota', 'required')); ?>
                                </div>
                                <label class="col-sm-2 control-label">Nro Factura:</label>
                                <div class="col-sm-4">
                                    <?php echo $this->Form->text('RegistrosCtp.nro_factura', array('class' => 'form-control', 'placeholder' => 'Nuemero de factura')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>

                                        <th>Insumo</th>
                                        <th>Cantidad cajas</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($insumos as $idKey => $insumo): ?>
                                        <?php echo $this->Form->hidden("Insumos.$idKey.insumos_ctp_id", array('value' => $insumo['InsumosCtp']['id'])); ?>
                                        <?php echo $this->Form->hidden("Insumos.$idKey.unid_x_caja", array('value' => $insumo['InsumosCtp']['unid_x_caja'])); ?>
                                        <tr>
                                            <td><?php echo $insumo['InsumosCtp']['nombre'] ?></td>
                                            <td>
                                                <?php echo $this->Form->text("Insumos.$idKey.cantidad", array('class' => 'form-control', 'placeholder' => 'Cantidad de cajas', 'type' => 'number')); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-sm-3 control-label">Reveladores Bidon 2Lts:</label>
                                <div class="col-sm-3">
                                    <?php echo $this->Form->text('RegistrosCtp.reveladores_20_lts', array('class' => 'form-control', 'placeholder' => 'Cantidad')); ?>
                                </div>
                                <label class="col-sm-3 control-label">Goma Araviga Bindon 10Lts:</label>
                                <div class="col-sm-3">
                                    <?php echo $this->Form->text('RegistrosCtp.goma_arabiga_10_lts', array('class' => 'form-control', 'placeholder' => 'Cantidad')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-inverse col-md-12" type="submit">Registrar</button>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Insumos en
                    "<?php echo $this->Session->read('Auth.User.Sucursale.nombre'); ?>"</h3>
            </div>
            <div>
                <table class="table table-striped" id="listaventas">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Preci.V.</th>
                        <th>UdsxCaja</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($insumos as $insumo): ?>
                        <tr>
                            <td><?= $insumo['InsumosCtp']['id'] ?></td>
                            <td><?= $insumo['InsumosCtp']['nombre'] ?></td>
                            <td><?= $insumo['InsumosCtp']['descripcion'] ?></td>
                            <td><?= $insumo['InsumosCtp']['precio_venta_unid'] ?></td>
                            <td><?= $insumo['InsumosCtp']['unid_x_caja'] ?></td>
                            <td>
                                <?php
                                if (isset($insumo['TotalesCTP']['cantidad'])) {
                                    echo $insumo['TotalesCTP']['cantidad'];
                                } else {
                                    echo "0";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="javascript:" class="btn btn-success btn-xs"
                                   onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'ingresar', $insumo['InsumosCtp']['id'])); ?>')"
                                   title="Ingresar"><i class="ico-upload-alt"></i></a>
                                <?php
                                $role = $this->Session->read('Auth.User.role');
                                if ($role == 'Administrador CTP' || $insumo['InsumosCtp']['autorizacion'] == 1):?>
                                    <a href="javascript:" class="btn btn-primary btn-xs"
                                       onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'sacar', $insumo['InsumosCtp']['id'])); ?>')"
                                       title="Sacar"><i class="ico-download-alt"></i></a>
                                <?php endif; ?>
                                <a href="<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'movimientos', $insumo['InsumosCtp']['id'])); ?>"
                                   class="btn btn-info btn-xs" title="Movimientos"><i class="ico-list-ol"></i></a>
                                <a href="javascript:" class="btn btn-warning btn-xs"
                                   onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'insumo', $insumo['InsumosCtp']['id'])); ?>')"
                                   title="Editar"><i class="ico-edit"></i></a>
                                <button class="btn btn-danger btn-xs" type="button"
                                        onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar', $insumo['InsumosCtp']['id'])) ?>', '<?php echo 'Esta seguro de eliminar el insumo ' . $insumo['InsumosCtp']['nombre']; ?>');"
                                        title="Eliminar"><i class="ico-trash"></i></button>

                                <?php if ($role == 'Administrador CTP'): ?>
                                    <?php if ($insumo['InsumosCtp']['autorizacion'] != 1): ?>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'autorizar', $insumo['InsumosCtp']['id'])); ?>"
                                           class="btn btn-inverse btn-xs"
                                           title="AUTORIZAR"><i class="ico-unlock-alt"></i></a>
                                    <?php else: ?>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'desautorizar', $insumo['InsumosCtp']['id'])); ?>"
                                           class="btn btn-default btn-xs"
                                           title="DESAUTORIZAR"><i class="ico-lock2"></i></a>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
/*echo $this->Html->css(array(
        '../plugins/datatables/css/datatables.css'
    , '../plugins/datatables/css/tabletools.css'
    )
    , array('block' => 'cssadd'));*/
?>
<?php
/*echo $this->Html->script(array(
    '../plugins/datatables/js/jquery.dataTables.js'
, '../plugins/datatables/js/datatables-bs3.js'
, 'listaventas.js'
), array('block' => 'scriptadd'));*/
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
</script>
