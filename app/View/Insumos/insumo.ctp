<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class=" ico-cube4 mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info"><?php echo $categoria['Categoria']['nombre'].' - Insumo'?></h3></div>
    
</div>
<?php echo $this->Form->create('Insumo',array('action' => 'guarda_insumo','data-parsley-validate'));?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Nombre</label>
                <?php echo $this->Form->hidden('id');?>
                <?php echo $this->Form->hidden('categoria_id');?>
                <?php echo $this->Form->text('nombre',array('class' => 'form-control','required','placeholder' => 'Ingrese el nombre del insumo'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php 
        $disabled_mic = 'disabled';
        //$disabled_alto = 'disabled';
        $required_mic = '';
        //$required_alto = '';
        if($categoria['Categoria']['micraje']){
            $disabled_mic = '';
            $required_mic = 'required';
        }/*
        if($categoria['Categoria']['alto']){
            $disabled_alto = '';
            $required_alto = 'required';
        }*/
        ?>
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Micraje</label>
                <?php echo $this->Form->text('micraje',array('class' => 'form-control',$disabled_mic,'data-parsley-type' => 'number',$required_mic));?>
            </div>
            <!--
            <div class="col-sm-6">
                <label class="control-label">Alto</label>
                <?php //echo $this->Form->text('alto',array('class' => 'form-control',$disabled_alto,'data-parsley-type' => 'number',$required_alto));?>
            </div>-->
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Observacion</label>
                <?php echo $this->Form->textarea('observacion',array('class' => 'form-control','placeholder' => 'Ingrese una observacion del insumo'));?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Registrar</button>
</div>
<?php echo $this->Form->end();?>

<?php echo $this->Html->script(array(
    '../plugins/parsley/js/parsley.js'
    )); ?>