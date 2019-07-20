<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mod_crud');
	}
	public function index(){
		$data['judul']		= 'Dashboard Admin sekolah';
		$this->andisu->sugara('dasbor',$data);
	}
	public function fixed(){
		$data['judul']		= 'Daftar Siswa';
		$this->andisu->sugara('fixed',$data);
	}
}

/* End of file Home_admin.php */
/* Location: ./application/controllers/Home_admin.php */