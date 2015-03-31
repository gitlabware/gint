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
                    <td class="text-center" style="font-weight: normal;font-size: 11px;">
                        Casa Matriz<br>
                        TELEFONOS: 76553265<br>
                        LA PAZ-BOLIVIA
                    </td>
                    <td style="width: 30%;"></td>
                    <td>
                        NIT: <?php echo $factura['Parametrosfactura']['nit'] ?><br>
                        AUTORIZACI&Oacute;N N°: <?php echo $factura['Factura']['autorizacion'] ?><br>
                        <span style="font-size: 15px;">
                            FACTURA
                        </span>
                        <span class="text-danger" style="font-size: 15px;">
                            N° <?php echo sprintf("%06d", $factura['Factura']['numero']); ?>
                        </span>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td style="width: 50%;">

                    </td>
                    <td class="text-center">
                        <span style="font-size: 16px;">
                            ORIGINAL
                        </span><br>
                        <span style="font-size: 11px;">
                            Actividad Econ&oacute;mica: Realizacion de trabajos de imprenta
                        </span>
                    </td>
                </tr>
            </table>
            <span class="text-success" style="font-weight: bold; font-size: 19px; margin-top: 4px; margin-bottom: 4px;" >FACTURA</span>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td style="font-size: 12px;">
                        Fecha: <?php echo $factura['Factura']['fecha'] ?><br>
                        Cliente: <?php echo $factura['Factura']['cliente'] ?>
                    </td>
                    <td style="font-size: 12px;">
                        NIT/CI: <?php echo $factura['Factura']['nit'] ?>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:1px;">
                <tr>
                    <td>Cantidad</td>
                    <td>Concepto</td>
                    <td>Precio</td>
                </tr>
                <?php foreach (unserialize($factura['Factura']['conceptos']) as $hp): ?>
                    <tr>
                        <td><?php echo $hp['cantidad']; ?></td>
                        <td><?php echo $hp['descripcion']; ?></td>
                        <td><?php echo $hp['costo'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td class="text-danger">TOTAL</td>
                    <td><?php echo $factura['Factura']['importetotal']; ?></td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td>
                        Son: <?php echo $literaltotal; ?>
                    </td>
                </tr>
            </table>
            <table class="CSSTableGenerator" style="margin-top:-1px;">
                <tr>
                    <td align="center" style="width: 30%;">
                        CODIGO DE CONTROL: <?php echo $factura['Factura']['codigo_control'] ?><br>
                        Fecha l&iacute;mite de emisi&oacute;n: <?php echo $factura['Parametrosfactura']['fechalimite'] ?><br>
                        <div id="codigoQRfactura">

                        </div>
                    </td>
                    <td>
                        <span style="font-size: 12px;">
                            "LA ALTERACI&Oacute;N, FALSIFICACI&Oacute;N O COMERCIALIZACI&Oacute;N ILEGAL DE ESTE DOCUMENTO TIENE C&Aacute;RCEL”
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <button type="button" onclick="window.print();" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR</button>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<script>
    var textoqr = "<?php echo $factura['Factura']['qr']; ?>";

    var opcionesQRejmeplar = {
        render: 'image'
        , size: 80
        , background: '#fdfdfd'
        , text: textoqr
    };
    var divSelector = '#codigoQRfactura';
</script>
<?php
$this->Html->script(array(
    'jquery.qrcode-0.10.0.js'
    , 'codigoQRini.js'
        ), array('block' => 'scriptadd'));
?>