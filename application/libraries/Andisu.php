<?php 

/**
 * 
 */
class Andisu
{
	
	function __construct()
	{
		$this->CI =& get_instance();
	}
	function sugara($template, $data = null)
	{
		$data['contents']	= $this->CI->load->view($template, $data, TRUE);
		$this->CI->load->view('template', $data);
	}
}