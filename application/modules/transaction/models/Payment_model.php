<?php

class Payment_model extends CI_Model {
	
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
	 * Get the info of the specified payment
	 * 
	 */
	function get_info($payment_id) {
		$this->db->select('*, lend_payments.id as payment_id');
		$this->db->from('lend_payments');
		$this->db->join('lend_borrower', 'lend_payments.borrower_id = lend_borrower.id');
		$this->db->where(array('lend_payments.id' => $payment_id));
		$info = $this->db->get();

		if ($info->num_rows() > 0) {
			return $info->row();
		} else {
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * process single payment
	 * 
	 */
	function paid($payment_id) {
		//get first the infos
		$info = $this->get_info($payment_id);
		
		//update payment status to PAID
		$uStatus = $this->db->update('lend_payments', array('status' => 'PAID'), array('id' => $payment_id));
		
		//if it was the last payment, CLOSED the loan
		$this->db->select('MAX(id) as last_payment');
		$payment = $this->db->get_where('lend_payments', array('borrower_loan_id' => $info->borrower_loan_id));
		$result = $payment->row();
		
		if($result->last_payment == $payment_id) {
			$this->db->update('lend_borrower_loans', array('status' => 'CLOSED'), array('id' => $info->borrower_loan_id));
		}
		
		//insert transaction
		$uTransact = $this->db->insert('lend_transactions', array('borrower_id' => $info->borrower_id, 'payment' => $info->amount, 'admin_id' => $this->session->userdata('lend_user_id'), 'payment_id' => $info->payment_id));
		
		//if all were successfull, return TRUE 
		if ($uStatus AND $uTransact) {
			return TRUE;
		}
		
		//if something went wrong return FALSE
		return FALSE;
	}

	// --------------------------------------------------------------------
	
	/**
	 * process multiple payments
	 * 
	 */
	function advance_paid($payments) {

		$total_payments = 0;
		$payment_ids = array();

		//insert advance payment record
		$advPayment = $this->db->insert('lend_advance_payments', array('admin_id' => $this->session->userdata('lend_user_id')));
		$advPayment_id = $this->db->insert_id();

		foreach ($payments as $payment_id) {
			//get first the infos
			$info = $this->get_info($payment_id);
			
			//put payment ids in one string variable
			$payment_ids[] = $payment_id;

			//update payment status to PAID
			$uStatus = $this->db->update('lend_payments', array('status' => 'PAID'), array('id' => $payment_id));
			
			//compute total payments made
			$total_payments += $info->amount;

			//if it was the last payment, CLOSED the loan
			$this->db->select('MAX(id) as last_payment');
			$payment = $this->db->get_where('lend_payments', array('borrower_loan_id' => $info->borrower_loan_id));
			$result = $payment->row();
			
			if($result->last_payment == $payment_id) {
				$this->db->update('lend_borrower_loans', array('status' => 'CLOSED'), array('id' => $info->borrower_loan_id));
			}

			//insert transaction
			$uTransact = $this->db->insert('lend_transactions', array('advance_payment_id' => $advPayment_id, 'borrower_id' => $info->borrower_id, 'borrower_id' => $info->borrower_id, 'payment' => $info->amount, 'admin_id' => $this->session->userdata('lend_user_id'), 'payment_id' => $info->payment_id));
		}
		
		//update advance payment info
		$uAdvPayment = $this->db->update('lend_advance_payments', array('payment_ids' => implode(",", $payment_ids), 'total_payments' => $total_payments, 'admin_id' => $this->session->userdata('lend_user_id'), 'borrower_id' => $info->borrower_id, 'borrower_loan_id' => $info->borrower_loan_id), array('id' => $advPayment_id));

		//if all were successfull, return TRUE 
		if ($uAdvPayment) {
			return $advPayment_id;
		}
		
		//if something went wrong return FALSE
		return FALSE;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Get incoming payments
	 * 
	 */
	function get_incoming_payments($filter = array())
	{
		$this->db->select('*');
		$this->db->from('lend_payments');
		$this->db->join('lend_borrower', 'lend_payments.borrower_id = lend_borrower.id');
		$this->db->where(array('lend_payments.status' => 'UNPAID'));
		$this->db->order_by('lend_payments.payment_sched');
		$info = $this->db->get();

		if ($info->num_rows() > 0) {
			return $info;
		} else {
			return FALSE;
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Get received payments
	 * 
	 */
	function get_received_payments($filter = array())
	{
		$this->db->select('*, lend_transactions.rdate as process_date ');
		$this->db->from('lend_transactions');
		$this->db->join('lend_borrower', 'lend_transactions.borrower_id = lend_borrower.id');
		$this->db->join('lend_admin', 'lend_transactions.admin_id = lend_admin.id');
		$this->db->join('lend_payments', 'lend_transactions.payment_id = lend_payments.id');
		$this->db->order_by('lend_transactions.rdate', 'DESC');

		if(count($filter) > 0) {
			$this->db->where(array('lend_payments.rdate >=' => $filter['sdate'], 'lend_payments.rdate <=' => $filter['edate']));
		}
		$info = $this->db->get();

		if ($info->num_rows() > 0) {
			return $info;
		} else {
			return FALSE;
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Move payment date
	 * 
	 */
	function move_payment($payment_id, $movein_date)
	{
		//get payment info
		$query = $this->db->get_where('lend_payments', array('id' => $payment_id));
		
		//No Result? exit
		if ($query->num_rows() == 0) {
			return FALSE;
		}
		
		$row = $query->row();
		
		//update payment date
		$uDate = $this->db->update('lend_payments', array('payment_sched' => $movein_date, 'payment_sched_prev' => $row->payment_sched), array('id' => $payment_id));
		
		//if all were successfull, return TRUE 
		if ($uDate) {
			return TRUE;
		}
		
		//if something went wrong return FALSE
		return FALSE;
	}


	// --------------------------------------------------------------------
	
	/**
	 * Get last payment date
	 * 
	 */
	function get_last_payment($borrower_loan_id)
	{
		//get last payment info
		$this->db->from('lend_payments');
		$this->db->where(array('borrower_loan_id' => $borrower_loan_id));
		$this->db->order_by('payment_sched', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
			$payment = $result->row();
			return $payment->payment_sched;
		}
		
		return FALSE;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Get first payment date
	 * 
	 */
	function get_first_payment($borrower_loan_id)
	{
		//get first payment info
		$this->db->from('lend_payments');
		$this->db->where(array('borrower_loan_id' => $borrower_loan_id));
		$this->db->order_by('payment_sched');
		$this->db->limit(1);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
			$payment = $result->row();
			return $payment->payment_sched;
		}
		
		return FALSE;
	}


	// --------------------------------------------------------------------
	
	/**
	 * Get first payment date
	 * 
	 */
	function get_payments($borrower_loan_id)
	{
		//get first payment info
		$this->db->from('lend_payments');
		$this->db->where(array('borrower_loan_id' => $borrower_loan_id));
		$this->db->order_by('payment_number');
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
			return $result->result();
		}
		
		return FALSE;
	}
	
}