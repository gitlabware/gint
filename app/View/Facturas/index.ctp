<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">

                <h3 class="panel-title">Listado de Facturas</h3>
            </div>
            <div>
                <table class="table table-striped" id="listadatatable">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Codigo Control</th>
                            <th>Cliente</th>
                            <th>Nit</th>
                            <th>Fecha</th>
                            <th>Imp. Total</th>
                            <th>Estado</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($facturas as $fac): ?>
                        
                            <tr>
                                <td><?php echo $fac['Factura']['numero'] ?></td>
                                <td><?php echo $fac['Factura']['codigo_control'] ?></td>
                                <td><?php echo $fac['Factura']['cliente'] ?></td>
                                <td><?php echo $fac['Factura']['nit'] ?></td>
                                <td><?php echo $fac['Factura']['fecha'] ?></td>
                                <td><?php echo $fac['Factura']['importetotal'] ?></td>
                                <td>
                                    <?php 
                                    $tipoe = 'label label-success';
                                    if($fac['Factura']['estado'] == 'Anulado'){
                                        $tipoe = 'label label-danger';
                                    }
                                    ?>
                                    <span class="<?php echo $tipoe;?>"><?php echo $fac['Factura']['estado'];?></span>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs" type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'vista_factura',$fac['Factura']['id']));?>';"><i class="ico-eye-open"></i> Ver</button> 
                                    <?php if($fac['Factura']['estado'] != 'Anulado'):?>
                                    <button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'anula_factura',$fac['Factura']['id']));?>','Esta seguro de eliminar la factura numero <?php echo $fac['Factura']['numero'];?>')"><i class="ico-cancel"></i> Anular</button>
                                    <?php endif;?>
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

