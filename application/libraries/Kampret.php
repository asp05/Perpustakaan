<?php 

/**
 * 
 */
class Kampret
{
	
	function __construct()
	{
		$this->CI =& get_instance();
	}
	function cebong($template, $data = null)
	{
		$data['contents']	= $this->CI->load->view($template, $data, TRUE);
		$this->CI->load->view('pengguna/template_user',$data);
	}
}