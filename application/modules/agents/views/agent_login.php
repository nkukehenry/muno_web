            <div class="row padded col-md-12 " style="width: 100%;">
                    <div class=" card w-100" >
                        <div class="card-header text-dark">
                            <h4>Reset Agent Login</h4>
                        </div>
                        <div class="card-body">

                            <?php print_r($agent); ?>

                            <form class="form-material" method="post" action="<?php echo BASE_URL;?>agents/confirmReset" enctype="multipart/form-data">
                                <!-- Input -->
                                <div class="body">

                                    <input type="hidden" name="agentNo" value="<?=$agent->agentNo?>">
                                    
                                    <fieldset>
                                        <legend>USERCODE: <?=$agent->user_code;?></legend>

                                        <div class="form-group">
                                            <label>New PIN:</label>
                                            <input type="password" name="pin" class="form-control">
                                        </div>
                                    </fieldset>

                                </div>
                            </form>

                </div>
                </div>
            </div>
