<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class=" ico-folder8 mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Categoria</h3></div>
    
</div>
<?php echo $this->Form->create('Categoria',array('action' => 'guarda_categoria','data-parsley-validate'));?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Nombre</label>
                <?php echo $this->Form->hidden('id');?>
                <?php echo $this->Form->text('nombre',array('class' => 'form-control','required','placeholder' => 'Ingrese el nombre de la categoria'));?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Micraje</label>
                <?php echo $this->Form->checkbox('micraje',array('class' => 'form-control'));?>
            </div>
            <div class="col-sm-6">
                <label class="control-label">Alto</label>
                <?php echo $this->Form->checkbox('alto',array('class' => 'form-control'));?>
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