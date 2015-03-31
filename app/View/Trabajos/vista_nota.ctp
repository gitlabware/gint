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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" align="center">
            <table class="CSSTableGenerator">
                <tr>
                    <td><h4 class="text-danger">NOTA DE ENTREGA #<?php echo $nota['Nota']['numero'] ?></h4></td>
                    <td>
                        <h4 class="text-info">Fecha y Hora: 
                            <?php echo $nota['Nota']['created']?>
                        </h4>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-danger">Se&ntilde;pres: </td>
                    <td><?php echo $trabajo['Cliente']['nombre']; ?></td>
                    <td class="text-danger">Nit</td>
                    <td><?php echo $trabajo['Cliente']['nit']; ?></td>
                    <td class="text-danger">Telefonos</td>
                    <td><?php echo $trabajo['Cliente']['telefono'] . ' ' . $trabajo['Cliente']['celular']; ?></td>
                </tr>
            </table>
            <span class="text-success" style="font-weight: bold; font-size: 19px; margin-top: 4px; margin-bottom: 4px;" >DETALLE DE ENTREGA</span>
            <table class="CSSTableGenerator">
                <tr>
                    <td>Cantidad</td>
                    <td>Formato</td>
                    <td>Detalle</td>
                    <td>Precio</td>
                </tr>
                <?php $total = 0.00; ?>
                <?php foreach ($hproducciones as $pro): ?>
                    <tr>
                        <td><?php echo $pro['Hojasproduccione']['cantidad']; ?></td>
                        <td>
                            <?php
                            if (!empty($pro['Hojasproduccione']['metrajeini']) && !empty($pro['Hojasproduccione']['metrajefin'])) {
                                echo $pro['Hojasproduccione']['metrajeini'] . ' X ' . $pro['Hojasproduccione']['metrajefin'];
                            } elseif ($pro['Hojasproduccione']['precio'] == 3) {
                                echo 'Carta';
                            } elseif ($pro['Hojasproduccione']['precio'] == 4) {
                                echo 'Oficio';
                            }
                            ?>
                        </td>
                        <td><?php echo $pro['Hojasproduccione']['descripcion']; ?></td>
                        <td><?php echo $pro['Hojasproduccione']['costo']; ?></td>
                    </tr>
                    <?php $total = $total + $pro['Hojasproduccione']['costo']; ?>
                <?php endforeach; ?>
                <tr>
                    <td class="text-danger">Forma pago: </td>
                    <td><?php echo $nota['Nota']['tipo_pago'];?></td>
                    <td class="text-danger">TOTAL: </td>
                    <td><?php echo $total; ?></td>
                </tr>
                <tr>
                    <td class="text-danger">Saldo: </td>
                    <td><?php echo $nota['Nota']['saldo'];?></td>
                    <td class="text-danger">Total pagado: </td>
                    <td><?php echo $nota['Nota']['total_pagado'];?></td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-danger">Entregado por: </td>
                    <td>
                        <?php echo $nota['User']['nombre']?>
                    </td>
                    <td class="text-danger">Sucursal:</td>
                    <td>
                        <?php echo $nota['Sucursale']['nombre']?>
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
                <div class="col-md-6">
                    <div class="panel-body">
                        <button type="button" onclick="window.print();" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel-body">
                        <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'nota',$trabajo['Trabajo']['id'],$nota['Nota']['tipo']));?>';" class="btn btn-success col-md-12"> <i class="ico-pencil3"> </i> EDITAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>