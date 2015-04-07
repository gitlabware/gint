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
                            <?php echo $this->Form->text('Hojasproduccione.fecha_inicio', array('class' => 'form-control fecha_p', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Hasta</label>
                            <?php echo $this->Form->text('Hojasproduccione.fecha_fin', array('class' => 'form-control fecha_p', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
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
<?php
echo $this->Html->script(array(
  '../plugins/jquery-ui/js/jquery-ui',
  '../plugins/parsley/js/parsley'
  )
);
?>
<script>
  $('.fecha_p').datepicker({dateFormat: 'yy-mm-dd'});
</script>