 <body class="navbar-top">

  <!-- Main navbar -->
  <div class="navbar navbar-expand-md navbar-dark bg-dark navbar-static fixed-top">
    <div class="navbar-brand">
      <a href="" class="d-inline-block">
        <img src="<?php echo BASE_URL; ?>assets/images/logo_light.png" alt="">
      </a>
    </div>

    <div class="d-md-none">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
        <i class="icon-tree5"></i>
      </button>
      <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
        <i class="icon-paragraph-justify3"></i>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
            <i class="icon-paragraph-justify3"></i>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
      

        <li class="nav-item dropdown dropdown-user">
          <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo BASE_URL; ?>assets/images/image.png" class="rounded-circle mr-2" height="34" alt="">
            <span><?php echo $userdata->name?></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right">
            <?php /*
            <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
            <a href="#" class="dropdown-item"><i class="icon-coins"></i> 
              <?php echo $this->lang->line('my_disbursements'); ?></a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a> */?>
            <a href="<?php echo BASE_URL; ?>auth/logout" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <!-- /main navbar -->