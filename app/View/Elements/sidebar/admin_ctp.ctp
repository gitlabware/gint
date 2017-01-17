<?php

?>
<!-- START Template Sidebar (Left) -->
<aside class="sidebar sidebar-left sidebar-menu">
    <!-- START Sidebar Content -->
    <section class="content slimscroll">
        <h5 class="heading">Main Menu</h5>
        <!-- START Template Navigation/Menu -->
        <ul class="topmenu topmenu-responsive" data-toggle="menu">


            <li>
                <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>" data-target="#side-usuarios" data-parent=".topmenu">
                    <span class="figure"><i class="ico-users3"></i></span>
                    <span class="text">Usuarios</span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-usuarios" class="submenu">
                    <li class="submenu-header ellipsis">Usuarios</li>
                    <li >
                        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usuario')); ?>');">
                            <span class="text">Nuevo Usuario</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li >
                <a href="<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'index')); ?>" data-target="#side-insumos"  data-parent=".topmenu">
                    <span class="figure"><i class="ico-cube2"></i></span>
                    <span class="text">Insumos</span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-insumos" class="submenu">
                    <li >
                        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'InsumosCtp', 'action' => 'insumo')); ?>')">
                            <span class="text">Nueva Insumo</span>
                        </a>
                    </li>
                </ul>
                <!--/ END 2nd Level Menu -->
            </li>
            <li >
                <a href="<?php echo $this->Html->url(array('controller' => 'ClientesCtp', 'action' => 'index')); ?>"  data-parent=".topmenu">
                    <span class="figure"><i class="ico-people"></i></span>
                    <span class="text">Clientes</span>
                </a>
                <!-- START 2nd Level Menu -->
                <ul id="side-clientes" class="submenu">
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
                    <span class="figure"><i class="ico-database"></i></span>
                    <span class="text">Trabajos</span>
                </a>
            </li>
            <li >
                <a href="<?php echo $this->Html->url(array('controller' => 'RegistrosCtp','action' => 'index'));?>" data-target="#side-trabajos" data-parent=".topmenu">
                    <span class="figure"><i class="ico-file10"></i></span>
                    <span class="text">Registros Orden</span>
                </a>
            </li>

        </ul>
        <!--/ END Template Navigation/Menu -->
    </section>
    <!--/ END Sidebar Container -->
</aside>
<!--/ END Template Sidebar (Left) -->