<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span>VENTA</h3>
            </div>
            <!--/ panel heading/header -->
            <div class="panel-body">
                <div class="form-horizontal form-striped form-bordered">
                    <?php echo $this->Form->create('Movimiento', array('action' => 'registra_venta', 'id' => 'idformventa')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Cliente</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->select('cliente_id', $clientes, array('class' => 'form-control', 'required', 'data-parsley-group' => 'gventa')) ?>
                            <?php echo $this->Form->hidden('total', array('id' => 'idhidtotal')) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Categoria</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->select('categoria_id', $categorias, array('class' => 'form-control', 'id' => 'idselectcategoria')) ?>
                        </div>
                    </div>
                    <div id="divajaxinsumo">

                    </div>
                    <div class="row">
                        <table class="table table-bordered table-hover">
                            <tr id="regis-tab-0">
                                <th>Nro</th>
                                <th>Insumo</th>
                                <th>Micraje</th>
                                <th>Alto</th>
                                <th>Cantidad Kg</th>
                                <th>Precio</th>
                                <th>Quitar</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>TOTAL</b></td>
                                <td id="idtdtotal">0.00</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary col-md-12" type="button" onclick="valida_f_venta();">Registrar</button>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script(array(
    'iniventa.js'
    , '../plugins/parsley/js/parsley.js'
        ), array('block' => 'scriptadd'));
?>
<script>
    var array_insumos = [];
    var contador = 0;
    var datos_insumos = [];
    var total_p = 0.00;
<?php foreach ($all_insumos as $in): ?>
        array_insumos[<?php echo $in['Insumo']['id']; ?>] = [];
        array_insumos[<?php echo $in['Insumo']['id']; ?>]['nombre'] = '<?php echo $in['Insumo']['nombre']; ?>';
        array_insumos[<?php echo $in['Insumo']['id']; ?>]['micraje'] = '<?php echo $in['Insumo']['micraje']; ?>';
<?php endforeach; ?>
    function iniventana() {
        $('#idselectcategoria').change(function () {
            var idcategoria = $(this).val();
            $('#divajaxinsumo').load('<?php echo $this->Html->url(array('action' => 'ajax_form_insumo')); ?>/' + idcategoria);
        });
    }
    function valida_f_venta() {
        if ($('#idformventa').parsley().validate('gventa')) {
            $('#idformventa').parsley().destroy();
            $('#idformventa').submit();
        }
    }
    function editar() {
<?php if (!empty($this->request->data['Insumos'])): ?>
            $('#divajaxinsumo').load('<?php echo $this->Html->url(array('action' => 'ajax_form_insumo')); ?>/' + 0);
    <?php foreach ($this->request->data['Insumos'] as $d_ins): ?>
                contador++;
                datos_insumos[contador] = [];
                datos_insumos[contador]['idinsumo'] = <?php echo $d_ins['Inventario']['insumo_id'] ?>;
                datos_insumos[contador]['nombre'] = array_insumos[<?php echo $d_ins['Inventario']['insumo_id'] ?>]['nombre'];
                datos_insumos[contador]['micraje'] = '<?php echo $d_ins['Inventario']['micraje'] ?>';
                datos_insumos[contador]['alto'] = '<?php echo $d_ins['Inventario']['alto'] ?>';
                datos_insumos[contador]['cantidad'] = '<?php echo $d_ins['Inventario']['cantidad'] ?>';
                datos_insumos[contador]['precio'] = '<?php echo $d_ins['Inventario']['precio'] ?>';
    <?php endforeach; ?>
            quitar_insumo(0);
<?php endif; ?>
    }

    //-------------------------

    var registro_tr = '';
    var id_insumo = 0;
    var precio = 0.00;
    var cantidad = 0;
    var alto = 0;
    function add_a_tabla() {
        if ($('#idselectinsumo').val() != '' && $('#idselectinsumo').val() != null) {
            id_insumo = $('#idselectinsumo').val();
            alto = $('#idinputalto').val();
            cantidad = $('#idinputcantidad').val();
            precio = $('#idinputprecio').val();
        }
        
        contador++;
        registro_tr = ''
                + '<tr id="regis-tab-' + contador + '" class="ctrinsumos">'
                + '    <input type="hidden" name="data[Insumos][' + contador + '][Inventario][insumo_id]" value="' + id_insumo + '">'
                + '    <input type="hidden" name="data[Insumos][' + contador + '][Inventario][micraje]" value="' + array_insumos[id_insumo]['micraje'] + '">'
                + '    <input type="hidden" name="data[Insumos][' + contador + '][Inventario][alto]" value="' + alto + '">'
                + '    <input type="hidden" name="data[Insumos][' + contador + '][Inventario][cantidad]" value="' + cantidad + '">'
                + '    <input type="hidden" name="data[Insumos][' + contador + '][Inventario][precio]" value="' + precio + '">'
                + '    <td>' + contador + '</td>'
                + '    <td>' + array_insumos[id_insumo]['nombre'] + '</td>'
                + '    <td>' + array_insumos[id_insumo]['micraje'] + '</td>'
                + '    <td>' + alto + '</td>'
                + '    <td>' + cantidad + '</td>'
                + '    <td>' + precio + '</td>'
                + '    <td> <button class="btn btn-danger btn-xs" type="button" onclick="quitar_insumo(' + contador + ');">Quitar</button> </td>'
                + '</tr>';
        total_p = total_p + parseFloat(precio);

        var auxc = contador - 1;
        $('#regis-tab-' + auxc).after(registro_tr);
        $('#idtdtotal').html(total_p);
        $('#idhidtotal').val(total_p);
        add_vec_insumos();
        limpia_f_insumo();
    }
    function add_vec_insumos() {
        datos_insumos[contador] = [];
        datos_insumos[contador]['idinsumo'] = id_insumo;
        datos_insumos[contador]['nombre'] = array_insumos[id_insumo]['nombre'];
        datos_insumos[contador]['micraje'] = array_insumos[id_insumo]['micraje'];
        datos_insumos[contador]['alto'] = alto;
        datos_insumos[contador]['cantidad'] = cantidad;
        datos_insumos[contador]['precio'] = precio;
    }
    function quitar_insumo(idnumero) {
        limpia_f_insumo();
        contador = 0;
        total_p = 0.00;
        $('.ctrinsumos').remove();
        datos_insumos.splice(idnumero, 1);
        var aux_d_insumos = [];
        aux_d_insumos = datos_insumos;
        datos_insumos = [];
        aux_d_insumos.forEach(function (valorDelElemento, indiceDelElemento) {
            id_insumo = valorDelElemento['idinsumo'];
            precio = valorDelElemento['precio'];
            alto = valorDelElemento['alto'];
            cantidad = valorDelElemento['cantidad'];
            add_a_tabla();
        });
    }
    function limpia_f_insumo() {
        $('#idselectinsumo').val('');
        $('#idinputalto').val('');
        $('#idinputcantidad').val('');
        $('#idinputprecio').val('');
    }

</script>
