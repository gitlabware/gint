<?php if(!empty($sdetalle['Categoriasmonto']['id'])):?>
<button type="button" class="btn btn-primary btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'combodetalle1',$campoform,$div));?>');"><?php echo $sdetalle['Categoriasmonto']['nombre'];?></button>
    <?php echo $this->Form->hidden($campoform,array('value' => $sdetalle['Categoriasmonto']['id']));?>
<?php else:?>
    <button type="button" class="btn btn-primary btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Cajachicas','action' => 'combodetalle1',$campoform,$div));?>');"><?php echo 'SELECCIONE EL CLIENTE';?></button>
    <?php echo $this->Form->hidden($campoform,array('value' => null));?>
<?php endif; ?>
