<!-- Page Header -->
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold">Categorias</h4>
    </div>
</div>
<!-- Page Header -->

<!-- START row -->
<div class="row">
    <div class="col-md-8">
        <!-- START panel -->
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Listado de categorias</h3>

            </div>
            <!--/ panel heading/header -->


            <!-- panel body with collapse capabale -->
            <div class="table-responsive panel-collapse pull out">
                <table class="table table-bordered table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $ca): ?>
                            <tr>
                                <td><?php echo $ca['Categoria']['nombre']?></td>
                                <td class="text-center">
                                    <!-- button toolbar -->
                                    <div class="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-default">Accion</button>
                                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:void(0);" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'categoria',$ca['Categoria']['id']));?>');"><i class="icon ico-pencil"></i>Editar</a></li>
                                                <li class="divider"></li>
                                                <li><a class="text-danger" href="javascript:" onclick="confirma_url('<?php echo $this->Html->url(array('action' => 'eliminar',$ca['Categoria']['id']))?>','<?php echo 'Esta seguro de eliminar la categoria '.$ca['Categoria']['nombre'];?>');"><i class="icon ico-remove3"></i>Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/ button toolbar -->
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