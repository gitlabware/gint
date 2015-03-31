<!-- Page Header -->
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><?php echo $categoria['Categoria']['nombre']; ?></h4>
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
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Listado de <?php echo $categoria['Categoria']['nombre']; ?></h3>
                <div class="panel-toolbar text-right">
                    <div class="option">
                        <button class="btn up" type="button" title="Adicionar Insumo"   onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Insumos', 'action' => 'insumo', $categoria['Categoria']['id'])); ?>');"><i class="ico-plus"></i> </button>
                    </div>
                </div>
            </div>
            <!--/ panel heading/header -->
            

            <!-- panel body with collapse capabale -->
            <div class="table-responsive panel-collapse pull out">
                <table class="table table-bordered table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <?php if ($categoria['Categoria']['micraje']): ?>
                                <th>Micraje</th>
                            <?php endif; ?>
                            <?php //if ($categoria['Categoria']['alto']): ?>
                <!--<th>Alto</th>-->
                            <?php //endif; ?>
                                <th>Total kg.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($insumos as $in): ?>
                            <tr>
                                <td><?php echo $in['Insumo']['nombre'] ?></td>
                                <?php if ($categoria['Categoria']['micraje']): ?>
                                    <td><?php echo $in['Insumo']['micraje'] ?></td>
                                <?php endif; ?>
                                <?php //if ($categoria['Categoria']['alto']): ?>
                    <!--<td><?php //echo $in['Insumo']['alto']     ?></td>-->
                                <?php //endif; ?>
                                    <td><?php echo $this->requestAction(array('action' => 'get_total',$in['Insumo']['id'])); ?></td> 
                                <td class="text-center">
                                    <button class="btn btn-primary btn-xs" type="button"  onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'insumo', $categoria['Categoria']['id'], $in['Insumo']['id'])); ?>');"> <i class="ico-pencil4"></i> Editar</button>
                                    <button class="btn btn-success btn-xs" type="button"  onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'adicionar', $in['Insumo']['id'])); ?>');"> <i class="ico-download-alt"></i> Adicionar</button>
                                    <button class="btn btn-info btn-xs" type="button"  onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'sacar', $in['Insumo']['id'])); ?>');"> <i class="ico-upload-alt"></i> Sacar</button>
                                    <button class="btn btn-danger btn-xs" type="button" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar', $in['Insumo']['id'])) ?>', '<?php echo 'Esta seguro de eliminar el insumo ' . $in['Insumo']['nombre']; ?>');"> <i class="ico-trash"></i> Eliminar</button>
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