<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function __construct(){
		parent::__construct();
	   define('DMODULE', 'dashboard');
	   $this->load->model('dashboard_model');

	}

	public function index(){
	  $data['module'] = DMODULE;
	  $data['view'] = 'dashboard';
	  $data['rowOne'] = $this->rowOneData();
	  $data['statData'] = $this->statData();
	  $data['insights'] = $this->insights();
	  $data['numberData'] = $this->numberData();
	  $data['alerts'] = $this->alerts();
	  $data['title'] = $this->lang->line('dashboard');
	  echo Modules::run("templates/main",$data,true);
	}
	 function rowOneData(){

	 	//main widgets

		$data = array(
			array(
				"title"=>"Due  Today",
				"icon"=>"icon-puzzle3",
				'icon-class'=>'success',
				"comment"=>"",
				"value"=>"UGX ".number_format($this->dashboard_model->dueToday()),
				'icon-class'
			),
			array(
				"title"=>"Total Interest",
				"icon"=>"icon-download7",
				"comment"=>"",
				'icon-class'=>'dark',
				"value"=>"UGX ".number_format($this->dashboard_model->loanInterest())
			),
			array(
				"title"=>"Total Disbursed",
				"icon"=>"icon-touch-zoom",
				"comment"=>"",
				'icon-class'=>'primary',
				"value"=>"UGX ". number_format($this->dashboard_model->sumLoans())
			)

		);

		return $data;

	}

	function statData(){

		//top starts

		$data = array(
			array(
				"title"=>"Due  Today",
				"comment"=>"",
				"value"=>"UGX ".number_format($this->dashboard_model->dueToday()),
			),
			array(
				"title"=>"Interest Today",
				"comment"=>"",
				"value"=>"UGX ".number_format($this->dashboard_model->interestToday()),
			),
			array(
				"title"=>"Due loans  Today",
				"comment"=>"",
				"value"=>$this->dashboard_model->loansToday()." loans",
			)
		);

		return $data;

	}

	function insights(){

		//start notes
		$data = $this->dashboard_model->getMessages();
		return $data;

	}

	function numberData(){

		//overview

		$data = array(
			array(
				"key" => "Borrowers",
				"icon"=>"icon-users2",
				'icon-class'=>'dark',
				"value" => $this->dashboard_model->countBorrowers()
			),
			array(
				"key" => "Disbursed Total",
				"icon"=>"icon-stack-check",
				'icon-class'=>'info',
				"value" =>"UGX ". number_format($this->dashboard_model->sumLoans())
			),
			array(
				"key" => "Due this week",
				"icon"=>"icon-clipboard5",
				'icon-class'=>'success',
				"value" => "UGX ". number_format($this->dashboard_model->dueWeek())
			),
			array(
				"key" => "Due this month",
				"icon"=>"icon-calendar2",
				'icon-class'=>'indigo',
				"value" => "UGX ". number_format($this->dashboard_model->dueMonth())
			)
		);
		return $data;
	}

	function alerts(){

		$data = ['Management Modules coming soon,','Henry just deployed'];
		return $data;
	}

}
