	<div class="card card-body">
	        			<?php $due = Modules::run('loan/getDuePayments'); ?>
	        			<?php if($due) : ?>
		        		<table class="past_due table" cellspacing="1">
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
			        			<?php foreach ($due->result() as $due_payment) :?>
			        			<tr>
			        				<td><a href="<?php echo base_url();?>loan/view_info/?id=<?php echo $due_payment->borrower_loan_id ;?>"><?php echo $due_payment->borrower_loan_id ;?></a></td>
			        				<td><?php echo $due_payment->payment_sched ;?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . $due_payment->amount ;?></td>
			        				<td><a href="<?php echo base_url();?>borrower/view/?id=<?php echo $due_payment->borrower_id ;?>"><?php echo $due_payment->lname.', '.$due_payment->fname ;?></a></td>
			        				<td><?php echo $due_payment->payment_number ;?></td>
			        			</tr>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
			        	<?php else : ?>
			        	No past due payments.
			        	<?php endif; ?>
	        		</div>