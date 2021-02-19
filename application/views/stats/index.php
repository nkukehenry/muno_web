
	        <div class="rightcontentBody">
	        	<div class="frm_container">
	        		<div class="frm_heading"><span>Past Due Payments</span></div>
	        		<div class="frm_inputs">
	        			<?php $due = $this->Loan_model->get_due_payments();?>
	        			<?php if($due) : ?>
		        		<table class="past_due" cellspacing="1">
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
			        	<!-- pager -->
						<div class='past_due_pager'>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/first.png' class='first'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/prev.png' class='prev'/>
						    <span class='pagedisplay'></span> <!-- this can be any element, including an input -->
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/next.png' class='next'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/last.png' class='last'/>
						    <select class='pagesize'>
						        <option value='20'>20</option>
						        <option value='30'>30</option>
						        <option value='40'>40</option>
						    </select>
						</div>
			        	<?php else : ?>
			        	No past due payments.
			        	<?php endif; ?>
	        		</div>
        		</div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Due Payments Today</span></div>
	        		<div class="frm_inputs">
	        			<?php $due = $this->Loan_model->get_due_payments_now();?>
	        			<?php if($due) : ?>
		        		<table class="due_now" cellspacing="1">
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
			        	<!-- pager -->
						<div class='due_now_pager'>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/first.png' class='first'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/prev.png' class='prev'/>
						    <span class='pagedisplay'></span> <!-- this can be any element, including an input -->
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/next.png' class='next'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/last.png' class='last'/>
						    <select class='pagesize'>
						        <option value='20'>20</option>
						        <option value='30'>30</option>
						        <option value='40'>40</option>
						    </select>
						</div>
			        	<?php else : ?>
			        	No due payments today.
			        	<?php endif; ?>
	        		</div>
        		</div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Due Payments This Week</span></div>
	        		<div class="frm_inputs">
	        			<?php $due = $this->Loan_model->get_due_payments_week();?>
	        			<?php if($due) : ?>
		        		<table class="due_week" cellspacing="1">
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
			        	<!-- pager -->
						<div class='due_week_pager'>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/first.png' class='first'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/prev.png' class='prev'/>
						    <span class='pagedisplay'></span> <!-- this can be any element, including an input -->
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/next.png' class='next'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/last.png' class='last'/>
						    <select class='pagesize'>
						        <option value='20'>20</option>
						        <option value='30'>30</option>
						        <option value='40'>40</option>
						    </select>
						</div>
			        	<?php else : ?>
			        	No due payments this week.
			        	<?php endif; ?>
	        		</div>
        		</div>
	        </div>
		<script type='text/javascript'>
			$('.past_due').tablesorter()
				.tablesorterPager({
				    container: $('.past_due_pager'),
				    updateArrows: true,
				    page: 0,
				    size: 20,
				    fixedHeight: false,
				    removeRows: false,
				    cssNext: '.next',
				    cssPrev: '.prev',
				    cssFirst: '.first',
				    cssLast: '.last',
				    cssPageDisplay: '.pagedisplay',
				    cssPageSize: '.pagesize',
				    cssDisabled: 'disabled'
			});
			$('.due_now').tablesorter()
				.tablesorterPager({
				    container: $('.due_now_pager'),
				    updateArrows: true,
				    page: 0,
				    size: 20,
				    fixedHeight: false,
				    removeRows: false,
				    cssNext: '.next',
				    cssPrev: '.prev',
				    cssFirst: '.first',
				    cssLast: '.last',
				    cssPageDisplay: '.pagedisplay',
				    cssPageSize: '.pagesize',
				    cssDisabled: 'disabled'
			});
			$('.due_week').tablesorter()
				.tablesorterPager({
				    container: $('.due_week_pager'),
				    updateArrows: true,
				    page: 0,
				    size: 20,
				    fixedHeight: false,
				    removeRows: false,
				    cssNext: '.next',
				    cssPrev: '.prev',
				    cssFirst: '.first',
				    cssLast: '.last',
				    cssPageDisplay: '.pagedisplay',
				    cssPageSize: '.pagesize',
				    cssDisabled: 'disabled'
			});
		</script>