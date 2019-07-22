<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

 function __construct(){
		parent::__construct();
		$this->load->model('mod_buku');
		if (!$this->session->userdata('nama_admin')) {
			redirect('login/admin');
		}
	}
	public function index(){
		$data['title']	= 'Buku';
		$data['judul']	= 'admin - Buku';
		$data['admin']	= $this->andi->get_where('tbl_admin',['nama_admin'=> $this->session->userdata('nama_admin')])->row_array();
		$this->andisu->sugara('admin/buku' ,$data);
	}

	public function ajax_list(){
		$list 	= $this->mod_buku->get_datatables();
		$data 	= array();
		$no 	= $_POST['start'];
		foreach ($list as $x) {
			$no++;
			$button = '<div class="btn-group">';
            $button .= '<button type="button" class="btn btn-danger btn-flat dropdown-toggle" data-toggle="dropdown">';
            $button .= 'Aksi';
            $button .= '</button>';
            $button .= '<ul class="dropdown-menu" role="menu">';
            $button .= '<li><a onclick="return confirm(' . "'Apakah Anda Yakin?'" . ')" href="'.base_url('admin/buku/hapus/'.$x->id_buku) .'">Hapus</a></li>';
            $button .= '<li><a href="'.base_url('admin/buku/edit/'.$x->id_buku) .'">edit</a></li>';
            $button .= '</ul>';
            $button .= '</div>';
			$row	= array();
			$row[]	= $no; 
			$row[]	= $x->nama_buku;
			$row[]	= '<img src="'.base_url('assets/dist/img/'.$x->gambar) .'" class="img img-responsive" alt="User Image">';
			$row[] 	= $x->nama_kategori;
			$row[]	= $button;
			$data[]	= $row;
		}
		$output = array(
			"draw"				=> $_POST['draw'],
			"recordsTotal"		=> $this->mod_buku->count_all(),
			"records_filtered"	=> $this->mod_buku->count_filtered(),
			"data"				=> $data	
		);
		echo json_encode($output);
	}
	public function hapus($id){
		$this->andi->delete('tbl_buku',['id_buku' => $id]);
		redirect('admin/buku');
	}

}

/* End of file Buku.php */
/* Location: ./application/controllers/admin/Buku.php */