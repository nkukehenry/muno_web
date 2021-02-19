<?php

class Borrower extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Borrower_model');
		$this->load->model('loan/Loan_model');
		$this->module="borrower";
	}
	
	public function index()
	{
		$this->viewall();
	}

	public function borrowerHasLoan($id){
		return $this->Borrower_model->get_borrower_has_loan($id);
	}
	
	public function viewall()
	{
		$data = array(
				'view'=>'index', 
				'location' => 'Borrower / View all',
				'title' => 'Borrowers',
				'module'=>$this->module
			);

		echo Modules::run('templates/main', $data);
	}

	public function applications()
	{
		$data = array(
				'view'=>'applications', 
				'location' => $this->lang->line('applications'),
				'title' => $this->lang->line('agent').' '.$this->lang->line('applications'),
				'applications'=>$this->Borrower_model->applications(),
				'module'=>$this->module
			);

		echo Modules::run('templates/main', $data);
	}

	public function approval($id=null)
	{
		
			if (isset($_POST['submit_borrower'])) {
				//destroy submit_borrower from the POST array
				unset($_POST['submit_borrower']);
				//add loan
				if ($this->Borrower_model->approval($_POST)) {
					redirect('borrower/applications','refresh');
				}
			}
		else{
			//check if borrower has active loan
			$active_loan = false;

			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data = array(
					'has_active_loan' => $active_loan,
					'view'=>'approval', 
					'location' => 'Applicant / View info',
					'title' => 'Applicant info',
				    'module' => $this->module,
				    'data'=>$this->Borrower_model->applications($id)
			      );
			echo Modules::run('templates/main', $data);
		
		}
	}
	
	public function view()
	{
		//validation
		$this->form_validation->set_rules('loan_amount', 'Amount', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_id', 'Loan Type', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('borrower_id', 'Borrower', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_months', 'Months', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_date', 'Loan Date', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			//check if borrower has active loan
			$active_loan = $this->Borrower_model->hasActiveLoan($_GET['id']);


			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data = array(
					'has_active_loan' => $active_loan,
					'view'=>'view', 
					'location' => 'Borrower / View info',
					'title' => 'Borrower info',
				    'module' => $this->module
			      );
			echo Modules::run('templates/main', $data);
		}
		else
		{
			if (isset($_POST['submit_borrower'])) {
				//destroy submit_borrower from the POST array
				unset($_POST['submit_borrower']);
				//add loan
				if ($this->Borrower_model->add_loan($_POST)) {
					redirect('borrower/view/?id='.$this->input->post('borrower_id'), 'refresh');
				}
			}
		}
		
	}
	
	public function add()
	{
		
		//print_r($_POST);
		//validation
		
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mi', 'Middle Initial', 'trim|required|xss_clean');
		$this->form_validation->set_rules('age', 'Age', 'trim|required|xss_clean');
		$this->form_validation->set_rules('birth_date', 'Date of Birth', 'trim|required|xss_clean');
		$this->form_validation->set_rules('civil_status', 'Civil Status', 'trim|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone_cell', 'Phone / Cellphone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
		$this->form_validation->set_rules('employment_status', 'Employment Status', 'trim|required|xss_clean');
		$this->form_validation->set_rules('company', 'Company', 'trim|xss_clean');
		$this->form_validation->set_rules('job_title', 'Job Title', 'trim|xss_clean');
		$this->form_validation->set_rules('income', 'Income', 'trim|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			$data = array(
				'view' => 'add1', 
				'location' => 'Borrower / Add new',
				'title'=>'Add Borrower',
				'module' => $this->module
			    );
			echo Modules::run('templates/main', $data);
		}
		else
		{
			if (isset($_POST['submit_borrower'])) {
				//destroy submit_borrower from the POST array
				unset($_POST['submit_borrower']);
				//add borrower
				$insert_id = $this->Borrower_model->add($_POST);
				if ($insert_id) {
					redirect('borrower/view/?id='.$insert_id, 'refresh');
				}
			}
		}

	}
	
	public function edit()
	{
		//validation
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('birth_date', 'Date of Birth', 'trim|required|xss_clean');
		$this->form_validation->set_rules('civil_status', 'Marital Status', 'trim|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone_cell', 'Phone / Cellphone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
		$this->form_validation->set_rules('employment_status', 'Employment Status', 'trim|required|xss_clean');
		$this->form_validation->set_rules('company', 'Company', 'trim|xss_clean');
		$this->form_validation->set_rules('job_title', 'Job Title', 'trim|xss_clean');
		$this->form_validation->set_rules('income', 'Income', 'trim|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			$data = array(
				'view' => 'edit', 
				'location' => 'Borrower / Edit',
				'title' => 'Edit Borrower',
				'module' => $this->module
			);
			echo Modules::run('templates/main', $data);
		}
		else
		{
			if (isset($_POST['submit_borrower'])) {
				$id = $this->input->post('id');
				//destroy submit_borrower from the POST array
				unset($_POST['submit_borrower']);
				unset($_POST['id']);
				//add loan
				if ($this->Borrower_model->edit($_POST, $id)) {
					redirect('borrower/view/?id='.$id, 'refresh');
				}
			}
		}
	}
	
	public function calculator()
	{
		//validation
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_type', 'Loan Type', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('loan_date', 'Loan Date', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//change validation error delimiters
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$data =  array(
				'view' => 'calculator',
				'location' => 'Loan / Loan Calculator',
				'title' => 'Loan Calculator',
				'module' => $this->module);
		}
		else
		{
			if (isset($_POST['submit_loan'])) {
				//check if loan name exist
				$id = $this->input->post('loan_type');
				$exist = $this->Loan_model->chk_loan_exist(array('id' => $id));
				
				if ($exist) {
					$result = $this->Loan_model->calculate(
						$this->input->post('amount'), 
						$this->input->post('loan_type'),
						$this->input->post('loan_date'));

					$data =  array(
						'content' => 'calculator',
						'data' => array('result' => $result),
						'location' => 'Loan / Loan Calculator',
				        'title' => 'Edit Borrower',
					 	'module' => $this->module);

				} else {

					 $data = array(
					 	'view' => 'calculator',
					 	'data' => array('error' => '<div class="error">Sorry, loan doesn\'t exist.</div>'),
					 	'location' => 'Login',
					 	'title' => 'Edit Borrower',
					 	'module' => $this->module);
				}
			}
		   }
			
			echo Modules::run('templates/main', $data);
	}

	function delete($id){
		$this->Borrower_model->deleteBorrower($id);
		redirect('borrower/index');
	}
}