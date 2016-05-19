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
                    <td><h4 class="text-danger"><?php echo strtoupper($tipo); ?> #<?php echo $nota['Nota']['numero'] ?></h4></td>
                    <td style="font-size: 14px;">
                        <span class="text-info">Fecha y Hora: 
                            <?php echo $nota['Nota']['created'] ?>
                        </span>
                        <?php //debug(strtoupper($tipo)); ?>
                        <?php if (strtoupper($tipo) === 'NOTA DE REMISION'): ?>
                            <br>
                            <span class="text-info">FACTURA: 
                                <?php echo $nota['Nota']['numero_factura'] ?>
                            </span>
                        <?php endif; ?>
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
            <span class="text-success" style="font-weight: bold; font-size: 19px; margin-top: 4px; margin-bottom: 4px;" >DETALLE DE <?php echo strtoupper($tipo); ?></span>
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
                    <td><?php echo $nota['Nota']['tipo_pago']; ?></td>
                    <td class="text-danger">TOTAL: </td>
                    <td><?php echo $total; ?></td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-danger">Entregado por: </td>
                    <td>
                        <?php echo $nota['User']['nombre'] ?>
                    </td>
                    <td class="text-danger">Sucursal:</td>
                    <td>
                        <?php echo $nota['Sucursale']['nombre'] ?>
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
                <div class="col-md-4">
                    <div class="panel-body">
                        <button type="button" id="btnImprimir" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR V.1</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel-body">
                        <button type="button" onclick="window.print();" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR V.2</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel-body">
                        <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'nota', $trabajo['Trabajo']['id'], $nota['Nota']['tipo'])); ?>';" class="btn btn-success col-md-12"> <i class="ico-pencil3"> </i> EDITAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div style="display: none;">
    <div id="areaImprimir">
        <?php //echo $this->Html->image('generalInternational.jpg'); ?>
        <?php
        $idsucursal = $nota['Sucursale']['id'];
        if ($idsucursal == 3) {
            echo $this->Html->image('Finisheer.jpg');
        }
        if ($idsucursal == 2) {
            echo $this->Html->image('cover-fine.jpg');
        }
        if ($idsucursal == 1) {
            echo $this->Html->image('generalInternational.jpg');
        }
        ?> 
        <table width="70%" style="height: 70px; float: right;" border="0" id="miTabla">
            <tr>                 
                <td rowspan="2" align="center" width="40%"><h2><?php echo strtoupper($tipo); ?></h2></td>
                <td width="30%"><b>No. <?php echo $nota['Nota']['numero']; ?></b></td>
            </tr>
            <tr>
                <td height="21">Fecha: 
<?php
//debug($hojaProduccion);
$fechaHp = split(' ', $nota['Nota']['created']);
//$tiempo = split(' ', $trabajo['Trabajo']['fecharegistro']);
$fecha = split('-', $fechaHp[0]);
//debug($fecha);
echo $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
?>
                </td>
            </tr>
        </table>            
        <table width="100%" border="0">
            <tr>
                <td width="70%">Se&ntilde;ores: <?php echo $trabajo['Cliente']['nombre']; ?></td>
                <td width="30%" align="left">
<?php if (strtoupper($tipo) === 'NOTA DE REMISION'): ?>
                        Factura: <?php echo $nota['Nota']['numero_factura']; ?>
                    <?php endif; ?>

                </td>
            </tr>
        </table>
        <div style="height: 5px;"></div>            
        <table width="100%" border="1">
            <tr>                    
                <th width="11%" scope="col">CANTIDAD</th>
                <th width="10%" scope="col">FORMATO</th>
                <th width="63%" scope="col">DETALLE</th>
                <th width="10%" scope="col">PRECIO</th>
            </tr>
<?php $total = 0; ?>
<?php foreach ($hproducciones as $pro): ?>
                <tr>                    
                    <td align="center">
                        <div style="font-size: 8pt;">
    <?php echo $pro['Hojasproduccione']['cantidad']; ?>
                        </div>    
                    </td>
                    <td align="center">
                        <div style="font-size: 8pt;">
    <?php
    if (!empty($pro['Hojasproduccione']['metrajeini']) && !empty($pro['Hojasproduccione']['metrajefin'])) {
        echo $pro['Hojasproduccione']['metrajeini'] . ' X ' . $pro['Hojasproduccione']['metrajefin'];
    } elseif ($pro['Hojasproduccione']['precio'] == 3) {
        echo 'Carta';
    } elseif ($pro['Hojasproduccione']['precio'] == 4) {
        echo 'Oficio';
    }
    ?>
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 8pt;">
    <?php echo $pro['Hojasproduccione']['descripcion']; ?> 
                        </div>
                    </td>
                    <td align="right">
                        <div style="font-size: 8pt;">
    <?php
    echo number_format($pro['Hojasproduccione']['costo'], 2);
    ?>
                        </div>
                    </td>
                </tr>
    <?php $total = $total + $pro['Hojasproduccione']['costo']; ?>
<?php endforeach; ?>
        </table>
        <table width="100%" border="0">
            <tr>
                <td width="85%" align="right">TOTAL &nbsp;&nbsp;Bs. &nbsp;</td>                    
                <td width="15%" align="right">
                    <div style="font-size: 8pt;">
                        <b>
<?php echo number_format($total, 2); ?> 
                        </b>
                    </div>
                </td>
            </tr>
        </table>


        <table width="30%" border="1">
<?php if ($nota['Nota']['tipo_pago'] == 'Credito'): ?>
                <tr>
                    <td>
                        <div style="font-size: 8pt;">
                            <b>TIPO DE PAGO</b>
                        </div>
                    </td>                   
                    <td align="right">
                        <div style="font-size: 8pt;">
                            Al Cr&eacute;dito
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="font-size: 8pt;">
                            <b>TOTAL CANCELADO</b>
                        </div>
                    </td>
                    <td align="right">
                        <div style="font-size: 8pt;">
    <?php echo number_format($nota['Nota']['total_pagado'], 2); ?> Bs.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="font-size: 8pt;">
                            <b>Saldo</b>
                        </div>
                    </td>
                    <td align="right">
                        <div style="font-size: 8pt;">
<?php echo number_format( ($total-$nota['Nota']['total_pagado']), 2); ?> Bs. 
                        </div>                           
                    </td>
                </tr>                    
<?php else: ?>
                <tr>
                    <td>Tipo de Pago</td>
                    <td>al Contado</td>
                    <td style="text-align:right; padding-right: 20px">
                        Saldo
                    </td>
                    <td style="text-align:right; padding-right: 20px">
                        0 Bs.
                    </td>
                </tr>
<?php endif; ?>
        </table>   

        <center><b>Entregado Por</b></center>
<?php //fin de la tanbla;   ?>

    </div>
</div>

<?php echo $this->Html->script(array('print')); ?>
<script type="text/javascript">

    $(document).ready(function () {

        $("#btnImprimir").click(function () {
            //alert('dsadsa');
            //console.log('click');
            printElem({
                leaveOpen: true,
                printMode: 'popup',
                overrideElementCSS: [
                    '<?php echo $this->webroot; ?>css/imprimir.css',
                    {href: '<?php echo $this->webroot; ?>css/imprimir.css', media: 'print'}]
            });
            //printElem({ overrideElementCSS: ['http://www.imprenta.com/css/printable.css'] });
        });

    });
    function printElem(options) {
        $('#areaImprimir').printElement(options);
    }
</script>