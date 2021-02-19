    
            <div class="row">
                
                
                    <div class="col-md-12 " style="width: 100%; margin-bottom:10px;">
                    <div class=" card w-100" >
                        <div class="card-header text-dark">
                            <h4>Search Agents</h4>
                            
                        </div>
                        <div class="card-body">
                            <form class="form-material" method="post" action="<?php echo BASE_URL;?>agents/list" enctype="multipart/form-data">
                                <div class="row clearfix">
                            
                            <div class="col-sm-12 col-lg-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="names" class="form-control"  autocomplete="off" value="<?php echo (!empty($search['names']))? $search['names']:''; ?>" >
                                            <label class="form-label">Agent Name</label>
                                        </div>
                                    </div>
                            </div>
                           
                            <div class="col-sm-12 col-lg-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="agentNo" class="form-control"  autocomplete="off" value="<?php echo (!empty($search['agentNo']))? $search['agentNo']:''; ?>" >
                                            <label class="form-label">Agent Number</label>
                                        </div>
                                    </div>
                            </div>
                      
                            <div class="col-sm-12 col-lg-3">
                                <input type="submit" class="btn btn-success" value="Search Now"></input>
                            </div>
                            
                            </form>
                             </div>
                        </div>
                    </div>
                </div>
                
                   
                   
                <div class="col-md-12">
                    <div class="card no-b shadow">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover ">
                                    <tbody>
                                    <?php 

                                    const  EDIT_AGENT_LINK = BASE_URL."agents/edit/";

                                    foreach($agents as $agent):

                                     $balance=Modules::run("agents/getAgentBalance",$agent->agentNo);
                                        ?>
                                    <tr class="">
                                        <td class="w-10">
                                            <img class="avatar avatar-lg" src="<?php echo IMG_URL; ?>people/<?php echo $agent->photo; ?>" alt="" width="50px">
                                        </td>
                                        <td>
                                            <h6><?php echo $agent->names; ?></h6>
                                            <small class="text-dark"><?php echo $agent->agentNo; ?></small>
                                        </td>
                                        <td>
                                            <h6>Location: <?php echo $agent->location; ?></h6>
                                            <small class="text-muted">Contact: <?php echo $agent->phoneNumber; ?> </small>
                                        </td>
                                       
                                       <td>
                                            <h6 class="text-dark">BALANCE: UGX 
                                                <?php echo ($balance)? number_format($balance): 0; ?>
                                                    
                                                </h6>
                                            <small class="text-muted">
                                                <?php 

                                                echo date('d, F Y h:i:s',strtotime($agent->lastActivity)); ?>
                                                    
                                                </small>
                                        </td>

                                        <td>
                                            <?php if($agent->status==1): ?>
                                            <span class="badge badge-success text-white text-caps">
                                                Active
                                            </span>
                                            <?php endif; ?>

                                            <?php  if($agent->status==0): ?>
                                            <span class="badge badge-danger text-white text-caps">
                                                Inactive
                                            </span>
                                            <?php endif; ?>
                                        </td>
                              
                                        <td class="text-center">
                                <i class="icon-menu text-dark" data-toggle="dropdown"></i>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo EDIT_AGENT_LINK; ?>/<?php echo $agent->id; ?>" class="dropdown-item">
                                        <i class="icon-pencil"></i><?php echo $this->lang->line('edit'); ?></a>

                                        <a href="<?php echo BASE_URL; ?>agents/reset/<?php echo $agent->agentNo; ?>" class="dropdown-item">
                                        <i class="icon-lock"></i><?php echo $this->lang->line('reset_password'); ?></a>

                                        <a href="<?php echo BASE_URL; ?>agents/reset/<?php echo $agent->agentNo; ?>" class="dropdown-item">

                                        
                                  </div>

                            </td>
                                    </tr>
                                  <?php endforeach;  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <?php echo $links ; ?>
            
            
                            
                                <br>
                                <br>
      