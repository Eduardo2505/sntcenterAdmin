<div class="page-sidebar-wrapper">

  <div class="page-sidebar navbar-collapse collapse">

    <ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
      <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
      <li class="sidebar-search-wrapper">

        <form class="sidebar-search sidebar-search-bordered" action="#" method="POST">
          <a href="javascript:;" class="remove">
            <i class="icon-close"></i>
          </a>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar...">
            <span class="input-group-btn">
              <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
            </span>
          </div>
        </form>
        <!-- END RESPONSIVE QUICK SEARCH FORM -->
      </li>

      

      <li  class="<?php  if(!empty($cliente)) {echo $cliente; }?>">

        <a href="<?php echo site_url('') ?>cliente">
          <i class="fa fa fa-child"></i>
          <span class="title">Clientes</span>
          <span class="selected"></span>

        </a>

      </li>



    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>