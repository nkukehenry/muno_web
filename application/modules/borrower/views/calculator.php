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
		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="leftcontentBody">
				
	        </div>
	        <div class="rightcontentBody">
	        	<form action="" method="post" class="form-horizontal">
	        		<div class="row">
	        		<div class="col-md-4">
	        		<div class="form-group">
	        			<label>Loan Amout:</label>
	        			<input type="number" name="amount" value="<?php echo set_value('amount'); ?>" class="form-control" placeholder="Amount" />
	        		</div>
	        		<div class="form-group">
	        			<label>Loan Term (No. of repayments):</label>
	        			<input type="number" name="months" value="<?php echo set_value('months'); ?>" class="form-control" placeholder="Loan Term" />
	        		</div>
	        	    </div>

	        	    <div class="col-md-4">
	        		 <div class="form-group">
	        			<label>Initiatial Payment Date:</label>
	        			<input type="text" name="loan_date" class="form-control datepicker" value="<?php echo set_value('loan_date'); ?>" placeholder="First Payment date"  />
	        		 </div>


	        		 <div class="form-group">
	        		 	<br>
	        		 	<br>
	        			<label>Loan Product:</label>
	        			<?php echo form_dropdown('loan_type', $loan_types); ?>
	        		 </div>


	        		<?php 

	        		   if (validation_errors()) :
	        			   echo validation_errors(); 
	        			  endif;
	        		   if (isset($error)) : 
	        				    echo $error; 
	        			   endif;
	        		 ?>

	        		 <div class="form-group">
	        		 	<input type="submit" name="submit_loan" class="btn btn-primary" value="CALCULATE">
	        		 </div>
	        		</div>
	        	</div>

	        	</form>
	        </div>
	        <div class="clearFix"></div>
		</div>
		<?php if (isset($result)): ?>
		<div class="clearFix"></div>
		<div class="contentBody w500">
			<!-- <div class="contentTitle">Loan Result</div> -->
			<div class="clearFix"></div>
	        <div class="midcontentBody">
	        	<?php echo $result; ?>
	        </div>
	        <div class="clearFix"></div>
		</div>
		<?php endif;?>