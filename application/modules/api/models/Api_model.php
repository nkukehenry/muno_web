<?php

class Api_model extends CI_Model {

function __construct()
	{
		parent::__construct();
}
	
function agentLogin($param = array()) {

	$username =    $param['username'];
	$password =    md5($param['password']); 

	$result = $this->db->where('user_code',$username)
	         ->where('pin',$password)
	         ->get("agents")
	         ->row();

    if ($result){
    	unset($result->pin);
    	unset($result->last_modified);
    	unset($result->createdBy);
    	unset($result->userId);
    	unset($result->float_limit);
    	return $result;
    }else{
    	return array("message"=>"Login failed, wrong usercode or password");
    }

}

function saveBorrower($param = array()) {
		$this->db->set('rdate', 'NOW()', FALSE);
		
		$insert = $this->db->insert('lend_borrower_requests', $param);
		
			if ($insert) {

		   $id = $this->db->insert_id();
		   $filename = "customer.jpg";
            
		  if(!empty($param['photo'])){
             $customerPhoto =base64_decode($param['photo']);
          	 $base64_string = $param['photo'];
             $filename = time().$this->db->insert_id().'.jpg';
             //file_put_contents(FCPATH.'assets/images/customers/'.$filename,$photoData);
              $this->base64_to_jpeg($base64_string,FCPATH.'assets/images/customers/'.$filename);
		   }
           $this->db->where('id',$id)
			        ->update('lend_borrower_requests',array('photo'=>$filename));

			return $this->db->where('id',$id)
			                ->get('lend_borrower_requests')
			                ->row();
		}else {
			return FALSE;
		}

		return $insert;
	}

function getBorrowers($agentId){
		$this->db->where('agent_id', $agentId);
		$this->db->order_by('lname, fname');
		$return = $this->db->get('lend_borrower');
		return $return->result();
	}

	function getBorrowerApplications($agentId){
		$this->db->where('agent_id', $agentId);
		$this->db->order_by('lname, fname');
		$return = $this->db->get('lend_borrower_requests');
		return $return->result();
	}
	
function get_borrower_loan($borrowerId)
{
	$this->db->order_by('id');
	$result = $this->db->get_where('lend_borrower_loans', array('borrower_id' => $borrowerId));
	
	if ($result->num_rows() > 0)
	{
		return $result;
	} else {
		return FALSE;		
	}
}

function add_loan_request($param = array()){

	$data =array(
		"loan_id" => $param["loan_id"],
		"borrower_id" => $param["borrower_id"],
		"amount" => $param["loan_amount"],
		"agent_id" => $param["agent_id"]
	);

	$result = $this->db->insert('lend_requests',$data);
	return $result;
}

