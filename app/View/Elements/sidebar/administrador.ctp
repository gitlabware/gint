<?php
App::import('Model', 'Categoria');
$categoria = new Categoria();
$categorias = $categoria->find('all');
?>
<!-- START Template Sidebar (Left) -->
<aside class="sidebar sidebar-left sidebar-menu">
    <!-- START Sidebar Content -->
    <section class="content slimscroll">
        <h5 class="heading">Main Menu</h5>
        <!-- START Template Navigation/Menu -->
        <ul class="topmenu topmenu-responsive" data-toggle="menu">
            <li>
                <a href="javascript:void(0);" data-target="#side-usuarios" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-users3"></i></span>
                    <span class="text">Usuarios</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-usuarios" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Usuarios</li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>">
                            <span class="text">Listado de Usuarios</span>
                        </a>
                    </li>
                    <li >
                        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usuario')); ?>');">
                            <span class="text">Nuevo Usuario</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li >
                <a href="javascript:void(0);" data-target="#side-trabajos" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-briefcase"></i></span>
                    <span class="text">Trabajos</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-trabajos" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Trabajos</li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Trabajos', 'action' => 'index')); ?>">
                            <span class="text">Listado de Trabajos</span>
                        </a>
                    </li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Trabajos', 'action' => 'trabajo')); ?>">
                            <span class="text">Nuevo Trabajo</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li >
                <a href="javascript:void(0);" data-target="#side-insumos" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-th-large"></i></span>
                    <span class="text">Insumos</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-insumos" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Insumos</li>
                    <?php foreach ($categorias as $ca): ?>
                        <li >
                            <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-categorias-<?php echo $ca['Categoria']['id']; ?>" data-parent="#page">
                                <span class="text"><?php echo $ca['Categoria']['nombre'] ?></span>
                                <span class="arrow"></span>
                            </a>
                            <!-- START 2nd Level Menu -->
                            <ul id="sub-side-categorias-<?php echo $ca['Categoria']['id']; ?>" class="submenu collapse ">
                                <li >
                                    <a href="<?php echo $this->Html->url(array('controller' => 'Insumos', 'action' => 'index', $ca['Categoria']['id'])); ?>"><span class="text">Listado de <?php echo $ca['Categoria']['nombre'] ?></span></a>
                                </li>
                                <li >
                                    <a href="javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Insumos', 'action' => 'insumo', $ca['Categoria']['id'])); ?>');"><span class="text">Adicionar</span></a>
                                </li>
                            </ul>
                            <!--/ END 2nd Level Menu -->
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li >
                <a href="javascript:void(0);" data-target="#side-configuraciones" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-wrench2"></i></span>
                    <span class="text">Configuraciones</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-configuraciones" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Configuraciones</li>
                    <li >
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-categorias" data-parent="#page">
                            <span class="text">Categorias</span>
                            <span class="arrow"></span>
                        </a>
                        <!-- START 2nd Level Menu -->
                        <ul id="sub-side-categorias" class="submenu collapse ">
                            <li >
                                <a href="<?php echo $this->Html->url(array('controller' => 'Categorias', 'action' => 'index')); ?>"><span class="text">Listado de Categorias</span></a>
                            </li>
                            <li >
                                <a href="javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Categorias', 'action' => 'categoria')); ?>');"><span class="text">Nueva Categoria</span></a>
                            </li>
                        </ul>
                        <!--/ END 2nd Level Menu -->
                    </li>
                    <li >
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-docificaciones" data-parent="#page">
                            <span class="text">Docificaciones</span>
                            <span class="arrow"></span>
                        </a>
                        <!-- START 2nd Level Menu -->
                        <ul id="sub-side-docificaciones" class="submenu collapse ">
                            <li >
                                <a href="<?php echo $this->Html->url(array('controller' => 'Facturas', 'action' => 'listaparametros')); ?>"><span class="text">Listado de Docificaciones</span></a>
                            </li>
                            <li >
                                <a href="javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Facturas', 'action' => 'parametrofactura')); ?>');"><span class="text">Nueva Docificacion</span></a>
                            </li>
                        </ul>
                        <!--/ END 2nd Level Menu -->
                    </li>

                    <li >
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-sucursales" data-parent="#page">
                            <span class="text">Sucursales</span>
                            <span class="arrow"></span>
                        </a>
                        <!-- START 2nd Level Menu -->
                        <ul id="sub-side-sucursales" class="submenu collapse ">
                            <li >
                                <a href="<?php echo $this->Html->url(array('controller' => 'Sucursales', 'action' => 'index')); ?>"><span class="text">Listado de Sucursales</span></a>
                            </li>
                            <li >
                                <a href="javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Sucursales', 'action' => 'sucursal')); ?>');"><span class="text">Nueva Sucursal</span></a>
                            </li>
                        </ul>
                        <!--/ END 2nd Level Menu -->
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>

            <li >
                <a href="javascript:void(0);" data-target="#side-ventas" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class=" ico-cart7"></i></span>
                    <span class="text">Ventas</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-ventas" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Ventas</li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Movimientos', 'action' => 'ventas')); ?>">
                            <span class="text">Listado de ventas</span>
                        </a>
                    </li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Movimientos', 'action' => 'venta')); ?>">
                            <span class="text">Nueva venta</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>

            <li >
                <a href="javascript:void(0);" data-target="#side-transferencias" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-transmission"></i></span>
                    <span class="text">Transferencias</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-transferencias" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Transferencias</li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Movimientos', 'action' => 'transferencias')); ?>">
                            <span class="text">Listado de Transferencias</span>
                        </a>
                    </li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Movimientos', 'action' => 'transferencia')); ?>">
                            <span class="text">Nueva Transferencia</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>

            <li>
                <a href="javascript:void(0)" data-target="#side-clientes" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-user7"></i></span>
                    <span class="text">Clientes</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-clientes" class="submenu collapse ">
                    <li class="submenu-header ellipsis">Clientes</li>
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'Clientes', 'action' => 'index')); ?>">
                            <span class="text">Listado de clientes</span>
                        </a>
                    </li>
                    <li >
                        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Clientes', 'action' => 'add')); ?>');">
                            <span class="text">Nuevo Cliente</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li>
                <a href="javascript:void(0)" data-target="#side-maquinarias" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-power-cord"></i></span>
                    <span class="text">Maquinarias</span>
                    <span class="arrow"></span>
                </a>
                <ul id="side-maquinarias" class="submenu collapse">
                    <li class="submenu-header ellipsis">Maquinarias0</li>
                    <li>
                        <a href="<?php echo $this->Html->url(array('controller' => 'Maquinarias', 'action' => 'index')); ?>">
                            <span class="text">Listado de Maquinarias</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Maquinarias', 'action' => 'add')); ?>')">
                            <span class="text">Nueva Maquinaria</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" data-target="#side-formatos" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class="ico-calculate2"></i></span>
                    <span class="text">Formatos</span>
                    <span class="arrow"></span>
                </a>
                <ul id="side-formatos" class="submenu collapse">
                    <li class="submenu-header ellipsis">Formatos</li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-34" data-parent="#page">
                            <span class="text">U.v brillo/ Mate</span>
                            <span class="arrow"></span>
                        </a>
                        <!-- START 2nd Level Menu -->
                        <ul id="sub-side-34" class="submenu collapse ">
                            <li >
                                <a href="<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'lista34')); ?>"><span class="text">Listado de U.v brillo/ Mate</span></a>
                            </li>
                            <li >
                                <a href="javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'formato34')); ?>');"><span class="text">Adicionar U.v brillo/Mate</span></a>
                            </li>
                        </ul>
                        <!--/ END 2nd Level Menu -->
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-6" data-parent="#page">
                            <span class="text">Sectorizado Brillo</span>
                            <span class="arrow"></span>
                        </a>
                        <ul id="sub-side-6" class="submenu collapse ">
                            <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'lista6')); ?>"><span class="text">Listado Sectorizado Brillo</span></a>
                            </li>
                            <li>
                                <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'formato6'))?>');"><span class="text">Adicionar Sectorizado Brillo</span></a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-15" data-parent="#page">
                            <span class="text">Guillotina Cortes</span>
                            <span class="arrow"></span>
                        </a>
                        <ul id="sub-side-15" class="submenu collapse ">
                            <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'lista15')); ?>"><span class="text">Listado Guillotina Cortes</span></a>
                            </li>
                            <li>
                                <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller'=>'Formatos', 'action'=>'formato15'))?>');"><span class="text">Adicionar Guillotina Cortes</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-16" data-parent="#page">
                            <span class="text">Guillotina Hora</span>
                            <span class="arrow"></span>
                        </a>
                        <ul id="sub-side-16" class="submenu collapse ">
                            <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'lista16')); ?>"><span class="text">Listado Guillotina Hora</span></a>
                            </li>
                            <li>
                                <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller'=>'Formatos', 'action'=>'formato16'))?>');"><span class="text">Adicionar Guillotina Hora</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                         <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-17" data-parent="#page">
                            <span class="text">Troquelado</span>
                            <span class="arrow"></span>
                        </a>
                        <ul id="sub-side-17" class="submenu collapse ">
                            <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'lista17')); ?>"><span class="text">Listado Troquelado</span></a>
                            </li>
                            <li>
                                <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller'=>'Formatos', 'action'=>'formato17'))?>');"><span class="text">Adicionar Troquelado</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="submenu" data-target="#sub-side-18" data-parent="#page">
                            <span class="text">Linea de Agua</span>
                            <span class="arrow"></span>
                        </a>
                        <ul id="sub-side-18" class="submenu collapse ">
                            <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Formatos', 'action' => 'lista18')); ?>"><span class="text">Listado Linea de agua</span></a>
                            </li>
                            <li>
                                <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller'=>'Formatos', 'action'=>'formato18'))?>');"><span class="text">Adicionar Linea de Agua</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?php echo $this->Html->url(array('controller' => 'Cajachicas', 'action' => 'nuevo')); ?>"  data-parent=".topmenu">
                    <span class="figure"><i class="ico-coins"></i></span>
                    <span class="text">Caja Chica</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $this->Html->url(array('controller' => 'Facturas', 'action' => 'index')); ?>"  data-parent=".topmenu">
                    <span class="figure"><i class="ico-list"></i></span>
                    <span class="text">Facturas</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'index')); ?>"  data-parent=".topmenu">
                    <span class="figure"><i class="ico-calendar6"></i></span>
                    <span class="text">Reportes</span>
                </a>
            </li>

        </ul>
        <!--/ END Template Navigation/Menu -->
    </section>
    <!--/ END Sidebar Container -->
</aside>
<!--/ END Template Sidebar (Left) -->