            <div class="card  card-body" >
                    
                            <form class="form-material" method="post" action="<?php echo BASE_URL;?>agents/saveAgent" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label class="form-label">Agent Number.</label>
                                                    <input type="text" name="agentNo" class="form-control" value="<?=$agentNo?>" autocomplete="off">
                                            </div>

                                            <div class="form-group">

                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="first_name" class="form-control" required autocomplete="off">
                                            </div>
                                            <div class="form-group">

                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control" required autocomplete="off">
                                            </div>

                                           <div class="form-group ">
                                                <label class="form-label">National ID No.</label>
                                                    <input type="text" name="nin" class="form-control" autocomplete="off">
                                                
                                            </div>
                                            <div class="form-group ">
                                                <label class="form-label">National ID No.</label>
                                                    <input type="text" name="nin" class="form-control" autocomplete="off">
                                                
                                            </div>

                                              <div class="form-group ">

                                                    <label class="form-label">User Code</label>
                                                    <input type="text" name="user_code" class="form-control" autocomplete="off">
                                            </div>

                                            <div class="form-group ">

                                                    <label class="form-label">PIN</label>
                                                    <input type="text" name="pin" class="form-control" autocomplete="off">
                                            </div>

                                            <div class="form-group ">

                                                    <label class="form-label">Float limit</label>
                                                    <input type="text" name="float_limit" class="form-control" autocomplete="off">
                                            </div>


                                    </div>

                                    <div class="col-sm-6">
                                   
                                            
                                           <div class="form-group ">

                                                    <label class="form-label">Address</label>
                                                    <input type="text" name="location" class="form-control"  required autocomplete="off">
                                            </div>

                                           <div class="form-group ">

                                                    <label class="form-label">Email</label>
                                                    <input type="text" name="email" class="form-control"  autocomplete="off">
                                            </div>

                                             <div class="form-group ">

                                                    <label class="form-label" required>Phone</label>
                                                    <input type="text" name="phoneNumber" class="form-control"  autocomplete="off">
                                            </div>

                                    
                                         <div class="form-group ">
                                              <label class="form-label" >Referral Agent :</label>
                                                    <input type="text" name="refferalAgent" class="form-control"  autocomplete="off"  >
                                                  
                                            </div>


                                             <div class="form-group">
                                                <label><i class="icon icon-attach_file"></i> KYC Attachment: 
                                                </label>
                                                    <input  type="file" name="kyc" id="kyc">
                                                    <br>
                                            </div>

                                            

                                              <div class="form-group">
                                                <label class="form-label" style="display:block; text-align: center;">Passport Photo</label>
                                                
                                                <center>
                                                   <img onclick="$('#photo').click()" src="<?php echo IMG_URL; ?>image.png" class="img img-thumbnail preview" width="200px;">

                                                    <input style="display: none;" type="file" name="photo" id="photo">
                                                </center>

                                                    <br>
                                            </div>


                                            <div class="form-group">
                                                
                                                <input type="submit" class="btn btn-success pull-right col-md-12" name="" value="SAVE AGENT">
                                            </div>

                                          

                                        </div>

                                    </div>

                            </form>
                    </div>
        