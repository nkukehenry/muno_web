	
	
	        <div class="card card-body">
	        	<?php if ($data): 
	        		if($data->status=="PENDING"): ?>
	        	<div class="row">
		            <div class="col-md-3 offset-9">
		        	   <form method="post" action="<?php echo base_url(); ?>borrower/approval">
			               <input type="hidden" name="id" value="<?php echo $data->id; ?>">
			                <button class="btn btn-primary" name="submit_borrower" type="submit">Approve Borrower <button>
		              </form>
		            </div>
	            </div>

	          <?php endif ?>
	        	
        		<fieldset>
	        		<legend><span>Personal Info</legend>
	        		<div class="frm_inputs">
		        		<table class="table col-md-6">
		        			<tr>
		        				<th>First Name:</th>
		        				<td><?php echo $data->fname; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Last Name:</th>
		        				<td><?php echo $data->lname; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Middle Name:</th>
		        				<td><?php echo $data->mi; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Age:</th>
		        				<td><?php echo $data->age; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Date of Birth:</th>
		        				<td><?php echo $data->birth_date; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Marital Status:</th>
		        				<td><?php echo $data->civil_status; ?></td>
		        			</tr>
		        		</table>
	        		</div>
	        		</fieldset>
	        		<fieldset>
	        		<legend><span>Contact Info</span></legend>
		        		<table class="table col-md-6">
		        			<tr>
		        				<th>Address:</th>
		        				<td><?php echo $data->address; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Phone / Cellphone:</th>
		        				<td><?php echo $data->phone_cell; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Email:</th>
		        				<td><?php echo $data->email; ?></td>
		        			</tr>
		        		</table>
	        		</fieldset>
        		<fieldset>
	        		<legend><span>Current Employment Info</legend>

		        		<table class="table col-md-6">
		        			<tr>
		        				<th>Employment Status:</th>
		        				<td><?php echo $data->employment_status; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Company:</th>
		        				<td><?php echo $data->company; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Job Title:</th>
		        				<td><?php echo $data->job_title; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Monthly Income:</th>
		        				<td><?php echo $this->config->item('currency_symbol') . $data->income; ?></td>
		        			</tr>
		        		</table>
	        	</fieldset>

	        	<fieldset>
	        		<legend><span>Created By</legend>

		        		<table class="table col-md-6">
		        			<tr>
		        				<th>Agent Name:</th>
		        				<td><?php echo $data->names; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Agent Account:</th>
		        				<td><?php echo $data->agentNo; ?></td>
		        			</tr>
		        			<tr>
		        				<th>Agent Contact:</th>
		        				<td><?php echo $data->phoneNumber; ?></td>
		        			</tr>
		        			
		        		</table>
	        	</fieldset>

        		<fieldset>

        		<?php endif; 

        		if($data->status=="PENDING"): ?>
	        	<div class="row">
		            <div class="col-md-3 offset-9">
		        	   <form method="post" action="<?php echo base_url(); ?>borrower/approval">
			               <input type="hidden" name="id" value="<?php echo $data->id; ?>">
			                <button class="btn btn-primary" name="submit_borrower" type="submit">Approve Borrower <button>
		              </form>
		            </div>
	            </div>

	          <?php endif ?>

			</div>
	        		
        		
