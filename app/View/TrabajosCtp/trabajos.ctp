<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Trabajos de <?php echo $cliente['ClientesCtp']['nombre'] ?></h3>
            </div>
            <div class="panel-toolbar-wrapper">

                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        <a href="<?php echo $this->Html->url(array('controller' => 'ClientesCtp','action' => 'index'));?>" class="btn btn-sm btn-inverse"><b>CLIENTES</b></a>
                        <a href="<?php echo $this->Html->url(array('controller' => 'TrabajosCtp','action' => 'detalle',$cliente['ClientesCtp']['id']));?>" class="btn btn-sm btn-primary"><b>DETALLE DE TRABAJOS</b></a>
                        <a href="<?php echo $this->Html->url(array('controller' => 'TrabajosCtp','action' => 'trabajo',$cliente['ClientesCtp']['id']));?>" class="btn btn-sm btn-success"><b>NUEVA ORDEN DE TRABAJO</b></a>
                    </div>
                </div>
            </div>
            <div>
                <table class="table table-striped" id="listaventas">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Numero</th>
                        <th>Fecha</th>
                        <th>Precio T.</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                        <th>Usurio</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($trabajos as $trabajo): ?>
                        <tr>
                            <td><?= $trabajo['TrabajosCtp']['id'] ?></td>
                            <td><?= $trabajo['TrabajosCtp']['numero'] ?></td>
                            <td><?= $trabajo['TrabajosCtp']['fecha'] ?></td>
                            <td><?= $trabajo[0]['precio_v'] ?></td>
                            <td><?= $trabajo[0]['precio_v']-$trabajo[0]['monto_p'] ?></td>
                            <td>

                                <a href="<?php echo $this->Html->url(array('controller' => 'TrabajosCtp', 'action' => 'trabajo',$cliente['ClientesCtp']['id'], $trabajo['TrabajosCtp']['id'])); ?>" class="btn btn-warning btn-xs"

                                   title="Editar"><i class="ico-edit"></i></a>
                                <button class="btn btn-danger btn-xs" type="button"
                                        onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar', $trabajo['TrabajosCtp']['id'])) ?>', '<?php echo 'Esta seguro de eliminar el trabajo ' . $trabajo['TrabajosCtp']['numero']; ?>');"
                                        title="Eliminar"><i class="ico-trash"></i></button>
                            </td>
                            <td><?= $trabajo['User']['nombre'] ?></td>
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
    , array('block' => 'cssadd'));
*/ ?><!--
--><?php
/*echo $this->Html->script(array(
    '../plugins/datatables/js/jquery.dataTables.js'
, '../plugins/datatables/js/datatables-bs3.js'
, 'listaventas.js'
), array('block' => 'scriptadd'));*/
?>
