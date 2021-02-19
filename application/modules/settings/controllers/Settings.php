<?php

class Settings extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('settings_model');
		$this->module="settings";
	}
	
	public function getAll()
	{
		return $this->settings_model->getAll();
	}

}

?>