<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Listado de trabajos</h3>
            </div>
            <div>
                <table class="table table-bordered" id="listatrabajos">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Telefono</th>
                            <th>Sucursal</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Telefono</th>
                            <th>Sucursal</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
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
    var urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'index.json')); ?>';
    function editart(idTrabajo) {
        window.location = '<?php echo $this->Html->url(array('action' => 'trabajo')); ?>/' + idTrabajo;
    }
    function imprimirt(idTrabajo) {
        window.location = '<?php echo $this->Html->url(array('action' => 'vista_trabajo')); ?>/' + idTrabajo;
    }
    function eliminart(idTrabajo) {
        confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar')); ?>/' + idTrabajo, 'Esta seguro de liminar el trabajo ' + idTrabajo + '???');
    }
    function produccion(idTrabajo) {
        window.location = '<?php echo $this->Html->url(array('action' => 'vista_produccion',)); ?>/' + idTrabajo;
    }
</script>
<?php
echo $this->Html->css(array(
    '../plugins/datatables/css/datatables.css'
    , '../plugins/datatables/css/tabletools.css'
        )
        , array('block' => 'cssadd'));
?>
<?php echo $this->start('scriptadd'); ?>
<?php
echo $this->Html->script(array(
    '../plugins/datatables/js/jquery.dataTables.js'
    , '../plugins/datatables/js/datatables-bs3.js'
    , 'jquery.dataTables.columnFilter'
));
?>
<script>
    var filtro_c = [
    {type: "text"},
    {type: "text"},
    {type: "text"},
    {type: "select", values: [
<?php foreach ($sucursales as $su): ?>
        '<?php echo $su; ?>',
<?php endforeach; ?>
    ]},
    {type: "text"},
    {type: "text"},
    ];
    $('#listatrabajos').dataTable({
        'bProcessing': true,
        'sAjaxSource': urljsontablatrab,
        'sServerMethod': 'POST',
        "order": [],
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            if (aData[4] == 'Produccion')
            {
                // color rows from 0-6
                for (var i = 0; i < 7; i++) {
                    $('td:eq(' + i + ')', nRow).css("backgroundColor", "#d9edf7");
                }
            }
        }
    }).columnFilter({
        sPlaceHolder: "head:before",
        aoColumns: filtro_c
    });
</script>
<?php echo $this->end(); ?>