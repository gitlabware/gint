<!DOCTYPE html>
<!-- 
TEMPLATE NAME : Adminre - backend
VERSION : 1.3.0
AUTHOR : JohnPozy
AUTHOR URL : http://themeforest.net/user/JohnPozy
EMAIL : pampersdry@gmail.com
LAST UPDATE: 2015/01/05

** A license must be purchased in order to legally use this template for your project **
** PLEASE SUPPORT ME. YOUR SUPPORT ENSURE THE CONTINUITY OF THIS PROJECT **
-->
<html class="backend">
    <!-- START Head -->
    <head>
        <!-- START META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GINT</title>
        <meta name="author" content="pampersdry.info">
        <meta name="description" content="Adminre is a clean and flat backend and frontend theme build with twitter bootstrap">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->webroot; ?>image/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->webroot; ?>image/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->webroot; ?>image/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot; ?>image/touch/apple-touch-icon-57x57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo $this->webroot; ?>image/favicon.ico">
        <!--/ END META SECTION -->

        <!-- START STYLESHEETS -->
        <!-- Plugins stylesheet : optional -->
        <?php echo $this->fetch('cssadd'); ?>
        <!--/ Plugins stylesheet : optional -->

        <!-- Application stylesheet : mandatory -->
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>stylesheet/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>stylesheet/layout.css">
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>stylesheet/uielement.css">
        <!--/ Application stylesheet -->

        <!-- Theme stylesheet : optional -->
        <!--/ Theme stylesheet : optional -->

        <!-- modernizr script -->
        <script type="text/javascript" src="<?php echo $this->webroot; ?>js/javascript/vendor.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/modernizr/js/modernizr.js"></script>
        <!--/ modernizr script -->
        <!-- END STYLESHEETS -->
    </head>
    <!--/ END Head -->

    <!-- START Body -->
    <body>
        <!-- START Template Header -->
        <header id="header" class="navbar">
            <!-- START navbar header -->
            <div class="navbar-header">
                <!-- Brand -->
                <a class="navbar-brand" href="javascript:void(0);">
                    <span class="logo-figure"></span>
                    <span class="logo-text"></span>
                </a>
                <!--/ Brand -->
            </div>
            <!--/ END navbar header -->

            <!-- START Toolbar -->
            <div class="navbar-toolbar clearfix">
                <!-- START Left nav -->
                <ul class="nav navbar-nav navbar-left">
                    <!-- Sidebar shrink -->
                    <li class="hidden-xs hidden-sm">
                        <a href="javascript:void(0);" class="sidebar-minimize" data-toggle="minimize" title="Minimize sidebar">
                            <span class="meta">
                                <span class="icon"></span>
                            </span>
                        </a>
                    </li>
                    <!--/ Sidebar shrink -->

                    <!-- Offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                    <li class="navbar-main hidden-lg hidden-md hidden-sm">
                        <a href="javascript:void(0);" data-toggle="sidebar" data-direction="ltr" rel="tooltip" title="Menu sidebar">
                            <span class="meta">
                                <span class="icon"><i class="ico-paragraph-justify3"></i></span>
                            </span>
                        </a>
                    </li>
                    <!--/ Offcanvas left -->

                    <!-- Search form toggler  -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="dropdown" data-target="#dropdown-form">
                            <span class="meta">
                                <span class="icon"><i class="ico-search"></i></span>
                            </span>
                        </a>
                    </li>
                    <!--/ Search form toggler -->
                </ul>
                <!--/ END Left nav -->

                <!-- START navbar form -->
                <div class="navbar-form navbar-left dropdown" id="dropdown-form">
                    <form action="" role="search">
                        <div class="has-icon">
                            <input type="text" class="form-control" placeholder="Search application...">
                            <i class="ico-search form-control-icon"></i>
                        </div>
                    </form>
                </div>
                <!-- START navbar form -->

                <!-- START Right nav -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Profile dropdown -->
                    <li class="dropdown profile">
                        <a href="javascript:void(0);" class="dropdown-toggle dropdown-hover" data-toggle="dropdown">
                            <span class="meta">
                                <span class="avatar"><img src="<?php echo $this->webroot; ?>image/avatar/avatar7.jpg" class="img-circle" alt="" /></span>
                                <span class="text hidden-xs hidden-sm pl5"><?php echo $this->Session->read('Auth.User.nombre'); ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="divider"></li>
                            <li><a href="javascript:void(0);"><span class="icon"><i class="ico-cog4"></i></span> Editar datos</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'salir')); ?>"><span class="icon"><i class="ico-exit"></i></span> Salir</a></li>
                        </ul>
                    </li>
                    <!-- Profile dropdown -->


                </ul>
                <!--/ END Right nav -->
            </div>
            <!--/ END Toolbar -->
        </header>
        <!--/ END Template Header -->

        <?php echo $this->element('sidebar/administrador') ?>
        <!-- START Template Main -->
        <section id="main" role="main">
            <div class="container-fluid">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
                <!-- START modal -->
                <script>
                    function cargarmodal(urll)
                    {
                        jQuery("#spin-cargando-mod").addClass('show');
                        jQuery('#modal-principal').modal('show', {backdrop: 'static'});
                        jQuery("#divmodalimprenta").load(urll, function (responseText, textStatus, req) {
                            if (textStatus == "error")
                            {
                                alert("error!!!");
                            }
                            else {
                                jQuery("#spin-cargando-mod").removeClass('show');
                            }
                        });

                    }
                </script>
                <div id="modal-principal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div id="spin-cargando-mod" class="indicator"><span class="spinner spinner3"></span></div>
                            <div id="divmodalimprenta">

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!--/ END modal -->
            </div>
        </section>
        <!-- END Template Main -->

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- Application and vendor script : mandatory -->
        
        <script type="text/javascript" src="<?php echo $this->webroot; ?>js/javascript/core.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>js/javascript/backend/app.js"></script>
        <!--/ Application and vendor script : mandatory -->
        <script type="text/javascript" src="<?php echo $this->webroot; ?>plugins/bootbox/js/bootbox.js"></script>
        <?php echo $this->fetch('scriptadd'); ?>

        <script>
                    function confirma_url(curl,texto)
                    {
                        bootbox.confirm(texto, function (result) {
                            // callback
                            if(result){
                                window.location = curl;
                            }
                        });
                        event.preventDefault();
                    }
                    /*$('#confirmacion-url').on('click', function (event) {
                        bootbox.confirm('Are you sure?', function (result) {
                            // callback
                        });
                        event.preventDefault();
                    });*/
                    //$('#cargaajax').load('<?php echo $this->Html->url(array('controller' => 'Trabajos', 'action' => 'prueba')); ?>');
        </script>
        <!-- Plugins and page level script : optional -->
        <!--/ Plugins and page level script : optional -->
        <!--/ END JAVASCRIPT SECTION -->
    </body>
    <!--/ END Body -->
</html>