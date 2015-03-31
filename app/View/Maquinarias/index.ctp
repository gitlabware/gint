<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">

                <h3 class="panel-title">Listado de Maquinarias</h3>
            </div>
            <div>
                <table class="table table-striped" id="listadatatable">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Nombre</th>
                            <th>Nr. de maquina</th>
                            <th>Descripcion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($maquinarias as $ma): ?>
                            <tr>
                                <td><?php echo $ma['Maquinaria']['id'] ?></td>
                                <td><?php echo $ma['Maquinaria']['nombre'] ?></td>
                                <td><?php echo $ma['Maquinaria']['numero_maquina'] ?></td>
                                <td><?php echo $ma['Maquinaria']['descripcion'] ?></td>
                                <td class="text-center">
                                    <!-- button toolbar -->
                                    <div class="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-default">Accion</button>
                                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:void(0);" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'edit', $ma['Maquinaria']['id'])); ?>');"><i class="icon ico-pencil"></i>Editar</a></li>
                                                <li class="divider"></li>
                                                <li><a class="text-danger" href="javascript:" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'delete', $ma['Maquinaria']['id'])) ?>', '<?php echo 'Esta seguro de eliminar ' . $ma['Maquinaria']['id']; ?>');"><i class="icon ico-remove3"></i>Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/ button toolbar -->
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