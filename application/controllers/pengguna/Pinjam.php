<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjam extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('keranjang_model');
	}

	public function index()
	{
		$data['user']	= $this->andi->get_where('tbl_user',['nama_user' => $this->session->userdata('nama_user')])->row_array();		
		$kategori=($this->uri->segment(4))?$this->uri->segment(4):0;
		$data['produk'] = $this->keranjang_model->get_produk_kategori($kategori);
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->kampret->cebong('pengguna/list_buku',$data);
	}
	public function tampil_cart()
	{
		$data['user']	= $this->andi->get_where('tbl_user',['nama_user' => $this->session->userdata('nama_user')])->row_array();
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->kampret->cebong('pengguna/tampil_chart',$data);
	}
	
	function tambah()
	{
		$data_produk= array('id' => $this->input->post('id'),
							 'name' => $this->input->post('nama'),
							 'price' => $this->input->post('harga'),
							 'gambar' => $this->input->post('gambar'),
							 'qty' =>$this->input->post('qty')
							);
		$this->cart->insert($data_produk);
		redirect('pengguna/pinjam');
	}

	function hapus($rowid) 
	{
		if ($rowid=="all")
			{
				$this->cart->destroy();
			}
		else
			{
				$data = array('rowid' => $rowid,
			  				  'qty' =>0);
				$this->cart->update($data);
			}
		redirect('pengguna/pinjam/tampil_cart');
	}

	function ubah_cart()
	{
		$cart_info = $_POST['cart'] ;
		foreach( $cart_info as $id => $cart)
		{
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$gambar = $cart['gambar'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];
			$data = array('rowid' => $rowid,
							'price' => $price,
							'gambar' => $gambar,
							'amount' => $amount,
							'qty' => $qty);
			$this->cart->update($data);
		}
		redirect('pengguna/pinjam/tampil_cart');
	}

	public function proses_order()
	{
			//-------------------------Input data order------------------------------
		
		$data_order = array('tanggal_pinjam' => date('Y-m-d'),
					   		'id_siswa' => $this->session->userdata('id_user'));
		$id_order = $this->keranjang_model->tambah_order($data_order);
		//-------------------------Input data detail order-----------------------		
		if ($cart = $this->cart->contents())
			{
				foreach ($cart as $item)
					{
						$data_detail = array('id_pinjam' =>$id_order,
										'nama_buku' => $item['id'],
										'qty' => $item['qty'],
										'harga' => $item['price']);			
						$proses = $this->keranjang_model->tambah_detail_order($data_detail);
					}
			}
		//-------------------------Hapus shopping cart--------------------------		
		$this->cart->destroy();
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$data['user']	=$this->andi->get_where('tbl_user',['nama_user' => $this->session->userdata('nama_user')])->row_array();
		$this->kampret->cebong('pengguna/sukses',$data);
	}

}

/* End of file Pinjam.php */
/* Location: ./application/controllers/pengguna/Pinjam.php */