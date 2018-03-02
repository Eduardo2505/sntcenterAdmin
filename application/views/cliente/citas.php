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
                    Citas 
                </h3>
                <!-- BEGIN PAGE CONTENT-->


                <div class="row">

                    <div class="col-md-12">

                        <div class="row search-form-default">
                            <div class="col-md-12">
                                <form action="<?php echo site_url('') ?>cliente/insertarcitas">
                                    <input type="hidden" name="idPlancontrolado" value="<?php echo $idPlancontrolado ?>">
                                    <input type="hidden" name="idCliente" value="<?php echo $idCliente ?>">


                                    <span class="input-group-btn">

                                        <button type="submit" class="btn green-haze">
                                            FINALIZAR CONSULTA &nbsp; <i class="m-icon-swapright m-icon-white"></i>
                                        </button>
                                    </span>

                                </div>
                            </form>
                        </br>
                    </div>
                </div>

                <br><bR>

                <div class="tabbable-line boxless tabbable-reversed">

                    <div class="tab-content">


                        <div class="tab-pane active" id="tab_1">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa fa-child"></i> Citas
                                    </div>



                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Consultas</th>
                                                    <th>Registro</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>


                                                </tr>
                                            </thead>
                                            <tbody>


                                             <?php
                                             if (isset($registros)) {
                                               
                                                foreach ($registros->result() as $rowx) {
                                                    $est=$rowx->estatus;

                                                    $estatus="";
                                                    if($est==1){
                                                        $estatus="Activa";
                                                    }
                                                    if($est==0){
                                                        $estatus="Cancelada";
                                                    }
                                                    ?>



                                                    <tr>
                                                        <td><?php echo $rowx->idconsulta ?></td>
                                                        <td><?php echo $rowx->registro; ?></td>

                                                        <td><?php echo $estatus; ?></td>


                                                        <td>

                                                            <a href="<?php echo site_url('') ?>cliente/cancelar?idconsulta=<?php echo $rowx->idconsulta; ?>&idCliente=<?php echo $idCliente?>" title="Ver Captura" class="btn input-circle btn-sm btn btn-danger">
                                                                Cancelar
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