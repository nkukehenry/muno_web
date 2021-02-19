		<div class="clearFix"></div>
		<div class="card card-body">
			<fieldset>
                            <legend class="font-weight-semibold"><i class="icon-users mr-2"></i><?=$title;?></legend>
		
			        	<table class="table table-striped table-bordered" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th><?=$this->lang->line('request_date')?></th>
			        				<th><?=$this->lang->line('borrower')?></th>
			        				<th><?=$this->lang->line('agent')?></th>
			        				<th><?=$this->lang->line('loan')?></th>
			        				<th><?=$this->lang->line('amount')?></th>
			        				<th></th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			
			        			<?php if($requests) : ?>
			        			<?php foreach ($requests as $row) :?>

			        			<?php $status = $row->status > 0 ? ' class="due"' : ''; ?>
			        			<tr>

			        				<td<?php echo $status; ?>><?php echo $row->request_date; ?></td>
			        				
			        				<td<?php echo $status; ?>><a href="<?php echo base_url();?>borrower/view/?id=<?php echo $row->borrower_id ;?>"><?php echo $row->borrower_name ;?></a></td>
			        				<td<?php echo $status; ?>><a href="<?php echo base_url();?>agents/view/?id=<?php echo $row->agent_id ;?>"><?php echo $row->agent_name ;?></a></td>
			        				<td<?php echo $status; ?>><a href="<?php echo base_url();?>loan/edit/?id=<?php echo $row->loan_id ;?>"><?php echo $row->loan_name ;?></a></td>
			        				<td<?php echo $status; ?>><?php echo $this->config->item('currency_symbol') . number_format($row->amount, 2, '.', ','); ?></td>
			        				<td>
			        					<i class="icon-menu text-dark" data-toggle="dropdown"></i>
					        	  <div class="dropdown-menu dropdown-menu-right">
				                    <a href="<?php echo base_url(); ?>loan/approve/<?php echo $row->id; ?>" class="dropdown-item">
				                    	<i class="icon-pencil"></i><?php echo $this->lang->line('approve'); ?></a>
				                    	<div class="dropdown-divider"></div>
				                      <a href="<?php echo base_url(); ?>loan/decline/<?php echo $row->id; ?>" class="dropdown-item text-danger">
				                    	<i class="icon-bin"></i><?php echo $this->lang->line('decline'); ?></a>
				                    	
				                  </div>
			        				</td>
			        			</tr>
			        			<?php endforeach; ?>
			        			<?php endif; ?>
			        		</tbody>

			        	</table>

			        </fieldset>
			        
		        	</div>