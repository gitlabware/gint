<!-- Page Header -->
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold">Sucursales</h4>
    </div>
</div>
<!-- Page Header -->

<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Listado de sucursales</h3>

            </div>
            <!--/ panel heading/header -->


            <!-- panel body with collapse capabale -->
            <div class="table-responsive panel-collapse pull out">
                <table class="table table-bordered table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefonos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sucursales as $su): ?>
                            <tr>
                                <td><?php echo $su['Sucursale']['nombre'] ?></td>
                                <td><?php echo $su['Sucursale']['direccion'] ?></td>
                                <td><?php echo $su['Sucursale']['telefono'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-xs" type="button" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'sucursal', $su['Sucursale']['id'])); ?>')"><i class="ico-pencil3"></i> Editar</button>
                                    <button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar', $su['Sucursale']['id'])); ?>', 'Esta seguro de eliminar la sucursal <?php echo $su['Sucursale']['nombre']; ?>')"><i class="ico-cancel"></i> Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br><br><br><br>
            </div>
            <!--/ panel body with collapse capabale -->
        </div>
    </div>
</div>
<!--/ END row -->