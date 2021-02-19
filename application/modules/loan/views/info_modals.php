
						<div class="modal fade" id="dialog-modal-pay">
							<div class="modal-dialog" >
								<div class="modal-content" >
									<div class="modal-body" >

				        		<div class="frm_heading"><span>Payment Confirmation</span></div>
				        		<div class="frm_inputs">
				        			<form action="<?php echo base_url(); ?>transaction/paid/<?php echo $payment->id.'/'.$_GET['id']; ?>" method="post">
					        		<table class="info_view">
					        			<tr>
					        				<td>Payment #:</td>
					        				<td><?php echo $ipayment->payment_number; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Borrower:</td>
					        				<td><?php echo $ipayment->lname.', '.$ipayment->fname; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Amount:</td>
					        				<td><?php echo $this->config->item('currency_symbol') . $ipayment->amount; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Due Date:</td>
					        				<td><?php echo $ipayment->payment_sched; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Status:</td>
					        				<td><?php echo $ipayment->status; ?></td>
					        			</tr>
					        			

					        		</table>
					        		<input type="hidden" name="borrower_id" value="<?php echo $_GET['id']; ?>" />
					        		
				        		</div>
				        		<div class="modal-footer">
				        			<input type="submit" class="btn btn-primary btn-sm" name="submit_payment" value="Confirm Payment" />
				        		</div>
				        		</form>  
			        		</div>   
						</div>
					</div>   
				</div>

						<div class="modal fade" id="dialog-modal-advance">
							<div class="modal-dialog" >
								<div class="modal-content" >
									<div class="modal-body" >
				        		     <div class="frm_heading"><span>Advance Payment Confirmation</span></div>
				        		     <div class="frm_inputs">
				        			 <form action="<?php echo base_url(); ?>transaction/advance/<?php echo $_GET['id']; ?>"  method="post">
					        		<table class="info_view">
					        			<tr>
					        				<td><b><?php echo $ipayment->lname.', '.$ipayment->fname; ?></b></td>
					        			</tr>
					        			<tr>
					        				
					        				<td>
					        					<table class="tablesorter" cellspacing="1">
									        		<thead>
									        			<tr>
									        				<th>Payment #</th>
									        				<th>Check Date</th>
									        				<th>Amount</th>
									        				<th>Status</th>
									        				<th></th>
									        			</tr>
									        		</thead>
									        		<tbody>
									        			<?php $payments = $this->Loan_model->unpaid_payments($_GET['id']);?>
									        			<?php foreach ($payments->result() as $_payment) :?>
									        			<?php 
									        				//change color depending on it's status
									        				$css = '';
															$xstatus = '';
									        				if($_payment->is_due > 0  AND $_payment->status == 'UNPAID') {
									        					$css = ' class="due"';
																$xstatus = ' | OVER DUE';
									        				} elseif($_payment->status=='PAID') {
									        					$css = ' class="paid"';
									        				} elseif($_payment->is_due == 0  AND $_payment->status == 'UNPAID') {
									        					$css = ' class="due_now"';
									        					$xstatus = ' | DUE TODAY';
															}
									        			?>
									        			<tr style="font-weight: <?php echo !empty($xstatus)?'900':'200'; ?>;">
									        				<td<?php echo $css; ?>><?php echo $_payment->payment_number ;?></td>
									        				<td<?php echo $css; ?>><?php echo $_payment->payment_sched ;?></td>
									        				<td<?php echo $css; ?>><?php echo $this->config->item('currency_symbol') . $_payment->amount ;?></td>
									        				<td<?php echo $css; ?>><span style="color:<?php echo $_payment->status=='PAID' ? 'GREEN' : 'RED'?>"><?php echo $_payment->status.$xstatus; ?></span></td>
									        				<td<?php echo $css; ?>><input type="checkbox" name="payment[]" value="<?php echo $_payment->payment_id; ?>"></td>
									        			</tr>
									        			<?php endforeach; ?>
									        		</tbody>
									        	</table>

					        				</td>
					        			</tr>
					        		</table>
					        		<input type="hidden" name="borrower_id" value="<?php echo $_GET['id']; ?>" />
					        		
				        		</div>
				        		<div class="modal-footer">
				        			<input type="submit" name="submit_advpayment" class="btn btn-primary btn-sm" value="Confirm Advance Pay" />
				        		</div>
				        		</form>  
			        		</div>   
						</div>
					</div>
			       </div>   
				</div>
						
						<div class="modal fade" id="dialog-modal-move">
							<div class="modal-dialog" >
								<div class="modal-content" >
									<div class="modal-body" >
				        		<div class="frm_heading"><span>Re-schedule Payments</span></div>
				        		<div class="frm_inputs">
				        			<form action="<?php echo base_url(); ?>transaction/move/<?php echo $payment->id.'/'.$_GET['id']; ?>" method="post">
					        		<table class="info_view">
					        			<tr>
					        				<td>Payment #:</td>
					        				<td><?php echo $ipayment->payment_number; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Borrower:</td>
					        				<td><?php echo $ipayment->lname.', '.$ipayment->fname; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Amount:</td>
					        				<td><?php echo $this->config->item('currency_symbol') . $ipayment->amount; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Due Date:</td>
					        				<td><?php echo $ipayment->payment_sched; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Status:</td>
					        				<td><?php echo $ipayment->status; ?></td>
					        			</tr>
					        			<tr>
					        				<td>Move-in Date:</td>
					        				<td><input type="text" name="mdate" class="datepicker" value="<?php echo $ipayment->payment_sched; ?>" /></td>
					        			</tr>
					        			<tr>
					        				<td>Notes:</td>
					        				<td><textarea name="notes" rows="5" cols="45"></textarea></td>
					        			</tr>
					        			<!--
					        			<tr>
					        				<td></td>
					        				<td><input type="checkbox" name="move_all" /> adjust remaining payments</td>
					        			</tr>
					        			-->
					        			<tr>
					        				<td></td>
					        				<td><input type="submit" name="submit_move" value="Move Payment" /></td>
					        			</tr>
					        		</table>
					        		<input type="hidden" name="borrower_id" value="<?php echo $_GET['id']; ?>" />
					        		</form>  
				        		</div>
			        		</div>   
						</div>
					</div>   
				 </div>