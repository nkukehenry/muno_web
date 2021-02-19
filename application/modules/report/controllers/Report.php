<?php

class Report extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Report_model','report_mdl');
		$this->module="report";
		$this->load->model('transaction/Payment_model');
	}
	
	function index()
	{
		$this->summary();
	}
	
	function summary()
	{
		$data = array(
				'view'=>'summary', 
				'location' => 'Report / Summary',
				'title' => 'Loans Summary',
				'module' => $this->module
			);
		echo Modules::run('templates/main',$data);
	}

	function requests()
	{
		$data = array(
				'view'=>'requests', 
				'location' => 'Loan Requests',
				'title' => 'Loan Requests',
				'module' => $this->module,
				'requests' => $this->report_mdl->getRequests()
			);

		//print_r($this->report_mdl->getRequests());
		echo Modules::run('templates/main',$data);
	}
	function test()
	{

		echo "Testing";
	}

	function outStanding()
	{
		
		$data = array(
				'view'=>'due_payments', 
				'location' => 'Loans / Due',
				'title' => 'Due Repayments',
				'module' => $this->module
			);
		echo Modules::run('templates/main',$data);
	}

	function payments()
	{
		$data = array(
				'view'=>'payment', 
				'location' => 'Loans / Due',
				'title' => 'Due Repayments',
				'module' => $this->module
			);
		echo Modules::run('templates/main',$data);
	}
	
}