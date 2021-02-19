<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu {
	
	var $CI;
	
	public function __construct()
	{
		//instantiate CI
		$this->CI =& get_instance();
		$menu_arr = array();
	}
	
	public function generate()
	{
		$menu_arr[] = array('text' => 'Dashboard','icon'=>'icofont icofont-dashboard','controller' => 'stats', 'function' => 'index');
		$menu_arr[] = array('text' => 'Loans','icon'=>'icofont icofont-money-bag','controller' => 'loan', 'function' => 'view',
			'submenu' => array(
				array(
					'text' => 'Loan List', 
					'controller' => 'loan', 
					'function' => 'view'
				),
				array(
					'text' => 'Loan Summary', 
					'controller' => 'report', 
					'function' => 'summary'
				),
				array(
					'text' => 'Loan Products', 
					'controller' => 'loan', 
					'function' => 'view_loan_types'
				),
				array(
					'text' => 'Loan Calculator', 
					'controller' => 'loan', 
					'function' => 'calculator'
				)
			)
		);
		$menu_arr[] = array('text' => 'Borrowers', 'icon'=>'icofont icofont-people', 'controller' => 'borrower', 'function' => 'index',
			'submenu' => array(
				array(
					'text' => 'Borrower List', 
					'controller' => 'borrower', 
					'function' => 'viewall'
				),
				array(
					'text' => 'Add Borrower', 
					'controller' => 'borrower', 
					'function' => 'add'
				)
			)
		);
		$menu_arr[] = array('text' => 'Payments', 'icon'=>'icofont icofont-penalty-card','controller' => 'stats', 'function' => 'payments',
			'submenu' => array(
				array(
					'text' => 'Received', 
					'controller' => 'stats', 
					'function' => 'payments/received'
				),
				array(
					'text' => 'incoming', 
					'controller' => 'stats', 
					'function' => 'payments/incoming'
				)
			)
		);
		
		
		//print_r($menu_arr);
		
		$level = 0;
		$this->print_link($menu_arr, $level);
		
	}

	function print_link($complex_array, &$level)
	{
		$base_url = base_url();

		echo  '<ul class="main-navigation">';
		$i = 0;
	    foreach ($complex_array as $n)
	    {
	    	$has_sub = (array_key_exists('submenu', $n) AND is_array($n['submenu'])) ? TRUE:FALSE;
			
			$class = $has_sub?"class='nav-item'":"class='nav-item'";

			if($i==0)
				$class ="class='nav-item has-class'";
			
			if($has_sub) {

	    	echo "<li $class><a href='#!'>
	    	<i class='{$n['icon']}'></i>
			<span>{$n['text']}</span>
	    	</a>";
			//str_repeat('-',$level).$n['text'].'-'.$n['controller'].'-'.$n['function'].'<br />';
				//$level++;
				echo "<ul class='tree-1'>";
				foreach ($n['submenu'] as $sub)
	            {
	                echo "<li><a href='{$base_url}{$sub['controller']}/{$sub['function']}'>
	                {$sub['text']}</a>
                        </li>";
                }
	            echo "</ul>";
				//$level--;
				echo  "</li>";
			}
			else{
				echo "<li $class><a href='{$base_url}{$n['controller']}/{$n['function']}'>
				<i class='{$n['icon']}'></i>
				<span>{$n['text']}</span>
				</a></li>";
			}
        
			$i++;
	    }
		echo "</ul>";
	}
	
}