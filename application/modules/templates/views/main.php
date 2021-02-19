<?php

 //Modules::run('auth/isLegal'); //check logged in
include('includes/css_files.php');
include('includes/header.php');
include('includes/side_menu.php');
$config= Modules::run("settings/getAll");
define('CURRENCY_SYMBOL',$config->currency_symbol);

?>

<!-- Main content -->
    <div class="content-wrapper">
      <!-- Page header -->
      <div class="page-header page-header-light">
     
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
          <div class="d-flex">
            <div class="breadcrumb">
              <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ::
               <?php echo $title; ?></a> 
             <!--  <a href="#" class="breadcrumb-item">Link</a>
              <span class="breadcrumb-item active">Current</span> -->
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>

         
        </div>
      </div>
      <!-- /page header -->


      <!-- Content area -->
      <div class="content">

        <?php if($this->session->flashdata('msg')): ?>
          <div class="alert">
             <p><?php echo $this->session->flashdata('msg'); ?></p>
          </div>
      <?php endif; ?>

        <?php

          $this->load->view($module.'/'.$view);

        ?>

          
      </div>
      <!-- /content area -->


      <!-- Footer -->
      <?php /*
      <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
          <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
          </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
          <span class="navbar-text">
            &copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
          </span>

          <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item">
              <a href="#" class="navbar-nav-link">Text link</a>
            </li>

            <li class="nav-item">
              <a href="#" class="navbar-nav-link">
                <i class="icon-lifebuoy"></i>
              </a>
            </li>

            <li class="nav-item">
              <a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold">
                <span class="text-pink-400">
                  <i class="icon-cart2 mr-2"></i>
                  Purchase
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- /footer -->

      <?php */ ?>

    </div>
    <!-- /main content -->

  </div>
  <!-- /page content -->
  <?php
    include('includes/footer.php');
  ?>
