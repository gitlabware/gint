<?php if(!empty($listatipos)):?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
    <th>ID</th>
    <th>Tipo</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($listatipos as $lt):?>
        <tr style="cursor: pointer;" onclick="$('#<?php echo $div;?>').load('<?php echo $this->Html->url(array('action' => 'combodetalle3',$campoform,$div,$lt['Categoriasmonto']['id']));?>');$('#modal-principal').modal('toggle');" >
        <td><?php echo $lt['Categoriasmonto']['id'];?></td>
        <td><?php echo $lt['Categoriasmonto']['nombre'];?></td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
<h4 style="color: blue;">No hay registros!!!</h4>
<?php endif;?>
