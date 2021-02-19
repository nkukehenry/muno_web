		<?php 
			$data = $this->Loan_model->chk_loan_exist(array('id' => $_GET['id']));
		?>
		<div class="clearFix"></div>
		<div class="contentBody">
	        <div class="rightcontentBody">
	        	<?php if ($data): ?>
	        	<form action="" method="post">
	        		<table class="form_tbl">
	        			<tr>
	        				<td>Loan Name:</td>
	        				<td><input type="text" name="lname" value="<?php echo $data->lname; ?>" /></td>
	        			</tr>
	        			<tr>
	        				<td>Monthly Interest Rate (%):</td>
	        				<td><input type="text" name="interest" value="<?php echo $data->interest; ?>" /></td>
	        			</tr>
	        			<!--
	        			<tr>
	        				<td>Months to Pay:</td>
	        				<td><input type="text" name="terms" value="<?php echo $data->terms; ?>" /></td>
	        			</tr>
	        			-->
	        			<tr>
	        				<td>Frequency (days):</td>
	        				<td>
	        					<select name="frequency">
	        						<option value=""></option>
	        						<option value="Monthly" <?php  echo $data->frequency == 'Monthly'? 'selected="selected"':''; ?>>Monthly</option>
	        						<option value="2 Weeks" <?php  echo $data->frequency == '2 Weeks'? 'selected="selected"':''; ?>>2 Weeks</option>
	        						<option value="Weekly" <?php  echo $data->frequency == 'Weekly'? 'selected="selected"':''; ?>>Weekly</option>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td></td>
	        				<td><input type="submit" name="submit_loan" value="Submit" /></td>
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
	        		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
	        	</form>
	        	<?php else: ?>
	        	<br>Sorry, loan doesn't exist.<br><br>
	        	<?php endif; ?>
	        </div>
	        <div class="clearFix"></div>
		</div>