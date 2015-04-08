<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span>HOJA DE PRODUCCION DE TRABAJO #<?php echo $trabajo['Trabajo']['id'] ?></h3>
            </div>
            <!--/ panel heading/header -->
            <div class="panel-body">
                <div class="form-horizontal form-bordered">
                    <?php echo $this->Form->create('Trabajo', array('action' => 'registra_produccion/' . $trabajo['Trabajo']['id'] . '/' . $sw, 'id' => 'idform-hproduccion', 'data-parsley-validate')); ?>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="text-info">Cliente: </label> <?php echo $trabajo['Cliente']['nombre'] ?>
                        </div>
                        <div class="col-md-4">
                            <label class="text-info">Nit: </label> <?php echo $trabajo['Cliente']['nit'] ?>
                        </div>
                        <div class="col-md-4">
                            <label class="text-info">Telefonos: </label> <?php echo $trabajo['Cliente']['telefono'] . ' ' . $trabajo['Cliente']['celular'] ?>
                        </div>
                    </div>    
                    <div class="form-group">
                        <h4 class="text-success text-center">TIPOS DE TRABAJOS REALIZADOS</h4>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Tipo</th>
                                        <th>Descripcion</th>
                                        <th>Cara</th>
                                        <th>Ancho</th>
                                        <th></th>
                                        <th>Alto</th>
                                        <th>#</th>
                                        <th>Precio</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($hojas_tra as $ht): ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.id"); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.trabajo_id", array('value' => $trabajo['Trabajo']['id'])); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.caras", array('value' => $ht['Hojastipostrabajo']['caras'], 'id' => 'idcaras-' . $i)); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.user_id", array('value' => $this->Session->read('Auth.User.id'))); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.tipotrabajo_id", array('value' => $ht['Hojastipostrabajo']['tipotrabajo_id'])); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.hojastipostrabajo_id", array('value' => $ht['Hojastipostrabajo']['id'])); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.numero_hruta", array('value' => $ht['Hojastipostrabajo']['numero_hojaruta'])); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.descripcion", array('value' => $ht['Hojastipostrabajo']['descripcion'] . ' - ' . $ht['Tipotrabajo']['descripcion'])); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.sucursale_id", array('value' => $this->Session->read('Auth.User.sucursale_id'))); ?>
                                      <?php echo $this->Form->hidden("Hojasproduccione.$i.tipo_nota", array('id' => "idhtiponota-$i")); ?>
                                      <?php
                                      $displayp = '';
                                      $required = 'required';
                                      $required2 = '';
                                      $displayp2 = 'style="display: none;"';
                                      if (!empty($this->request->data['Hojasproduccione'][$i])) {
                                        $displayp = 'style="display: none;"';
                                        $required = '';
                                        $required2 = 'required';
                                        $displayp2 = '';
                                      }
                                      ?>
                                      <?php
                                      $cantidad = '';
                                      if (!empty($this->request->data['Hojasproduccione'][$i])) {
                                        $cantidad = $this->request->data['Hojasproduccione'][$i]['cantidad'];
                                      } else {
                                        $cantidad = $ht['Hojastipostrabajo']['cantidad_nominal'];
                                      }
                                      ?>
                                      <tr>
                                          <?php if ($ht['Tipotrabajo']['tipo'] == 0): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo0($i,0);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo0($i,0);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td> X </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo0($i,0);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td><?php //echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo1($i);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required'));   ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo0($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['tipo'] == 1): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo1($i);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo1($i);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td> X </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo1($i);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo1($i);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo1($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['tipo'] == 2): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo2($i,2);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo2($i,0);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td> X </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo2($i,0);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td>
                                                <div id="iddivselectprecio-<?php echo $i; ?>" <?php echo $displayp; ?>>
                                                    <?php echo $this->Form->select("Hojasproduccione.$i.precio1", $precios2, array('class' => 'form-control input-sm', 'onchange' => "calcula_costo2($i,2)", 'id' => "idpreciose-$i", $required)) ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', false);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', true);
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);">Texto</a> 
                                                </div>
                                                <div id="iddivtextprecio-<?php echo $i; ?>" <?php echo $displayp2; ?>>
                                                    <?php echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo2($i,3);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, $required2)); ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', true);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', false);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#idpreciose-<?php echo $i; ?>').val('');
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);">Select</a> 
                                                </div>
                                            </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo2($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['tipo'] == 3): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo3($i,0);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td><?php echo $this->Form->select("Hojasproduccione.$i.precio", array(3 => 'Carta', 4 => 'Oficio'), array('class' => 'form-control input-sm', 'id' => "idprecio-$i", 'onchange' => "calcula_costo3($i,0)", 'required')); ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo3($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['tipo'] == 4): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo4($i,2);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo4($i,0);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td> X </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo4($i,0);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td>
                                                <div id="iddivselectprecio-<?php echo $i; ?>" <?php echo $displayp; ?>>
                                                    <?php echo $this->Form->select("Hojasproduccione.$i.precio1", $precios4, array('class' => 'form-control input-sm', 'onchange' => "calcula_costo4($i,2)", 'id' => "idpreciose-$i", $required)) ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', false);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', true);
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);">Texto</a> 
                                                </div>
                                                <div id="iddivtextprecio-<?php echo $i; ?>" <?php echo $displayp2; ?>>
                                                    <?php echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo4($i,3);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, $required2)); ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', true);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', false);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#idpreciose-<?php echo $i; ?>').val('');
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);">Select</a> 
                                                </div>
                                            </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo4($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['tipo'] == 5): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i,0);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i,0);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td> X </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i,0);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td>
                                                <?php echo $this->Form->hidden("Hojasproduccione.$i.precio", array('class' => 'form-control', 'id' => "idprecio-$i")); ?>
                                            </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['id'] == 15): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo15($i,2);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                #Cortes
                                            </td>
                                            <td> - </td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                <?php echo $this->Form->text("Hojasproduccione.$i.numero_cortes", array('class' => 'form-control', 'onkeyup' => "calcula_costo15($i);", 'id' => "idcortes-$i", 'data-parsley-group' => "grup-cortes-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                            </td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td>
                                                <div id="iddivselectprecio-<?php echo $i; ?>" <?php echo $displayp; ?>>
                                                    <?php echo $this->Form->select("Hojasproduccione.$i.precio1", $precios_g_cortes, array('class' => 'form-control input-sm', 'onchange' => "calcula_costo15($i,2)", 'id' => "idpreciose-$i", $required)) ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', false);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', true);
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);">Texto</a> 
                                                </div>
                                                <div id="iddivtextprecio-<?php echo $i; ?>" <?php echo $displayp2; ?>>
                                                    <?php echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo15($i,3);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, $required2)); ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', true);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', false);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#idpreciose-<?php echo $i; ?>').val('');
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);">Select</a> 
                                                </div>
                                            </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo15($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['id'] == 16): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo16($i,2);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                #Cortes
                                            </td>
                                            <td> - </td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                <?php echo $this->Form->text("Hojasproduccione.$i.numero_cortes", array('class' => 'form-control', 'onkeyup' => "calcula_costo16($i);", 'id' => "idcortes-$i", 'data-parsley-group' => "grup-cortes-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                            </td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td>
                                                <div id="iddivselectprecio-<?php echo $i; ?>" <?php echo $displayp; ?>>
                                                    <?php echo $this->Form->select("Hojasproduccione.$i.precio1", $precios_g_hora, array('class' => 'form-control input-sm', 'onchange' => "calcula_costo16($i,2)", 'id' => "idpreciose-$i", $required)) ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', false);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', true);
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);">Texto</a> 
                                                </div>
                                                <div id="iddivtextprecio-<?php echo $i; ?>" <?php echo $displayp2; ?>>
                                                    <?php echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo16($i,3);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, $required2)); ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', true);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', false);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#idpreciose-<?php echo $i; ?>').val('');
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);">Select</a> 
                                                </div>
                                            </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo16($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['id'] == 17): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo17($i,2);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                #Lineas
                                            </td>
                                            <td> - </td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                <?php echo $this->Form->text("Hojasproduccione.$i.numero_lineas", array('class' => 'form-control', 'onkeyup' => "calcula_costo17($i);", 'id' => "idlineas-$i", 'data-parsley-group' => "grup-lineas-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                            </td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td>
                                                <div id="iddivselectprecio-<?php echo $i; ?>" <?php echo $displayp; ?>>
                                                    <?php echo $this->Form->select("Hojasproduccione.$i.precio1", $precios_troquelado, array('class' => 'form-control input-sm', 'onchange' => "calcula_costo17($i,2)", 'id' => "idpreciose-$i", $required)) ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', false);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', true);
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);">Texto</a> 
                                                </div>
                                                <div id="iddivtextprecio-<?php echo $i; ?>" <?php echo $displayp2; ?>>
                                                    <?php echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo17($i,3);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, $required2)); ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', true);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', false);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#idpreciose-<?php echo $i; ?>').val('');
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);">Select</a> 
                                                </div>
                                            </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo17($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                          <?php if ($ht['Tipotrabajo']['id'] == 18): ?>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.cantidad", array('class' => 'form-control', 'onkeyup' => "calcula_costo18($i,2);", 'id' => "idcantidad-$i", 'data-parsley-group' => "grup-cantidad-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'value' => $cantidad, 'required')); ?></td>
                                            <td><?php echo $ht['Tipotrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['descripcion']; ?></td>
                                            <td><?php echo $ht['Hojastipostrabajo']['caras']; ?></td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajeini", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idancho-$i", 'data-parsley-group' => "grup-ancho-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                #Lineas
                                            </td>
                                            <td> - </td>
                                            <td>
                                                <?php //echo $this->Form->text("Hojasproduccione.$i.metrajefin", array('class' => 'form-control', 'onkeyup' => "calcula_costo5($i);", 'id' => "idalto-$i", 'data-parsley-group' => "grup-alto-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                                <?php echo $this->Form->text("Hojasproduccione.$i.numero_lineas", array('class' => 'form-control', 'onkeyup' => "calcula_costo18($i);", 'id' => "idcortes-$i", 'data-parsley-group' => "grup-cortes-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?>
                                            </td>
                                            <td><?php echo $ht['Hojastipostrabajo']['numero']; ?></td>
                                            <td>
                                                <div id="iddivselectprecio-<?php echo $i; ?>" <?php echo $displayp; ?>>
                                                    <?php echo $this->Form->select("Hojasproduccione.$i.precio1", $precios_l_agua, array('class' => 'form-control input-sm', 'onchange' => "calcula_costo18($i,2)", 'id' => "idpreciose-$i", $required)) ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', false);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', true);
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);">Texto</a> 
                                                </div>
                                                <div id="iddivtextprecio-<?php echo $i; ?>" <?php echo $displayp2; ?>>
                                                    <?php echo $this->Form->text("Hojasproduccione.$i.precio", array('class' => 'form-control', 'onkeyup' => "calcula_costo18($i,3);", 'id' => "idprecio-$i", 'data-parsley-group' => "grup-precio-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, $required2)); ?>
                                                    <a class="label label-success" style="margin-top: 3px;" onclick="$('#idpreciose-<?php echo $i; ?>').attr('required', true);
                                                          $('#idprecio-<?php echo $i; ?>').attr('required', false);
                                                          $('#iddivtextprecio-<?php echo $i; ?>').toggle(200);
                                                          $('#idpreciose-<?php echo $i; ?>').val('');
                                                          $('#iddivselectprecio-<?php echo $i; ?>').toggle(200);">Select</a> 
                                                </div>
                                            </td>
                                            <td><?php echo $this->Form->text("Hojasproduccione.$i.costo", array('class' => 'form-control', 'onkeyup' => "calcula_costo18($i,1);", 'id' => "idcosto-$i", 'data-parsley-group' => "grup-costo-$i", 'data-parsley-type' => 'number', 'data-parsley-min' => 0, 'required')); ?></td>
                                          <?php endif; ?>
                                      </tr>
                                      <?php $i++; ?>
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
                                        <td>TOTAL</td>
                                        <td id="idtdtotalp">0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <?php echo $this->Form->select('Hojasproduccione.tipo_nota', array('Nota de entrega' => 'Nota de entrega', 'Nota de Remision' => 'Nota de Remision'), array('class' => 'form-control', 'required', 'onchange' => 'actualiza_nota();', 'id' => 'idselectnota')) ?>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary col-md-12">REGISTRAR</button>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script(array('../plugins/parsley/js/parsley.js'
  , 'iniproduccion'
  ), array('block' => 'scriptadd'));
