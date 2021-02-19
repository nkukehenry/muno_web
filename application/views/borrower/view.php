		<?php 
			$data = $this->Borrower_model->chk_borrower_exist(array('id' => $_GET['id']));


		?>
		<div class="clearFix"></div>
		<div class="contentBody">
			
	        <div class="rightcontentBody">
	        	<?php if ($data): ?>
	        	<div class="manage_menu"><span class="button_add">Loan</span><a href="<?php echo base_url();?>borrower/edit/?id=<?php echo $_GET['id']; ?>" class="button_edit">Edit</a></div>
	        	<div class="clearFix"></div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Personal Info</span></div>
	        		<div class="frm_inputs">
		        		<table class="info_view">
		        			<tr>
		        				<td>First Name:</td>
		        				<td><?php echo $data->fname; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Last Name:</td>
		        				<td><?php echo $data->lname; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Middle Name:</td>
		        				<td><?php echo $data->mi; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Age:</td>
		        				<td><?php echo $data->age; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Date of Birth:</td>
		        				<td><?php echo $data->birth_date; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Civil Status:</td>
		        				<td><?php echo $data->civil_status; ?></td>
		        			</tr>
		        		</table>
	        		</div>
        		</div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Contact Info</span></div>
	        		<div class="frm_inputs">
		        		<table class="info_view">
		        			<tr>
		        				<td>Address:</td>
		        				<td><?php echo $data->address; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Phone / Cellphone:</td>
		        				<td><?php echo $data->phone_cell; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Email:</td>
		        				<td><?php echo $data->email; ?></td>
		        			</tr>
		        		</table>
	        		</div>
        		</div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Current Employment Info</span></div>
	        		<div class="frm_inputs">
		        		<table class="info_view">
		        			<tr>
		        				<td>Employment Status:</td>
		        				<td><?php echo $data->employment_status; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Company:</td>
		        				<td><?php echo $data->company; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Job Title:</td>
		        				<td><?php echo $data->job_title; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Monthly Income:</td>
		        				<td><?php echo $this->config->item('currency_symbol') . $data->income; ?></td>
		        			</tr>
		        		</table>
	        		</div>
        		</div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Applied Loan</span></div>
	        		<div class="frm_inputs">
		        		<table class="info_view">
		        		<?php $data_loan = $this->Borrower_model->get_borrower_loan($data->id); ?>
		        		<?php if ($data_loan): ?>
		        			<?php foreach ($data_loan->result() as $borrower_loan): ?>
		        			<tr>
		        				<td><?php echo anchor('loan/view_info/?id='.$borrower_loan->id, '#'.$borrower_loan->id);?>:</td>
		        				<td><?php 
		        					switch ($borrower_loan->status) {
		        						case 'CLOSED':
		        							echo "<span><strong>".$borrower_loan->status."</strong></span>";
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
		        				<td>No applied loan</td>
		        				<td></td>
		        			</tr>
		        		<?php endif; ?>
		        		</table>
	        		</div>
        		</div>
        		<table>
        			<?php if (validation_errors()) : ?>
        			<tr>
						<td>
							<div class="error"><strong>Add Loan Error:</strong></div>
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
	        <div class="clearFix"></div>
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
			<script type="text/javascript">
				$(function() {
					$(".button_add").colorbox({width:"50%", inline:true, href:"#dialog-modal"});
				});
			</script>
			<div style='display:none'>
				<div class="frm_container" id="dialog-modal">
	        		<div class="frm_heading"><span>Add Loan for <?php echo $data->fname.' '.$data->lname; ?></span></div>
	        		<div class="frm_inputs">
	        			<form action="" method="post">
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
		        				<td>Select Loan Type:</td>
		        				<td><?php echo form_dropdown('loan_id', $loan_types); ?></td>
		        			</tr>
		        			<tr>
		        				<td>Loan Start Date:</td>
		        				<td><input type="text" name="loan_date" class="datepicker" value="<?php echo set_value('loan_date'); ?>" /></td>
		        			</tr>
		        			<tr>
		        				<td></td>
		        				<td><input type="submit" name="submit_borrower" value="Submit" /></td>
		        			</tr>
		        		</table>
		        		<input type="hidden" name="borrower_id" value="<?php echo $_GET['id']; ?>" />
		        		</form>
		        		<?php echo $has_active_loan? "<span class='error'>** Please note that this borrower still has an active loan.<span>" : "" ?>
	        		</div>
        		</div>   
			</div>