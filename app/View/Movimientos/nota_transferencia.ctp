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
        <!-- START panel -->
        <div class="panel panel-primary" align="center">
            <table class="CSSTableGenerator">
                <tr>
                    <td><h4 class="text-danger">NOTA DE VENTA #<?php echo $movimiento['Movimiento']['id'] ?></h4></td>
                    <td><h4 class="text-info">Fecha y Hora: <?php echo $movimiento['Movimiento']['created']; ?></h4></td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-danger">Sucursal Transferida</td>
                    <td><?php echo $movimiento['Sucursale']['nombre']; ?></td>
                </tr>
            </table>
            <span class="text-success" style="font-weight: bold; font-size: 19px; margin-top: 4px; margin-bottom: 4px;" >DETALLE DE TRANSFERENCIA</span>
            <table class="CSSTableGenerator">
                <tr>
                    <td class="text-danger">Insumo</td>
                    <td class="text-danger">Micraje</td>
                    <td class="text-danger">Alto</td>
                    <td class="text-danger">Peso kg</td>
                </tr>
                <?php foreach ($insumos as $in): ?>
                    <tr>
                        <td><?php echo $in['Insumo']['nombre'] ?></td>
                        <td><?php echo $in['Inventario']['micraje'] ?></td>
                        <td><?php echo $in['Inventario']['alto'] ?></td>
                        <td><?php echo $in['Inventario']['cantidad'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-danger">Usuario:</td>
                    <td><?php echo $movimiento['User']['nombre'];?></td>
                    <td class="text-danger">Sucursal:</td>
                    <td><?php echo $movimiento['Sucursale']['nombre']?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <div>
                <div class="panel-body">
                    <button type="button" onclick="window.print();" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR</button>
                </div>
            </div>
        </div>
    </div>
</div>