?>
<script>
  var precios2 = [];
<?php foreach ($precios2_array as $pre): ?>
    precios2[<?php echo $pre['Formato']['id'] ?>] = [];
    precios2[<?php echo $pre['Formato']['id'] ?>]['cantidadfinal'] = <?php echo $pre['Formato']['cantidadfinal'] ?>;
    precios2[<?php echo $pre['Formato']['id'] ?>]['precio'] = <?php echo $pre['Formato']['precio'] ?>;
<?php endforeach; ?>

  var precios4 = [];
<?php foreach ($precios4_array as $pre): ?>
    precios4[<?php echo $pre['Formato']['id'] ?>] = [];
    precios4[<?php echo $pre['Formato']['id'] ?>]['cantidadfinal'] = <?php echo $pre['Formato']['cantidadfinal'] ?>;
    precios4[<?php echo $pre['Formato']['id'] ?>]['precio'] = <?php echo $pre['Formato']['precio'] ?>;
<?php endforeach; ?>

  var g_cortes = [];
<?php foreach ($precios_g_cortes_array as $pre): ?>
    g_cortes[<?php echo $pre['Formato']['id'] ?>] = [];
    g_cortes[<?php echo $pre['Formato']['id'] ?>]['cantidadfinal'] = <?php echo $pre['Formato']['cantidadfinal'] ?>;
    g_cortes[<?php echo $pre['Formato']['id'] ?>]['precio'] = <?php echo $pre['Formato']['precio'] ?>;
