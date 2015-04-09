<?php if(!empty($scliente['Cliente']['id'])):?>
<button type="button" class="btn btn-primary btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboclientes1',$campoform,$div));?>');"><?php echo $scliente['Cliente']['nombre'];?></button>
    <?php echo $this->Form->hidden($campoform,array('value' => $scliente['Cliente']['id']));?>
<?php else:?>
    <button type="button" class="btn btn-primary btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Trabajos','action' => 'comboclientes1',$campoform,$div));?>');"><?php echo 'SELECCIONE EL CLIENTE';?></button>
    <?php echo $this->Form->hidden($campoform,array('value' => null));?>
<?php endif; ?>
