 <div class="col-md-12">
  <div class="row">

   <?php 
   $userdata= @$this->user->user_data;

   foreach($rowOne as $item): ?>

          <div class="col-md-4">
            <div class="card card-body bounce">
              <div class="media mb-3">
                <div class="media-body">
                  <h6 class="mb-0 font-weight-semibold"><?php echo $item['title']; ?></h6>
                  <span class="text-muted"><?php echo $item['comment']; ?></span>
                </div>
                <div class="ml-3 align-self-center">
                  <i class="<?php echo $item['icon']; ?> icon-2x text-<?php echo $item['icon-class']; ?>" data-toggle="dropdown"></i>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-switch2"></i>Reports</a>
                  </div>
                </div>
              </div>
              <div>
                <div class="dropdown-divider"></div>
                  <span class="float-right text-large text-<?php echo $item['icon-class']; ?>"><?php echo $item['value']; ?></span>
                </div>
            </div>
            
          </div>

        <?php endforeach; ?>

        </div>

        <div class="row">

          <div class="col-md-4">

            <!-- Application status -->
            <div class="card">
              <div class="card-header header-elements-inline">
                <h6 class="card-title">Top Stats</h6>

              </div>

              <div class="card-body">
                    <ul class="list-unstyled mb-0">
                      <?php foreach ($statData as $row): ?>
                        <li class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                              <?php echo $row['title']; ?>
                              <span class="text-muted ml-auto"><?php echo $row['value']; ?></span></div>
                        <div class="progress" style="height: 0.375rem;">
                          <div class="progress-bar bg-teal" style="width: 50%">
                           <span class="sr-only"><?php echo $row['value']; ?></span>
                          </div>
                        </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
              </div>
            </div>
            <!-- /application status -->
            </div>

            <div class="col-md-4">

               <!-- Simple card with a list and button -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="#" class="text-default">
                    <i class="icon-statistics mr-2"></i>
                    Staff Notes
                  </a>
                </h5>

                <ul class="list list-unstyled mb-0">
                  <?php foreach ($insights as $message): ?>
                  <li>
                    <i class="icon-checkmark-circle text-success mr-2"></i>
                     <?php echo $message->message; ?>
                  </li>
                <?php endforeach; ?>
                 
                </ul>
              </div>

              <div class="card-footer text-center">
                <a href="#" class="btn bg-pink-400">
                  <i class="icon-bubbles8 mr-2"></i>
                  <?=$this->lang->line('view_all')?>
                </a>
              </div>
            </div>
            <!-- /simple card with a list and button -->
              
            </div>

            <div class="col-md-4">

               <!-- Tabs widget -->
            <div class="card">
              <ul class="nav nav-tabs nav-tabs-bottom nav-justified mb-0">
                <li class="nav-item"><a href="#tab-desc" class="nav-link active" data-toggle="tab">Overview</a></li>
                <li class="nav-item"><a href="#tab-spec" class="nav-link" data-toggle="tab">Updates</a></li>
                <li class="nav-item"><a href="#tab-shipping" class="nav-link" data-toggle="tab">Alerts</a></li>
              </ul>

              <div class="tab-content card-body border-top-0 rounded-top-0 mb-0">
                <div class="tab-pane fade show active" id="tab-desc">
                  

                    <div class="row text-center">
                      <?php foreach ($numberData as $row): ?>
                      <div class="col-4 mt-2">
                        <p><i class="<?php echo $row['icon']; ?> icon-2x d-inline-block text-<?php echo $row['icon-class']; ?>"></i></p>
                        <small class="font-weight-semibold mb-0"><?php echo $row['value']; ?></small>
                        <br>
                        <span class="text-muted font-size-sm"><?php echo $row['key']; ?></span>
                      </div>
                    <?php endforeach; ?>

                      
                    </div>

                </div>

                <div class="tab-pane fade" id="tab-spec">
                  <p><?php echo $alerts[0]; ?></p>
                </div>

                <div class="tab-pane fade" id="tab-shipping">
                  <p><?php echo $alerts[1]; ?></p>
                </div>
              </div>
            </div>
            <!-- /tabs widget -->

              
            </div>

          
        </div>



         


          

