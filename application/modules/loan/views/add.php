	
	        <div class="card card-body">

	        	<fieldset>
	        		<legend>
	        			<i class="icon-stack-empty"></i>
	        			<?=$this->lang->line('add_loan_prod')?>
	        		</legend>
	        	</fieldset>

	        	<form class ="row" action="" method="post">
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
                            <input type="number" class="form-control" name="interest" value="<?php echo set_value('interest'); ?>"  placeholder="<?=$this->lang->line('interest')?>">
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
						<div class="form-group">
                               <label class="">
                               	<span class="text-danger"></span><?=$this->lang->line('growth_amount')?>:
                               </label>
                            <input type="number" class="form-control" name="growth_amount" value="<?php echo set_value('growth_amount'); ?>"  placeholder="Growth Amount">
                       </div>

                       <div class="form-group">
                               <label class="">
                               	<span class="text-danger"></span><?=$this->lang->line('grace_on_expiry')?>:
                               </label>
                            <input type="number" class="form-control" name="grace_at_start" value="<?php echo set_value('grace_at_start'); ?>"  placeholder="<?=$this->lang->line('grace_on_expiry')?>">
                       </div>

                    <div class="form-group">
						<input type="submit" class="btn btn-primary btn-sm  pull-right" name="submit_loan" value="Save Loan Product" />
					</div>

					</div>
	        	</form>
	        </div>
	    