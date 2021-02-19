<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	</head>
	<body>
		<style>
			body, p, table, tr, td {
				font-size: 12px;
				font-family: verdana,helvetica,arial,sans-serif;
			}
			p {
				text-align: justify;
				margin:0;
			}
			table {width:100%;}
			table.collapse {
				border-collapse: collapse;
			}

			tr td, tr th {
				text-align: right;
			}

			tr.total {
				font-weight: 900;
			}
			hr {
				margin: 15px 0;
			}
			h1 {
				margin:0;
			}
			.title {
				color: #000;
				font-size: 18px;
				font-weight: normal;
			}

			.section {
				border-bottom: 1px #D4D4D4 solid;
				padding: 10px 0;
				margin-bottom: 20px;
			}

			.section .content {
				margin-left: 10px;
			}

			#hor-minimalist-b
			{
				font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
				font-size: 12px;
				background: #fff;
				width: 480px;
				border-collapse: collapse;
				text-align: center;
			}
			#hor-minimalist-b th
			{
				font-size: 14px;
				font-weight: 900;
				padding: 10px 8px;
				border-bottom: 2px solid #000;
				text-align: center;
			}
			#hor-minimalist-b td
			{
				border-bottom: 1px solid #ccc;
				padding: 6px 8px;
			}

			#pattern-style-a
			{
				font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
				font-size: 12px;
				width: 100%;
				text-align: left;
				border-collapse: collapse;
				background: url('./public/img/pattern.png');
			}

			#pattern-style-a th
			{
				font-size: 13px;
				font-weight: normal;
				padding: 8px;
				border-bottom: 1px solid #fff;
				color: #039;
			}
			#pattern-style-a td
			{
				padding: 3px; 
				border-bottom: 1px solid #fff;
				color: #000;
				border-top: 1px solid transparent;
			}
			#pattern-style-a tbody tr:hover td
			{
				color: #339;
				background: #fff;
			}
		</style>
		<h2 style="text-align: center;">Loan Summary Report</h2>

		<div class="section">
			<div class="content">
				<table id="pattern-style-a">
					<tr>
						<td colspan="2">
							<table>
								<tr><td width="40%">Borrower Name:</td><td><strong><?= $name ?></strong></td></tr>
								<tr><td>Principal Amount:</td><td><strong><?= number_format($loan->loan_amount,2) ?></strong></td></tr>
								<tr><td>Interest rate:</td><td><strong><?= $loan->interest ?>%</strong></td></tr>
								<tr><td>Loan term:</td><td><strong><?= $loan->terms ?> months</strong></td></tr>
								<tr><td>Amortization:</td><td><strong><?= number_format($loan->loan_amount_term,2) ?></strong></td></tr>
							</table>
						</td>
						<td colspan="4"></td>
						<td colspan="2">
							<table>
								<tr><td>Loan ID:</td><td><strong><?= $loan->borrower_loan_id ?></strong></td></tr>
								<tr><td>Loan Date:</td><td><strong><?= $loan->loan_date ?></strong></td></tr>
								<tr><td>Maturity Date:</td><td><strong><?= $maturity ?></strong></td></tr>
								<tr><td>First Deduction:</td><td><strong><?= $first_payment ?></strong></td></tr>
								<tr><td>Last Deduction:</td><td><strong><?= $maturity ?></strong></td></tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="section">
			<div class="title">Summary</div>
			<br>
			<div class="content">
				<table class="collapse" id="pattern-style-a">
					<thead>
						<tr>
							<th>Payment #</th>
							<th>Date</th>
							<th>Interest</th>
							<th>Principal</th>
							<th>Total</th>
							<th>Principal Balance</th>
							<th>Loan Balance</th>
						</tr>
					</thead>
					<tbody>
					<?php $i=1; ?>
					<?php foreach($payments as $payment): ?>
					<?php 
						$principal = $loan->loan_amount_term - $loan->loan_amount_interest;
						$total_term = $principal + $loan->loan_amount_interest;
					?>
					<tr>
						<td><?= $payment->payment_number ?></td>
						<td><?= $payment->payment_sched ?></td>
						<td><?= number_format($loan->loan_amount_interest,2) ?></td>
						<td><?= number_format($principal,2) ?></td>
						<td><?= number_format($total_term,2) ?></td>
						<td><?= number_format($loan->loan_amount - $principal*$i,2) ?></td>
						<td><?= number_format($loan->loan_amount_total - ($loan->loan_amount_term)*$i,2) ?></td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
					<tr class="total">
						<td>-</td>
						<td>-</td>
						<td><?= number_format($loan->loan_amount_interest*$loan->terms,2) ?></td>
						<td><?= number_format($loan->loan_amount,2) ?></td>
						<td><?= number_format($loan->loan_amount_total,2) ?></td>
						<td>-</td>
						<td>-</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div style="margin: auto"><strong>********** NOTHING FOLLOWS **********</strong></div>
	</body>
</html>