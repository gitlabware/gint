<?php

?>
<!-- START Template Sidebar (Left) -->
<aside class="sidebar sidebar-left sidebar-menu">
    <!-- START Sidebar Content -->
    <section class="content slimscroll">
        <h5 class="heading">Main Menu</h5>
        <!-- START Template Navigation/Menu -->
        <ul class="topmenu topmenu-responsive" data-toggle="menu">



            <li >
                <a href="javascript:void(0);" data-target="#side-insumos" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class=" ico-square"></i></span>
                    <span class="text">Insumos</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-insumos" class="submenu collapse ">
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'index')); ?>">
                            <span class="text">Listado de Insumos</span>
                        </a>
                    </li>
                    <li >
                        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'insumo')); ?>')">
                            <span class="text">Nueva Insumo</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li >
                <a href="javascript:void(0);" data-target="#side-clientes" data-toggle="submenu" data-parent=".topmenu">
                    <span class="figure"><i class=" ico-square"></i></span>
                    <span class="text">Clientes</span>
                    <span class="arrow"></span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-clientes" class="submenu collapse ">
                    <li >
                        <a href="<?php echo $this->Html->url(array('controller' => 'ClientesCtp', 'action' => 'index')); ?>">
                            <span class="text">Listado de Clientes</span>
                        </a>
                    </li>
                    <li >
                        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'ClientesCtp', 'action' => 'cliente')); ?>')">
                            <span class="text">Nuev Cliente</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li >
                <a href="<?php echo $this->Html->url(array('controller' => 'TrabajosCtp','action' => 'index'));?>" data-target="#side-trabajos" data-parent=".topmenu">
                    <span class="figure"><i class=" ico-square"></i></span>
                    <span class="text">Trabajos</span>
                </a>
            </li>

        </ul>
        <!--/ END Template Navigation/Menu -->
    </section>
    <!--/ END Sidebar Container -->
</aside>
<!--/ END Template Sidebar (Left) -->