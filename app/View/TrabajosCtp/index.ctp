<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Trabajos</h3>
            </div>
            <div>
                <table class="table table-striped" id="listaventas">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Numero</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Usurio</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($trabajos as $trabajo):?>
                        <tr>
                            <td><?= $trabajo['TrabajosCtp']['id'] ?></td>
                            <td><?= $trabajo['TrabajosCtp']['numero'] ?></td>
                            <td><?= $trabajo['ClientesCtp']['nombre'] ?></td>
                            <td><?= $trabajo['TrabajosCtp']['fecha'] ?></td>
                            <td><?= $trabajo['User']['nombre'] ?></td>
                            <td>

                                <a href="javascript:" class="btn btn-warning btn-xs" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'TrabajosCtp','action' => 'trabajo',$trabajo['TrabajosCtp']['id']));?>')" title="Editar"><i class="ico-edit"></i></a>
                                <button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar', $trabajo['TrabajosCtp']['id'])) ?>', '<?php echo 'Esta seguro de eliminar el trabajo ' . $trabajo['TrabajosCtp']['numero']; ?>');" title="Eliminar"> <i class="ico-trash"></i> </button>
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
