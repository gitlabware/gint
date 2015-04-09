<style>

    .CSSTableGenerator {
        margin:0px;padding:0px;
        width:100%;
        border:1px solid #000000;

        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;

        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;

        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;

        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }.CSSTableGenerator table{
        border-collapse: collapse;
        border-spacing: 0;
        width:100%;
        height:100%;
        margin:0px;padding:0px;
    }.CSSTableGenerator tr:last-child td:last-child {
        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:first-child {
        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:last-child {
        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;
    }.CSSTableGenerator tr:last-child td:first-child{
        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;
    }.CSSTableGenerator tr:hover td{
        background-color:#ffffff;


    }
    .CSSTableGenerator td{
        vertical-align:middle;

        background-color:#ffffff;

        border:1px solid #000000;
        border-width:0px 1px 1px 0px;
        padding:7px;
        font-size:10px;
        font-family:Arial;
        font-weight:bold;
        color:#000000;
    }.CSSTableGenerator tr:last-child td{
        border-width:0px 1px 0px 0px;
    }.CSSTableGenerator tr td:last-child{
        border-width:0px 0px 1px 0px;
    }.CSSTableGenerator tr:last-child td:last-child{
        border-width:0px 0px 0px 0px;
    }
</style>
<?php if ($trabajo['Trabajo']['estado'] != 'Facturado'): ?>
    <div class="row hidden-print">
        <div class="col-md-12">
            <!-- START panel -->
            <div class="panel panel-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('controller' => 'Facturas', 'action' => 'factura', $trabajo['Trabajo']['id'])); ?>'" class="btn btn-warning col-md-12"> <i class="ico-qrcode"> </i> FACTURAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row hidden-print">
        <div class="col-md-12">
            <!-- START panel -->
            <div class="panel panel-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('controller' => 'Facturas', 'action' => 'vista_factura', $trabajo['Trabajo']['factura_id'])); ?>'" class="btn btn-info col-md-12"> <i class="ico-qrcode"> </i> VER FACTURAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" align="center">
            <table class="CSSTableGenerator">
                <tr>
                    <td><h4 class="text-danger">HOJA DE PRODUCCION DE TRABAJO #<?php echo $trabajo['Trabajo']['id'] ?></h4></td>
                    <td>
                        <h4 class="text-info">Fecha y Hora: 
                            <?php
                            if (!empty($producciones)) {
                                echo $producciones[0]['Hojasproduccione']['created'];
                            }
                            ?>
                        </h4>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-danger">Cliente</td>
                    <td><?php echo $trabajo['Cliente']['nombre']; ?></td>
                    <td class="text-danger">Nit</td>
                    <td><?php echo $trabajo['Cliente']['nit']; ?></td>
                    <td class="text-danger">Telefonos</td>
                    <td><?php echo $trabajo['Cliente']['telefono'] . ' ' . $trabajo['Cliente']['celular']; ?></td>
                </tr>
            </table>
            <span class="text-success" style="font-weight: bold; font-size: 19px; margin-top: 4px; margin-bottom: 4px;" >DETALLE DE PRODUCCION</span>
            <table class="CSSTableGenerator">
                <tr>
                    <td>Cantidad</td>
                    <td>Descripcion</td>
                    <td>Formato</td>
                    <td>Cara</td>
                    <td>Costo</td>
                </tr>
                <?php $total = 0.00; ?>
                <?php foreach ($producciones as $pro): ?>
                    <tr>
                        <td><?php echo $pro['Hojasproduccione']['cantidad']; ?></td>
                        <td><?php echo $pro['Hojasproduccione']['descripcion']; ?></td>
                        <td>
                            <?php
                            if (!empty($pro['Hojasproduccione']['metrajeini']) && !empty($pro['Hojasproduccione']['metrajefin'])) {
                                echo $pro['Hojasproduccione']['metrajeini'] . ' X ' . $pro['Hojasproduccione']['metrajefin'];
                            } elseif ($pro['Hojasproduccione']['precio'] == 3) {
                                echo 'Carta';
                            } elseif ($pro['Hojasproduccione']['precio'] == 4) {
                                echo 'Oficio';
                            } elseif (!empty($pro['Hojasproduccione']['numero_cortes'])) {
                                echo $pro['Hojasproduccione']['numero_cortes'] . ' cortes';
                            } elseif (!empty($pro['Hojasproduccione']['numero_lineas'])) {
                                echo $pro['Hojasproduccione']['numero_lineas'] . ' lineas';
                            }
                            ?>
                        </td>
                        <td><?php echo $pro['Hojasproduccione']['caras']; ?></td>
                        <td><?php echo $pro['Hojasproduccione']['costo']; ?></td>
                    </tr>
                    <?php $total = $total + $pro['Hojasproduccione']['costo']; ?>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td><?php echo $total; ?></td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-danger">Usuario: </td>
                    <td>
                        <?php
                        if (!empty($producciones)) {
                            echo $producciones[0]['User']['nombre'];
                        }
                        ?>
                    </td>
                    <td class="text-danger">Sucursal:</td>
                    <td>
                        <?php
                        if (!empty($producciones)) {
                            echo $producciones[0]['Sucursale']['nombre'];
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel-body">
                        <button type="button" onclick="window.print();" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel-body">
                        <?php if (!empty($producciones)): ?>
                            <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'vista_nota', $trabajo['Trabajo']['id'], $producciones[0]['Hojasproduccione']['tipo_nota'])); ?>';" class="btn btn-primary col-md-12"> <i class="ico-certificate"> </i> <?php echo $producciones[0]['Hojasproduccione']['tipo_nota']; ?></button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel-body">
                        <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'produccion', $trabajo['Trabajo']['id'])); ?>';" class="btn btn-success col-md-12"> <i class="ico-pencil3"> </i> EDITAR</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel-body">
                        <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('controller' => 'Movimientos', 'action' => 'inventario', $trabajo['Trabajo']['id'])); ?>';" class="btn btn-info col-md-12"> <i class="ico-th-large"> </i> INVENTARIO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>