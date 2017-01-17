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
                    <td><h4 class="text-danger">CLIENTE: <span class="text-default"><?php echo strtoupper($cliente['ClientesCtp']['nombre']) ?></span></h4></td>
                    <td style="font-size: 14px;">
                        <span class="text-info">Fecha y Hora:
                            <?php echo date('d/m/Y H:i:s') ?>
                        </span>
                    </td>

                </tr>
            </table>
            <span class="text-success" style="font-weight: bold; font-size: 19px; margin-top: 4px; margin-bottom: 4px;" >DETALLE DE CREDITO</span>
            <table class="CSSTableGenerator">

                <tr>
                    <td style="color: #002a80; !important;">Fecha Trabajo</td>
                    <td style="color: #002a80; !important;">Nro Trabajo</td>
                    <td style="color: #002a80; !important;">Descripcion</td>
                    <td style="color: #002a80; !important;">Insumo</td>
                    <td style="color: #002a80; !important;">cantidad</td>
                    <td style="color: #002a80; !important;">Total Bs.</td>
                    <td style="color: #002a80; !important;" class="text-center">Saldo <br><?= $saldo_total?></td>
                    <td style="color: #002a80; !important;">Fecha Pago</td>
                    <td style="color: #002a80; !important;">Monto Pago</td>
                    <td style="color: #002a80; !important;">Tipo</td>
                </tr>

                <?php foreach ($ventas as $venta): ?>
                    <?php
                    if (!empty($venta[0]['cancelado'])) {
                        $saldo_p = $venta['VentasCtp']['precio_venta'] - $venta[0]['cancelado'];
                    } else {
                        $saldo_p = $venta['VentasCtp']['precio_venta'];;
                    }

                    ?>
                    <tr>
                        <td><?= $venta['TrabajosCtp']['fecha'] ?></td>
                        <td><?= $venta['TrabajosCtp']['numero'] ?></td>
                        <td><?= $venta['VentasCtp']['descripcion'] ?></td>
                        <td><?= $venta['InsumosCtp']['nombre'] ?></td>
                        <td><?= $venta['VentasCtp']['cantidad'] ?></td>
                        <td><?= $venta['VentasCtp']['precio_venta'] ?></td>
                        <td><b><?= $saldo_p ?></b></td>
                        <td><?= $venta['PagosCtp']['fecha'] ?></td>
                        <td><?= $venta['PagosCtp']['monto'] ?></td>
                        <td>
                            <?php
                            if(!empty($venta['PagosCtp']['tipo'])){
                                echo $venta['PagosCtp']['tipo'];
                            }else{
                                echo "CREDITO";
                            }
                            ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="color: red;">SALDO TOTAL:</td>
                    <td style="color: red;"><?= $saldo_total?></td>
                    <td></td>
                    <td></td>
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
                <div class="col-md-4">
                    <div class="panel-body">
                        <button type="button" onclick="window.print();" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel-body">
                        <button type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'detalle', $cliente['ClientesCtp']['id'])); ?>';" class="btn btn-info col-md-12"> DETALLE DE TRABAJOS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
