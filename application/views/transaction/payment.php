		<div class="clearFix"></div>
		<div class="contentBody">
			
	        <div class="rightcontentBody">
	        	<?php 
					$payment = $this->Payment_model->get_info($payment->id);
				?>
				<?php if($payment) : ?>
	        	<form action="" method="post">
	        		<div class="manage_menu"><a href="<?php echo base_url();?>transaction/paid/<?php echo $payment->payment_id; ?>" class="button_cart">Paid</a></div>
	        		<div class="clearFix"></div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Summary</span></div>
		        		<div class="frm_inputs">
			        		<table class="info_view">
			        			<tr>
			        				<td>Payment #:</td>
			        				<td><?php echo $payment->payment_number; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Borrower:</td>
			        				<td><?php echo $payment->lname.', '.$payment->fname; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Amount:</td>
			        				<td><?php echo $payment->amount; ?></td>
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
		        		</div>
	        		</div>
	        	</form>
	        	<?php else : ?>
	        	Payment not exist.
				<?php endif; ?>
	        </div>
	        <div class="clearFix"></div>
		</div>