<?php endforeach; ?>

  var g_hora = [];
<?php foreach ($precios_g_hora_array as $pre): ?>
    g_hora[<?php echo $pre['Formato']['id'] ?>] = [];
    g_hora[<?php echo $pre['Formato']['id'] ?>]['cantidadfinal'] = <?php echo $pre['Formato']['cantidadfinal'] ?>;
    g_hora[<?php echo $pre['Formato']['id'] ?>]['precio'] = <?php echo $pre['Formato']['precio'] ?>;
<?php endforeach; ?>

  var troquelado = [];
<?php foreach ($precios_troquelado_array as $pre): ?>
    troquelado[<?php echo $pre['Formato']['id'] ?>] = [];
    troquelado[<?php echo $pre['Formato']['id'] ?>]['cantidadfinal'] = <?php echo $pre['Formato']['cantidadfinal'] ?>;
    troquelado[<?php echo $pre['Formato']['id'] ?>]['precio'] = <?php echo $pre['Formato']['precio'] ?>;
<?php endforeach; ?>

  var l_agua = [];
<?php foreach ($precios_l_agua_array as $pre): ?>
    l_agua[<?php echo $pre['Formato']['id'] ?>] = [];
    l_agua[<?php echo $pre['Formato']['id'] ?>]['cantidadfinal'] = <?php echo $pre['Formato']['cantidadfinal'] ?>;
    l_agua[<?php echo $pre['Formato']['id'] ?>]['precio'] = <?php echo $pre['Formato']['precio'] ?>;
