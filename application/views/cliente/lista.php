<!DOCTYPE html>

<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <?php $this->load->view('plantilla/head') ?>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content ">
    <!-- BEGIN HEADER -->
    <div class="page-header -i navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <?php echo $barra; ?>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">


        <?php echo $menu; ?>


        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">

                <!-- END PAGE HEADER-->
                <h3 class="page-title">
                    Clientes 
                </h3>
                <!-- BEGIN PAGE CONTENT-->


                <div class="row">

                    <div class="col-md-12">

                        <div class="row search-form-default">
                            <div class="col-md-12">
                                <form action="<?php echo site_url('') ?>cliente/index">
                                    <div class="input-group">
                                        <div class="input-cont">
                                            <div class="col-md-12">
                                                <input type="text" name="buscar" class="form-control" placeholder="Buscar .." maxlength="45">
                                            </div>

                                        </div>

                                        <span class="input-group-btn">

                                            <button type="submit" class="btn green-haze">
                                                Buscar &nbsp; <i class="m-icon-swapright m-icon-white"></i>
                                            </button>
                                        </span>

                                    </div>
                                </form>
                            </br>
                        </div>
                    </div>



                    <div class="tabbable-line boxless tabbable-reversed">

                        <div class="tab-content">


                            <div class="tab-pane active" id="tab_1">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa fa-child"></i> Clientes
                                        </div>



                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-scrollable">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Género</th>
                                                        <th>Cumpleaños</th>
                                                        <th>Télefono</th>
                                                        <th>Email</th>
                                                        <th>Objetivo</th>
                                                        <th>Registro</th>
                                                        <th>Acciones</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                   <?php
                                                   if (isset($registros)) {
                                                    foreach ($registros->result() as $rowx) {
                                                        ?>


                                                        <tr>
                                                            <td><?php echo $rowx->nombre; ?></td>
                                                            <td><?php echo $rowx->genero; ?></td>
                                                            <td><?php echo $rowx->fecha_nacimento; ?></td>
                                                            <td><?php echo $rowx->telefono; ?> / <?php echo $rowx->movil; ?></td>
                                                            <td><?php echo $rowx->email; ?></td>
                                                            <td><?php echo $rowx->objetivo_principal; ?></td>
                                                            <td><?php echo $rowx->registro; ?></td>

                                                            <td>

                                                                <a href="<?php echo site_url('') ?>pdfclientenline/generar?idCliente=<?php echo $rowx->idCliente; ?>" title="Ver Captura" target="_blank" class="btn input-circle btn-sm yellow-crusta">
                                                                    <i class="fa fa-file"></i>
                                                                </a>
                                                                 <a href="<?php echo site_url('') ?>cliente/citas?idcliente=<?php echo $rowx->idCliente; ?>" title="Ver Citas" class="btn input-circle btn-sm yellow-crusta">
                                                                   Consultas
                                                                </a>


                                                            </td>
                                                        </tr>



                                                        <?php
                                                    }
                                                }
                                                ?>  







                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                                <div class="pull-right" >

                                    <?php echo $pagination; ?>

                                </div>
                            </div>
                           


                        </div>

                       





                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2016 &copy; HelpMex.com.mx
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>

<!-- END JAVASCRIPTS -->
<?php $this->load->view('plantilla/script') ?>

<script>
    jQuery(document).ready(function() {
                // initiate layout and plugins

                Layout.init(); // init current layout
                QuickSidebar.init(); // init quick sidebar
                Metronic.init(); // init metronic core components
                Demo.init(); // init demo features
               // UIExtendedModals.init();

           });
       </script>





   </body>
   <!-- END BODY -->
   </html>