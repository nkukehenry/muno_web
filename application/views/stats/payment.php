	
		<div class="card card-body">
			 <form action="<?php echo base_url(); ?>stats/payments/received/filter" method="get">
	        			<fieldset>
	        				<legend>
	        					<?=$this->lang->line('search_filter')?>
	        				</legend>
		        			<div class="form-group">
		        				<label>Start Date:</label>>
		        				<td><input type="text" name="sdate" class="datepicker" /></td>
		        			</div>
		        			<div class="form-group">
		        				<label>End Date:</label>
		        				<input type="text" name="edate" class="datepicker" />
		        			</div>
		        			<div class="form-group">
		        				<input type="submit" name="submit_borrower" value="Submit" />
		        			</div>
		        		</fieldset>
	        		</form> 
		</div>
		<div class="card card-body">
			
	        		<?php 
	        			$total_amount = 0;

        				$action = $this->uri->segment(3);
						
						switch ($action) {
							case 'incoming':
								if($filter) {
									$payments = $this->Payment_model->get_incoming_payments($_GET);
								} else {
									$payments = $this->Payment_model->get_incoming_payments();
								}
								$payment_type = 'Incoming';
								break;
							default:
								if($filter) {
									$payments = $this->Payment_model->get_received_payments($_GET);
									
								} else {
									$payments = $this->Payment_model->get_received_payments();
								}
								$payment_type = 'Received';
								break;
						}
        			?>
	        		
	        		
	        		<div class="card card-body">
	        			<fieldset>
	        				<legend>Detailed</legend>

			        	<?php if($payments AND $payment_type == 'Incoming') : ?>
			        	 <table class="incoming" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Loan #</th>
			        				<th>Check Date</th>
			        				<th>Amount Due</th>
			        				<th>Name</th>
			        				<th>Payment #</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php foreach ($payments->result() as $payment) :?>
			        			<tr>
			        				<td><a href="<?php echo base_url();?>loan/view_info/?id=<?php echo $payment->borrower_loan_id ;?>"><?php echo $payment->borrower_loan_id ;?></a></td>
			        				<td><?php echo $payment->payment_sched ;?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . $payment->amount ;?></td>
			        				<td><a href="<?php echo base_url();?>borrower/view/?id=<?php echo $payment->borrower_id ;?>"><?php echo $payment->lname.', '.$payment->fname ;?></a></td>
			        				<td><?php echo $payment->payment_number ;?></td>
			        			</tr>
			        			<?php 
			        				//compute total amount
			        				$total_amount .= $payment->amount;
			        			?>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
			        	</fieldset>
			          

			        	<fieldset>
	        				<legend>Received</legend>
			        	
			        	<?php elseif($payments AND $payment_type == 'Received') : ?>
			        	<table class="received" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Loan #</th>
			        				<th>Process Date</th>
			        				<th>Amount Received</th>
			        				<th>Customer Name</th>
			        				<th>Processed By</th>
			        				<th>Payment #</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php foreach ($payments->result() as $payment) :?>
			        			<tr>
			        				<td><a href="<?php echo base_url();?>loan/view_info/?id=<?php echo $payment->borrower_loan_id ;?>"><?php echo $payment->borrower_loan_id ;?></a></td>
			        				<td><?php echo $payment->process_date ;?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . $payment->amount ;?></td>
			        				<td><a href="<?php echo base_url();?>borrower/view/?id=<?php echo $payment->borrower_id ;?>"><?php echo $payment->lname.', '.$payment->fname ;?></a></td>
			        				<td><?php echo $payment->username ;?></td>
			        				<td><?php echo $payment->payment_number ;?></td>
			        			</tr>
			        			<?php 
			        				//compute total amount
			        				$total_amount += $payment->amount;
			        			?>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
			        </fieldset>

			        <fieldset>
	        				<legend>Summary</legend>
			        	<span>Total <?php echo $payment_type ?> = <?php echo $this->config->item('currency_symbol') . $total_amount; ?></span>
			        	<?php else : ?>
					        No records found.
					    <?php endif; ?>
					</fieldset>
	        		</div>
	        	</div>
	       
	    <script type="text/javascript">

			$( ".datepicker" ).datepicker();
		</script>