		<?php 
			$data = $this->Borrower_model->chk_borrower_exist(array('id' => $_GET['id']));


		?>
		
			
	        <div class="card card-body">
	        	<?php if ($data): ?>
	        	<div class="row">
	          <?php if(!$has_active_loan): ?>
	        	<div class="col-md-3">
	        	<a href="#newloan" data-toggle="modal" class="btn btn-dark">New Loan</a>
	            </div>
	          <?php endif; ?>
	            <div class="col-md-3">
	        	<a href="<?php echo base_url();?>borrower/edit/?id=<?php echo $_GET['id']; ?>" class="btn btn-info">Edit Borrower</a>
	            </div>
	            </div>
	        	
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
	        		<legend>Previous Loans</legend>
		        		<table class="table">
		        		<?php 
		        		$data_loan = $this->Borrower_model->get_borrower_loan($data->id);
		        		 ?>
		        		 <thead>
		        		 	<th>#</th>
		        		 	<th>Date</th>
		        		 	<th>Amount</th>
		        		 	<th>Interest</th>
		        		 	<th>Total</th>
		        		 	<th>Status</th>
		        		 </thead>
		        		<?php if ($data_loan): ?>
		        			<?php foreach ($data_loan->result() as $borrower_loan): ?>
		        			<tr>
		        				<td><?php echo anchor('loan/view_info/?id='.$borrower_loan->id, '#'.$borrower_loan->id);?></td>
		        				<td><?=$borrower_loan->loan_date?></td>
		        				<td><?=$this->config->item('currency_symbol').$borrower_loan->loan_amount?></td>
		        				<td><?=$this->config->item('currency_symbol').$borrower_loan->loan_amount_interest?></td>
		        				<td><?=$this->config->item('currency_symbol').$borrower_loan->loan_amount_total?></td>
		        				<td><?php 
		        					switch ($borrower_loan->status) {
		        						case 'CLOSED':
		        							echo "<span><strong style='color:green'>".$borrower_loan->status."</strong></span>";
		        							break;
		        						case 'ACTIVE':
		        							echo "<span style='color:RED'><strong>".$borrower_loan->status."</strong></span>";
		        							break;
		        						default:
		        							# code...
		        							break;
		        					}
		        					?>
		        				</td>
		        			</tr>
		        			<?php endforeach; ?>
		        		<?php else: ?>
		        			<tr>
		        				<td>No loans yet</td>
		        				<td></td>
		        			</tr>
		        		<?php endif; ?>
		        		</table>
	        		</fieldset>

        		<table class="table">
        			<?php if (validation_errors()) : ?>
        			<tr>
						<td>
							<div class="error"><strong>Loan Error:</strong></div>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo validation_errors(); ?>
						</td>
					</tr>
					<?php endif;?>
					<?php if (isset($error)) : ?>
					<tr>
						<td>
							<?php echo $error; ?>
						</td>
					</tr>
					<?php endif;?>
        		</table>
	        	<?php else: ?>
	        	<br>Sorry, borrower doesn't exist.<br><br>
	        	<?php endif; ?>

	        </div>
	        

		
		<!-- Dialog Box -->
			<?php 
				//get all loan type and display it on a dropdown
				$loans = $this->Loan_model->view_all();
				
				$temp_arr = array();
				$loan_types = array();
				foreach ($loans->result() as $loan)
				{
					$temp_arr = array($loan->id => $loan->lname);
					$loan_types = $loan_types + $temp_arr;
				}
			?>

		

			<div class="modal" id="newloan">
				<div class="modal-dialog" >
					<form action="" method="post">
					<div class="modal-content" >
						<div class="modal-header"><span>New Loan for <?php echo $data->fname.' '.$data->lname; ?></span></div>
						<div class="modal-body">

	        		<div class="card card-body">
	        			
		        		<table class="form_tbl">
		        			<tr>
		        				<td>Loan Amout:</td>
		        				<td><input type="text" name="loan_amount" value="<?php echo set_value('loan_amount'); ?>" /></td>
		        			</tr>
		        			<tr>
		        				<td>Months to Pay:</td>
		        				<td><input type="text" name="loan_months" value="<?php echo set_value('loan_months'); ?>" /></td>
		        			</tr>
		        			<tr>
		        				<td>Select Loan Product:</td>
		        				<td><?php echo form_dropdown('loan_id', $loan_types); ?></td>
		        			</tr>
		        			<tr>
		        				<td>Loan Start Date:</td>
		        				<td><input type="date" name="loan_date" class="datepicker" value="<?php echo set_value('loan_date'); ?>" /></td>
		        			</tr>
		        			<tr>
		        				<td></td>
		        				<td><input type="submit" name="submit_borrower" value="Submit" /></td>
		        			</tr>
		        		</table>
		        		<input type="hidden" name="borrower_id" value="<?php echo $_GET['id']; ?>" />
		        		
		        		<?php echo $has_active_loan? "<span class='error'>** Please note that this borrower still has an active loan.<span>" : "" ?>
	        		</div>

						</div>

					</div>
				</form>
				</div>
			</div>
	        		
        		
