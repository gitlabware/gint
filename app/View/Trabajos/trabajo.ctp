
<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span>HOJA DE RUTA</h3>

            </div>
            <!--/ panel heading/header -->
            <div class="panel-body">
                <div class="form-horizontal form-striped form-bordered">
                    <?php echo $this->Form->create('Trabajo', array('action' => 'registra_trabajo', 'data-parsley-validate')); ?>
                    <?php echo $this->Form->hidden('user_id', array('value' => $this->Session->read('Auth.User.id'))); ?>
                    <?php echo $this->Form->hidden('id'); ?>
                    <?php echo $this->Form->hidden('sucursale_id', array('value' => $this->Session->read('Auth.User.sucursale_id'))); ?>
                    <?php echo $this->Form->hidden('estado', array('value' => 'Creado')); ?>
                    <div id="ultimotrabajo-0">
                        <div class="form-group" id="idseleccli">
                            <label class="col-sm-2 control-label">Cliente</label>
                            <div class="col-sm-8">
                                <div id="divselectcliente">
                                    <button type="button" class="btn btn-primary btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboclientes1', 'Trabajo.cliente_id', 'divselectcliente')); ?>');">
                                        <?php
                                        if (empty($this->request->data['Trabajo']['cliente_id'])) {
                                          echo 'SELECCIONE AL CLIENTE';
                                        } else {
                                          echo $this->request->data['Cliente']['nombre'];
                                        }
                                        ?>
                                    </button>
                                </div>
                                <?php //echo $this->Form->select('cliente_id', $clientes, array('class' => 'form-control', 'required')); ?>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-inverse col-md-12" type="button" onclick="jQuery('#idseleccli').toggle(400);
                                  jQuery('#idnuevocli').toggle(400);
                                  jQuery('#idclinom').attr('required', true);
                                  jQuery('#idclinit').attr('required', true);">NUEVO</button>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;" id="idnuevocli">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-4">
                                <?php echo $this->Form->text('Cliente.nombre', array('class' => 'form-control', 'id' => 'idclinom', 'placeholder' => 'Ingrese nombre del cliente', 'value' => '')); ?>
                            </div>
                            <label class="col-sm-2 control-label">NIT/CI</label>
                            <div class="col-sm-2">
                                <?php echo $this->Form->text('Cliente.nit', array('class' => 'form-control', 'id' => 'idclinit', 'placeholder' => 'Ingrese nit o ci del cliente', 'value' => '')); ?>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info" onclick="jQuery('#idnuevocli').toggle(400);
                                  jQuery('#idseleccli').toggle(400);
                                  jQuery('#idclinom').attr('required', false);
                                  jQuery('#idclinit').attr('required', false);">SELECCIONAR</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-xs" type="button" onclick="add_trabajo();">Add Trabajo</button> 
                            <button class="btn btn-danger btn-xs" type="button" onclick="quita_trabajo();">Quitar Trabajo</button>
                        </div>
                    </div>
                    <div class="form-group" id="uempleado-0">
                        <div class="col-md-12">
                            <h4 class="semibold text-primary nm">ENCARGADO: <?php echo $this->Session->read('Auth.User.nombre'); ?></h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-xs" type="button" onclick="add_empleadom();">Add Empleado</button> 
                            <button class="btn btn-danger btn-xs" type="button" onclick="quita_empleadom();">Quitar Empleado</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary col-md-12" type="submit">Registrar</button>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<!--/ END row -->
