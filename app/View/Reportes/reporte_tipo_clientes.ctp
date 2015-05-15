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
        padding:5px;
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
                    <td class="text-center">
                        <h4 class="text-info">REPORTE POR CLIENTES</h4>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-success">REPORTE ENTRE FECHAS : <?php echo $fecha1 . 'A ' . $fecha2; ?></td>
                    <td class="text-success">
                        CLIENTE: <?php
                        if (!empty($cliente)) {
                          echo $cliente['Cliente']['nombre'];
                        } else {
                          echo 'Todos';
                        }
                        ?>
                    </td>
                    <td class="text-success">
                        SUCURSAL: <?php
                        if (!empty($sucursal)) {
                          echo $sucursal['Sucursale']['nombre'];
                        } else {
                          echo 'Todos';
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;" >
                <tr>
                    <td>Fecha</td>
                    <td>#IdTrab.</td>
                    <td>#H. Ruta.</td>
                    <td>#Orden</td>
                    <td>Cliente</td>
                    <td>Cantidad</td>
                    <td>Descripcion</td>
                    <td>Tipo Trabajo</td>
                    <td>Formato</td>
                    <td>Cara</td>
                    <td>Costo</td>
                </tr>
                <?php $total = 0.00;?>
                <?php foreach ($resultados as $re): ?>
                <?php $total = $total +  $re['Hojasproduccione']['costo'];?>
                  <tr>
                      <td><?php echo $re[0]['fecha_produccion']; ?></td>
                      <td><?php echo $re['Hojasproduccione']['trabajo_id'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['numero_hruta'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['orden'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['cliente'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['cantidad'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['descripcion'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['tipo_trabajo'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['formato'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['caras'] ?></td>
                      <td><?php echo $re['Hojasproduccione']['costo'] ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td><?php echo $total;?></td>
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
                        <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'index')); ?>';" class="btn btn-success col-md-12"> <i class="ico-pencil3"> </i> REPORTES</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel-body">
                        <button type="button" onclick="window.print();" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>