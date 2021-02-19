		<div class="clearFix"></div>
		<div class="contentBody">
		
	        <div class="rightcontentBody">
	        	<div class="frm_container">
	        		<div class="frm_inputs">
			        	<table class="tablesorter" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Loan #</th>
			        				<th>Payment</th>
			        				<th>Principal</th>
			        				<th>Interest</th>
			        				<th>Balance</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php 
			        				$summary = $this->Report_model->get_summary();
			        				$t_payment = 0; $t_principal = 0; $t_interest = 0; $t_balance = 0;
			        			?>
			        			<?php if($summary) : ?>
			        			<?php foreach ($summary->result() as $row) :?>
			        			<?php $due = $row->is_due > 0 ? ' class="due"' : ''; ?>
			        			<tr>
			        				<td<?php echo $due; ?>><a href="<?php echo base_url();?>loan/view_info/?id=<?php echo $row->loan_id ;?>"><?php echo $row->loan_id ;?></a></td>
			        				<td<?php echo $due; ?>><?php echo $this->config->item('currency_symbol') . number_format($row->t_payment, 2, '.', ','); $t_payment += $row->t_payment; ?></td>
			        				<td<?php echo $due; ?>><?php echo $this->config->item('currency_symbol') . number_format($row->t_principal, 2, '.', ','); $t_principal += $row->t_principal;?></td>
			        				<td<?php echo $due; ?>><?php echo $this->config->item('currency_symbol') . number_format($row->t_interest, 2, '.', ','); $t_interest += $row->t_interest; ?></td>
			        				<td<?php echo $due; ?>><?php echo $this->config->item('currency_symbol') . number_format($row->t_balance, 2, '.', ','); $t_balance += $row->t_balance; ?></td>
			        			</tr>
			        			<?php endforeach; ?>
			        			<?php endif; ?>
			        		</tbody>
			        		<tfoot>
			        			<tr>
			        				<td>TOTAL</td>
			        				<td><?php echo $this->config->item('currency_symbol') . number_format($t_payment, 2, '.', ','); ?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . number_format($t_principal, 2, '.', ','); ?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . number_format($t_interest, 2, '.', ','); ?></td>
			        				<td><?php echo $this->config->item('currency_symbol') . number_format($t_balance, 2, '.', ','); ?></td>
			        			</tr>
			        		</tfoot>
			        	</table>
		        	</div>
	        	</div>
	        </div>
	        <div class="clearFix"></div>
		</div>