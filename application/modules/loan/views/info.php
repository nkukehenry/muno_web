		<?php 
		
		$loan = $this->Loan_model->chk_borrower_loan_exist(array('lend_borrower_loans.id' => $_GET['id']));
		?>


			<div class="col-md-12">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h6 class="card-title"><?=$this->lang->line('loan_details')?></h6>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		<a class="list-icons-item" data-action="remove"></a>
				                	</div>
			                	</div>
							</div>

							<div class="card-body">
								<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
									<li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active" data-toggle="tab">
											<?=$this->lang->line('loan_summary')?>
									</a></li>
									<li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab">
										<?=$this->lang->line('payment_schedule')?>
									</a></li>
									<!-- <li class="nav-item"><a href="#highlighted-justified-tab3" class="nav-link" data-toggle="tab">
										<?=$this->lang->line('transactions')?>
									</a></li> -->
									
								</ul>

								<div class="tab-content">
									<div class="tab-pane fade show active" id="highlighted-justified-tab1">

										<!--first summary-->

	        <div class="card card-body">

	        	<div class="manage_menu"><a href="<?php echo base_url(); ?>loan/view_report/?id=<?php echo $loan->borrower_loan_id;?>" style="margin-left: 12px;"><img src="<?php echo base_url(); ?>public/css/pdf.png" width="40px" /></a></div>

	        	<div class="col-md-6">
		        		<table class="table">
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
		        		<table class="table">
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
					<a href="#dialog-modal-pay" data-toggle="modal"  class="btn btn-primary col-md-3">Clear Next payment</a>
					<a href="#dialog-modal-advance" data-toggle="modal" class="btn btn-primary col-md-3">Advance Payment</a>
					<a href="#dialog-modal-move" data-toggle="modal" class="btn btn-primary col-md-3">Re-shedule Payment</a>
				</div>
				<?php endif; ?>

				<?php include('info_modals.php'); ?>

                 <!-- End Dialog Box -->
		        		<?php else : ?>
		        		No scheduled payment.
		        		<?php endif; ?>
	        	
				 <!--end summary-->
				</div>
			</div>
		</div>
				<div class="tab-pane fade" id="highlighted-justified-tab2">
										
										<!--schedule-->


        		<div class="card card-body">
	        		<span>Overview</span>
		        		<table class="table table-striped table-bordered" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Payment #</th>
			        				<th>Date</th>
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
			        			<tr style="font-weight: <?php echo !empty($xstatus)?'900':'500'; ?>;">
			        				<td<?php echo $css; ?>><?php echo $payment->payment_number ;?></td>
			        				<td<?php echo $css; ?>><?php echo $payment->payment_sched ;?></td>
			        				<td<?php echo $css; ?>><?php echo $this->config->item('currency_symbol') . $payment->amount ;?></td>
			        				<td<?php echo $css; ?>><span style="color:<?php echo $payment->status=='PAID' ? 'GREEN' : 'RED'?>"><?php echo $payment->status.$xstatus; ?></span></td>
			        			</tr>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
        		</div>

										<!--schedule-->
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /highlighted tabs -->


	