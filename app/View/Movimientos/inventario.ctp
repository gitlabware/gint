<?php
App::import('Model', 'Insumo');
$Insumo = new Insumo();
?>
<?php
echo $this->Html->css(array('../plugins/select2/css/select2'), array('block' => 'cssadd'));
?>
<!-- START row -->
<div class="row">
    <div class="col-md-12">
        <!-- START panel -->
        <div class="panel panel-primary">
            <!-- panel heading/header -->
            <div class="panel-heading">
                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span>INVENTARIO DEL TRABAJO #<?php echo $idTrabajo; ?></h3>
            </div>
            <!--/ panel heading/header -->
            <div class="panel-body">
                <div class="form-horizontal form-bordered">
                    <div class="form-group">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Trabajo</th>
                                    <th>Cantidad</th>
                                    <th>Formato</th>
                                    <th>Adicionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($hproducciones as $hp): ?>
                                    <tr>
                                        <td><?php echo $hp['Tipotrabajo']['descripcion'] ?></td>
                                        <td><?php echo $hp['Hojasproduccione']['cantidad'] ?></td>
                                        <td>
                                            <?php
                                            if (!empty($hp['Hojasproduccione']['metrajeini']) && !empty($hp['Hojasproduccione']['metrajefin'])) {
                                                echo $hp['Hojasproduccione']['metrajeini'] . ' X ' . $hp['Hojasproduccione']['metrajefin'];
                                            } elseif ($hp['Hojasproduccione']['precio'] == 3) {
                                                echo 'Carta';
                                            } elseif ($hp['Hojasproduccione']['precio'] == 4) {
                                                echo 'Oficio';
                                            }elseif (!empty($hp['Hojasproduccione']['numero_cortes'])) {
                                                echo $hp['Hojasproduccione']['numero_cortes'].' cortes';
                                            } elseif (!empty($hp['Hojasproduccione']['numero_lineas'])) {
                                                echo $hp['Hojasproduccione']['numero_lineas'].' lineas';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-xs" type="button" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'usado',$hp['Hojasproduccione']['id']));?>')"><i class="ico-upload-alt"></i> Registrar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Insumo</th>
                                    <th>Cantidad Kg</th>
                                    <th>Estado</th>
                                    <th>Anular</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inventarios as $in): ?>
                                <?php 
                                $color = 'success';
                                if($in['Inventario']['tipo'] == 'Devuelto'){
                                    $color = 'danger';
                                }
                                ?>
                                    <tr>
                                        <td class="<?php echo $color;?>"><?php echo $in['Insumo']['nombre'];?></td>
                                        <td class="<?php echo $color;?>"><?php echo $in['Inventario']['cantidad'];?></td>
                                        <td class="<?php echo $color;?>"><?php echo $in['Inventario']['tipo'];?></td>
                                        <td class="<?php echo $color;?>">
                                            <?php if($in['Inventario']['tipo'] != 'Devuelto'):?>
                                            <button class="btn btn-danger btn-xs" type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'registra_devuelto',$in['Inventario']['id']));?>';"><i class="ico-download-alt"></i> Devolver</button>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Html->script(array(
    '../plugins/select2/js/select2.js'
    , 'inventarios'
    , '../plugins/parsley/js/parsley.js'
        ), array('block' => 'scriptadd'));
?>