<?php endforeach; ?>

  var precio_total = 0.00;
  var total_tt = <?php echo $i; ?>;
  function actualiza_nota() {
      for (i = 0; i < total_tt; i++) {
          $('#idhtiponota-' + i).val($('#idselectnota').val());
      }
  }
  function calcula_costo0(numero, sw) {
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
          }
      }
      if ($('#idancho-' + numero).val() != null && $('#idancho-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-ancho-' + numero)) {
          }
      }
      if ($('#idalto-' + numero).val() != null && $('#idalto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-alto-' + numero)) {
          }
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
          }
      }
      suma_total();
  }
  function calcula_costo1(numero, sw) {
      var vcantidad = 0.00;
      var vancho = 0.00;
      var valto = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      var caras = 1;
      if ($('#idcaras-' + numero).val() == 'Ambos') {
          caras = 2;
      }
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idancho-' + numero).val() != null && $('#idancho-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-ancho-' + numero)) {
              vancho = $('#idancho-' + numero).val();
          }
      }
      if ($('#idalto-' + numero).val() != null && $('#idalto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-alto-' + numero)) {
              valto = $('#idalto-' + numero).val();
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val();
          }
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      //-------------------------
      if (!sw) {
          $('#idcosto-' + numero).val(parseFloat((vcantidad * vancho * valto * vprecio * caras)).toFixed(2));
      }
      suma_total();
  }

  function calcula_costo2(numero, sw) {
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      var caras = 1;
      if ($('#idcaras-' + numero).val() == 'Ambos') {
          caras = 2;
      }
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idancho-' + numero).val() != null && $('#idancho-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-ancho-' + numero)) {
          }
      }
      if ($('#idalto-' + numero).val() != null && $('#idalto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-alto-' + numero)) {
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '' && sw == 3) {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val()*caras;
              $('#idcosto-' + numero).val(vprecio);
          }
      }
      if (sw == 2) {
          if ($('#idpreciose-' + numero).val() != '') {
              if (vcantidad <= precios2[$('#idpreciose-' + numero).val()]['cantidadfinal']) {
                  vprecio = precios2[$('#idpreciose-' + numero).val()]['precio']*caras;
              } else {
                  vprecio = ((precios2[$('#idpreciose-' + numero).val()]['precio'] / precios2[$('#idpreciose-' + numero).val()]['cantidadfinal']) * vcantidad) * caras;
              }
          }
          vprecio = parseFloat(vprecio.toFixed(2));
          $('#idprecio-' + numero).val(vprecio);
          $('#idcosto-' + numero).val(vprecio);
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      suma_total();
  }
  function calcula_costo3(numero, sw) {
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '') {
          vprecio = $('#idprecio-' + numero).val();
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      //-------------------------
      if (!sw) {
          //vprecio = parseFloat(vprecio.toFixed(2));
          $('#idcosto-' + numero).val(vcantidad * vprecio);
      }
      suma_total();
  }
  function calcula_costo4(numero, sw) {
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      var caras = 1;
      if ($('#idcaras-' + numero).val() == 'Ambos') {
          caras = 2;
      }
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idancho-' + numero).val() != null && $('#idancho-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-ancho-' + numero)) {
          }
      }
      if ($('#idalto-' + numero).val() != null && $('#idalto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-alto-' + numero)) {
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '' && sw == 3) {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val()*caras;
              $('#idcosto-' + numero).val(vprecio);
          }
      }
      if (sw == 2) {
          if ($('#idpreciose-' + numero).val() != '') {
              if (vcantidad <= precios4[$('#idpreciose-' + numero).val()]['cantidadfinal']) {
                  vprecio = precios4[$('#idpreciose-' + numero).val()]['precio']*caras;
              } else {
                  vprecio = ((precios4[$('#idpreciose-' + numero).val()]['precio'] / precios4[$('#idpreciose-' + numero).val()]['cantidadfinal']) * vcantidad) * caras;
              }
          }
          vprecio = parseFloat(vprecio.toFixed(2));
          $('#idprecio-' + numero).val(vprecio);
          $('#idcosto-' + numero).val(vprecio);
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      suma_total();
  }
  function calcula_costo5(numero, sw) {
      //alert('sssssss');
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vancho = 0.00;
      var valto = 0.00;
      var vcosto = 0.00;
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idancho-' + numero).val() != null && $('#idancho-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-ancho-' + numero)) {
              vancho = $('#idancho-' + numero).val();
          }
      }
      if ($('#idalto-' + numero).val() != null && $('#idalto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-alto-' + numero)) {
              valto = $('#idalto-' + numero).val();
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '' && sw == 3) {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val();
              $('#idcosto-' + numero).val(vprecio);
          }
      }
      if (!sw) {
          vprecio = (vcantidad * vancho * valto * 0.03);
          vprecio = parseFloat(vprecio.toFixed(2));
          $('#idprecio-' + numero).val(vprecio);
          $('#idcosto-' + numero).val(vprecio);
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      suma_total();
  }
  function calcula_costo15(numero, sw) {
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idcortes-' + numero).val() != null && $('#idcortes-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cortes-' + numero)) {
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '' && sw == 3) {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val();
              $('#idcosto-' + numero).val(vprecio);
          }
      }
      if (sw == 2) {
          if ($('#idpreciose-' + numero).val() != '') {
              if (vcantidad <= g_cortes[$('#idpreciose-' + numero).val()]['cantidadfinal']) {
                  vprecio = g_cortes[$('#idpreciose-' + numero).val()]['precio'];
              } else {
                  vprecio = (g_cortes[$('#idpreciose-' + numero).val()]['precio'] / g_cortes[$('#idpreciose-' + numero).val()]['cantidadfinal']) * vcantidad;
              }
          }
          vprecio = parseFloat(vprecio.toFixed(2));
          $('#idprecio-' + numero).val(vprecio);
          $('#idcosto-' + numero).val(vprecio);
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      suma_total();
  }
  function calcula_costo16(numero, sw) {
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idcortes-' + numero).val() != null && $('#idcortes-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cortes-' + numero)) {
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '' && sw == 3) {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val();
              $('#idcosto-' + numero).val(vprecio);
          }
      }
      if (sw == 2) {
          if ($('#idpreciose-' + numero).val() != '') {
              if (vcantidad <= g_hora[$('#idpreciose-' + numero).val()]['cantidadfinal']) {
                  vprecio = g_hora[$('#idpreciose-' + numero).val()]['precio'];
              } else {
                  vprecio = (g_hora[$('#idpreciose-' + numero).val()]['precio'] / g_hora[$('#idpreciose-' + numero).val()]['cantidadfinal']) * vcantidad;
              }
          }
          vprecio = parseFloat(vprecio.toFixed(2));
          $('#idprecio-' + numero).val(vprecio);
          $('#idcosto-' + numero).val(vprecio);
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      suma_total();
  }
  function calcula_costo17(numero, sw) {
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idlineas-' + numero).val() != null && $('#idlineas-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-lineas-' + numero)) {
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '' && sw == 3) {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val();
              $('#idcosto-' + numero).val(vprecio);
          }
      }
      if (sw == 2) {
          if ($('#idpreciose-' + numero).val() != '') {
              if (vcantidad <= troquelado[$('#idpreciose-' + numero).val()]['cantidadfinal']) {
                  vprecio = troquelado[$('#idpreciose-' + numero).val()]['precio'];
              } else {
                  vprecio = (troquelado[$('#idpreciose-' + numero).val()]['precio'] / troquelado[$('#idpreciose-' + numero).val()]['cantidadfinal']) * vcantidad;
              }
          }
          vprecio = parseFloat(vprecio.toFixed(2));
          $('#idprecio-' + numero).val(vprecio);
          $('#idcosto-' + numero).val(vprecio);
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      suma_total();
  }
  function calcula_costo18(numero, sw) {
      var vcantidad = 0.00;
      var vprecio = 0.00;
      var vcosto = 0.00;
      //validar campos
      if ($('#idcantidad-' + numero).val() != null && $('#idcantidad-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-cantidad-' + numero)) {
              vcantidad = $('#idcantidad-' + numero).val();
          }
      }
      if ($('#idlineas-' + numero).val() != null && $('#idlineas-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-lineas-' + numero)) {
          }
      }
      if ($('#idprecio-' + numero).val() != null && $('#idprecio-' + numero).val() != '' && sw == 3) {
          if ($('#idform-hproduccion').parsley().validate('grup-precio-' + numero)) {
              vprecio = $('#idprecio-' + numero).val();
              $('#idcosto-' + numero).val(vprecio);
          }
      }
      if (sw == 2) {
          if ($('#idpreciose-' + numero).val() != '') {
              if (vcantidad <= l_agua[$('#idpreciose-' + numero).val()]['cantidadfinal']) {
                  vprecio = l_agua[$('#idpreciose-' + numero).val()]['precio'];
              } else {
                  vprecio = (l_agua[$('#idpreciose-' + numero).val()]['precio'] / l_agua[$('#idpreciose-' + numero).val()]['cantidadfinal']) * vcantidad;
              }
          }
          $('#idprecio-' + numero).val(vprecio);
          $('#idcosto-' + numero).val(vprecio);
      }
      if ($('#idcosto-' + numero).val() != null && $('#idcosto-' + numero).val() != '') {
          if ($('#idform-hproduccion').parsley().validate('grup-costo-' + numero)) {
              vcosto = $('#idcosto-' + numero).val();
          }
      }
      suma_total();
  }
  function suma_total() {
      precio_total = 0.00;
      var cosoto_p = 0.00;
      for (i = 0; i < total_tt; i++) {
          cosoto_p = 0.00;
          if ($('#idcosto-' + i).val() != null && $('#idcosto-' + i).val() != '') {
              if ($('#idform-hproduccion').parsley().validate('grup-costo-' + i)) {
                  cosoto_p = $('#idcosto-' + i).val();
              }
          }
          precio_total = precio_total + parseFloat(cosoto_p);
          precio_total = parseFloat(precio_total.toFixed(2));
      }
      $('#idtdtotalp').html(precio_total);
  }

  var sw_suma = false;
<?php if (!empty($this->request->data['Hojasproduccione'])): ?>
    sw_suma = true;
<?php endif; ?>
</script>