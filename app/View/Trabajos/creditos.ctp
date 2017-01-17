<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <?php echo $this->Form->create('Trabajo', array('action' => 'pagar_creditos')); ?>
            <div class="panel-heading">
                <h3 class="panel-title">Listado de Creditos de trabajos</h3>
                <div class="panel-toolbar text-right">
                    <button class="btn up btn-success" type="submit"><i class="icon ico-coins"></i>Pagar</button>
                </div>
            </div>
            <div>
                <table class="table table-striped table-bordered" id="listatrabajos">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Fecha</th>
                            <th>#Nota</th>
                            <th>#ID Trab.</th>
                            <th>Cliente</th>
                            <th>Sucursal</th>
                            <th>Nota</th>
                            <th>#Factura</th>
                            <th>Pago</th>
                            <th>Costo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<!--/ END row -->
<script>
    var urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'creditos.json')); ?>';
    function pagar(idNota) {
        window.location = '<?php echo $this->Html->url(array('action' => 'pagar_credito')); ?>/' + idNota;
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
    , 'listatrabajos.js'
        ), array('block' => 'scriptadd'));
?>