<?php
App::import('Model', 'Hojastipostrabajo');
$hojastipostrabajo = new Hojastipostrabajo();
?>
<script>
  var numero_trabajos = 0;
  var numero_tip_trab = [];
  var numero_emple = 0;
  var num_total_trab = 0;
  var sector_trabajo = '';
  var sector_tip_trab = '';
  var sector_emple = '';
  function add_trabajo()
  {
      numero_trabajos++;
      numero_tip_trab[numero_trabajos] = 0;
      sector_trabajo = ''
              + '<div id="ultimotrabajo-' + numero_trabajos + '">'
              + '<div class="form-group">'
              + '  <div class="col-md-9">'
              + '      <h4 class="semibold text-primary nm">TRABAJO #' + numero_trabajos + '</h4>'
              + '  </div>'
              + '  <div class="col-md-3">'
              + '      <button class="btn btn-success btn-xs" type="button" onclick="add_tip_trab(' + numero_trabajos + ');">Add Trabajo</button> '
              + '      <button class="btn btn-danger btn-xs" type="button" onclick="quita_tip_trab(' + numero_trabajos + ');">Quita Trabajo</button> '
              + '  </div>'
              + '</div>'
              + '<div class = "form-group" id="tipo-trab-' + numero_trabajos + '-0">'
              + '  <label class = "col-sm-2 control-label">Descripcion</label>'
              + '  <div class = "col-sm-4">'
              + '      <input id="idauxtrabdesc-' + numero_trabajos + '" name = "data[Aux][' + numero_trabajos + '][descripcion]" type = "text" class = "form-control" placeholder="Ingrese una descripcion" required>'
              + '  </div>'
              + '  <label class = "col-sm-2 control-label" > Cantidad Nominal </label>'
              + '  <div class = "col-sm-4" >'
              + '      <input name = "data[Aux][' + numero_trabajos + '][cantidad_nominal]" type = "text" class = "form-control" id="id-cantidad-' + numero_trabajos + '" placeholder="Ingrese la cantida nominal" required data-parsley-type="number" data-parsley-min="0">'
              + '  </div>'
              + '</div>'
              + '<div class="form-group">'
              + '  <label class = "col-md-3 control-label">Sucursal</label>'
              + '  <div class="col-md-8">'
              + '      <select name = "data[Aux][' + numero_trabajos + '][sucursale_id]" class = "form-control" id="idsucutrab-' + numero_trabajos + '" required>'
              + '          <option value = "" > Seleccionar Sucursal</option>'
<?php foreach ($sucursales as $su): ?>
        + '             <option value="<?php echo $su['Sucursale']['id'] ?>"><?php echo $su['Sucursale']['nombre'] ?> </option>'
<?php endforeach; ?>
      + '             </select>'
              + '  </div>'
              + '</div>'
              + '</div>';
      cantidad = numero_trabajos - 1;
      jQuery('#ultimotrabajo-' + cantidad).after(sector_trabajo);
      add_tip_trab(numero_trabajos);
  }
  function quita_trabajo()
  {
      if (numero_trabajos != 1) {
          jQuery('#ultimotrabajo-' + numero_trabajos).remove();
          numero_trabajos--;
      }
  }
  function add_tip_trab(numero_t) {
      num_total_trab++;
      numero_tip_trab[numero_t]++;
      sector_tip_trab = ''
              + '<div class="form-group" id="tipo-trab-' + numero_t + '-' + numero_tip_trab[numero_t] + '">'
              + '  <label class="col-sm-2 control-label"> Trabajo #' + numero_tip_trab[numero_t] + ' </label>'
              + '  <div class ="col-sm-4" >'
              + '      <select name="data[Aux][' + numero_t + '][trabajos][' + numero_tip_trab[numero_t] + '][tipotrabajo_id]" class = "form-control" id="idtiptrab-' + numero_t + '-' + numero_tip_trab[numero_t] + '" required>'
              + '          <option value = "" > Seleccionar </option>'
<?php foreach ($tipostrabajos as $tipo): ?>
        + '             <option value="<?php echo $tipo['Tipotrabajo']['id'] ?>"><?php echo $tipo['Tipotrabajo']['descripcion'] ?> </option>'
<?php endforeach; ?>
      + '             </select>'
              + '     <input type="hidden" name="data[Aux][' + numero_t + '][trabajos][' + numero_tip_trab[numero_t] + '][id]" id="idhtiptapbid-' + numero_t + '-' + numero_tip_trab[numero_t] + '">'
              + '     <input type="hidden" name="data[Aux][' + numero_t + '][trabajos][' + numero_tip_trab[numero_t] + '][numero_hojaruta]" id="idhtiptapbnumh-' + numero_t + '-' + numero_tip_trab[numero_t] + '">'
              + '  </div>'
              + '  <label class="col-sm-2 control-label" > Cara #' + numero_tip_trab[numero_t] + ' </label>'
              + '  <div class="col-sm-4" >'
              + '      <select name="data[Aux][' + numero_t + '][trabajos][' + numero_tip_trab[numero_t] + '][caras]" class="form-control" id="idcarastrab-' + numero_t + '-' + numero_tip_trab[numero_t] + '" required>'
              + '          <option value = "" > Seleccionar Cara</option>'
              + '          <option value = "Anverso" > Anverso</option>'
              + '          <option value = "Reverso" > Reverso</option>'
              + '          <option value = "Ambos" > Ambos</option>'
              + '      </select>'
              + '  </div>'
              + '</div>';
      cantidad = numero_tip_trab[numero_t] - 1;
      //cantaux = numero_t-1;
      jQuery('#tipo-trab-' + numero_t + '-' + cantidad).after(sector_tip_trab);
  }
  function quita_tip_trab(numero_t)
  {
      //alert(numero_t+'  '+numero_tip_trab[numero_t]);
      if (numero_tip_trab[numero_t] != 1) {
          jQuery('#tipo-trab-' + numero_t + '-' + numero_tip_trab[numero_t]).remove();
          numero_tip_trab[numero_t]--;
          num_total_trab--;
      }
  }
  function add_empleadom() {
      numero_emple++;
      sector_emple = ''
              + '<div class = "form-group" id="uempleado-' + numero_emple + '">'
              + '  <label class = "col-sm-2 control-label"> Empleado #' + numero_emple + ' </label>'
              + '  <div class = "col-sm-4" >'
              + '      <select name="data[Empleado][' + numero_emple + ' ][empleado_id]" class = "form-control" id="idemplead-' + numero_emple + '" required>'
              + '          <option value = "" > Seleccionar Empleado</option>'
<?php foreach ($empleados as $em): ?>
        + '             <option value="<?php echo $em['User']['id'] ?>"><?php echo $em['User']['nombre'] ?> </option>'
<?php endforeach; ?>
      + '             </select>'
              + '     <input type="hidden" name="data[Empleado][' + numero_emple + ' ][id]" id="idempleid-' + numero_emple + '">'
              + '  </div>'
              + '  <label class = "col-sm-2 control-label" > Maquina </label>'
              + '  <div class = "col-sm-4" >'
              + '      <select name="data[Empleado][' + numero_emple + ' ][maquinaria_id]" class = "form-control" id="idmaquinar-' + numero_emple + '" required>'
              + '          <option value = "" > Seleccionar Maquina</option>'
<?php foreach ($maquinarias as $ma): ?>
        + '             <option value="<?php echo $ma['Maquinaria']['id'] ?>"><?php echo $ma['Maquinaria']['nombre'] ?> </option>'
<?php endforeach; ?>
      + '             </select>'
              + '  </div>'
              + '</div>';
      cantidad = numero_emple - 1;
      jQuery('#uempleado-' + cantidad).after(sector_emple);
  }
  function quita_empleadom() {
      if (numero_emple != 0) {
          jQuery('#uempleado-' + numero_emple).remove();
          numero_emple--;
      }
  }
  function edit_trab() {
<?php if (!empty($data_tipost)): ?>
  <?php foreach ($data_tipost as $da): ?>
    <?php
    $htipost = $hojastipostrabajo->find('all', array(
      'conditions' => array('Hojastipostrabajo.trabajo_id' => $idTrabajo, 'Hojastipostrabajo.numero_hojaruta' => $da['Hojastipostrabajo']['numero_hojaruta'])
    ));
    ?>
          $('#idauxtrabdesc-' + numero_trabajos).val('<?php echo $htipost[0]['Hojastipostrabajo']['descripcion'] ?>');
          $('#id-cantidad-' + numero_trabajos).val('<?php echo $htipost[0]['Hojastipostrabajo']['cantidad_nominal'] ?>');
          $('#idsucutrab-' + numero_trabajos).val('<?php echo $htipost[0]['Hojastipostrabajo']['sucursale_id'] ?>');

    <?php if (!empty($htipost)): ?>
      <?php foreach ($htipost as $ht): ?>
              $('#idtiptrab-' + numero_trabajos + '-' + numero_tip_trab[numero_trabajos]).val('<?php echo $ht['Hojastipostrabajo']['tipotrabajo_id'] ?>');
              $('#idcarastrab-' + numero_trabajos + '-' + numero_tip_trab[numero_trabajos]).val('<?php echo $ht['Hojastipostrabajo']['caras'] ?>');
              $('#idhtiptapbid-' + numero_trabajos + '-' + numero_tip_trab[numero_trabajos]).val('<?php echo $ht['Hojastipostrabajo']['id'] ?>');
              $('#idhtiptapbnumh-' + numero_trabajos + '-' + numero_tip_trab[numero_trabajos]).val('<?php echo $ht['Hojastipostrabajo']['numero_hojaruta'] ?>');
              add_tip_trab(numero_trabajos);
      <?php endforeach; ?>
            quita_tip_trab(numero_trabajos);
    <?php endif; ?>
          add_trabajo();
  <?php endforeach; ?>
        quita_trabajo();
<?php endif; ?>
<?php foreach ($data_empleados as $da): ?>
        add_empleadom();
        $('#idemplead-' + numero_emple).val('<?php echo $da['Empleadostrabajo']['empleado_id'] ?>');
        $('#idmaquinar-' + numero_emple).val('<?php echo $da['Empleadostrabajo']['maquinaria_id'] ?>');
        $('#idempleid-' + numero_emple).val('<?php echo $da['Empleadostrabajo']['id'] ?>');
<?php endforeach; ?>
  }
</script>
<?php
echo $this->Html->script(array(
  'initrabajo.js'
  , '../plugins/parsley/js/parsley.js'
  ), array('block' => 'scriptadd'));
?>
