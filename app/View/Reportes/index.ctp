<?php
echo $this->Html->css(array(
  '../plugins/jquery-ui/css/jquery-ui'
  ), array('block' => 'cssadd'));
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Reporte por tipo de Trabajos</h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'reporte_tipo_trabajo', 'data-parsley-validate')); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Desde</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_inicio', array('class' => 'form-control','id' => 'fecha_p_1', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Hasta</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_fin', array('class' => 'form-control','id' => 'fecha_p_2', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Seleccione Tipo Fecha</label>
                            <?php echo $this->Form->select('Hojasproduccione.tipo_fecha', array('DATE(Hojasproduccione.created)' => 'Fecha Produccion', 'DATE(Hojastipostrabajo.created)' => 'Fecha Hojaruta'), array('class' => 'form-control', 'required','value' => 'DATE(Hojasproduccione.created)')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Tipo de trabajo</label>
                            <?php echo $this->Form->select('Hojasproduccione.tipotrabajo', $tipotrabajos, array('class' => 'form-control', 'required', 'value' => 'Todos')); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Sucursal</label>
                            <?php echo $this->Form->select('Hojasproduccione.sucursale_id', $sucursales, array('class' => 'form-control', 'required', 'value' => 'Todos')) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-md-12">GENERAR REPORTE</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Reporte por Clientes</h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'reporte_tipo_clientes', 'data-parsley-validate')); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Desde</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_inicio', array('class' => 'form-control','id' => 'fecha_p_3', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Hasta</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_fin', array('class' => 'form-control','id' => 'fecha_p_4' , 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Seleccione Tipo Fecha</label>
                            <?php echo $this->Form->select('Hojasproduccione.tipo_fecha', array('DATE(Hojasproduccione.created)' => 'Fecha Produccion', 'DATE(Hojastipostrabajo.created)' => 'Fecha Hojaruta'), array('class' => 'form-control', 'required','value' => 'DATE(Hojasproduccione.created)')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Cliente</label>
                            <?php echo $this->Form->select('Hojasproduccione.cliente_id', $clientes, array('class' => 'form-control', 'required', 'value' => 'Todos')); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Sucursal</label>
                            <?php echo $this->Form->select('Hojasproduccione.sucursale_id', $sucursales, array('class' => 'form-control', 'required', 'value' => 'Todos')) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-md-12">GENERAR REPORTE</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Reporte por Tipo de entrega</h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'reporte_tipo_entrega', 'data-parsley-validate')); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Desde</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_inicio', array('class' => 'form-control','id' => 'fecha_p_5', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Hasta</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_fin', array('class' => 'form-control','id' => 'fecha_p_6', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Seleccione Tipo Fecha</label>
                            <?php echo $this->Form->select('Hojasproduccione.tipo_fecha', array('DATE(Hojasproduccione.created)' => 'Fecha Produccion', 'DATE(Hojastipostrabajo.created)' => 'Fecha Hojaruta'), array('class' => 'form-control', 'required','value' => 'DATE(Hojasproduccione.created)')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Nota</label>
                            <?php echo $this->Form->select('Hojasproduccione.tiponota', array('Nota de entrega' => 'Nota de entrega','Nota de Remision' => 'Nota de Remision','Todos' => 'Todos'), array('class' => 'form-control', 'required', 'value' => 'Todos')); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Sucursal</label>
                            <?php echo $this->Form->select('Hojasproduccione.sucursale_id', $sucursales, array('class' => 'form-control', 'required', 'value' => 'Todos')) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-md-12">GENERAR REPORTE</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Reporte por Tipo de pago</h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'reporte_tipo_pago', 'data-parsley-validate')); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Desde</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_inicio', array('class' => 'form-control','id' => 'fecha_p_7', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Hasta</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_fin', array('class' => 'form-control','id' => 'fecha_p_8', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Seleccione Tipo Fecha</label>
                            <?php echo $this->Form->select('Hojasproduccione.tipo_fecha', array('DATE(Hojasproduccione.created)' => 'Fecha Produccion', 'DATE(Hojastipostrabajo.created)' => 'Fecha Hojaruta'), array('class' => 'form-control', 'required','value' => 'DATE(Hojasproduccione.created)')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Tipo pago</label>
                            <?php echo $this->Form->select('Hojasproduccione.tipopago', array('Contado' => 'Contado','Credito' => 'Credito','Saldo' => 'Saldo','Todos' => 'Todos'), array('class' => 'form-control', 'required', 'value' => 'Todos')); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Sucursal</label>
                            <?php echo $this->Form->select('Hojasproduccione.sucursale_id', $sucursales, array('class' => 'form-control', 'required', 'value' => 'Todos')) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-md-12">GENERAR REPORTE</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script(array(
  '../plugins/jquery-ui/js/jquery-ui',
  '../plugins/parsley/js/parsley'
  )
);
?>
<script>
  $('#fecha_p_1').datepicker({dateFormat: 'yy-mm-dd'});
  $('#fecha_p_2').datepicker({dateFormat: 'yy-mm-dd'});
  $('#fecha_p_3').datepicker({dateFormat: 'yy-mm-dd'});
  $('#fecha_p_4').datepicker({dateFormat: 'yy-mm-dd'});
  $('#fecha_p_5').datepicker({dateFormat: 'yy-mm-dd'});
  $('#fecha_p_6').datepicker({dateFormat: 'yy-mm-dd'});
  $('#fecha_p_7').datepicker({dateFormat: 'yy-mm-dd'});
  $('#fecha_p_8').datepicker({dateFormat: 'yy-mm-dd'});
</script>