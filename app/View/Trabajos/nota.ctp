<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span><?php echo strtoupper($tipo); ?> #<?php echo $numero; ?></h3>
            </div>
            <!--/ panel heading/header -->
            <div class="panel-body">
                <div class="form-horizontal form-bordered">
                    <?php echo $this->Form->create('Trabajo', array('action' => 'registra_nota/' . $trabajo['Trabajo']['id'], 'data-parsley-validate')); ?>
                    <?php echo $this->Form->hidden('Nota.id'); ?>
                    <?php echo $this->Form->hidden('Nota.tipo'); ?>
                    <?php echo $this->Form->hidden('Nota.trabajo_id', array('value' => $trabajo['Trabajo']['id'])); ?>
                    <?php echo $this->Form->hidden('Nota.numero', array('value' => $numero)); ?>
                    <?php echo $this->Form->hidden('Nota.sucursale_id', array('value' => $trabajo['Trabajo']['sucursale_id'])) ?>
                    <?php echo $this->Form->hidden('Nota.user_id', array('value' => $this->Session->read('Auth.User.id'))) ?>
                    <?php echo $this->Form->hidden('Nota.total_pagado'); ?>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label class="control-label col-md-12">Costo Total: </label>
                            <label class="col-md-12 text-success control-label"><?php echo $total; ?></label>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Forma de Pago</label>
                            <?php echo $this->Form->select('Nota.tipo_pago', array('Credito' => 'Credito', 'Contado' => 'Contado','Credito Pagado' => 'Credito Pagado'), array('class' => 'form-control', 'required', 'id' => 'idselectpago', 'onchange' => 'cambia_pago();')) ?>
                        </div>
                        <?php if ($tipo == 'Nota de Remision'): ?>
                          <div class="col-md-3">
                              <label class="control-label">Numero de Factura: </label>
                              <?php echo $this->Form->text('Nota.numero_factura', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el numero de factura')); ?>
                          </div>
                        <?php endif; ?>
                        <div class="col-md-3">
                            <label class="control-label">Observacion: </label>
                            <?php echo $this->Form->textarea('Nota.observaciones', array('class' => 'form-control disabled', 'placeholder' => 'Ingrese una observacion de la nota')) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-primary col-md-12" type="submit">Registrar</button>
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
  ), array('block' => 'scriptadd'));
?>
