<!DOCTYPE html>

<html lang="es">

    <head>
        <meta charset="utf-8"/>
        <title>SNT</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('') ?>metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('') ?>metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('') ?>metronic/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo site_url('') ?>metronic/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo site_url('') ?>metronic/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('') ?>metronic/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('') ?>metronic/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url('') ?>metronic/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo site_url('') ?>metronic/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="<?php echo site_url('') ?>favicon.png"/>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="login">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler sidebar-toggler">
        </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo site_url('') ?>">
                <img src="<?php echo site_url('') ?>metronic/admin/layout/img/logo-big.png" alt=""/>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" id="enviarbtn" action="<?php echo site_url('') ?>welcome/login" method="POST">
                <h3 class="form-title">LOGIN</h3>

                <?php if ((strcmp($cadena, "error") == 0)) { ?>
                    <div class="alert alert-danger">

                        <span>
                            Usuario no registrado. </span>
                    </div>

<?php } ?>



                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

                    <input class="form-control form-control-solid placeholder-no-fix"  type="email" autocomplete="off" placeholder="Correo eléctronico" name="email" required="" />
                </div>
                <div class="form-group">

                    <input class="form-control form-control-solid placeholder-no-fix"  type="password" autocomplete="off" placeholder="Password" name="pass" required=""/>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success uppercase">ENTRAR</button>
                    <label class="rememberme check">

                </div>


            </form>


        </div>
        <div class="copyright">
            2017 © apilink.com.mx
        </div>

        <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?php echo site_url('') ?>metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="<?php echo site_url('') ?>metronic/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->


        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>