<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <div class=" ico-books mb15 mt15" style="font-size:36px;"><h3 class="semibold modal-title text-info">Busque Detalle</h3></div>

</div>
<?php echo $this->Form->create('Trabajo', array('id' => 'idformcombo1')); ?>
<div class="modal-body">
    <div class="form-group">
        <div class="row">            
            <div class="col-sm-12">
                <?php echo $this->Form->text('Caja.detalle', array('class' => 'form-control', 'placeholder' => 'Ingrese el detalle', 'id' => 'combobuscadetalletext')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <div id="listadocombodetalle" class="table-responsive panel-collapse pull out">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary" onclick="$('#<?php echo $div; ?>').load('<?php echo $this->Html->url(array('action' => 'combodetalle3', $campoform, $div, NULL)); ?>');
          jQuery('#modal-principal').modal('toggle');">Ninguno</button>
</div>
<script>
  jQuery(document).ready(function () {
      jQuery("#idformcombo1").submit(function () {
          return false;
      });
  });
  jQuery('#combobuscadetalletext').keyup(function () {
      var postData = jQuery(this).serializeArray();
      var formURL = "<?php echo $this->Html->url(array('action' => 'combodetalle2', $campoform, $div)); ?>";
      jQuery.ajax(
              {
                  url: formURL,
                  type: "POST",
                  data: postData,
                  /*beforeSend:function (XMLHttpRequest) {
                   alert("antes de enviar");
                   },
                   complete:function (XMLHttpRequest, textStatus) {
                   alert('despues de enviar');
                   },*/
                  success: function (data, textStatus, jqXHR)
                  {
                      //data: return data from server
                      jQuery("#listadocombodetalle").html(data);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      //if fails   
                      alert("error");
                  }
              });
  });
</script>
<?php echo $this->Form->end(); ?>
