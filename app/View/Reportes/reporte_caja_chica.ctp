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
                        <h4 class="text-info">REPORTE CAJA CHICA</h4>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td class="text-success">REPORTE ENTRE FECHAS : <?php echo $fecha1 . 'A ' . $fecha2; ?></td>
                    <td class="text-success">
                        TIPO MOVIMIENTO: <?php echo $tipo;?>
                    </td>
                    <td class="text-success">
                        USUARIOS: <?php
                        if (!empty($usuarios)) {
                          echo $usuarios['User']['nombre'];
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
                    <td>#Nota</td>
                    <td>Detalle</td>
                    <td>Debe</td>
                    <td>Haber</td>
                    <td>Total</td>
                </tr>
                <?php $totalsalida = 0.00; $totalentrada = 0.00;?>
                <?php foreach ($movimientos as $mov): ?>
                <?php $totalentrada = $totalentrada +  $mov['Cajachica']['entrada'];?>   
                <?php $totalsalida = $totalsalida +  $mov['Cajachica']['salida'];?>
                  <tr>
                      <td><?php echo $mov['Cajachica']['fecha']; ?></td>
                      <td><?php echo $mov['Cajachica']['nota'] ?></td>
                      <td><?php echo $mov['Categoriasmonto']['nombre'] ?></td>
                      <td><?php echo $mov['Cajachica']['entrada'] ?></td>
                      <td><?php echo $mov['Cajachica']['salida'] ?></td>
                      <td><?php echo $mov['Cajachica']['total'] ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td><?php echo $totalentrada?></td>
                    <td><?php echo $totalsalida?></td>
                    <td></td>
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

