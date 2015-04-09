<?php if(!empty($listaclientes)):?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
    <th>NIT/CI</th>
    <th>Nombre</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($listaclientes as $ma):?>
        <tr style="cursor: pointer;" onclick="$('#<?php echo $div;?>').load('<?php echo $this->Html->url(array('action' => 'comboclientes3',$campoform,$div,$ma['Cliente']['id']));?>');$('#modal-principal').modal('toggle');" >
        <td><?php echo $ma['Cliente']['nit'];?></td>
        <td><?php echo $ma['Cliente']['nombre'];?></td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
<h4 style="color: blue;">No hay registros!!!</h4>
<?php endif;?>
