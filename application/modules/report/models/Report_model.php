<?php

class Report_model extends CI_Model {
	
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
	 * Get all loan records and show its loan summary
	 * 
	 */
	 function get_summary()
	 {
		$query = $this->db->query('
	 		SELECT
			  AA.id as loan_id,
			  ROUND(IFNULL((SELECT sum(amount) FROM lend_payments WHERE borrower_loan_id = AA.id AND status = "PAID"),0),2) AS t_payment,
			  ROUND(IFNULL((SELECT sum(amount) FROM lend_payments WHERE borrower_loan_id = AA.id AND status = "UNPAID"),0),2) AS t_balance,
			  ROUND((SELECT (count(amount) * (AA.loan_amount / MAX(BB.payment_number))) FROM lend_payments WHERE borrower_loan_id = AA.id AND status = "PAID"),2) AS t_principal,
			  ROUND((SELECT (count(amount) * (AA.loan_amount_interest)) FROM lend_payments WHERE borrower_loan_id = AA.id AND status = "PAID"),2) AS t_interest,
			  CC.id as is_due
			FROM lend_borrower_loans AS AA
			  INNER JOIN lend_payments AS BB
			    ON AA.id = BB.borrower_loan_id
			  LEFT JOIN (SELECT a.* FROM lend_borrower_loans a INNER JOIN lend_payments b ON a.id = b.borrower_loan_id	WHERE b.payment_sched < DATE(NOW()) AND a.status = \'ACTIVE\' AND b.status = \'UNPAID\' GROUP BY a.id) as CC
			    ON CC.id = AA.id
			GROUP BY AA.id
			ORDER BY AA.id
	 	');
			
		if ($query->num_rows() > 0)
		{
			return $query;
		}
		
		return FALSE;
	 }

	 function getRequests($id=null)
	 {
	 	$this->db->select(
	 		"lend_requests.amount,
	 		 lend_requests.agent_id,
	 		 lend_requests.request_date,
	 		 lend_requests.loan_id,
	 		 lend_requests.id,
	 		 lend_requests.status,
	 		 lend_requests.period,
	 		 CONCAT(lend_borrower.lname,' ',lend_borrower.fname) as borrower_name,
	 		 agents.names as agent_name,
	 		 lend_loan.lname as loan_name,
	 		 lend_borrower.id as borrower_id
	 		");
	 	$this->db->where('lend_requests.status',0);
	 	if($id)
	 	$this->db->where('lend_requests.id',$id);

	 	$this->db->join('lend_borrower','lend_borrower.id=lend_requests.borrower_id');
	 	$this->db->join('lend_loan','lend_loan.id=lend_requests.loan_id');
	 	$this->db->join('agents','agents.id=lend_requests.agent_id');
	 	
	 	if($id)
	 	return $this->db->get('lend_requests')->row();

	    return $this->db->get('lend_requests')->result();
	 }
}