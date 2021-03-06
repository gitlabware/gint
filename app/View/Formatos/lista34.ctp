<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">

                <h3 class="panel-title">Listado U.V. Brillo/U.V. Mate</h3>
                <div class="panel-toolbar text-right">
                    <div class="option">
                        <button class="btn up" type="button" title="Adicionar Insumo"   onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'formato34')); ?>');"><i class="ico-plus"></i> </button>
                    </div>
                </div>
            </div>
            <div>
                <table class="table table-striped" id="listadatatable">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Desde Med. Ini.</th>
                            <th>Desde Med. Fin</th>
                            <th>Hasta Med. Ini.</th>
                            <th>Hasta Med. Fin</th>
                            <th>Cantidad Inicial</th>
                            <th>Cantidad Final</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($formatos as $for): ?>
                            <tr>
                                <td><?php echo $for['Formato']['id'] ?></td>
                                <td><?php echo $for['Formato']['desdemedini'] ?></td>
                                <td><?php echo $for['Formato']['desdemedfin'] ?></td>
                                <td><?php echo $for['Formato']['hastamedini'] ?></td>
                                <td><?php echo $for['Formato']['hastamedfin'] ?></td>
                                <td><?php echo $for['Formato']['cantidadinicial'] ?></td>
                                <td><?php echo $for['Formato']['cantidadfinal'] ?></td>
                                <td><?php echo $for['Formato']['precio'] ?></td>                                  
                                <td class="text-center">
                                    <button class="btn btn-primary btn-xs" type="button" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'formato34', $for['Formato']['id'], $for['Formato']['id'])); ?>');"> <i class="ico-pencil4"></i> Editar</button>
                                    <button class="btn btn-danger btn-xs" type="button" title="Eliminar" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'delete', $for['Formato']['id'],'lista34')) ?>', '<?php echo 'Esta seguro de eliminar el insumo ' . $for['Formato']['id']; ?>');"> <i class="ico-trash"></i> Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<?php
echo $this->Html->css(array(
    '../plugins/datatables/css/datatables.css'
    , '../plugins/datatables/css/tabletools.css'
        )
        , array('block' => 'cssadd'));
?>
<?php
echo $this->Html->script(array(
    '../plugins/datatables/js/jquery.dataTables.js'
    , '../plugins/datatables/js/datatables-bs3.js'
    , 'listadatatable.js'
        ), array('block' => 'scriptadd'));
?>   

