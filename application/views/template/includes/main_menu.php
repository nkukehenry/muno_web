

    <!-- Menu aside start -->
    <div class="main-menu">
        <div class="main-menu-header">
            <img class="img-40" src="<?php echo IMG_URL; ?>user.png" alt="User-Profile-Image">
            <div class="user-details">
                <span>John Doe</span>
                <span id="more-details">UX Designer<i class="icon-arrow-down"></i></span>
            </div>
        </div>
        <div class="main-menu-content" style="max-height: 80px!important;">
           <!-- <ul class="main-navigation">
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item has-class">
                    <a href="#!">
                        <i class="ti-layout"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="tree-1">
                      
                        <li><a href="box-layout.html" target="_blank">Box Layout</a>
                            <label class="label label-warning menu-caption">NEW</label>
                        </li>
                       
                    </ul>
                    </li>
            </ul>-->

            <?php $this->menu->generate(); ?>
            
        </div>
    </div>
    <!-- Menu aside end -->