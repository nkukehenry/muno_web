	
	        <div class="card card-body">
	        	<div class="col-md-4">
	        	 <a href="<?php echo base_url();?>loan/addProduct/" class="btn btn-dark">
	        	 	<?php echo $this->lang->line('create_loan_prod'); ?>
	        	 </a>
	            </div>
	        	<table class="table">
	        		<thead>
	        			<tr>
	        				<th width="40%"><?php echo $this->lang->line('product_name'); ?></th>
	        				<th width="10%"><?php echo $this->lang->line('interest'); ?></th>
	        				<!-- <th width="50">Terms</th> -->
	        				<th width="40%">
	        					<?php echo $this->lang->line('period'); ?></th>
	        				<th width="10%"><?php echo $this->lang->line('options'); ?></th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php $loans = $this->Loan_model->view_all();?>
	        			<?php foreach ($loans->result() as $loan) :?>
	        			<tr>
	        				<td style="font-size: 12px; color: #191970; font-weight: 900;"><?php echo $loan->lname; ?></td>
	        				<td><?php echo $loan->interest; ?>%</td>
	        				<!-- <td><?php echo $loan->terms; ?></td> -->
	        				<td>Every <?php echo $loan->frequency; ?></td>
	        				<td>
	        					<i class="icon-menu text-dark" data-toggle="dropdown"></i>
					        	  <div class="dropdown-menu dropdown-menu-right">
				                    <a href="<?php echo base_url(); ?>loan/edit/?id=<?php echo $loan->id; ?>" class="dropdown-item">
				                    	<i class="icon-pencil"></i>
				                    	<?php echo $this->lang->line('edit'); ?>
				                    </a>

				                    <div class="dropdown-divider"></div>
				                    <a href="<?php echo base_url(); ?>loan/delete/<?php echo $loan->id; ?>" class="dropdown-item text-danger">
				                    	<i class="icon-bin"></i>
				                    	<?php echo $this->lang->line('delete'); ?>
				                    </a>

	        				</td>
	        			</tr>
	        			<?php endforeach; ?>
	        		</tbody>
	        	</table>
	        </div>