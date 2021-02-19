<?php

class Settings_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	public function getAll()
	{
		$qry  = $this->db->get('settings');
		return $qry->row();
	}

}

?>