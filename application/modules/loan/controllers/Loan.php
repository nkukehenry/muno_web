<?php

class Loan extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Loan_model');
		$this->load->model('transaction/Payment_model');
		$this->load->model('borrower/Borrower_model');
		$this->load->model('report/Report_model','report_mdl');
		$this->load->library('logger');
		$this->module="loan";
	}
	
	function view()
	{
		$data = array(
				'view'=>'index', 
				'location' => 'Loan / View all',
				'title' => 'Loans',
				'module' => $this->module
				);

		echo Modules::run('templates/main',$data);
	}
	
	function loanProducts()
	{
		$data = array(
				'view'=>'loan_types', 
				'location' => 'Loan / Loan Types / View all',
				'title' => 'Loan Products',
				'module' => $this->module
				);

		echo Modules::run('templates/main', $data);
	}
	
	function view_info()
	{
		$data = array(
			'view' => 'info',
			'location' => 'Loan / View',
			'title' => 'Loan Details',
			'module' => $this->module
		);
		echo Modules::run('templates/main',$data);
	}

	function view_report()
	{
		//get loan id
		if(isset($_GET['id'])) {
			$loan_id = $_GET['id'];
			
			//query loan details
			$loan = $this->Borrower_model->get_datails($loan_id);

			if($loan) {
				$name = $this->Borrower_model->get_name($loan->borrower_id);
				$maturity = $this->Payment_model->get_last_payment($loan->borrower_loan_id);
				$first_payment = $this->Payment_model->get_first_payment($loan->borrower_loan_id);
				$payments = $this->Payment_model->get_payments($loan->borrower_loan_id);
				$html = $this->load->view('report/loan', array('loan' => $loan, 'name' => $name, 'maturity' => $maturity, 'first_payment' => $first_payment, 'payments' => $payments), true);

				require_once("./public/dompdf/dompdf_config.inc.php");
				
				$pdf =  new DOMPDF();
				$pdf->load_html($html);
				$pdf->render();
				$pdf->stream($name . "-" . $loan->borrower_loan_id . ".pdf");
			}
		}
	}
	
	function addProduct()
	{
		//validation
		$this->form_validation->set_rules('lname', 'Loan Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required|xss_clean|numeric');
		//$this->form_validation->set_rules('terms', 'Terms', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('frequency', 'Frequency', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data = array(
				'view' => 'add',
				'location' => 'Loan / Loan Types / Add',
				'title' => 'Create Loan Product',
				'module' => $this->module
			);
		}
		else
		{
			if (isset($_POST['submit_loan'])) {
				//check if loan name exist
				$exist = $this->Loan_model->chk_loan_exist(array('lname' => $this->input->post('lname')));
				
				if ($exist) {
					$data =  array(
						'view' => 'add', 
						'data' => array('error' => '<div class="error">Loan Name Already Exist</div>'), 
						'location' => 'New Loan',
						'title' => 'Loan Types',
				        'module' => $this->module
				        );
				} else {
					//destroy submit_loan from the POST array
					unset($_POST['submit_loan']);
					//add loan
					if ($this->Loan_model->add($_POST)) {
						redirect('loan/view', 'refresh');
					}
				}
			}
		}

		echo Modules::run('templates/main', $data);
	}
	
	function edit()
	{
		//validation
		$this->form_validation->set_rules('lname', 'Loan Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('interest', 'Interest', 'trim|required|xss_clean|numeric');
		//$this->form_validation->set_rules('terms', 'Terms', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('frequency', 'Frequency', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data = array(
				'view' => 'edit',
				'location' => 'Loan / Loan Types / Edit',
				'title' => 'Loan Types',
				'module' => $this->module
			);
			
		}
		else
		{
			if (isset($_POST['submit_loan'])) {
				//check if loan name exist
				$id = $this->input->post('id');
				$exist = $this->Loan_model->chk_loan_exist(array('id' => $id));
				
				if ($exist) {
					//destroy submit_loan and id from the POST array
					unset($_POST['submit_loan']);
					unset($_POST['id']);
					//edit loan
					if ($this->Loan_model->edit($_POST, $id)) {
						redirect('loan/view', 'refresh');
					}
				} else {
					$data =  array(
						'view' => 'edit',
						'data' => array('error' => '<div class="error">Sorry, loan doesn\'t exist.</div>'),
						'title' => 'Edit Loan',
						'location' => 'Edit Loan',
				        'module' => $this->module);
				}
			}
		}

		echo Modules::run('templates/main', $data);
	}
	
	function calculator()
	{
		//validation
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_type', 'Loan Type', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('months', 'Months', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_date', 'Loan Date', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data =  array(
				'view' => 'calculator',
				'location' => 'Loan / Loan Calculator',
				'title' => 'Loan Calculator',
				'module' => $this->module
			);
		}
		else
		{
			if (isset($_POST['submit_loan'])) {
				//check if loan name exist
				$id = $this->input->post('loan_type');
				$exist = $this->Loan_model->chk_loan_exist(array('id' => $id));
				
				if ($exist) {
					$result = $this->Loan_model->calculate($this->input->post('amount'), $this->input->post('months'), $this->input->post('loan_type'), $this->input->post('loan_date'));

					$data = array(
						'view' => 'calculator',
						'data' => array('result' => $result),
						'location' => 'Loan / Loan Calculator',
						'title' => 'Loan Calculator',
				        'module' => $this->module
					);
					

				} else {
					$data =  array(
						'view' => 'calculator',
						'data' => array('error' => '<div class="error">Sorry, loan don\'t exist.</div>'),
						'location' => 'Login',
						'title' => 'Loan Calculator',
				        'module' => $this->module
					);
					
				}
			}
		}

		echo Modules::run('templates/main',$data);
	}

	function getDuePayments(){
		return $this->Loan_model->get_due_payments();
	}

	function dueToday(){

		return $this->Loan_model->get_due_payments_now();
	}
	
	function dueThisWeek(){

		return $this->Loan_model->get_due_payments_week();
	}

	function approve($id){

		$request = $this->report_mdl->getRequests($id);

		$result = $this->Loan_model->calculate($request->amount,$request->period,$request->loan_id,$request->request_date);

					$data = array(
						'view' => 'approval',
						'result' => $result,
						'request' =>$request,
						'location' => 'Loan / Loan Calculator',
						'title' => 'Loan Calculator',
				        'module' => $this->module
					);
		 echo Modules::run('templates/main',$data);

		 //print_r($request);
	}
	

}