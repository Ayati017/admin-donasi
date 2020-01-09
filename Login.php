<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index(){

		//validasi
		$valid = $this->form_validation;

		$valid->set_rules('username', 'Username', 'required',
				 array(	'required'	=> 'Username harus diisi'));

		$valid->set_rules('password_admin', 'Passord_admin', 'required|min_length[6]',
				 array(	'required'	=> 'Password harus diisi',
						'min_length'=> 'Password minimal 6 karakter'));

		if ($valid->run()=== FALSE) {
		//end validasi

		$data = array ('title' => 'Login Administrator');
		$this->load->view('admin/login_view', $data, FALSE);
		//cek username dan password dengan yang ada di database
		}else{
			$i 				=$this->input;
			$username 		=$i->post('username');
			$password_admin =$i->post('password_admin');
			//cek didatabase
			$check_login	= $this->user_model->login($username, $password_admin);
			//kalau ada record, maka create session dan redirect ke halaman dasbor
			if (count($check_login) == 1) {
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('akses_level', $check_login->akses_level);
				$this->session->set_userdata('id_admin', $check_login->id_admin);
				$this->session->set_userdata('email_admin', $check_login->email_admin);
				$this->session->set_userdata('id_panti', $check_login->id_panti);
				redirect(base_url('admin/dasbor'), 'refresh');
			}else{
				//kalau username dan password tidak cocok
				$this->session->set_flashdata('sukses', 'username dan password tidak cocok');
				redirect(base_url('login'), 'refresh');
			}
		}
		//end cek
	}

	//logout
	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('akses_level');
		$this->session->unset_userdata('id_admin');
		$this->session->unset_userdata('email_admin');
		$this->session->set_flashdata('sukses', 'Anda berhasil logout');
		redirect(base_url('login'), 'refresh');


	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */