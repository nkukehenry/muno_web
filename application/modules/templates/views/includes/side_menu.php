<?php 
   if(empty($this->user->user_data))
     redirect('auth');
   ?>
  <!-- Page content -->
  <div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-light sidebar-main sidebar-fixed sidebar-expand-md">

      <!-- Sidebar mobile toggler -->
      <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
          <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
          <i class="icon-screen-full"></i>
          <i class="icon-screen-normal"></i>
        </a>
      </div>
      <!-- /sidebar mobile toggler -->


      <!-- Sidebar content -->
      <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
          <div class="sidebar-user-material-body">
            <div class="card-body text-center">
              <a href="#">
                <img src="<?php echo BASE_URL; ?>assets/images/image.png" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
              </a>
              <!-- <h6 class="mb-0 text-white text-shadow-dark">Victoria Baker</h6>
              <span class="font-size-sm text-white text-shadow-dark">Santa Ana, CA</span> -->
            </div>
                          
            <div class="sidebar-user-material-footer">
              <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse">
                <span><?php echo $userdata->name?></span></a>
            </div>
          </div>

          <div class="collapse" id="user-nav">
            <ul class="nav nav-sidebar">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="icon-user-plus"></i>
                  <span>My profile</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="icon-cog5"></i>
                  <span><?php echo $this->lang->line('account_settings'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>auth/logout" class="nav-link">
                  <i class="icon-switch2"></i>
                  <span><?php echo $this->lang->line('logout'); ?></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
          <ul class="nav nav-sidebar" data-nav-type="accordion">

            <!-- Main -->
            <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>dashboard" class="nav-link">
                <i class="icon-home4"></i>
                <span>Dashboard</span>
              </a>
            </li>

            <?php if($this->user->has_permission('add_borrowers')): ?>
            <li class="nav-item nav-item-submenu">
              <a href="#" class="nav-link"><i class="icon-users2"></i> 
                <span><?php echo $this->lang->line('borrowers');?></span></a>

              <ul class="nav nav-group-sub" data-submenu-title="<?php echo $this->lang->line('borrowers');?>">

                <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>borrower/applications" class="nav-link">
                    <i class="icon-collaboration"></i>
                     <?php echo $this->lang->line('applications');?>
                  </a></li>
                <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>borrower/add" class="nav-link">
                    <i class="icon-user-plus"></i>
                     <?php echo $this->lang->line('add_borrower');?>
                  </a></li>
                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>borrower" class="nav-link">
                    <i class="icon-users4"></i>
                     <?php echo $this->lang->line('view_borrowers');?>
                  </a></li>
                  <?php /*
                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>borrower" class="nav-link">
                    <i class="icon-collaboration"></i>
                     <?php echo $this->lang->line('borrower_groups');?>
                  </a></li>*/ ?>
              </ul>
            </li>
            <?php endif; ?>

            <?php if($this->user->has_permission('create_products')): ?>
            <li class="nav-item nav-item-submenu">
              <a href="#" class="nav-link"><i class="icon-cash4"></i> 
                <span><?php echo $this->lang->line('loan_products');?></span></a>

              <ul class="nav nav-group-sub" data-submenu-title="<?php echo $this->lang->line('loan_products');?>">
                <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>loan/addProduct" class="nav-link">
                    <i class="icon-add-to-list"></i>
                     <?php echo $this->lang->line('add_loan_prods');?>
                  </a></li>
                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>loan/loanProducts" class="nav-link">
                    <i class="icon-stack-empty"></i>
                     <?php echo $this->lang->line('view_loan_prods');?>
                  </a></li>
              </ul>
            </li>
          <?php endif; ?>

           <?php if($this->user->has_permission('view_reports')): ?>
            <li class="nav-item nav-item-submenu">
              <a href="#" class="nav-link"><i class="icon-file-presentation"></i> 
                <span><?php echo $this->lang->line('reports');?></span></a>

              <ul class="nav nav-group-sub" data-submenu-title="<?php echo $this->lang->line('reports');?>">

                 <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>report/requests" class="nav-link">
                    <i class="icon-stack-empty"></i>
                     <?php echo $this->lang->line('loan_request');?>
                  </a>
                 </li>

                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>report" class="nav-link">
                    <i class="icon-add-to-list"></i>
                     <?php echo $this->lang->line('repayments');?>
                  </a>
                 </li>
                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>report" class="nav-link">
                    <i class="icon-add-to-list"></i>
                     <?php echo $this->lang->line('loan_summary');?>
                  </a>
                 </li>
                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>report/outStanding" class="nav-link">
                    <i class="icon-stack-empty"></i>
                     <?php echo $this->lang->line('outstanding');?>
                  </a>
                 </li>
              </ul>
            </li>
          <?php endif; ?>

         <?php if($this->user->has_permission('manage_agents')): ?>
             <li class="nav-item nav-item-submenu">
              <a href="#" class="nav-link"><i class="icon-location4"></i> 
                <span><?php echo $this->lang->line('agents');?></span></a>

              <ul class="nav nav-group-sub" data-submenu-title="<?php echo $this->lang->line('agents');?>">
                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>agents/add" class="nav-link">
                    <i class="icon-user-plus"></i>
                     <?php echo $this->lang->line('add_agent');?>
                  </a>
                 </li>
                  <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>agents" class="nav-link">
                    <i class="icon-vcard"></i>
                     <?php echo $this->lang->line('agent_list');?>
                  </a>
                 </li>
              </ul>
            </li>
            <?php endif; ?>

            <?php if($this->user->has_permission('manage_user_accounts')): ?>
            <li class="nav-item nav-item-submenu">
              <a href="#" class="nav-link"><i class="icon-cog"></i> 
                <span><?php echo $this->lang->line('management');?></span></a>

              <ul class="nav nav-group-sub" data-submenu-title="<?php echo $this->lang->line('management');?>">
                  <!-- <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="icon-list"></i>
                     <?php echo $this->lang->line('user_roles');?>
                  </a>
                 </li> -->
                  <li class="nav-item">
                  <a href="<?=BASE_URL?>auth/users" class="nav-link">
                    <i class="icon-user"></i>
                     <?php echo $this->lang->line('users');?>
                  </a>
                 </li>
                 
              </ul>
            </li>
            <?php endif; ?>
            <!-- /main -->

          </ul>
        </div>
        <!-- /main navigation -->

      </div>
      <!-- /sidebar content -->
      
    </div>
    <!-- /main sidebar -->
