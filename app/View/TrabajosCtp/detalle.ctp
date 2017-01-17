<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Trabajos de <?php echo $cliente['ClientesCtp']['nombre'] ?></h3>
            </div>
            <div class="panel-toolbar-wrapper">

                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        <a href="<?php echo $this->Html->url(array('controller' => 'ClientesCtp','action' => 'index'));?>" class="btn btn-sm btn-inverse"><b>CLIENTES</b></a>
                        <a href="<?php echo $this->Html->url(array('controller' => 'TrabajosCtp','action' => 'trabajos',$cliente['ClientesCtp']['id']));?>" class="btn btn-sm btn-primary"><b>TRABAJOS</b></a>
                        <a href="<?php echo $this->Html->url(array('controller' => 'TrabajosCtp','action' => 'reporte_saldos',$cliente['ClientesCtp']['id']));?>" class="btn btn-sm btn-inverse"><b>REPORTE DE SALDOS</b></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-horizontal form-striped form-bordered">
                    <?php echo $this->Form->create('TrabajosCtp', array('url' => array('controller' => 'TrabajosCtp', 'action' => 'registra_pago_ext'), 'data-parsley-validate')); ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-sm-2">
                                <?php echo $this->Form->select('PagosCtp.tipo', ['Efectivo' => 'Efectivo', 'Cheque' => 'Cheque', 'Deposito' => 'Deposito'], array('class' => 'form-control', 'empty' => false, 'required')); ?>
                            </div>
                            <div class="col-sm-2">
                                <?php echo $this->Form->text('PagosCtp.monto', array('class' => 'form-control', 'placeholder' => 'Monto', 'required', 'type' => 'number', 'step' => 'any')); ?>
                            </div>
                            <div class="col-sm-4">
                                <?php echo $this->Form->text('PagosCtp.descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
                            </div>
                            <div class="col-sm-2">
                                <?php echo $this->Form->text('PagosCtp.fecha', array('class' => 'form-control', 'placeholder' => 'Fecha', 'required', 'id' => 'fecha_p_2', 'value' => date('Y-m-d'))); ?>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success col-md-12" type="submit">Registrar</button>
                            </div>
                        </div>
                    </div>
                    <?php //echo $this->Form->hidden('PagosCtp.trabajos_ctp_id', array('value' => $this->request->data['TrabajosCtp']['id'])); ?>
                    <?php echo $this->Form->end(); ?>
                </div>
                <table class="table table-bordered" id="listaventas">
                    <thead>
                    <tr>
                        <th>Fecha Trabajo</th>
                        <th>Nro Trabajo</th>
                        <th>Descripcion</th>
                        <th>Insumo</th>
                        <th>cantidad</th>
                        <th>Total Bs.</th>
                        <th class="text-center">Saldo <br><?= $saldo_total?></th>
                        <th>Fecha Pago</th>
                        <th>Monto Pago</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ventas as $venta): ?>
                        <?php

                        $color_td = '';
                        if (!empty($venta['PagosCtp']['tipo'])) {
                            $color_td = 'warning';
                        }
                        if (!empty($venta[0]['cancelado'])) {
                            if($venta[0]['cancelado'] == $venta['VentasCtp']['precio_venta']){
                                $color_td = 'success';
                            }
                            $saldo_p = $venta['VentasCtp']['precio_venta'] - $venta[0]['cancelado'];
                        } else {
                            $saldo_p = $venta['VentasCtp']['precio_venta'];;
                        }

                        ?>
                        <tr class="<?= $color_td ?>">
                            <td><?= $venta['TrabajosCtp']['fecha'] ?></td>
                            <td><?= $venta['TrabajosCtp']['numero'] ?></td>
                            <td><?= $venta['VentasCtp']['descripcion'] ?></td>
                            <td><?= $venta['InsumosCtp']['nombre'] ?></td>
                            <td><?= $venta['VentasCtp']['cantidad'] ?></td>
                            <td><?= $venta['VentasCtp']['precio_venta'] ?></td>
                            <td><b><?= $saldo_p ?></b></td>
                            <td><?= $venta['PagosCtp']['fecha'] ?></td>
                            <td><?= $venta['PagosCtp']['monto'] ?></td>
                            <td><?= $venta['PagosCtp']['tipo'] ?></td>
                            <td>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="panel-toolbar-wrapper">

                <div class="panel-toolbar text-right">
                    <div class="btn-group">
                        <!--                        <a href="<?php /*echo $this->Html->url(array('controller' => 'ClientesCtp','action' => 'index'));*/ ?>" class="btn btn-sm btn-inverse"><b>CLIENTES</b></a>
                        <a href="<?php /*echo $this->Html->url(array('controller' => 'VentasCtp','action' => 'detalle',$cliente['ClientesCtp']['id']));*/ ?>" class="btn btn-sm btn-primary"><b>DETALLE DE TRABAJOS</b></a>
                        <a href="<?php /*echo $this->Html->url(array('controller' => 'VentasCtp','action' => 'trabajo',$cliente['ClientesCtp']['id']));*/ ?>" class="btn btn-sm btn-success"><b>NUEVA ORDEN DE TRABAJO</b></a>-->
                    </div>
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>
</div>

<?php
/*echo $this->Html->css(array(
        '../plugins/datatables/css/datatables.css'
    , '../plugins/datatables/css/tabletools.css'
    )
    , array('block' => 'cssadd'));
*/ ?><!--
--><?php
/*echo $this->Html->script(array(
    '../plugins/datatables/js/jquery.dataTables.js'
, '../plugins/datatables/js/datatables-bs3.js'
, 'listaventas.js'
), array('block' => 'scriptadd'));*/
?>
