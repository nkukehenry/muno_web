<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logger {

	var $CI;
	var $user_id;

	public function __construct()
	{
		$this->CI =& get_instance();
		//get user_id through session
		$this->user_id = $this->CI->session->userdata('lend_user_id');
	}

	public function save($affected = '', $id = 0, $type = '', $notes = '')
	{
		if ($affected != '') {
			switch ($affected) {
				case 'payment': 
					$table = 'lend_payments';
					break;
				case 'advance_payment': 
					$table = 'lend_advance_payments';
					break;
				case 'loan':
					$table = 'lend_borrower_loans';
					break;
				default:
			}
		} else {
			return FALSE;
		}
		
		//get info
		$query = $this->CI->db->get_where($table, array('id' => $id), 1);
		
		//No result? exit
		if ($query->num_rows() == 0) {
			return FALSE;
		}
		
		//If there's an info, get it.
		$row = $query->row();
		
		//generate description
		switch ($type) {
			case 'payment':
				$description = "<strong>Payment #</strong>({$row->payment_number}), <strong>Amount</strong>({$row->amount})";
				break;
			case 'advance_payment':
				$description = "<strong>Payment #</strong>({$this->get_payment_number(explode(',', $row->payment_ids))}), <strong>Total Amount</strong>({$row->total_payments})";
				break;
			case 'move':
				$description = "<strong>Payment #</strong>({$row->payment_number}), <strong>Original Date</strong>({$row->payment_sched_prev}), <strong>Move-in Date</strong>({$row->payment_sched})";
				$description .= empty($notes)?'':", <br /><strong>Notes</strong>: ".$notes;
				break;
			default:
				$description = '';
				break;
		}
		
		//Insert log
		$insert = $this->CI->db->insert('lend_logs', array('loan_id' => $row->borrower_loan_id, 'payment_id' => $row->id, 'admin_id' => $this->user_id, 'type' => $type, 'ip_address' => $this->CI->input->ip_address(), 'description' => $description));
	}


	public function show($loan_id)
	{
		$i = 0;
		$table = "
		<table class='logger' cellspacing='1'>
    		<thead>
    			<tr>
    				<th>#</th>
    				<th>Trans Date</th>
    				<th>User</th>
    				<th>Type</th>
    				<th>Description</th>
    			</tr>
    		</thead>
    		<tbody>";
		//get all logs
		$query = $this->CI->db->query("
			SELECT a.rdate as 'tdate', b.username as 'user', a.type, a.description
			FROM lend_logs a
			INNER JOIN lend_admin b
			  ON a.admin_id = b.id
			WHERE a.loan_id = {$loan_id}
		");
		
		foreach ($query->result() as $row) {
			$i++;
			$table .= "
				<tr>
					<td>{$i}</td>
					<td>{$row->tdate}</td>
					<td>{$row->user}</td>
					<td>{$row->type}</td>
					<td>{$row->description}</td>
				</tr>
			";		
		}
		$table .= "
    		</tbody>
    	</table>
    	<!-- pager -->
		<div class='logger_pager'>
		    <img src='".base_url()."public/css/tablesorter/first.png' class='first'/>
		    <img src='".base_url()."public/css/tablesorter/prev.png' class='prev'/>
		    <span class='pagedisplay'></span> <!-- this can be any element, including an input -->
		    <img src='".base_url()."public/css/tablesorter/next.png' class='next'/>
		    <img src='".base_url()."public/css/tablesorter/last.png' class='last'/>
		    <select class='pagesize'>
		        <option value='20'>20</option>
		        <option value='30'>30</option>
		        <option value='40'>40</option>
		    </select>
		</div>
		";
		
		$javascript = "
			<script type='text/javascript'>
				$('.logger').tablesorter()
				.tablesorterPager({
			    container: $('.logger_pager'),
			    updateArrows: true,
			    page: 0,
			    size: 20,
			    fixedHeight: false,
			    removeRows: false,
			    cssNext: '.next',
			    cssPrev: '.prev',
			    cssFirst: '.first',
			    cssLast: '.last',
			    cssPageDisplay: '.pagedisplay',
			    cssPageSize: '.pagesize',
			    cssDisabled: 'disabled'
			});
			</script>
		";
		return $table.$javascript;
	}


	private function get_payment_number($payment_id) {
		if(is_array($payment_id)) {
			$payment_numbers = array();

			foreach ($payment_id as $payment) {
				$query = $this->CI->db->get_where('lend_payments', array('id' => $payment), 1);
				$row = $query->row();

				$payment_numbers[] = $row->payment_number;
			}

			return implode(',', $payment_numbers);
		} else {
			$query = $this->CI->db->get_where('lend_payments', array('id' => $payment_id), 1);

			$row = $query->row();

			return $row->payment_number;
		}
	}
}