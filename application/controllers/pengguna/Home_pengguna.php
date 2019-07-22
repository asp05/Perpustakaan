<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_pengguna extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('keranjang_model');
		if (!$this->session->userdata('nama_user')) {
			redirect('login');
		}
	}
	public function index()
	{
		$data['user']	= $this->andi->get_where('tbl_user',['nama_user' => $this->session->userdata('nama_user')])->row_array();
		$data['produk'] = $this->keranjang_model->get_produk_all();
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->kampret->cebong('pengguna/list_buku',$data);		
	}
}

/* End of file Home_pengguna.php */
/* Location: ./application/controllers/pengguna/Home_pengguna.php */