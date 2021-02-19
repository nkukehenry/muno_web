		<?php 
			$data = $this->Borrower_model->chk_borrower_exist(array('id' => $_GET['id']));
		?>
		<div class="card card-body">
	        	<?php if ($data): ?>
	        	<form action="" method="post">
	        		<div class="row">
	        		<div class="col-md-6">
	        		<fieldset>
		        		<legend>Personal Info</legend>
		        		
			        			<div class="form-group">
			        				<label>* First Name:</label>
			        				<input class="form-control" type="text" name="fname" value="<?php echo $data->fname; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>* Last Name:</label>
			        				<input class="form-control" type="text" name="lname" value="<?php echo $data->lname; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>* Middle Name:</label>
			        				<input class="form-control" type="text" name="mi" value="<?php echo $data->mi; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>* Age:</label>
			        				<input class="form-control" type="text" name="age" value="<?php echo $data->age; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>* Date of Birth:</label>
			        				<input class="form-control" type="date" name="birth_date" value="<?php echo $data->birth_date; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>Civil Status:</label>
			        				<input class="form-control" type="text" name="civil_status" value="<?php echo $data->civil_status; ?>" />
			        			</div>
	        		</fieldset>
	        	 </div>
	        	 <div class="col-md-6">
	        		<fieldset>
		        		<legend>Contact Info</legend>
			        			<div class="form-group">
			        				<label>* Address:</label>
			        				<textarea class="form-control"  rows="4" cols="50" name="address"><?php echo $data->address; ?></textarea>
			        			</div>
			        			<div class="form-group">
			        				<label>* Phone / Cellphone:</label>
			        				<input class="form-control" type="text" name="phone_cell" value="<?php echo $data->phone_cell; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>Email:</label>
			        				<input class="form-control" type="text" name="email" value="<?php echo $data->email; ?>" />
			        			</div>
		        	</fieldset>
		        </div>
		       </div>
		       <br>
		       <div class="row">
		        <div class="col-md-6">
	        		<div class="col-md-12">
	        		<fieldset>
		        		<legend>Current Employment Info</legend>
			        			<div class="form-group">
			        				<label>* Employment Status:</label>
			        				<input class="form-control" type="text" name="employment_status" value="<?php echo $data->employment_status; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>Company:</label>
			        				<input class="form-control" type="text" name="company" value="<?php echo $data->company; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>Job Title:</label>
			        				<input class="form-control" type="text" name="job_title" value="<?php echo $data->job_title; ?>" />
			        			</div>
			        			<div class="form-group">
			        				<label>Monthly Income:</label>
			        				<input class="form-control" type="text" name="income" value="<?php echo $data->income; ?>" />
			        			</div>
			        			<div class="form-group">
			        				
			        				<input class="btn btn-dark" type="submit" name="submit_borrower" value="<?=$this->lang->line('save_changes')?>" />
			        			</div>
			        			<?php if (validation_errors()) : ?>
								<div class="form-group">
									
										<?php echo validation_errors(); ?>
									
								</div>
								<?php endif;?>
								<?php if (isset($error)) : ?>
								<div class="form-group">
									
										<?php echo $error; ?>
									
								</div>
								<?php endif;?>
	        		<input class="form-control" type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
	        		</fieldset>
	        	</div>
	        </div>
	        	</form>
	        	<?php else: ?>
	        	<br>Sorry, borrower doesn't exist.<br><br>
	        	<?php endif; ?>
	        </div>
		