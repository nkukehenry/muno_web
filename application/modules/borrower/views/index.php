		
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
														 <!--  <select data-placeholder="Select your country" class="form-control form-control-select2">
								                                <option value="0">Credit Worthy</option>  
								                                <option value="1">Suspect</option> 
								                            </select> -->
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
	        				<th>Name</th>
	        				<th width="30%">Address</th>
	        				<th width="10^%">Contact #</th>
	        				<th width="20%">Employer</th>
	        				<th width="10%">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php 
	        			 $borrowers = $this->Borrower_model->view_all()->result();
	        			 //print_r($borrowers[0]);

	        			 foreach ($borrowers as $borrower) :
	        			 	?>
	        			<tr>
	        				<td><?php echo anchor('borrower/view/?id='.$borrower->id, $borrower->lname.', '.$borrower->fname, 'style="text-decoration: none; font-size: 12px; color: #191970; font-weight: 900;"') ; ?></td>
	        				<td><?php echo $borrower->address; ?></td>
	        				<td><?php echo $borrower->phone_cell; ?></td>
	        				<td><?php echo $borrower->employment_status; ?></td>
	        				<td class="text-center">
	        					<i class="icon-menu text-dark" data-toggle="dropdown"></i>
					        	  <div class="dropdown-menu dropdown-menu-right">
				                    <a href="<?php echo base_url(); ?>borrower/edit/?id=<?php echo $borrower->id; ?>" class="dropdown-item">
				                    	<i class="icon-pencil"></i><?php echo $this->lang->line('edit'); ?></a>
				                    	<a href="<?php echo base_url(); ?>borrower/view/?id=<?php echo $borrower->id; ?>" class="dropdown-item">
				                    	<i class="icon-brain"></i><?php echo $this->lang->line('details'); ?></a>
				                    	<div class="dropdown-divider"></div>
				                      <a href="<?php echo base_url(); ?>borrower/delete/<?php echo $borrower->id; ?>" class="dropdown-item text-danger">
				                    	<i class="icon-bin"></i><?php echo $this->lang->line('delete'); ?></a>
				                    	
				                  </div>

	        				</td>
	        			</tr>
	        			<?php endforeach; ?>
	        		</tbody>
	        	</table>
	      </div>