	
	        	<form action="" method="post" enctype="multipart-formdata">

	        		<div class="row">

                      <div class="col-sm-6">

                      	<h4 class="sub-title">Personal Info</h4>

                           <div class="form-group">
                               <label class=""><span class="text-danger">*</span> First Name:</label>
                            <input type="text" class="form-control" name="fname" value="<?php echo set_value('fname'); ?>" placeholder="First Name">
                           </div>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Last Name:
                               </label>
                            <input type="text" class="form-control" name="lname" value="<?php echo set_value('lname'); ?>" placeholder="Last Name">
                           </div>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Middle Name:
                               </label>
                            <input type="text" class="form-control" name="mi" value="<?php echo set_value('mi'); ?>" placeholder="Middle Name">
                           </div>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Age:
                               </label>
                            <input type="text" class="form-control" name="age" value="<?php echo set_value('age'); ?>" placeholder="Age">
                           </div>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Date of Birth:
                               </label>
                            <input type="text" class="form-control datepicker" name="birth_date" value="<?php echo set_value('birth_date'); ?>" placeholder="Date of Birth">
                           </div>

                           <div class="form-group">
                               <label class="">
                               	Marital Status:
                               </label>
                            <select class="form-control" name="civil_status"  placeholder="Marrital Status">
                            	<option>Married</option>
                            	<option>Single</option>
                            	<option>Divorced</option>
                            	<option>Widowed</option>
                            </select> 
                           </div>

                        <br>

                      	<h4 class="sub-title">Contact Info</h4>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Address:
                               </label>
                            <textarea rows="4" placeholder="Address" cols="50" name="address"  class="form-control"><?php echo set_value('address'); ?></textarea>
                           </div>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Phone / Cellphone:
                               </label>
                            <input type="text" class="form-control" name="phone_cell" value="<?php echo set_value('phone_cell'); ?>" placeholder="Cellphone">
                           </div>

                           <div class="form-group">
                               <label class="">
                                Email:
                               </label>
                            <input type="text" class="form-control" name="mi" value="<?php echo set_value('mi'); ?>" placeholder="Email">
                           </div>

                        </div>


                        <div class="col-sm-6">
                      	<h4 class="sub-title">Employment Info</h4>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Employment Status:
                               </label>
                               <select class="form-control" name="employment_status">
                            	 <option>Employee</option>
                            	 <option>Self-Employed</option>
                            	 <option>Unemployed</option>
                            	 <option>FreeLancer</option>
                               </select>
                           </div>

                           <div class="form-group">
                               <label class=""> Company:
                               </label>
                            <input type="text" class="form-control"  name="company" value="<?php echo set_value('company'); ?>" placeholder="Company">
                           </div>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Job Title:
                               </label>
                            <input type="text" class="form-control" name="job_title" value="<?php echo set_value('job_title'); ?>" placeholder="Job Title">
                           </div>

                           <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Monthly Income:
                               </label>
                            <input type="text" class="form-control" name="income" value="<?php echo set_value('income'); ?>" placeholder="Monthly Income">
                           </div>


                           <b style="color: red;">
                        	 	<?php 
                        	 	if (validation_errors()) : 
                        	 	 echo validation_errors();
                        	 	endif;
								 if (isset($error)) :  
								 	echo $error; 
								 endif;?>
                        	 </b>
                        	 <br>
                        	 <div class="form-group">

                        	 	<input type="file" name="photo" id="photo" style="display: none;">

                        	 	<div class="col-sm-6">
                        	 		
                        	 			<img class="img img-thumbnail" src="<?php echo IMG_URL; ?>avatar.jpg" width="200px" onclick="$('#photo').click()">
                        	 		
                        	    </div>
                        	    <div class="col-sm-6">
                        	    	<center>
                        	    	 <p>Borrower Photo</p>
                        	    	 </center>
                        	    </div>
                        	</div>
                        	 <div class="form-group">
                           	<input style="margin-left: 50%;" type="submit" class="btn btn-primary pull-right" name="submit_borrower" value="SAVE BORROWER" />
                            </div>

                        </div>

                       </div>
	        	</form>
	       