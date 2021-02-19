<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils {


	public function __construct()
	{
		$this->CI =& get_instance();
		$this->curency= $this->CI->config->item('currency_symbol');
	}

	function smartDate($date){
		return date('jS F,Y', strtotime($date));
	}
	function money($number){

		return $this->curency.number_format($number,2);
	}
    


}