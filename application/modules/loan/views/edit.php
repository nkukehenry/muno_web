		<?php 
			$data = $this->Loan_model->chk_loan_exist(array('id' => $_GET['id']));
		?>
	
		<div class="card card-body">
	        	<?php if ($data): ?>
	        	<form action="" method="post">
	        		<div class="form-group">
	        			<label><?=$this->lang->line('product_name')?></label>
	        		   <input class="form-control float"type="text" name="lname" value="<?php echo $data->lname; ?>" />
	        	    </div>
	        		<div class="form-group">
	        		  <label><?=$this->lang->line('monthly_interest')?> (%):</label>
	        		  <input class="form-control" type="text" name="interest" value="<?php echo $data->interest; ?>" />
	        		</div>
	        		
	        			<!--
	        			<tr>
	        				<td>Months to Pay:</td>
	        				<td><input type="text" name="terms" value="<?php echo $data->terms; ?>" /></td>
	        			</tr>
	        			-->
	        			<div class="form-group">
	        				<label><?php echo $this->lang->line('period'); ?>:</label>
	        					<select name="frequency" class="form-control">
	        						<option value=""></option>
	        						<option value="Monthly" <?php  echo $data->frequency == 'Monthly'? 'selected="selected"':''; ?>>Monthly</option>
	        						<option value="2 Weeks" <?php  echo $data->frequency == '2 Weeks'? 'selected="selected"':''; ?>>2 Weeks</option>
	        						<option value="Weekly" <?php  echo $data->frequency == 'Weekly'? 'selected="selected"':''; ?>>Weekly</option>
	        					</select>
	        			</div>
	        		   <div class="form-group pull-right">
	        				<input type="submit" class="btn btn-dark" name="submit_loan" value="<?php echo $this->lang->line('save_loan_product');?>" />
	        			</div>
	        				        			
	        			<?php if (validation_errors()) : ?>
						<div class="alert alert-danger">
								<?php echo validation_errors(); ?>
						 </div>
						<?php endif;?>

						<?php if (isset($error)) : ?>
						<div class="alert alert-danger">
								<?php echo $error; ?>
						</div>
						<?php endif;?>
	        	
	        		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
	        	</form>
	        	<?php else: ?>
	        	<br>Sorry, loan doesn't exist.<br><br>
	        	<?php endif; ?>
	        </div>
	     