	function getDuePayments($agentId)
	{
		$due = $this->db->query(
			"
			SELECT CONCAT(c.fname,' ',
			 c.lname) as borrower_name, c.id as borrower_id, 
			 a.id as borrower_loan_id,
			 a.loan_amount_total as total,
			 b.amount as due_amount, 
			 b.payment_number,
			 b.payment_sched,
			 d.lname as loanProduct,
			 b.payment_sched as date
			FROM lend_borrower_loans a 
			INNER JOIN lend_payments b
			  ON a.id = b.borrower_loan_id
			  INNER JOIN lend_loan d
			  ON d.id = a.loan_id
			INNER JOIN lend_borrower c
			  ON a.borrower_id = c.id
			WHERE b.payment_sched < DATE(NOW())
			  AND a.status = 'ACTIVE'
			  AND b.status = 'UNPAID'
			  AND a.agent_id=".$agentId
		);

		$result=$due->result();
		
		if (count($result) > 0) {
			return $result;
		} else {
			return [];
		}
	}

function get_loan_requests($agentId){

	
	$this->db->select("lend_requests.amount,
	 		 lend_requests.agent_id,
	 		 lend_requests.request_date,
	 		 lend_requests.loan_id,
	 		 lend_requests.id,
	 		 lend_requests.status,
	 		 lend_requests.period,
	 		 CONCAT(lend_borrower.lname,' ',lend_borrower.fname) as borrower_name,
	 		 agents.names as agent_name,
	 		 lend_loan.lname as loan_name,
	 		 lend_borrower.id as borrower_id");

	$this->db->order_by('id');
	$this->db->where('lend_requests.agent_id',$agentId);
	$this->db->join('lend_borrower','lend_borrower.id=lend_requests.borrower_id');
	 	$this->db->join('lend_loan','lend_loan.id=lend_requests.loan_id');
	 	$this->db->join('agents','agents.id=lend_requests.agent_id');

	$result = $this->db->get('lend_requests')->result();

	if (count($result) > 0)
	{
		return $result;
	} else {
		return FALSE;		
	}
}

function add_loan($param = array())
	{
		//set Time Zone
		date_default_timezone_set('Africa/Kampala');
		
		$amount = $param['loan_amount'];
		$loan_date = $param['loan_date'];
		$months = $param['loan_months'];
		//get loan parameters
		$loan = $this->chk_loan_exist(array('id' => $param['loan_id']));
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
		$payment = $this->next_payment($id);
		$this->db->update('lend_borrower_loans', array('next_payment_id' => $payment->id), array('id' => $id));
		
		if ($insert) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function chk_borrower_exist($param = array()) {
		$exist = $this->db->get_where('lend_borrower', $param);
		
		if ($exist->num_rows() > 0) {
			return $exist->row();
		} else {
			return FALSE;
		}
	}

	function chk_loan_exist($param = array()) {
		$exist = $this->db->get_where('lend_loan', $param);
		
		if ($exist->num_rows() > 0) {
			return $exist->row();
		} else {
			return FALSE;
		}
	}

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

   //list loan products

	function getProducts(){
			$this->db->select('id,lname,interest,frequency');
			return $this->db->get('lend_loan')->result();
	}
	// --------------------------------------------------------------------
	//Calculate loan repayments basing on product,amount,start date
	function calculate($amount, $months, $loan_id)
	{
		//get loan parameters
		$loan = $this->chk_loan_exist(array('id' => $loan_id));
		
		$loan_date = date("Y-m-d");//today's date
		//divisor
		switch ($loan->frequency) {
			case 'Monthly':
				$divisor = 1;
				$days = 30;
				//$date =  strtotime('+30 day',strtotime($loan_date));
				break;
			case '2 Weeks':
				$divisor = 2;
				$days = 15;
				//$date = strtotime('+15 day',strtotime($loan_date));
				break;
			case 'Weekly':
				$divisor = 4;
				$days = 7;
				//$date= strtotime('+7 day',strtotime($loan_date));
				break;
		}

		$date = $loan_date;

		//interest
		$amount_interest = $amount * ($loan->interest/100)/$divisor;
		
		//total payments applying interest
		$amount_total = $amount + $amount_interest * $months * $divisor;
		
		//payment per term
		$amount_term  = round($amount / ($months * $divisor), 2) + $amount_interest;

		$payment_amount_term = round($amount / ($months * $divisor), 2);
		
		//to hold all loan data
		$loan_calculation = array();

		$total_in_interest= ($amount_interest*$months)*$divisor;

		
        //high level computations
		$summary =array(
			"loanName"=>$loan->lname,
			"interest"=>$loan->interest,
			"terms"=>$months * $divisor,
			"frequency"=>$loan->frequency,
			"amount"=>$amount,
			"totalinterest"=>$total_in_interest,
			"interest_perterm"=>$amount_interest,
			"term_amount"=>round($amount_term,2),
			"total_payable"=>$amount+$total_in_interest
		);

		//to hold the shcedule row by row
		$schedule = array();

		$sum_amount = 0; //total to be paid from per term
		$sum_interest = 0; // total interest from per term

		for ($i = 1; $i <= $months * $divisor; $i++)
		{
			$frequency = $days * $i;
			$newdate = strtotime ('+'.$frequency.' day', strtotime($date)) ;
			//check if payment date landed on weekend
			//if Sunday, make it Monday. If Saturday, make it Friday
			if(date('D', $newdate) == 'Sun') {
				$newdate = strtotime('+1 day', $newdate);
			}
			elseif(date ('D' , $newdate) == 'Sat') {
				$newdate = strtotime('-1 day', $newdate);
			}
			
			$newdate = date('Y/m/d', $newdate);

			if($i ==1) //first payment
			  $summary["first_payment"]=date('F d Y',strtotime($newdate));
			
			//repayments row
			$repayment = array(
				'no'      => $i,
				'date'    => date('F d Y',strtotime($newdate)),
				'amount'  => round($payment_amount_term,2),
				"interest"=>$amount_interest,
				"total"   =>round(($payment_amount_term+$amount_interest),2)
			);
			//push to repayments
			array_push($schedule, $repayment);

			$sum_amount += $payment_amount_term;
			$sum_interest += $amount_interest;
		}

		$sums =  array(
			'sum_amount' => $sum_interest,
			'sum_amount' =>$sum_interest
		);

		$loan_calculation["summary"]  =  $summary;
		$loan_calculation["schedule"] = $schedule;
		
		return $loan_calculation;
	}

	function get_agent_loans($agentId) {
		$this->db->select('*, lend_borrower_loans.id as borrower_loan_id, lend_borrower_loan_settings.lname as loan_name');
		$this->db->from('lend_borrower_loans');
		$this->db->join('lend_borrower_loan_settings', 'lend_borrower_loans.id = lend_borrower_loan_settings.borrower_loan_id');
		$this->db->join('lend_borrower', 'lend_borrower.id = lend_borrower_loans.borrower_id');
		$this->db->where('lend_borrower_loans.agent_id',$agentId);
		
		
		$result = $this->db->get()->result();
		
		if (count($result) > 0) {
			return $result;
		} else {
			return [];
		}
	}

	function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 
    $data = explode( ',', $base64_string );
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    fclose( $ifp ); 
    return $output_file; 
    }

	
	}