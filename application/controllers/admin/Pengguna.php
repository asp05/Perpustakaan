<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mod_pengguna');
		if (!$this->session->userdata('nama_admin')) {
			redirect('login/admin');
		}
	}
	public function index(){
		$data['title']	= 'Pengguna';
		$data['judul']	= 'admin - pengguna';
		$data['admin']	= $this->andi->get_where('tbl_admin',['nama_admin'=> $this->session->userdata('nama_admin')])->row_array();
		$this->andisu->sugara('admin/pengguna',$data);
	}

	public function ajax_list(){
		$list 	= $this->mod_pengguna->get_datatables();
		$data 	= array();
		$no 	= $_POST['start'];
		foreach ($list as $x) {
			$no++;
			$button = '<div class="btn-group">';
            $button .= '<button type="button" class="btn btn-danger btn-flat dropdown-toggle" data-toggle="dropdown">';
            $button .= 'Aksi';
            $button .= '</button>';
            $button .= '<ul class="dropdown-menu" role="menu">';
            if ($x->id_status == 1) {
            	$button.= '<li><a href="'.base_url('admin/pengguna/ubah_status/'.$x->id_user).'" >Verifikasi</a></li>';
            }
            $button .= '<li><a onclick="return confirm(' . "'Apakah Anda Yakin?'" . ')" href="'.base_url('admin/pengguna/hapus/'.$x->id_user) .'">Hapus</a></li>';
            $button .= '</ul>';
            $button .= '</div>';
			$row	= array();
			$row[]	= $no; 
			$row[]	= $x->nama_user;
			$row[] 	= $x->nama_status;
			$row[]	= $button;
			$data[]	= $row;
		}
		$output = array(
			"draw"				=> $_POST['draw'],
			"recordsTotal"		=> $this->mod_pengguna->count_all(),
			"records_filtered"	=> $this->mod_pengguna->count_filtered(),
			"data"				=> $data	
		);
		echo json_encode($output);
	}
	public function hapus($id){
		$this->andi->delete('tbl_user',['id_user' => $id]);
		redirect('admin/Pengguna');
	}
	public function ubah_status($id){
		$this->andi->edit('tbl_user',['status' => 4],['id_user' => $id]);
		redirect('admin/pengguna');
	}

}

/* End of file Pengguna.php */
/* Location: ./application/controllers/admin/Pengguna.php */