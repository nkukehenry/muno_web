<?php

class Borrower_model extends CI_Model {
	
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
	function chk_borrower_exist($param = array()) {
		$exist = $this->db->get_where('lend_borrower', $param);
		
		if ($exist->num_rows() > 0) {
			return $exist->row();
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
		
		$insert = $this->db->insert('lend_borrower', $param);
		
		if ($insert) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	
	// --------------------------------------------------------------------
	
	function edit($param = array(), $id) {
		$update = $this->db->update('lend_borrower', $param, array('id' => $id));
		
		if ($update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
		
	// --------------------------------------------------------------------
	
	/**
	 * View entries in lend_borrower table
	 */
	function view_all()
	{
		$this->db->order_by('lname, fname');
		$return = $this->db->get('lend_borrower');
		
		return $return;
	}

	function applications($id=null)
	{
		$this->db->select('lend_borrower_requests.*,agents.names,agents.phoneNumber,agents.agentNo');
		$this->db->order_by('lend_borrower_requests.status','desc');
		$this->db->join('agents','agents.id=lend_borrower_requests.agent_id');
		if(!empty($id))
			$this->db->where('lend_borrower_requests.id',$id);

		$return = $this->db->get('lend_borrower_requests');
		if(!empty($id))
			return $return->row();

		return $return->result();
	}

	

	function getBorrowers($agentId){
		$this->db->where('agent_id', $agentId);
		$this->db->order_by('lname, fname');
		$return = $this->db->get('lend_borrower');
		return $return;
	}
	
	// --------------------------------------------------------------------
	
	function get_borrower_loan($borrower_id)
	{
		$this->db->order_by('id');
		$result = $this->db->get_where('lend_borrower_loans', array('borrower_id' => $borrower_id));
		
		if ($result->num_rows() > 0)
		{
			return $result;
		} else {
			return FALSE;		
		}
	}



	// --------------------------------------------------------------------
	
	function get_datails($borrower_loan_id)
	{
		//$result = $this->db->get_where('lend_borrower_loans', array('id' => $borrower_loan_id));

		$this->db->select('*, lend_borrower_loans.id as borrower_loan_id, lend_borrower_loan_settings.lname as loan_name');
		$this->db->from('lend_borrower_loans');
		$this->db->join('lend_borrower_loan_settings', 'lend_borrower_loans.id = lend_borrower_loan_settings.borrower_loan_id');
		$this->db->join('lend_borrower', 'lend_borrower.id = lend_borrower_loans.borrower_id');
		$this->db->where('lend_borrower_loans.id', $borrower_loan_id);
		$result = $this->db->get();

		if ($result->num_rows() > 0)
		{
			return $result->row();
		} else {
			return FALSE;		
		}
	}

	// --------------------------------------------------------------------
	
	function get_name($borrower_id)
	{
		$result = $this->db->get_where('lend_borrower', array('id' => $borrower_id));
		
		if ($result->num_rows() > 0)
		{
			$borrower = $result->row();
			
			return $borrower->lname . ', ' . $borrower->fname . ' ' . $borrower->mi;
		} else {
			return FALSE;		
		}
	}
	
	// --------------------------------------------------------------------
	
	function add_loan($param = array())
	{
		//set Time Zone
		date_default_timezone_set('Africa/Kampala');

		
		$amount = $param['loan_amount'];
		$loan_date = $param['loan_date'];
		$months = $param['loan_months'];
		//get loan parameters
		$loan = $this->Loan_model->chk_loan_exist(array('id' => $param['loan_id']));
		
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
		$amount_term = number_format(round($amount / ($months * $divisor), 2) + $amount_interest, 2, '.', '');
		
		$date = $loan_date;
		
		//additional info to be insert
		$add_info = array(
						'loan_amount_interest' => $amount_interest,
						'loan_amount_term' => $amount_term,
						'loan_amount_total' => $amount_total
					);
					
		$param = array_merge($param, $add_info);
		
		$insert = $this->db->insert('lend_borrower_loans', $param);
		
		//borrower_loan_id
		$id = $this->db->insert_id();
		
		//copy loan parameters to lend_borrower_loan_settings table
		$this->db->insert(
			    'lend_borrower_loan_settings', array(
				'loan_id' => $loan->id,
				'borrower_loan_id' => $id,
				'lname' => $loan->lname,
				'interest' => $loan->interest,
				'months' => $months,
				'terms' => $months * $divisor,
				'frequency' => $loan->frequency,
				'late_fee' => $loan->late_fee,
				'growth_amount' =>0
			)
		);
		
		//insert each payment records to lend_payments
		if($loan->frequency == '2 Weeks') {
			$date = $loan_date;
			$frequency = $months*2;
			$start_day = 0;
			$loan_day = date('d', strtotime($date));
			$loan_month = date('m', strtotime($date));

			//get first payment day if 15 or 30
			if($loan_day >= 15) {
				if($loan_month == '02') {
					$start_day = 28;
				} else {
					$start_day = 30;
				}
			} elseif($loan_day == 30 OR $loan_day > 15) {
				$start_day = 15;
			} else {
				$start_day = 15;
			}

			$date = date('Y/m/'.$start_day, strtotime($date));
			for ($i=1; $i<=$frequency; $i++) { 
				$this->db->insert(
					'lend_payments', array(
						'borrower_id' => $param['borrower_id'],
						'borrower_loan_id' => $id,
						'payment_sched' => $date,
						'payment_number' => $i,
						'amount' => $amount_term
					)
				);
				
				$day = date('d', strtotime($date));
				if($day == 15) {
					//check if February
					if(date('m', strtotime($date)) == '02') {
						$date = date('Y/02/28', strtotime($date));
					} else {
						$date = date('Y/m/30', strtotime($date));
					}
				} elseif($day == 30 OR $day > 15) {
					//check if January, going to February
					if(date('m', strtotime($date)) == '01') {
						$date = date('Y/02/15', strtotime('+1 month', strtotime($date)));
					} else {
						$date = date('Y/m/15', strtotime('+1 month', strtotime($date)));
					}
				}

			}
		} else {
			for ($i = 1; $i <= $months * $divisor; $i++)
			{
				$frequency = $days * $i;
				$newdate = strtotime ('+'.$frequency.' day', strtotime ($date)) ;

				//check if payment date landed on weekend
				//if Sunday, make it Monday. If Saturday, make it Friday
				if(date ('D', $newdate) == 'Sun') {
					$newdate = strtotime('+1 day', $newdate) ;
				} elseif(date('D', $newdate) == 'Sat') {
					$newdate = strtotime('-1 day', $newdate) ;
				}

				$newdate = date('Y-m-d', $newdate );
				
				$this->db->insert(
					'lend_payments', array(
						'borrower_id' => $param['borrower_id'],
						'borrower_loan_id' => $id,
						'payment_sched' => $newdate,
						'payment_number' => $i,
						'amount' => $amount_term
					)
				);
				//$table = $table . '<tr><td>'.$i.'</td><td>'.$amount_term.'</td><td>'.$newdate.'</td></tr>';
			}
			
		}
		
		//get next payment id and insert to lend_borrower_loans.next_payment_id
		$payment = $this->Loan_model->next_payment($id);
		$this->db->update('lend_borrower_loans', array('next_payment_id' => $payment->id), array('id' => $id));
		
		if ($insert) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	// --------------------------------------------------------------------
	
	function hasActiveLoan($borrower_id)
	{
		$result = $this->db->get_where('lend_borrower_loans', array('borrower_id' => $borrower_id, 'status' => 'ACTIVE'));
		
		if ($result->num_rows() > 0)
		{
			return TRUE;
		} else {
			return FALSE;		
		}
	}

	public function deleteBorrower($id){

		$this->db->where('id',$id);
		return $this->db->delete('lend_borrower');
	}

	function approval($data){

		
		    $sql = "INSERT INTO `lend_borrower` (
		    `company`,
		    `address`,
		    `phone_cell`,
		    `email`,
		    `income`,
		    `civil_status`,
		    `sex`,
		    `age`,
		    `employment_status`,
		    `job_title`,
		    `fname`,
		    `lname`,
		    `mi`,
		    `rdate`,
		    `birth_date`,
		    `photo`,
		    `work_address`,
		    `gender`,
		    `kin_name`,
		    `kin_contact`,
		    `kin_address`,
		    `signed_form`,
		    `other_attachment`,
		    `kyc_attachment`,
		    `agent_id`) SELECT `company`, `address`, `phone_cell`, `email`, `income`, `civil_status`, `sex`, `age`, `employment_status`, `job_title`, `fname`, `lname`, `mi`, `rdate`, `birth_date`, `photo`, `work_address`, `gender`, `kin_name`, `kin_contact`, `kin_address`, `signed_form`, `other_attachment`, `kyc_attachment`, `agent_id` from lend_borrower_requests where id=".$data['id'];

		    $insert = $this->db->query($sql);
		    if($insert){
			    $this->db->where('id',$data['id']);
			    $this->db->update('lend_borrower_requests',array('status'=>'APPROVED'));
		    }

		    return $insert;

	}


	
}