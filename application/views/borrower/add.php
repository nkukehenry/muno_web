		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="leftcontentBody">
				
	        </div>
	        <div class="rightcontentBody">
	        	<form action="" method="post">
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Personal Info</span></div>
		        		<div class="frm_inputs">
			        		<table class="form_tbl">
			        			<tr>
			        				<td>* First Name:</td>
			        				<td><input type="text" name="fname" value="<?php echo set_value('fname'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Last Name:</td>
			        				<td><input type="text" name="lname" value="<?php echo set_value('lname'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Middle Name:</td>
			        				<td><input type="text" name="mi" value="<?php echo set_value('mi'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Age:</td>
			        				<td><input type="text" name="age" value="<?php echo set_value('age'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Date of Birth:</td>
			        				<td><input type="text" name="birth_date" value="<?php echo set_value('birth_date'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Civil Status:</td>
			        				<td><input type="text" name="civil_status" value="<?php echo set_value('civil_status'); ?>" /></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Contact Info</span></div>
		        		<div class="frm_inputs">
			        		<table class="form_tbl">
			        			<tr>
			        				<td>* Address:</td>
			        				<td><textarea rows="4" cols="50" name="address"><?php echo set_value('address'); ?></textarea></td>
			        			</tr>
			        			<tr>
			        				<td>* Phone / Cellphone:</td>
			        				<td><input type="text" name="phone_cell" value="<?php echo set_value('phone_cell'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Email:</td>
			        				<td><input type="text" name="email" value="<?php echo set_value('email'); ?>" /></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Current Employment Info</span></div>
		        		<div class="frm_inputs">
			        		<table class="form_tbl">
			        			<tr>
			        				<td>* Employment Status:</td>
			        				<td><input type="text" name="employment_status" value="<?php echo set_value('employment_status'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Company:</td>
			        				<td><input type="text" name="company" value="<?php echo set_value('company'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Job Title:</td>
			        				<td><input type="text" name="job_title" value="<?php echo set_value('job_title'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Monthly Income:</td>
			        				<td><input type="text" name="income" value="<?php echo set_value('income'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td></td>
			        				<td><input type="submit" name="submit_borrower" value="Submit" /></td>
			        			</tr>
			        			<?php if (validation_errors()) : ?>
								<tr>
									<td>
										
									</td>
									<td>
										<?php echo validation_errors(); ?>
									</td>
								</tr>
								<?php endif;?>
								<?php if (isset($error)) : ?>
								<tr>
									<td>
										
									</td>
									<td>
										<?php echo $error; ?>
									</td>
								</tr>
								<?php endif;?>
			        		</table>
		        		</div>
	        		</div>
	        	</form>
	        </div>
	        <div class="clearFix"></div>
		</div>