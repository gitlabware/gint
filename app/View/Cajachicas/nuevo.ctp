<?php
echo $this->Html->css(array(
  '../plugins/jquery-ui/css/jquery-ui'
  ), array('block' => 'cssadd'));
?>
<!-- START row -->
<div class="row">
    <div class="col-md-4">
        <!-- START panel -->
        <!--<form class="panel panel-primary form-horizontal form-bordered" action="">-->
        <?php echo $this->Form->create('Cajachica', array('class' => 'panel panel-primary form-horizontal form-bordered')); ?>
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title">Movimientos</h3>
                <?php //debug($movimientosHoy); ?>
            </div>            
            <!--/ panel heading/header -->
            <!-- panel body with collapse capabale -->
            <div class="panel-collapse">
                <div class="panel-body">                    
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tipo</label>
                        <div class="col-sm-9">
                            <span class="radio custom-radio custom-radio-primary">  
                                <input name="data[Cajachica][tipo]" type="radio" id="customradio1" value="ingreso" checked="checked">  
                                <label for="customradio1">&nbsp;&nbsp;Regitra Ingreso</label>   
                            </span>
                            <span class="radio custom-radio custom-radio-teal">  
                                <input name="data[Cajachica][tipo]" type="radio" id="customradio2" value="gasto">  
                                <label for="customradio2">&nbsp;&nbsp;Registra Gasto</label>   
                            </span>
                        </div>
                    </div>

                    <div class="form-group" id="selectDetalle">
                        <label class="col-sm-3 control-label">Seleccione</label>
                        <div class="col-sm-9">
                            <div id="divselectdetalle">
                                <button type="button" class="btn btn-primary btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'combodetalle1', 'Cajachica.categoriasmonto_id', 'divselectdetalle')); ?>');">                                    
                                    Detalle
                                </button>                                  
                            </div>
                            <br />
                            <button type="button" class="btn btn-success btn-block" onclick="jQuery('#selectDetalle').toggle(400);jQuery('#txtDetalle').toggle(400);jQuery('#txtNuevoDetalle').attr('required', true);">Adiciona Detalle</button>                            
                        </div>
                    </div>  
                    
                    <div class="form-group" style="display: none;" id="txtDetalle">
                        <label class="control-label col-sm-3">Detalle</label>
                        <div class="col-sm-9">
                            <input name="data[Cajachica][nuevoDetalle]" id="txtNuevoDetalle" type="text" class="form-control">                        
                        <br />
                        <button type="button" class="btn btn-primary btn-block" onclick="jQuery('#txtDetalle').toggle(400);jQuery('#selectDetalle').toggle(400);jQuery('#txtNuevoDetalle').attr('required', false);">Selecciona Detalle</button>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-3">Monto</label>
                        <div class="col-sm-9">                            
                            <input name="data[Cajachica][monto]" type="number" class="form-control" step="any" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Nota</label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->text('nota', array('class'=>'form-control', 'style'=>'display: block;')); ?>
                            <!--<input type="text" value="55" name="bs-touchspin-prefix" class="form-control" style="display: block;">-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Fecha</label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->text('Cajachica.fecha', array('class' => 'form-control', 'id' => 'fecha_p_3', 'placeholder' => 'Seleccione la fecha', 'required')); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-3">Obs.</label>
                        <div class="col-sm-9">
                            <textarea name="data[Cajachica][obs]" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success">Registrar Monto</button>                        
                    </div>
                    
                </div>
            </div>
            <!--/ panel body with collapse capabale -->
        </form>
        <!-- END form panel -->
    </div>
    <div class="col-md-8">
        <!-- START panel -->
        <div class="panel panel-success">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title">
                    CAJA CHICA &nbsp;&nbsp;
                    ( <?php echo $this->Session->read('Auth.User.nombre'); ?> )
                    &nbsp;&nbsp;
                    <?php echo date('Y/m/d'); ?>
                </h3>
                <!-- panel toolbar -->
                <div class="panel-toolbar text-right">
                    <!-- option -->
                    <div class="option">
                        <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                        <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                    </div>
                    <!--/ option -->
                </div>
                <!--/ panel toolbar -->
            </div>
            <!--/ panel heading/header -->
            <!-- panel body with collapse capabale -->
            <div class="table-responsive panel-collapse pull out">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Nota</th>
                            <th>Detalle</th>
                            <th>Debe</th>
                            <th>Haber</th>
                            <th>Saldo</th>
                            <th>Elim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($movimientosHoy as $mh): ?>
                        <?php 
                              $salida = $mh['Cajachica']['salida'];         
                              if($salida != 0)
                              {
                                $color = '#f00';
                              }else{
                                $color = '#000';
                              }
                            ?>
                        <tr style="color: <?php echo $color;?>">
                            <td class="text-center">
                                <span class="sparklines" sparkType="line" sparkLineColor="#4fc0e8" sparkFillColor="#d6f0fa">
                                  <?php echo $mh['Cajachica']['fecha']; ?>
                                </span>
                            </td>                            
                            <td><?php echo $mh['Cajachica']['nota']; ?></td>                            
                            <td><?php echo $mh['Categoriasmonto']['nombre']; ?></td>                            
                            <td><?php echo $mh['Cajachica']['entrada']; ?></td>
                            <td><?php echo $mh['Cajachica']['salida']; ?></td>
                            <td><?php echo $mh['Cajachica']['total']; ?></td>
                            <?php if($ultimo['Cajachica']['id']==$mh['Cajachica']['id']): ?>
                            <td><button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'delete', $mh['Cajachica']['id'])) ?>', '<?php echo 'Esta seguro de eliminar el insumo ' . $mh['Categoriasmonto']['nombre']; ?>');"> <i class="ico-trash"></i> Eliminar</button></td>
                            <?php else: ?>
                            <td></td>
                            <?php endif; ?>
                        </tr> 
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!--/ panel body with collapse capabale -->
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
  function muestarFormulario()
  {
    $('#divselectdetalle').html('<input type="text" value="55" name="bs-touchspin-prefix" class="form-control" style="display: block;">');
  }
  function muestaSelect()
  {
    $('#divselectdetalle').html('<input type="text" value="55" name="bs-touchspin-prefix" class="form-control" style="display: block;">');
  }

  //------------ CAMBIA EL IDIOMA AL DATEPICKER ------------
  $(function ($) {
      $.datepicker.regional['es'] = {
          closeText: 'Cerrar',
          prevText: '<Ant',
          nextText: 'Sig>',
          currentText: 'Hoy',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
          dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
          weekHeader: 'Sm',
          dateFormat: 'dd/mm/yy',
          firstDay: 1,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''
      };
      $.datepicker.setDefaults($.datepicker.regional['es']);
  });
  //----------------- TERMINA CAMBIO DE IDIOMA ---------------  
  $('#fecha_p_3').datepicker({dateFormat: 'yy-mm-dd'});  
</script>
