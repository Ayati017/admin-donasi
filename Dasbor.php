<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		$akses_level = $this->session->userdata('akses_level');
		if($akses_level != "super admin"){
			$id_panti = $this->session->userdata('id_panti');
			$total_donasi = $this->db->query("select *,SUM(jumlah_donasi) AS total_donasi from tb_donasi where id_panti='$id_panti'")->row();
			$donasi_un = $this->db->query("select *,SUM(jumlah_donasi) AS total_donasi from tb_donasi where status='verified'")->row();
			$total_donatur = $this->db->query("select *,COUNT(id_donatur) AS total_donatur from tb_donasi where id_panti='$id_panti'")->row();
			$data = array(	'title' 	=> 'Halaman Dasboar',
						'total_donasi'	=> $total_donasi,
						'donasi_un'	=> $donasi_un,
						'total_donatur'	=> $total_donatur,
						'isi' 		=> 'admin/dasbor/list');
		}else{
			$total_donasi = $this->db->query("select *,SUM(jumlah_donasi) AS total_donasi from tb_donasi")->row();
			$donasi_un = $this->db->query("select *,SUM(jumlah_donasi) AS total_donasi from tb_donasi where status='verified'")->row();
			$total_donatur = $this->db->query("select *,COUNT(id_donatur) AS total_donatur from tb_donatur")->row();
			$total_panti = $this->db->query("select *,COUNT(id_panti) AS total_panti from tb_panti")->row();
			$data = array(	'title' 	=> 'Halaman Dasboar',
						'total_donasi'	=> $total_donasi,
						'donasi_un'	=> $donasi_un,
						'total_donatur'	=> $total_donatur,
						'total_panti'	=> $total_panti,
						'isi' 		=> 'admin/dasbor/list');
		}
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		
	}

	public function profil(){
		$id_admin = $this->session->userdata('id_admin');
		$admin = $this->user_model->detailadmin($id_admin);

		//validasi
		$valid = $this->form_validation;

		$valid->set_rules('username', 'Username', 'required',
						array('required'	=> 'Username harus diisi'));

		$valid->set_rules('email_admin', 'Email', 'required|valid_email',
						array(	'required'		=> 'Email harus diisi',
								'valid_email'	=> 'Format email tidak benar'));

		if ($valid->run()=== FALSE){
			//end validasi

		$data = array(	'title' => 'Update Profil : '.$admin->username,
						'admin'	=> $admin,
						'isi' 	=> 'admin/dasbor/profil');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		//ga ada yg error, maka masuk ke database
		}else{
			$i = $this->input;

			//jika input password lebih dari 6
			if (strlen($i->post('password')) > 6) {
			
			$data = array(	'id_admin'		=> $id_admin,
							'username'		=> $i->post('username'),
							'password_admin'=> sha1($i->post('password_admin')),
							'email_admin'	=> $i->post('email_admin'),
							'akses_level'	=> $i->post('akses_level'));

			}else{

			$data = array(	'id_admin'		=> $id_admin,
							'username'		=> $i->post('username'),
							'email_admin'	=> $i->post('email_admin'),						
							'akses_level'	=> $i->post('akses_level'));

			}

		//end if

			$this->user_model->editadmin($data);
			$this->session->set_flashdata('sukses', 'Profil telah diupdate');
			redirect(base_url('admin/dasbor/profil'),'refresh');
		}
			//end masuk ke database
	}

}

/* End of file Dashbor.php */
/* Location: ./application/controllers/admin/Dashbor.php */