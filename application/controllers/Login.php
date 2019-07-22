<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('nama_user')) {
			redirect('pengguna/home_pengguna');
		}
		$this->auth();
		if ($this->form_validation->run() == false) {
			$this->load->view('masuk/login');
		}else{
			$nama 		= $this->input->post('nama');
			$password 	= $this->input->post('password');

			$user = $this->andi->get_where('tbl_user',['nama_user' => $nama])->row_array();
			if ($user) {
						
				if ($user['status'] == 2||$user['status'] == 3||$user['status'] == 4) {
					if (password_verify($password, $user['password'])) {
						$data = array(
							'id_user'	=> $user['id_user'],
							'nama_user' => $user['nama_user'],
							'status'	=> $user['status'],
						);
						
						$this->session->set_userdata( $data );
						redirect('pengguna/home_pengguna');
					}else{
						$this->session->set_flashdata('berhasil','<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i>Siswa!</h4>
                wrong password
              </div>');
			redirect('login/index');
					}
				}else{
					$this->session->set_flashdata('berhasil','<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i>Siswa!</h4>
                Untuk akun siswa,harap meminta verifikasi admin terlebih dahulu kepada petugas perpus
              </div>');
			redirect('login/index');
				}
			}else{
				$this->session->set_flashdata('berhasil','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Tidak ada user
              </div>');
			redirect('login/index');
			}
		}
	}
	public function daftar()
	{
		$this->auth();
		if ($this->form_validation->run() == false) {
			$data['status']	= $this->andi->get_limit('3','tbl_status')->result();
			$this->load->view('masuk/daftar',$data);
		} else {
			$data = array(
				'nama_user'		=> $this->input->post('nama'),
				'password'		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'status'		=> $this->input->post('status'),
				'gambar'		=> 'avatar5.png'
			);
			$this->andi->insert('tbl_user',$data);
			$this->session->set_flashdata('berhasil','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success alert preview. This alert is dismissable.
              </div>');
			redirect('login/index');
		}
	}
	public function auth(){
		$this->form_validation->set_rules('nama', 'nama', 'trim|required',['required'	=> 'nama tidak boleh kosong']);
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]',[
			'required'	=> 'password tidak boleh kosong',
			'min_length'=> 'password terlalu pendek',
			]);
	}
	public function admin(){
		if ($this->session->userdata('nama_admin')) {
			redirect('admin/home_admin');
		}
		$this->auth();
		if ($this->form_validation->run() == false ) {
			$this->load->view('masuk/login_admin');
		}else{
			$nama = $this->input->post('nama');
			$password = $this->input->post('password');

			$admin = $this->andi->get_where('tbl_admin',['nama_admin' => $nama])->row_array();
			if ($admin) {
				if (password_verify($password , $admin['password'])) {
					$data = array(
						'nama_admin' => $admin['nama_admin']
					);
					$this->session->set_userdata( $data );
					redirect('admin/home_admin');
				}else{
					$this->session->set_flashdata('berhasil','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                wrong password
              	</div>');		
				}
			}else{
				$this->session->set_flashdata('berhasil','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Tidak ada user
              	</div>');
			}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login/index');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */