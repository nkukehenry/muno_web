<?php

class Loan_model extends CI_Model {
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor. Instantiate CI to load database class.
	 * 
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check for any record from lend_loan table based on given parameters
	 * @param array $param
	 * @return boolean
	 */
	function chk_loan_exist($param = array()) {
		$exist = $this->db->get_where('lend_loan', $param);
		
		if ($exist->num_rows() > 0) {
			return $exist->row();
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check for any record from lend_borrower_loans table based on given parameters
	 * @param array $param
	 * @return boolean
	 */
	function chk_borrower_loan_exist($param = array()) {
		$this->db->select('*, lend_borrower_loans.id as borrower_loan_id, lend_borrower_loan_settings.lname as loan_name');
		$this->db->from('lend_borrower_loans');
		$this->db->join('lend_borrower_loan_settings', 'lend_borrower_loans.id = lend_borrower_loan_settings.borrower_loan_id');
		$this->db->join('lend_borrower', 'lend_borrower.id = lend_borrower_loans.borrower_id');
		
		//if there's a filter specify, consider it
		count($param) > 0 ? $this->db->where($param) : NULL;
		
		$exist = $this->db->get();
		
		if ($exist->num_rows() > 0) {
			return $exist->row();
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get record from lend_borrower_loans table based on given parameters
	 * @param array $param
	 * @return boolean
	 */
	function get_borrower_loans($param = array()) {
		$this->db->select('*, lend_borrower_loans.id as borrower_loan_id, lend_borrower_loan_settings.lname as loan_name');
		$this->db->from('lend_borrower_loans');
		$this->db->join('lend_borrower_loan_settings', 'lend_borrower_loans.id = lend_borrower_loan_settings.borrower_loan_id');
		$this->db->join('lend_borrower', 'lend_borrower.id = lend_borrower_loans.borrower_id');
		
		//if there's a filter specify, consider it
		count($param) > 0 ? $this->db->where($param) : NULL;
		
		$exist = $this->db->get();
		
		if ($exist->num_rows() > 0) {
			return $exist;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add entry in lend_loan table
	 * @param array $param
	 */
	function add($param = array()) {
		$this->db->set('rdate', 'NOW()', FALSE);
		
		$insert = $this->db->insert('lend_loan', $param);
		
		if ($insert) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	function edit($param = array(), $id) {
		$update = $this->db->update('lend_loan', $param, array('id' => $id));
		
		if ($update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	function calculate($amount, $months, $loan_id, $loan_date)
	{
		//get loan parameters
		$loan = $this->chk_loan_exist(array('id' => $loan_id));
		
		//divisor
		switch ($loan->frequency) {
			case 'Monthly':
				$divisor = 1;
				$days = 30;
				break;
			case '2 Weeks':
				$divisor = 2;
				$days = 15;
				break;
			case 'Weekly':
				$divisor = 4;
				$days = 7;
				break;
		}
		
		//interest
		$amount_interest = $amount * ($loan->interest/100)/$divisor;
		
		//total payments applying interest
		$amount_total = $amount + $amount_interest * $months * $divisor;
		
		//payment per term
		$amount_term = number_format(round($amount / ($months * $divisor), 2) + $amount_interest, 2, '.', ',');

		$payment_amount_term = round($amount / ($months * $divisor), 2);
		
		$date = $loan_date;
		
		//Loan info
		$table = '<div id="calculator"><h3>Loan Info</h3>';
		$table = $table . '<table class="table table-striped table-bordered">';
		$table = $table . '<tr><th>Loan Name:</th><td>'.$loan->lname.'</td></tr>';
		$table = $table . '<tr><th>Interest:</th><td>'.$loan->interest.'%</td></tr>';
		$table = $table . '<tr><th>Terms:</th><td>'.$months * $divisor.'</td></tr>';
		$table = $table . '<tr><th>Frequency:</th><td>'.$loan->frequency.'</td></tr>';
		$table = $table . '</table>';
		$table = $table . '<h3>Computation</h3>';
		$table = $table . '<table class="table table-striped table-bordered">';
		$table = $table . '<tr><th>Loan Amount:</th><td> '.$this->config->item('currency_symbol') . number_format($amount, 2, '.', ',').'</td></tr>';
		$table = $table . '<tr><th>Total Interest:</th><td> '.$this->config->item('currency_symbol') . $amount_interest*$divisor.'</td></tr>';
		$table = $table . '<tr><th>Interest per Term:</th><td> '.$this->config->item('currency_symbol') . $amount_interest.'</td></tr>';
		$table = $table . '<tr><th>Amount Per Term:</th><td> '.$this->config->item('currency_symbol') . $amount_term.'</td></tr>';
		$table = $table . '<tr><th>Total Payment:</th><td> '.$this->config->item('currency_symbol') . number_format($amount_total, 2, '.', ',').'</td></tr>';
		$table = $table . '</table> <br>';
		$table = $table . '<table  cellpadding="5" cellspacing="0" class="table table-striped table-bordered">';
		$table = $table . '<tr><th>Payment #</th><th>Payment Date</th><th>Amount ('.$this->config->item('currency_symbol') .')</th><th>Interest ('.$this->config->item('currency_symbol') .')</th></tr>';

		$sum_amount = 0;
		$sum_interest = 0;

		for ($i = 1; $i <= $months * $divisor; $i++)
		{
			$frequency = $days * $i;
			$newdate = strtotime ('+'.$frequency.' day', strtotime($date)) ;
			//check if payment date landed on weekend
			//if Sunday, make it Monday. If Saturday, make it Friday
			if(date('D', $newdate) == 'Sun') {
				$newdate = strtotime('+1 day', $newdate) ;
			} elseif(date ('D' , $newdate) == 'Sat') {
				$newdate = strtotime('-1 day', $newdate) ;
			}
			
			$newdate = date('m/d/Y', $newdate);
			$table = $table . '<tr><td>'.$i.'</td><td>'.$newdate.'</td><td>'.number_format($payment_amount_term,1).'</td><td>'.$amount_interest.'</td></tr>';

			$sum_amount += $payment_amount_term;
			$sum_interest += $amount_interest;
		}

		$table = $table . '<tr><th></th><th></th><th>'.number_format($sum_amount,1).'</th><th>'.number_format($sum_interest,1).'</th></tr>';

		$table = $table . '</table></div>';
		
		return $table;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * View entries in lend_loan table
	 */
	function view_all()
	{
		$this->db->order_by('lname');
		$return = $this->db->get('lend_loan');
		
		return $return;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Calculate payments made
	 */
	function payments_made($loan_id)
	{
		$this->db->select('sum(amount) as total');
		$amount = $this->db->get_where('lend_payments', array('borrower_loan_id' => $loan_id, 'status' => 'PAID'));
		
		if ($amount->num_rows() > 0) {
			$amount = $amount->row();
			
			return $amount->total;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Calculate next paymentinfo
	 */
	function next_payment($borrower_loan_id)
	{
		$this->db->order_by('payment_sched');
		$loan = $this->db->get_where('lend_payments', array('borrower_loan_id' => $borrower_loan_id, 'status' => 'UNPAID'));
		
		if ($loan->num_rows() > 0) {
			$loan = $loan->row();
			
			return $loan;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * View entries in lend_loan table
	 */
	function view_transactions($loan_id)
	{
		$this->db->select('*, lend_transactions.id as transaction_id, lend_transactions.rdate as transaction_date');
		$this->db->from('lend_transactions');
		$this->db->join('lend_payments', 'lend_transactions.payment_id = lend_payments.id');
		$this->db->join('lend_admin', 'lend_admin.id = lend_transactions.admin_id');
		$this->db->where(array('lend_payments.borrower_loan_id' => $loan_id));
		$this->db->order_by('lend_transactions.rdate');
		
		return $this->db->get();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all overdue payments
	 */
	function get_due_payments()
	{
		$due = $this->db->query(
			'
			SELECT c.fname, c.lname, c.id as \'borrower_id\', a.id as \'borrower_loan_id\', b.amount, b.payment_number, b.payment_sched 
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE b.payment_sched < DATE(NOW())
			  AND a.status = \'ACTIVE\'
			  AND b.status = \'UNPAID\'
			'
		);
		
		if ($due->num_rows() > 0) {
			return $due;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all today's due payments
	 */
	function get_due_payments_now()
	{
		$due = $this->db->query(
			'
			SELECT c.fname, c.lname, c.id as \'borrower_id\', a.id as \'borrower_loan_id\', b.amount, b.payment_number, b.payment_sched 
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE b.payment_sched = DATE(NOW())
			  AND a.status = \'ACTIVE\'
			  AND b.status = \'UNPAID\'
			'
		);
		
		if ($due->num_rows() > 0) {
			return $due;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all due payments on current week
	 */
	function get_due_payments_week()
	{
		$due = $this->db->query(
			'
			SELECT c.fname, c.lname, c.id as \'borrower_id\', a.id as \'borrower_loan_id\', b.amount, b.payment_number, b.payment_sched 
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE WEEK(b.payment_sched) + YEAR(b.payment_sched) = WEEK(NOW()) + YEAR(NOW())
			  AND a.status = \'ACTIVE\'
			  AND b.status = \'UNPAID\'
			'
		);
		
		if ($due->num_rows() > 0) {
			return $due;
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * View payments overview
	 * 
	 */
	function payments_overview($loan_id)
	{
		$this->db->select("*, datediff(NOW(), lend_payments.payment_sched) as is_due", FALSE);
		$this->db->from('lend_payments');
		$this->db->join('lend_borrower', 'lend_payments.borrower_id = lend_borrower.id');
		$this->db->where(array('lend_payments.borrower_loan_id' => $loan_id));
		$this->db->order_by('lend_payments.payment_number');
		$info = $this->db->get();

		if ($info->num_rows() > 0) {
			return $info;
		} else {
			return FALSE;
		}
	}


	// --------------------------------------------------------------------
	
	/**
	 * Get unpaid payments
	 * 
	 */
	function unpaid_payments($loan_id)
	{
		$this->db->select("*, datediff(NOW(), lend_payments.payment_sched) as is_due, lend_payments.id as payment_id", FALSE);
		$this->db->from('lend_payments');
		$this->db->join('lend_borrower', 'lend_payments.borrower_id = lend_borrower.id');
		$this->db->where(array('lend_payments.borrower_loan_id' => $loan_id, 'lend_payments.status' => 'UNPAID'));
		$this->db->order_by('lend_payments.payment_number');
		$info = $this->db->get();

		if ($info->num_rows() > 0) {
			return $info;
		} else {
			return FALSE;
		}
	}
	
}