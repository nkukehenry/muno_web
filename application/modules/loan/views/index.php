
	        <div class="card card-body">
	        	<table class="loan table table-striped table-bordered" cellspacing="1">
	        		<thead>
	        			<tr>
	        				<th>Loan #</th>
	        				<th>Disb.Date</th>
	        				<th>Borrower</th>
	        				<th>Loan Type</th>
	        				<th>Amount</th>
	        				<th>Interest</th>
	        				<th>Status</th>
	        				<th width="45">Download</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php 
							$loans = $this->Loan_model->get_borrower_loans();

							//print_r($loans->result()[0]);
						?>
						<?php if ($loans) : ?>
	        			<?php foreach ($loans->result() as $loan) :?>
	        			<tr>
	        				<td><a href="<?php echo base_url(); ?>loan/view_info/?id=<?php echo $loan->borrower_loan_id;?>"><?php echo $loan->borrower_loan_id; ?></a></td>
	        				<td><?php echo date('Y m d', strtotime($loan->loan_date)); ?></td>
	        				<td><a href="<?php echo base_url(); ?>borrower/view/?id=<?php echo $loan->borrower_id;?>"><?php echo $loan->lname.', '.$loan->fname; ?></a></td>
	        				<td><?php echo $loan->loan_name; ?></td>
	        				<td><?php echo $loan->loan_amount; ?></td>
	        				<td><?php echo $loan->loan_amount_interest; ?></td>
	        				<td><span style="color:<?php echo $loan->status=='ACTIVE' ? 'GREEN' : 'RED'?>"><?php echo $loan->status; ?></span></td>
	        				
	        				<td class="text-center">
	        					<i class="icon-menu text-dark" data-toggle="dropdown"></i>
					        	  <div class="dropdown-menu dropdown-menu-right">
				                    <a href="<?php echo base_url(); ?>loan/view_report/?id=<?php echo $loan->borrower_loan_id;?>" class="dropdown-item">
				                    	<i class="icon-download"></i>
				                    	<?php echo $this->lang->line('download_pdf'); ?>
				                    </a>
				                    <?php if($loan->status=='ACTIVE'): ?>
				                    	<a href="<?php echo base_url(); ?>loan/view_report/?id=<?php echo $loan->borrower_loan_id;?>" class="dropdown-item">
				                    	<i class="icon-download"></i>
				                    	<?php echo $this->lang->line('add_repayment'); ?>
				                    </a>
				                    <?php endif; ?>

				                    <div class="dropdown-divider"></div>
				                    <a href="<?php echo base_url(); ?>loan/delete/?id=<?php echo $loan->borrower_loan_id;?>" class="dropdown-item text-danger">
				                    	<i class="icon-bin"></i>
				                    	<?php echo $this->lang->line('delete'); ?>
				                    </a>
				                    	
				                  </div>

	        				</td>
	        			</tr>
	        			<?php endforeach; ?>
	        			<?php endif; ?>
	        		</tbody>
	        	</table>
	        	<!-- pager -->
		</div>
	