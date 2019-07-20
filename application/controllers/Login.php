<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mod_crud');
	}
	public function index(){
		$this->auth();
		if ($this->form_validation->run() == FALSE ) {
			$this->load->view('login');
		}else{
			$nama 		= $this->input->post('nama');
			$password	= $this->input->post('password');
			
			$user		= $this->mod_crud->get_where('admin',['nama_admin' => $nama])->row_array();
			if ($user) {
				if (password_verify($password, $user['password'])) {
					$data = array(
						'nama_admin' => $user['nama_admin']
					);
					$this->session->set_userdata( $data );
					redirect('home_admin');
				}else{
					echo "v";
				}
			}else{
				echo 'gagal';
			}
		}
	}
	private function auth(){
		$this->form_validation->set_rules('nama', 'nama', 'trim|required',[
			'required'	=> 'nama tidak boleh kosong'
		]);
		$this->form_validation->set_rules('password', 'password', 'trim|required',[
			'required'	=> 'password tidak boleh kosong'
		]);
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
	public function daftar(){
		$this->auth();
		if ($this->form_validation->run() == false) {
			$this->load->view('daftar');
		}else{
			$data = array(
				'nama_admin'	=> $this->input->post('nama'),
				'password'		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'waktu_masuk'	=> date('Y-m-d'),
				'gambar'		=> 'avatar5.png'	
			);
			$this->mod_crud->insert('admin',$data);
			$this->session->set_flashdata('berhasil_daftar', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success alert preview. This alert is dismissable.
              </div>');
			redirect('login');
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */