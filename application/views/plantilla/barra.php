 <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
        <a href="<?php echo site_url('') ?>cliente">
            <img src="<?php echo site_url('') ?>metronic/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
        </a>
        <div class="menu-toggler sidebar-toggler">
            <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
        </div>
    </div>

    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    </a>

    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">

         <li class="dropdown dropdown-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="" class="img-circle" src="<?php echo site_url('') ?>metronic/admin/layout/img/avatar3_small.jpg"/>
                <span class="username username-hide-on-mobile">
                    <?php echo $usuario; ?> </span>

                    <i class="fa fa-user"></i>
                </a>


            </li>
            <li class="dropdown dropdown-quick-sidebar-toggler">
                <a href="<?php echo site_url('') ?>cliente/salir" class="dropdown-toggle">
                    <i class="icon-logout"></i>
                </a>
            </li>

            
            <!-- END QUICK SIDEBAR TOGGLER -->
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
</div>