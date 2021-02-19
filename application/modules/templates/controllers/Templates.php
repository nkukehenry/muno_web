<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends MX_Controller {

	
	public function main($data=null)
	{
		$this->lang->load('ui_lang', 'english');
		$this->load->view('main',$data);
	}

	public function plain($data)
	{
		$this->load->view('plain',$data);
	}

}
