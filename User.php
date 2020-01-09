<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	//akses ke model
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	//login pakai  session 

	//halaman utama
	public function index(){
		$user = $this->user_model->listing();

		$data = array(	'title' => 'Data User ('.count($user).')',
						'user'	=> $user,
						'isi' 	=> 'admin/user/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		
	}

	//halaman tambah
	public function tambah(){
		$valid = $this->form_validation;

		$valid->set_rules('nama_donatur', 'Nama', 'required',
						array('required'	=> 'Nama harus diisi'));

		$valid->set_rules('email_donatur', 'Email', 'required|valid_email',
						array(	'required'		=> 'Email harus diisi',
								'valid_email'	=> 'Format email tidak benar'));

		$valid->set_rules('password', 'Password', 'required|min_length[6]',
						array(	'required'		=> 'Password harus diisi',
								'min_length'	=> 'Password minimal 6 karakter'));

		if ($valid->run()=== FALSE){
			//end validasi

		$data = array(	'title' => 'Tambah User',
						'isi' 	=> 'admin/user/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		//ga ada yg error, maka masuk ke database
		}else{
			$id = $this->db->query('select id_donatur from tb_donatur order by id_donatur desc limit 1')->row();

			if (isset($id->id_donatur)) {
				$x = $id->id_donatur+1;
			}else{
				$x = 11;
			}

			$i = $this->input;
			$data = array(	'id_donatur'		=> $x,
							'nama_donatur'		=> $i->post('nama_donatur'),
							'email_donatur'		=> $i->post('email_donatur'),
							'password'			=> sha1($i->post('password')),
							'alamat_donatur'	=> $i->post('alamat_donatur'),
							'akses_level'		=> $i->post('akses_level'),
							'telp_donatur'		=> $i->post('telp_donatur'));

			$this->user_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data ditambahkan');
			redirect(base_url('admin/user'),'refresh');
		}
			//end masuk ke database
	}

	//halaman Edit
	public function edit($id_donatur){
		$user = $this->user_model->detail($id_donatur);

		//validasi
		$valid = $this->form_validation;

		$valid->set_rules('nama_donatur', 'Nama', 'required',
						array('required'	=> 'Nama harus diisi'));

		$valid->set_rules('email_donatur', 'Email', 'required|valid_email',
						array(	'required'		=> 'Email harus diisi',
								'valid_email'	=> 'Format email tidak benar'));

		if ($valid->run()=== FALSE){
			//end validasi

		$data = array(	'title' => 'Edit User : '.$user->nama_donatur,
						'user'	=> $user,
						'isi' 	=> 'admin/user/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		//ga ada yg error, maka masuk ke database
		}else{
			$i = $this->input;

			//jika input password lebih dari 6
			if (strlen($i->post('password')) > 6) {
			
			$data = array(	'id_donatur'		=> $id_donatur,
							'nama_donatur'		=> $i->post('nama_donatur'),
							'email_donatur'		=> $i->post('email_donatur'),
							'password'			=> sha1($i->post('password')),
							'alamat_donatur'	=> $i->post('alamat_donatur'),
							'akses_level'		=> $i->post('akses_level'),
							'telp_donatur'		=> $i->post('telp_donatur'));

			}else{

			$data = array(	'id_donatur'		=> $id_donatur,
							'nama_donatur'		=> $i->post('nama_donatur'),
							'email_donatur'		=> $i->post('email_donatur'),
							'alamat_donatur'	=> $i->post('alamat_donatur'),
							'akses_level'		=> $i->post('akses_level'),
							'telp_donatur'		=> $i->post('telp_donatur'));

			}

		//end if

			$this->user_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/user'),'refresh');
		}
			//end masuk ke database
	}

	//halaman delete
	public function delete($id_donatur){
		$data = array('id_donatur'	=> $id_donatur);
		$this->user_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/user'),'refresh');

	}

	//halaman verifikasi
	public function aktif($id_donatur){
		$data = array('id_donatur'	=> $id_donatur);
		$data = array(	
			'status'					=> "aktif"
		);
		

		//end if

		$this->user_model->aktif($data,$id_donatur);
		$this->session->set_flashdata('sukses', 'Akun dapat digunakan');
		redirect(base_url('admin/user'),'refresh');

	}

	//halaman unverifikasi
	public function tidak($id_donatur){
		$data = array('id_donatur'	=> $id_donatur);
		$data = array(	
			'status'					=> "tidak"
		);
		

		//end if

		$this->user_model->tidak($data,$id_donatur);
		$this->session->set_flashdata('sukses', 'Akun Sudah tidak aktif');
		redirect(base_url('admin/user'),'refresh');

	}

}

/* End of file User.php */
/* Location: ./application/controllers/admin/User.php */