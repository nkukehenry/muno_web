		<?php 
		
		$loan = $this->Loan_model->chk_borrower_loan_exist(array('lend_borrower_loans.id' => $_GET['id']));
		?>
		<div class="clearFix"></div>
		<div class="contentBody">
			
	        <div class="rightcontentBody">
	        	<div class="manage_menu"><a href="<?php echo base_url(); ?>loan/view_report/?id=<?php echo $loan->borrower_loan_id;?>" style="margin-left: 12px;"><img src="<?php echo base_url(); ?>public/css/pdf.png" width="40px" /></a></div>

	        	<div class="col-md-6">
		        		<table class="info_view">
		        			<tr>
		        				<td>Loan #:</td>
		        				<td><?php echo $loan->borrower_loan_id; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Loan Type:</td>
		        				<td><?php echo $loan->loan_name; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Borrower:</td>
		        				<td><a href="<?php echo base_url(); ?>borrower/view/?id=<?php echo $loan->borrower_id;?>"><?php echo $loan->lname.', '.$loan->fname; ?></a></td>
		        			</tr>
		        			<tr>
		        				<td>Status:</td>
		        				<td><?php echo $loan->status; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Total Loan Amount:</td>
		        				<td><?php echo $this->config->item('currency_symbol') . number_format($loan->loan_amount_total, 2, '.', ','); ?></td>
		        			</tr>
		        			<tr>
		        				<td>Payments Made:</td>
		        				<td><?php $payments = $this->Loan_model->payments_made($loan->borrower_loan_id); 
		        						echo !$payments ? $this->config->item('currency_symbol') . 0: $this->config->item('currency_symbol') . number_format($payments, 2, '.', ',');
		        					?>
		        				</td>
		        			</tr>
		        			<tr>
		        				<td>Remaining Balance:</td>
		        				<td><?php echo $this->config->item('currency_symbol') . number_format($loan->loan_amount_total - $payments, 2, '.', ','); ?></td>
		        			</tr>
		        		</table>
	        		</div>

        	<div class="col-md-6">
        		<?php 
					$payment = $this->Loan_model->next_payment($loan->borrower_loan_id);
				?>
				<br><br>
	        		<div class="frm_heading"><span><b>Next Payment</b></span></div>
	        			<?php if ($payment) : ?>
		        		<table class="info_view">
		        			<tr>
		        				<td>Payment #:</td>
		        				<td><?php echo $payment->payment_number; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Amount:</td>
		        				<td><?php echo $this->config->item('currency_symbol') . $payment->amount; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Due Date:</td>
		        				<td><?php echo $payment->payment_sched; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Status:</td>
		        				<td><?php echo $payment->status; ?></td>
		        			</tr>
		        		</table>
		        		<!-- Dialog Box -->
						<?php 
							$ipayment = $this->Payment_model->get_info($payment->id);
						?>


				<?php if ($payment) : ?>
				<div class="manage_menu">
					<!-- <a href="<?php echo base_url();?>transaction/payment/?id=<?php echo $payment->id; ?>" class="button_cart">Payment</a> -->
					<span href="#dialog-modal-pay" data-toggle="modal"  class="btn btn-primary btn-outline button_cart">Clear Next payment</span>
					<a href="#dialog-modal-advance" data-toggle="modal" class="btn btn-primary btn-outline button_advance">Advance Payment</a>
					<a href="#dialog-modal-move" data-toggle="modal" class="btn btn-primary btn-outline button_move">Re-shedule Payment</a>
				</div>
				<?php endif; ?>

					</div>

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


						<!-- End Dialog Box -->
		        		<?php else : ?>
		        		No scheduled payment.
		        		<?php endif; ?>
	        		</div>
        		</div>

        		<div class="frm_container">
	        		<div class="frm_heading"><span>Overview</span></div>
	        		<div class="frm_inputs">
		        		<table class="tablesorter" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Payment #</th>
			        				<th>Check Date</th>
			        				<th>Amount</th>
			        				<th>Status</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php $payments = $this->Loan_model->payments_overview($_GET['id']);?>
			        			<?php foreach ($payments->result() as $payment) :?>
			        			<?php 
			        				//change color depending on it's status
			        				$css = '';
									$xstatus = '';
			        				if($payment->is_due > 0  AND $payment->status == 'UNPAID') {
			        					$css = ' class="due"';
										$xstatus = ' | OVER DUE';
			        				} elseif($payment->status=='PAID') {
			        					$css = ' class="paid"';
			        				} elseif($payment->is_due == 0  AND $payment->status == 'UNPAID') {
			        					$css = ' class="due_now"';
			        					$xstatus = ' | DUE TODAY';
									}
			        			?>
			        			<tr style="font-weight: <?php echo !empty($xstatus)?'900':'200'; ?>;">
			        				<td<?php echo $css; ?>><?php echo $payment->payment_number ;?></td>
			        				<td<?php echo $css; ?>><?php echo $payment->payment_sched ;?></td>
			        				<td<?php echo $css; ?>><?php echo $this->config->item('currency_symbol') . $payment->amount ;?></td>
			        				<td<?php echo $css; ?>><span style="color:<?php echo $payment->status=='PAID' ? 'GREEN' : 'RED'?>"><?php echo $payment->status.$xstatus; ?></span></td>
			        			</tr>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
	        		</div>
        		</div>
        		<div class="clearFix"></div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Transactions</span></div>
	        		<div class="frm_inputs">
						<?php echo $this->logger->show($_GET['id']); ?>
	        		</div>
        		</div>
	        </div>
	        <div class="clearFix"></div>
		</div>
		<script type="text/javascript">
			$( '.button_cart' ).button({ icons: {primary:'ui-icon-cart'} });
			$( '.button_cart').colorbox({width:'50%', inline:true, href:'#dialog-modal-pay'});

			$( '.button_advance' ).button({ icons: {primary:'ui-icon-cart'} });
			$( '.button_advance').colorbox({width:'50%', inline:true, href:'#dialog-modal-advance'});
			
			$('.button_move').on('click',function(){
				$('#dialog-modal-move').modal('show');
			});
		</script>