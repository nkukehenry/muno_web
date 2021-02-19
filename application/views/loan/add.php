		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="leftcontentBody">
				
	        </div>
	        <div class="rightcontentBody">

	        	<form action="" method="post">
	        		<div class="col-md-6">
	        		<div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span> Loan Product Name:
                               </label>
                            <input type="text" class="form-control" name="lname" value="<?php echo set_value('lname'); ?>" placeholder="Loan Product">
                    </div>

                    <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span>Interest rate (%):
                               </label>
                            <input type="number" class="form-control" name="interest" value="<?php echo set_value('interest'); ?>"  placeholder="Loan Product">
                    </div>

                    <div class="form-group">
                               <label class="">
                               	<span class="text-danger">*</span>Payment Frequency:
                               </label>
                           <select name="frequency" class="form-control">
	        						<option value=""></option>
	        						<option value="Monthly">Monthly</option>
	        						<option value="2 Weeks">2 Weeks</option>
	        						<option value="Weekly">Weekly</option>
	        					</select>
                    </div>

                    <div class="form-group">
						<input type="submit" class="btn btn-primary btn-sm" name="submit_loan" value="Save Loan Product" />
					</div>

					</div>
					<div class="col-md-6">
						<span class="text-danger">
	        			<?php 

	        			  if (validation_errors()) : ?>
								<?php echo validation_errors(); 
							endif;
						 if (isset($error)) : 
						
								echo $error; 
						endif;
						?>
						</span>

					</div>
	        	</form>
	        </div>
	        <div class="clearFix"></div>
		</div>