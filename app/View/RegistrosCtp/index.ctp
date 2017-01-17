
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Registros de Orden
                    "<?php echo $this->Session->read('Auth.User.Sucursale.nombre'); ?>"</h3>
            </div>
            <div>
                <table class="table table-striped" id="listaventas">
                    <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>#Nota</th>
                        <th>#Factura</th>
                        <th>Reveladores</th>
                        <th>G.araviga</th>
                        <th>Insumos</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($registros as $registro): ?>
                        <tr>
                            <td><?= $registro['RegistrosCtp']['proveedor'] ?></td>
                            <td><?= $registro['RegistrosCtp']['fecha'] ?></td>
                            <td><?= $registro['RegistrosCtp']['nro_orden_nota'] ?></td>
                            <td><?= $registro['RegistrosCtp']['nro_factura'] ?></td>
                            <td><?= $registro['RegistrosCtp']['reveladores_20_lts'] ?></td>
                            <td><?= $registro['RegistrosCtp']['goma_arabiga_10_lts'] ?></td>
                            <td><?= $registro['RegistrosCtp']['insumos'] ?></td>
                            <td>
             
                                <button class="btn btn-danger btn-xs" type="button"
                                        onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar', $registro['RegistrosCtp']['id'])) ?>', '<?php echo 'Esta seguro de eliminar el Registro '; ?>');"
                                        title="Eliminar"><i class="ico-trash"></i></button>
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

