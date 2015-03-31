<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">

                <h3 class="panel-title">Listado de Clientes</h3>
            </div>
            <div>
                <table class="table table-striped" id="listadatatable">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Nit</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cli): ?>
                            <tr>
                                <td><?php echo $cli['Cliente']['id'] ?></td>
                                <td><?php echo $cli['Cliente']['nombre'] ?></td>
                                <td><?php echo $cli['Cliente']['telefono'] ?></td>
                                <td><?php echo $cli['Cliente']['nit'] ?></td>
                                <td><?php echo $cli['Cliente']['correo'] ?></td>
                                <td class="text-center">
                                    <!-- button toolbar -->
                                    <div class="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-default">Accion</button>
                                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:void(0);" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'edit', $cli['Cliente']['id'])); ?>');"><i class="icon ico-pencil"></i>Editar</a></li>
                                                <li class="divider"></li>
                                                <li><a class="text-danger" href="javascript:" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'delete', $cli['Cliente']['id'])) ?>', '<?php echo 'Esta seguro de eliminar ' . $cli['Cliente']['id']; ?>');"><i class="icon ico-remove3"></i>Eliminar</a></li>
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

