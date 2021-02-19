		
		<div class="col-md-12 card card-body">
									<fieldset>
					                	<legend class="font-weight-semibold"><i class="icon-folder-search mr-2"></i><?=$this->lang->line('search_filter');?></legend>

										<div class="form-group row">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-md-3">
														<input type="text" placeholder="First name" class="form-control">
													</div>

													<div class="col-md-3">
														<input type="text" placeholder="Last name" class="form-control">
													</div>
													<div class="col-md-3">
														 
													</div>
													<div class="col-md-3"> 
														<button type="submit" class="btn btn-dark btn-block btn-sm">Apply Filter</button>
													</div>
												</div>
											</div>
										</div>

									</fieldset>
								</div>



		<div class="card card-body">
	        	<table class="table table-bordered table-striped">
	        		<thead>
	        			<tr>
	        				<th>Customer Name</th>
	        				<th width="10^%">Agent</th>
	        				<th width="20%">Address</th>
	        				<th width="10^%">Contact #</th>
	        				<th width="20%">Employer</th>
	        				<th width="10%">Status</th>
	        				<th width="5%">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php 
	        			 
	        			 foreach ($applications as $borrower) :
	        			 	?>
	        			<tr>
	        				<td><?php echo anchor('borrower/approval/'.$borrower->id, $borrower->lname.', '.$borrower->fname, 'style="text-decoration: none; font-size: 12px; color: #191970; font-weight: 900;"') ; ?></td>
	        				<td><?php echo $borrower->agentNo; ?></td>
	        				<td><?php echo $borrower->address; ?></td>
	        				<td><?php echo $borrower->phone_cell; ?></td>
	        				<td><?php echo $borrower->employment_status; ?></td>
	        				<td><?php echo $borrower->status; ?></td>
	        				<td class="text-center">

	        				<?php if($borrower->status=="PENDING"): ?>
	        					<i class="icon-menu text-dark" data-toggle="dropdown"></i>
					        	  <div class="dropdown-menu dropdown-menu-right">
					        	  	
				                    <a href="<?php echo base_url(); ?>borrower/approval/<?php echo $borrower->id; ?>" class="dropdown-item">
				                    	<i class="icon-pencil"></i><?php echo $this->lang->line('approve'); ?></a>


				                    	<div class="dropdown-divider"></div>
				                      <a href="<?php echo base_url(); ?>borrower/decline/<?php echo $borrower->id; ?>" class="dropdown-item text-danger">
				                    	<i class="icon-bin"></i><?php echo $this->lang->line('decline'); ?></a>
				                    	
				                  </div>

				              <?php endif; ?>

	        				</td>
	        			</tr>
	        			<?php endforeach; ?>
	        		</tbody>
	        	</table>
	      </div>