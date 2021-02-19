		<div class="clearFix"></div>
		<div class="card card-body">
			<fieldset>
                            <legend class="font-weight-semibold"><i class="icon-users mr-2"></i><?=$title;?></legend>
		
			        	<table class="table table-striped table-bordered" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th><?=$this->lang->line('loan')?> #</th>
			        				<th><?=$this->lang->line('payable')?></th>
			        				<th><?=$this->lang->line('principal')?></th>
			        				<th><?=$this->lang->line('interest')?></th>
			        				<th><?=$this->lang->line('balance')?></th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php 
			        				$summary = $this->report_mdl->get_summary();
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
			        				<th>TOTAL</th>
			        				<th><?php echo $this->config->item('currency_symbol') . number_format($t_payment, 2, '.', ','); ?></th>
			        				<th><?php echo $this->config->item('currency_symbol') . number_format($t_principal, 2, '.', ','); ?></th>
			        				<th><?php echo $this->config->item('currency_symbol') . number_format($t_interest, 2, '.', ','); ?></th>
			        				<th><?php echo $this->config->item('currency_symbol') . number_format($t_balance, 2, '.', ','); ?></th>
			        			</tr>
			        		</tfoot>
			        	</table>

			        </fieldset>
			        
		        	</div>