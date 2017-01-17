<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Clientes</h3>
            </div>
            
            <div>
                <table class="table table-striped" id="listaventas">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Nit</th>
                        <th>Telefonos/celular</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clientes as $cliente):?>
                        <tr>
                            <td><?= $cliente['ClientesCtp']['id'] ?></td>
                            <td><?= $cliente['ClientesCtp']['nombre'] ?></td>
                            <td><?= $cliente['ClientesCtp']['nit'] ?></td>
                            <td><?= $cliente['ClientesCtp']['telefonos'] ?></td>
                            <td>
                                <a href="<?= $this->Html->url(['controller' => 'TrabajosCtp','action' => 'detalle',$cliente['ClientesCtp']['id']]); ?>"><?= $cliente[0]['total_ventas']-$cliente[0]['total_pagado'] ?></a>
                            </td>
                            <td>
                                <a href="<?php echo $this->Html->url(array('controller' => 'TrabajosCtp','action' => 'trabajos',$cliente['ClientesCtp']['id']));?>" class="btn btn-primary btn-xs" title="Trabajos"><i class="ico-square"></i></a>
                                <a href="javascript:" class="btn btn-warning btn-xs" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'ClientesCtp','action' => 'cliente',$cliente['ClientesCtp']['id']));?>')" title="Editar"><i class="ico-edit"></i></a>
                                <button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar', $cliente['ClientesCtp']['id'])) ?>', '<?php echo 'Esta seguro de eliminar al cliente ' . $cliente['ClientesCtp']['nombre']; ?>');" title="Eliminar"> <i class="ico-trash"></i> </button>
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
, 'listaventas.js'
), array('block' => 'scriptadd'));
?>
