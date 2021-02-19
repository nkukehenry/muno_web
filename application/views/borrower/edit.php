		<?php 
			$data = $this->Borrower_model->chk_borrower_exist(array('id' => $_GET['id']));
		?>
		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="leftcontentBody">
				
	        </div>
	        <div class="rightcontentBody">
	        	<?php if ($data): ?>
	        	<div class="manage_menu"><a href="<?php echo base_url();?>borrower/view/?id=<?php echo $_GET['id']; ?>" class="button_back">Back</a></div>
	        	<div class="clearFix"></div>
	        	<form action="" method="post">
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Personal Info</span></div>
		        		<div class="frm_inputs">
			        		<table class="form_tbl">
			        			<tr>
			        				<td>* First Name:</td>
			        				<td><input type="text" name="fname" value="<?php echo $data->fname; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Last Name:</td>
			        				<td><input type="text" name="lname" value="<?php echo $data->lname; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Middle Name:</td>
			        				<td><input type="text" name="mi" value="<?php echo $data->mi; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Age:</td>
			        				<td><input type="text" name="age" value="<?php echo $data->age; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>* Date of Birth:</td>
			        				<td><input type="text" name="birth_date" value="<?php echo $data->birth_date; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Civil Status:</td>
			        				<td><input type="text" name="civil_status" value="<?php echo $data->civil_status; ?>" /></td>
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
			        				<td><textarea rows="4" cols="50" name="address"><?php echo $data->address; ?></textarea></td>
			        			</tr>
			        			<tr>
			        				<td>* Phone / Cellphone:</td>
			        				<td><input type="text" name="phone_cell" value="<?php echo $data->phone_cell; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Email:</td>
			        				<td><input type="text" name="email" value="<?php echo $data->email; ?>" /></td>
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
			        				<td><input type="text" name="employment_status" value="<?php echo $data->employment_status; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Company:</td>
			        				<td><input type="text" name="company" value="<?php echo $data->company; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Job Title:</td>
			        				<td><input type="text" name="job_title" value="<?php echo $data->job_title; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Monthly Income:</td>
			        				<td><input type="text" name="income" value="<?php echo $data->income; ?>" /></td>
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
	        		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
	        	</form>
	        	<?php else: ?>
	        	<br>Sorry, borrower doesn't exist.<br><br>
	        	<?php endif; ?>
	        </div>
	        <div class="clearFix"></div>
		</div>