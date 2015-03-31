<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">

                <h3 class="panel-title">Listado de Docificaciones</h3>
            </div>
            <div>
                <table class="table table-striped" id="listadatatable">
                    <thead>
                        <tr>
                            <th>Numero autorizacion</th>
                            <th>Llave de Docificacion</th>
                            <th>Fecha Limite</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parametros as $pfac): ?>
                            <tr>
                                <td><?php echo $pfac['Parametrosfactura']['numero_autorizacion'] ?></td>
                                <td><?php echo $pfac['Parametrosfactura']['llave'] ?></td>
                                <td><?php echo $pfac['Parametrosfactura']['fechalimite'] ?></td>
                                <td>
                                    <button class="btn btn-primary btn-xs" type="button" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'parametrofactura',$pfac['Parametrosfactura']['id']));?>');"><i class="ico-pencil3"></i> Editar</button>
                                    <button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'elimina_parametro',$pfac['Parametrosfactura']['id']));?>','Esta seguro de eliminar la docificacion numero <?php echo $pfac['Parametrosfactura']['numero_autorizacion']?>');"><i class="ico-remove3"></i> Eliminar</button>
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

