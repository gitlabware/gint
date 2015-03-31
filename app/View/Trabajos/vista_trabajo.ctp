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
        //text-align:left;
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
    }/*
    .CSSTableGenerator tr:first-child td{
        background:-o-linear-gradient(bottom, #ffffff 5%, #ffffff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #ffffff) );
        background:-moz-linear-gradient( center top, #ffffff 5%, #ffffff 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff", endColorstr="#ffffff");	background: -o-linear-gradient(top,#ffffff,ffffff);

        background-color:#ffffff;
        border:0px solid #000000;
        text-align:center;
        border-width:0px 0px 1px 1px;
        font-size:14px;
        font-family:Arial;
        font-weight:bold;
        color:#000000;
    }
    .CSSTableGenerator tr:first-child:hover td{
        background:-o-linear-gradient(bottom, #ffffff 5%, #ffffff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #ffffff) );
        background:-moz-linear-gradient( center top, #ffffff 5%, #ffffff 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff", endColorstr="#ffffff");	background: -o-linear-gradient(top,#ffffff,ffffff);

        background-color:#ffffff;
    }
    .CSSTableGenerator tr:first-child td:first-child{
        border-width:0px 0px 1px 0px;
    }
    .CSSTableGenerator tr:first-child td:last-child{
        border-width:0px 0px 1px 1px;
    }*/
</style>
<div class="row ocultop" id="iddivtrabajo">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <div align="center">
                <table class="CSSTableGenerator">
                    <tr>
                        <td><h4 class="text-danger">TRABAJO #<?php echo $trabajo['Trabajo']['id'] ?></h4></td>
                        <td><h4 class="text-info">Fecha y Hora<?php echo $trabajo['Trabajo']['created']; ?></h4></td>
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
                <span class="text-success" style="font-weight: bold; font-size: 19px; margin-top: 4px; margin-bottom: 4px;" >TIPO DE TRABAJO</span>
                <table class="CSSTableGenerator">
                    <tr>
                        <td class="text-danger">Desripcion</td>
                        <td class="text-danger">Cantidad Nominal</td>
                        <td class="text-danger">Tipo de trabajos</td>
                        <td class="text-danger">Caras</td>
                        <td class="text-danger">Sucursal</td>
                    </tr>
                    <?php foreach ($tipostra as $tra): ?>
                        <tr>
                            <td><?php echo $tra['Hojastipostrabajo']['descripcion'] ?></td>
                            <td><?php echo $tra['Hojastipostrabajo']['cantidad_nominal'] ?></td>
                            <td><?php echo $tra['Tipotrabajo']['descripcion'] ?></td>
                            <td><?php echo $tra['Hojastipostrabajo']['caras'] ?></td>
                            <td><?php echo $tra['Sucursale']['nombre'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <table class="CSSTableGenerator" style="margin-top:-1px;">
                    <tbody>
                        <tr>
                            <td class="text-danger">Usuario: </td>
                            <td><?php echo $trabajo['User']['nombre'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="CSSTableGenerator" style="margin-top:-1px;">
                    <tbody>
                        <?php foreach ($empleados as $emp): ?>
                            <tr>
                                <td class="text-danger">Operador: </td>
                                <td><?php echo $emp['Empleado']['nombre']; ?></td>
                                <td class="text-danger">Maquinaria: </td>
                                <td><?php echo $emp['Maquinaria']['nombre'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <div>
                <div class="panel-body">
                    <button type="button" onclick="imprimirp('iddivtrabajo');" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($tipostrabajos as $tip): ?>
    <?php
    App::import('Model', 'Hojastipostrabajo');
    $hojastipostrabajo = new Hojastipostrabajo();

    $htipost = $hojastipostrabajo->find('all', array(
        'conditions' => array('Hojastipostrabajo.trabajo_id' => $trabajo['Trabajo']['id'], 'Hojastipostrabajo.numero_hojaruta' => $tip['Hojastipostrabajo']['numero_hojaruta'])
    ));
    /* debug($htipost);
      exit; */
    ?>
    <div class="row ocultop" id="iddivtrabajo-<?php echo $tip['Hojastipostrabajo']['numero_hojaruta']; ?>">
        <div class="col-md-12">
            <!-- START panel -->
            <div class="panel panel-primary">
                <div>
                    <div align="center">
                        <table class="CSSTableGenerator">
                            <tr>
                                <td><h4 class="text-danger">TRABAJO #<?php echo $htipost[0]['Trabajo']['id'] ?></h4></td>
                                <td><h4 class="text-info">Fecha y Hora<?php echo $htipost[0]['Trabajo']['created']; ?></h4></td>
                                <td><h4 class="text-danger">Hoja Ruta #<?php echo $htipost[0]['Hojastipostrabajo']['numero_hojaruta'] ?></h4></td>
                            </tr>
                        </table>
                        <table class="CSSTableGenerator" style="margin-top:-1px;">
                            <tr>
                                <td>HOJA DE PRODUCCION</td>
                                <td>FECHA:</td>
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
                        <table class="CSSTableGenerator" style="margin-top:-1px;">
                            <tr>
                                <td class="text-danger">Desripcion</td>
                                <td class="text-danger">Cantidad Nominal</td>
                                <td class="text-danger">Tipo de trabajos</td>
                                <td class="text-danger">Caras</td>
                                <td class="text-danger">Sucursal</td>
                            </tr>
                            <?php foreach ($htipost as $trab): ?>
                                <tr>
                                    <td><?php echo $trab['Hojastipostrabajo']['descripcion'] ?></td>
                                    <td><?php echo $trab['Hojastipostrabajo']['cantidad_nominal'] ?></td>
                                    <td><?php echo $trab['Tipotrabajo']['descripcion'] ?></td>
                                    <td><?php echo $trab['Hojastipostrabajo']['caras'] ?></td>
                                    <td><?php echo $trab['Sucursale']['nombre'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <table class="CSSTableGenerator" style="margin-top:-1px;">
                            <tbody>
                                <?php foreach ($empleados as $emp): ?>
                                    <tr>
                                        <td class="text-danger">Operador: </td>
                                        <td><?php echo $emp['Empleado']['nombre']; ?></td>
                                        <td class="text-danger">Maquinaria: </td>
                                        <td><?php echo $emp['Maquinaria']['nombre'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <table class="CSSTableGenerator" style="margin-top:-1px;">
                            <tr>
                                <td align="center">
                                    <br>
                                    <div style="border-top: #000000 solid 1px; width: 20%;">
                                        <span class="text-danger">FIRMA RESPONSABLE</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row hidden-print">
        <div class="col-md-12">
            <!-- START panel -->
            <div class="panel panel-primary">
                <div>
                    <div class="panel-body">
                        <button type="button" onclick="imprimirp('iddivtrabajo-<?php echo $tip['Hojastipostrabajo']['numero_hojaruta']; ?>');" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR <?php echo $tip['Hojastipostrabajo']['numero_hojaruta']; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<div class="row hidden-print">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <div>
                <div class="panel-body">
                    <button type="button" onclick="imprimirp('');" class="btn btn-inverse col-md-12"> <i class="ico-print2"> </i> IMPRIMIR TODO</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function imprimirp(iddiv) {
        if (iddiv == '') {
            $('.ocultop').removeClass('hidden-print');
        } else {
            $('.ocultop').addClass('hidden-print');
            $('#' + iddiv).removeClass('hidden-print');
        }
        window.print();
    }
</script>