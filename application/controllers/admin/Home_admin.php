<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mod_crud');
		if (!$this->session->userdata('nama_admin')) {
			redirect('login/admin');
		}
	}
	public function index(){
		$data['user']		= $this->andi->get('tbl_user')->num_rows();
		$data['title']		= 'Dashboard';
		$data['blm_aktif']	= $this->andi->get_where('tbl_user',['status' =>1])->num_rows();
		$data['guru']		= $this->andi->get_where('tbl_user',['status' => 2])->num_rows();
		$data['pegawai']	= $this->andi->get_where('tbl_user',['status' => 3])->num_rows();
		$data['siswa']			= $this->andi->get_where('tbl_user',['status'=>4])->num_rows();
		$data['buku']		= $this->andi->get('tbl_buku')->num_rows();
		$data['admin']		= $this->andi->get_where('tbl_admin',['nama_admin' => $this->session->userdata('nama_admin')])->row_array();
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