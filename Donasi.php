<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donasi extends CI_Controller {

	//akses ke model
	public function __construct(){
		parent::__construct();
		$this->load->model('donasi_model');
	}

	//login pakai  session 

	//halaman utama
	public function index(){
		$id_panti = $this->session->userdata('id_panti');
		$donasi = $this->donasi_model->listing($id_panti);

		$data = array(	'title' => 'Data Donasi ('.count($donasi).')',
						'donasi'	=> $donasi,
						'isi' 	=> 'admin/donasi/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		
	}
	
	public function download(){
		$id_panti = $this->session->userdata('id_panti');
		$donasi = $this->donasi_model->listing($id_panti);

		$data = array(	'title' => 'Data Donasi ('.count($donasi).')',
						'donasi'	=> $donasi,
						'isi' 	=> 'admin/donasi/cetak');
		$this->load->view('admin/donasi/cetak', $data, FALSE);
		
	}

	//halaman tambah
	public function tambah(){
		$valid = $this->form_validation;

		$valid->set_rules('jumlah_donasi', 'jumlah', 'required',
						array('required'	=> 'jumlah harus diisi'));

		// $valid->set_rules('waktu_donasi', 'waktu', 'required',
						// array(	'required'		=> ' harus benar'));

		if ($valid->run()){
			//kalau upload tidak kosong
			if (!empty($_FILES['bukti_tf'] ['name'])) {
			
				$config['upload_path']   = './assets/upload/image/';
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['max_size']      = '1000'; // KB  
				$this->upload->initialize($config);
				if(! $this->upload->do_upload('bukti_tf')) {
					//end validasi

				$data = array(	'title' => 'Tambah Panti',
								'error'	=> $this->upload->display_errors(),
								'isi' 	=> 'admin/donasi/tambah');
				$this->load->view('admin/layout/wrapper', $data, FALSE);
				//ga ada yg error, maka masuk ke database
				}else{
					$id = $this->db->query('select id_donasi from tb_donasi order by id_donasi desc limit 1')->row();

					if (isset($id->id_donasi)) {
						$x = $id->id_donasi+1;
					}else{
						$x = 11;
					}
					//upload
					$upload_data        		= array('uploads' =>$this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
					$config['new_image']     	= './assets/upload/image/thumbs/';
					$config['create_thumb']   	= TRUE;
					$config['quality']       	= "100%";
					$config['maintain_ratio']   = TRUE;
					$config['width']       		= 360; // Pixel
					$config['height']       	= 360; // Pixel
					$config['x_axis']       	= 0;
					$config['y_axis']       	= 0;
					$config['thumb_marker']   	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$i = $this->input;
					$data = array(	
									'id_donasi'					=> $x,
									'jumlah_donasi'				=> $i->post('nama_donasi'),
									'waktu_donasi'				=> $i->post('norek_donasi'),
									'bukti_tf'					=> $upload_data['uploads']['file_name'],
									'status'					=> $i->post('status'),
									'id_donatur'				=> $i->post('id_donatur'),
									'id_panti'					=> $i->post('id_panti'));

					$this->donasi_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data ditambahkan');
					redirect(base_url('admin/donasi'),'refresh');
				}
			}else{
				$i = $this->input;
				$data = array(	
								'id_donasi'					=> $x,
								'jumlah_donasi'				=> $i->post('nama_donasi'),
								'waktu_donasi'				=> $i->post('norek_donasi'),
								'bukti_tf'					=> $upload_data['uploads']['file_name'],
								'status'					=> $i->post('status'),
								'id_donatur'				=> $i->post('id_donatur'),
								'id_panti'					=> $i->post('id_panti'));

				$this->donasi_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data ditambahkan');
				redirect(base_url('admin/donasi'),'refresh');
				
			}
		}
		$data = array(	'title' => 'Tambah Panti',
						'isi' 	=> 'admin/donasi/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		//end masuk ke database
}

	//halaman Edit
	public function edit($id_donasi){
		$donasi = $this->donasi_model->detail($id_donasi);

		//validasi
		$valid = $this->form_validation;

		$valid->set_rules('jumlah_donasi', 'jumlah', 'required',
						array('required'	=> 'jumlah harus diisi'));

		$valid->set_rules('waktu_donasi', 'waktu', 'required',
						array(	'required'		=> ' harus benar'));

		if ($valid->run()=== FALSE){
			//end validasi

		$data = array(	'title' 	=> 'Edit Donasi : '.$donasi->nama_donatur,
						'donasi'	=> $donasi,
						'isi' 		=> 'admin/donasi/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		//ga ada yg error, maka masuk ke database
		}else{
			$i = $this->input;

			//jika input password lebih dari 6
			if (strlen($i->post('password')) > 6) {
			
			$data = array(	
							'id_donasi'					=> $x,
							'jumlah_donasi'				=> $i->post('nama_donasi'),
							'waktu_donasi'				=> $i->post('norek_donasi'),
							'bukti_tf'					=> $upload_data['uploads']['file_name'],
							'status'					=> $i->post('status'),
							'id_donatur'				=> $i->post('id_donatur'),
							'id_panti'					=> $i->post('id_panti'));

			}else{

			$data = array(	
							'id_donasi'					=> $x,
							'jumlah_donasi'				=> $i->post('nama_donasi'),
							'waktu_donasi'				=> $i->post('norek_donasi'),
							'bukti_tf'					=> $upload_data['uploads']['file_name'],
							'status'					=> $i->post('status'),
							'id_donatur'				=> $i->post('id_donatur'),
							'id_panti'					=> $i->post('id_panti'));
			}

		//end if

			$this->donasi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/donasi'),'refresh');
		}
			//end masuk ke database
	}
	
	public function update(){
		
		//validasi
		$valid = $this->form_validation;

		$valid->set_rules('jumlah_donasi', 'jumlah', 'required',
						array('required'	=> 'jumlah harus diisi'));

		$valid->set_rules('waktu_donasi', 'waktu', 'required',
						array(	'required'		=> ' harus benar'));
		$i = $this->input;
		$id_donasi = $i->post('id_donasi');
		$config['upload_path']   = './assets/upload/image/';
		$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
		$config['max_size']      = '1000'; // KB  
		$this->upload->initialize($config);
		$this->upload->do_upload('bukti_tf');
		$file1 = $this->upload->data();
		$bukti_tf = $file1['file_name'];
			//upload
			$upload_data        		= array('uploads' =>$file1);
			// Image Editor
			$config['image_library']  	= 'gd2';
			$config['source_image']   	= './assets/upload/image/'.$file1['file_name']; 
			$config['new_image']     	= './assets/upload/image/thumbs/';
			$config['create_thumb']   	= TRUE;
			$config['quality']       	= "100%";
			$config['maintain_ratio']   = TRUE;
			$config['width']       		= 360; // Pixel
			$config['height']       	= 360; // Pixel
			$config['x_axis']       	= 0;
			$config['y_axis']       	= 0;
			$config['thumb_marker']   	= '';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$data = array(	
							'jumlah_donasi'				=> $i->post('jumlah_donasi'),
							'waktu_donasi'				=> $i->post('waktu_donasi'),
							'bukti_tf'					=> $bukti_tf,
							'status'					=> $i->post('status'));
			
			$this->donasi_model->edit($data,$id_donasi);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/donasi'),'refresh');
		
	}

	//halaman delete
	public function delete($id_donasi){
		$data = array('id_donasi'	=> $id_donasi);
		$this->donasi_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/donasi'),'refresh');

	}
	
	//halaman verifikasi
	public function verifikasi($id_donasi){
		$data = array('id_donasi'	=> $id_donasi);
		$data = array(	
			'status'					=> "verified"
		);
		

		//end if

		$this->donasi_model->verifikasi($data,$id_donasi);
		$this->session->set_flashdata('sukses', 'Data telah terverifikasi');
		redirect(base_url('admin/donasi'),'refresh');

	}
	
	//halaman unverifikasi
	public function unverifikasi($id_donasi){
		$data = array('id_donasi'	=> $id_donasi);
		$data = array(	
			'status'					=> "unverified"
		);
		

		//end if

		$this->donasi_model->unverifikasi($data,$id_donasi);
		$this->session->set_flashdata('sukses', 'Data Berbeda');
		redirect(base_url('admin/donasi'),'refresh');

	}

}

/* End of file Donasi.php */
/* Location: ./application/controllers/admin/Donasi.php */