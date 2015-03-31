<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Transferencias</h3>
            </div>
            <div>
                <table class="table table-striped" id="listatransferencias">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Sucursal Transferida</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/ END row -->
<script>
    var urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'transferencias.json')); ?>';
    
    function imprimirt(idMovimiento){
        window.location = '<?php echo $this->Html->url(array('action' => 'nota_transferencia'));?>/'+idMovimiento;
    }
    function eliminart(idMovimiento){
        confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar_transferencia'));?>/'+idMovimiento,'Esta seguro de cancelar la transferencia '+idMovimiento+'???');
    }
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
    , 'listatransferencias.js'
        ), array('block' => 'scriptadd'));
?>
