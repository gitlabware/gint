<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Movimientos de  "<?= $insumo['InsumosCtp']['nombre']?>" - "<?php echo (isset($insumo['TotalesCTP']['cantidad']) ? $insumo['TotalesCTP']['cantidad']." uds" : "0 uds") ?>"</h3>
                <div class="panel-toolbar text-right">
                    <div class="option">
                        <a href="<?php echo $this->Html->url(array('action' => 'index'));?>" class="btn up" type="button" title="Insumos"><b>Insumos</b> </a>
                    </div>
                </div>
            </div>
            <div>
                <table class="table table-striped" id="listaventas">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tipo</th>
                        <th>Unidad</th>
                        <th>Cantidad</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($movimientos as $movimiento):?>
                        <tr>
                            <td><?= $movimiento['MovimientosCtp']['id'] ?></td>
                            <td><?= $movimiento['MovimientosCtp']['tipo'] ?></td>
                            <td><?= $movimiento['MovimientosCtp']['unidad'] ?></td>
                            <td><?= $movimiento['MovimientosCtp']['cantidad'] ?></td>
                            <td><?= $movimiento['User']['nombre'] ?></td>
                            <td>
                                <button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar_movimiento_ctp', $movimiento['MovimientosCtp']['id'])) ?>', '<?php echo 'Esta seguro de eliminar  ' . $movimiento['MovimientosCtp']['tipo']; ?>');" title="Eliminar"> <i class="ico-trash"></i> </button>
                            </td>
                        </tr>
                    <?php endforeach;?>
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
