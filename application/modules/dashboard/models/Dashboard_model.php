<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function countBorrowers(){
		return $this->db->count_all('lend_borrower');
	}

	public function sumLoans(){
		$this->db->select('sum(loan_amount) as amount');
		//$this->db->where('');
		$qry = $this->db->get('lend_borrower_loans');
		$res = $qry->row();

		return $res->amount;
	}
	public function loanInterest(){
		$this->db->select('sum(loan_amount_interest) as amount');
		//$this->db->where('');
		$qry = $this->db->get('lend_borrower_loans');
		$res = $qry->row();

		return $res->amount;
	}

	public function dueToday(){

		$query = $this->db->query(
			"
			SELECT sum(loan_amount) as amount
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE b.payment_sched = DATE(NOW())
			  AND a.status = 'ACTIVE'
			  AND b.status = 'UNPAID'
			"
		);

		$res = $query->row();

		return $res->amount;

	}
	public function interestToday(){


		$query = $this->db->query(
			"
			SELECT sum(loan_amount_interest) as amount
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			  WHERE b.payment_sched = DATE(NOW())
			  AND a.status = 'ACTIVE'
			  AND b.status = 'UNPAID'
			"
		);

		//
		$res = $query->row();
		return $res->amount;
	}

	public function dueWeek(){

		$query = $this->db->query(
			"
			SELECT sum(loan_amount) as amount
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE WEEK(b.payment_sched) + YEAR(b.payment_sched) = WEEK(NOW()) + YEAR(NOW())
			  AND a.status = 'ACTIVE'
			  AND b.status = 'UNPAID'
			"
		);

		$res = $query->row();

		return $res->amount;

	}

	public function dueMonth(){

		$query = $this->db->query(
			"
			SELECT sum(loan_amount) as amount
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE MONTH(b.payment_sched) + YEAR(b.payment_sched) = MONTH(NOW()) + YEAR(NOW())
			  AND a.status = 'ACTIVE'
			  AND b.status = 'UNPAID'
			"
		);

		$res = $query->row();

		return $res->amount;

	}

	public function loansToday(){

		
		$query = $this->db->query(
			"
			SELECT count(loan_amount_interest) as loans
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE b.payment_sched = DATE(NOW())
			  AND a.status = 'ACTIVE'
			  AND b.status = 'UNPAID'
			"
		);

		$res = $query->row();
		return $res->loans;

	}

	public function getMessages(){

		$this->db->select('message');
		$qry = $this->db->get('messages');
		return $qry->result();
	}


}