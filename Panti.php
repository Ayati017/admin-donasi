<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panti extends CI_Controller {

	//akses ke model
	public function __construct(){
		parent::__construct();
		$this->load->model('panti_model');
	}

	//login pakai  session 

	//halaman utama
	public function index(){
		$id_panti = $this->session->userdata('id_panti');
		$panti = $this->panti_model->listing($id_panti);

		$data = array(	'title' => 'Data Panti ('.count($panti).')',
						'panti'	=> $panti,
						'isi' 	=> 'admin/panti/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		
	}

	//halaman tambah
	public function tambah(){
		$valid = $this->form_validation;

		$valid->set_rules('nama_panti', 'Nama', 'required',
						array('required'	=> 'Nama harus diisi'));

		$valid->set_rules('alamat_panti', 'Alamat', 'required',
						array(	'required'		=> 'alamat harus benar'));

		if ($valid->run()){
			
			if($this->input->post('edit')=="Yes"){
				if (!empty($_FILES['foto'] ['name']) or !empty($_FILES['foto_kegiatan_panti'] ['name'])) {
			
					$config['upload_path']   = './assets/upload/image/';
					$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
					$config['max_size']      = '1000'; // KB  
					$this->upload->initialize($config);
					$this->upload->do_upload('foto');
					$file1 = $this->upload->data();
					$foto = $file1['file_name'];
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
					$this->upload->do_upload('foto_kegiatan_panti');
					$file2 = $this->upload->data();
					$foto_kegiatan_panti = $file2['file_name'];
						//upload
						$upload_data        		= array('uploads' =>$file2);
						// Image Editor
						$config['image_library']  	= 'gd2';
						$config['source_image']   	= './assets/upload/image/'.$file2['file_name']; 
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
					$data = array(	'nama_panti'				=> $i->post('nama_panti'),
									'norek_panti'				=> $i->post('norek_panti'),
									'bank_panti'				=> $i->post('bank_panti'),
									'namarek_panti'				=> $i->post('namarek_panti'),
									'alamat_panti'				=> $i->post('alamat_panti'),
									'foto'						=> $foto,
									'lat'						=> $i->post('lat'),
									'lng'						=> $i->post('lng'),
									'telp_panti'				=> $i->post('telp_panti'),
									'status'					=> $i->post('status'),
									'email'						=> $i->post('email'),
									'keterangan_panti'			=> $i->post('keterangan_panti'),
									'nama_kegiatan_panti'		=> $i->post('nama_kegiatan_panti'),
									'foto_kegiatan_panti'				=> $foto_kegiatan_panti,
									'deskripsi_kegiatan_panti'	=> $i->post('deskripsi_kegiatan_panti'));
				}else{
					$i = $this->input;
					$data = array(	'nama_panti'				=> $i->post('nama_panti'),
								'norek_panti'				=> $i->post('norek_panti'),
								'bank_panti'				=> $i->post('bank_panti'),
								'namarek_panti'				=> $i->post('namarek_panti'),
								'alamat_panti'				=> $i->post('alamat_panti'),
								// 'foto'						=> $foto,
								'lat'						=> $i->post('lat'),
								'lng'						=> $i->post('lng'),
								'telp_panti'				=> $i->post('telp_panti'),
								'status'					=> $i->post('status'),
								'email'						=> $i->post('email'),
								'keterangan_panti'			=> $i->post('keterangan_panti'),
								'nama_kegiatan_panti'		=> $i->post('nama_kegiatan_panti'),
								// 'foto_kegiatan_panti'				=> $foto_kegiatan_panti,
								'deskripsi_kegiatan_panti'	=> $i->post('deskripsi_kegiatan_panti'));
				}
				$this->panti_model->edit($data,$i->post('id_panti'));
				redirect(base_url('admin/panti'),'refresh');
			}else{
				
			//kalau upload tidak kosong
			if (!empty($_FILES['foto'] ['name']) or !empty($_FILES['foto_kegiatan_panti'] ['name'])) {
		
				$config['upload_path']   = './assets/upload/image/';
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['max_size']      = '1000'; // KB  
				$this->upload->initialize($config);
				$this->upload->do_upload('foto');
				$file1 = $this->upload->data();
				$foto = $file1['file_name'];
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
				$this->upload->do_upload('foto_kegiatan_panti');
				$file2 = $this->upload->data();
				$foto_kegiatan_panti = $file2['file_name'];
					//upload
					$upload_data        		= array('uploads' =>$file2);
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/image/'.$file2['file_name']; 
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
				if( ! $foto or ! $foto_kegiatan_panti) {
				//end validasi

					$data = array(	'title' => 'Tambah Panti',
									'error'	=> $this->upload->display_errors(),
									'isi' 	=> 'admin/panti/tambah');
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					//ga ada yg error, maka masuk ke database
				}else{
					$id = $this->db->query('select id_panti from tb_panti order by id_panti desc limit 1')->row();

					if (isset($id->id_panti)) {
						$x = $id->id_panti+1;
					}else{
						$x = 11;
					}
					$i = $this->input;
					$data = array(	
						'id_panti'					=> $x,
						'nama_panti'				=> $i->post('nama_panti'),
						'norek_panti'				=> $i->post('norek_panti'),
						'bank_panti'				=> $i->post('bank_panti'),
						'namarek_panti'				=> $i->post('namarek_panti'),
						'alamat_panti'				=> $i->post('alamat_panti'),
						'lat'						=> $i->post('lat'),
						'lng'						=> $i->post('lng'),
						'telp_panti'				=> $i->post('telp_panti'),
						'foto'						=> $foto,
						'status'					=> $i->post('status'),
						'email'						=> $i->post('email'),
						'keterangan_panti'			=> $i->post('keterangan_panti'),
						'nama_kegiatan_panti'		=> $i->post('nama_kegiatan_panti'),
						'foto_kegiatan_panti'				=> $foto_kegiatan_panti,
						'deskripsi_kegiatan_panti'	=> $i->post('deskripsi_kegiatan_panti')
					);

					$this->panti_model->tambah($data);
					
					$data_admin = array(	
						'id_panti'					=> $x,
						'username'				=> $i->post('nama_panti'),
						'password_admin'				=> $x,
						'email_admin'						=> $i->post('email'),
						'akses_level'			=> "panti sosial"
					);

					$this->panti_model->tambah_admin($data_admin);
					
					//proses
					$this->load->library('email');

					$config['charset'] = 'utf-8';
               $config['useragent'] = 'Codeigniter';
               $config['protocol'] = 'smtp';
               $config['mailtype'] = 'html';
               $config['smtp_host'] = 'ssl://admindonasi.com';
               $config['smtp_port'] = '465';
               $config['smtp_timeout'] = '5';
               $config['smtp_user'] = 'official.donation131@gmail.com'; //isi dengan email gmail
               $config['smtp_pass'] = 'admindonasi'; //isi dengan password
               $config['crlf'] = "\r\n";
               $config['newline'] = "\r\n";
               $config['wordwrap'] = TRUE;

					$this->email->initialize($config);

					$this->email->from('official.donation131@gmail.com', "Pemberitahuan Login");
					$this->email->to($i->post('email', TRUE));
					$this->email->subject('Pemberitahuan Login');
					$halaman="http://www.admindonasi.com/admin_donasi/";
					$this->email->message(
					  'Thank you for join us<br/><br/>
					  Now. you can sign in (<a href="'.$halaman.'">Klik Here</a>) with.<br/>
					  Username:'.$i->post('nama_panti').'<br/>
					  Password:'.$x.'<br/><br/>
					  Best Regards.<br/>
					  E-donation Official'
					);
					$this->email->send();
					
					$this->session->set_flashdata('sukses', 'Data ditambahkan');
					redirect(base_url('admin/panti'),'refresh');
				}
			}else{
				
				$id = $this->db->query('select id_panti from tb_panti order by id_panti desc limit 1')->row();

				if (isset($id->id_panti)) {
					$x = $id->id_panti+1;
				}else{
					$x = 11;
				}
				$i = $this->input;
				$data = array(	
								'id_panti'					=> $x,
								'nama_panti'				=> $i->post('nama_panti'),
								'norek_panti'				=> $i->post('norek_panti'),
								'bank_panti'				=> $i->post('bank_panti'),
								'namarek_panti'				=> $i->post('namarek_panti'),
								'alamat_panti'				=> $i->post('alamat_panti'),
								'lat'						=> $i->post('lat'),
								'lng'						=> $i->post('lng'),
								'telp_panti'				=> $i->post('telp_panti'),
								// 'foto'						=> $upload_data['uploads']['file_name'],
								'status'					=> $i->post('status'),
								'email'						=> $i->post('email'),
								'keterangan_panti'			=> $i->post('keterangan_panti'),
								'nama_kegiatan_panti'		=> $i->post('nama_kegiatan_panti'),
								'deskripsi_kegiatan_panti'	=> $i->post('deskripsi_kegiatan_panti'));

				$this->panti_model->tambah($data);
				$data_admin = array(	
						'id_panti'					=> $x,
						'username'				=> $i->post('nama_panti'),
						'password_admin'				=> $x,
						'email_admin'						=> $i->post('email'),
						'akses_level'			=> "panti sosial"
					);

					$this->panti_model->tambah_admin($data_admin);
					
					//proses
					$this->load->library('email');

					$config['charset'] = 'utf-8';
					$config['useragent'] = 'Codeigniter';
					$config['protocol'] = 'smtp';
					$config['mailtype'] = 'html';
					$config['smtp_host'] = 'ssl://admindonasi.com';
					$config['smtp_port'] = '465';
					$config['smtp_timeout'] = '5';
					$config['smtp_user'] = 'official.donation131@gmail.com'; //isi dengan email gmail
					$config['smtp_pass'] = 'admindonasi'; //isi dengan password
					$config['crlf'] = "\r\n";
					$config['newline'] = "\r\n";
					$config['wordwrap'] = TRUE;

					$this->email->initialize($config);

					$this->email->from('official.donation131@gmail.com', "Pemberitahuan Login");
					$this->email->to($i->post('email'));
					$this->email->subject('Pemberitahuan Login');
					$halaman="http://www.admindonasi.com/admin_donasi/";
					$this->email->message(
					  'Thank you for join us<br/><br/>
					  Now. you can sign in (<a href="'.$halaman.'">Klik Here</a>) with.<br/>
					  Username:'.$i->post('nama_panti').'<br/>
					  Password:'.$x.'<br/><br/>
					  Best Regards.<br/>
					  E-donation Official'
					);
					$this->email->send();
				$this->session->set_flashdata('sukses', 'Data ditambahkan');
				redirect(base_url('admin/panti'),'refresh');
			}
			
			}
		}
		$data = array(	'title' => 'Tambah Panti',
						'isi' 	=> 'admin/panti/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		//end masuk ke database
}

	//halaman Edit
	public function edit($id_panti){
		$panti = $this->panti_model->detail($id_panti);

		//validasi
		$valid = $this->form_validation;

		$valid->set_rules('nama_panti', 'Nama', 'required',
						array('required'	=> 'Nama harus diisi'));

		// $valid->set_rules('alamat_panti', 'Alamat', 'required|',
						// array(	'required'		=> 'Nama harus diisi'));

		if ($valid->run()=== FALSE){
			//end validasi

			$data = array(	'title' => 'Edit User : '.$panti->nama_panti,
							'panti'	=> $panti,
							'isi' 	=> 'admin/panti/edit');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//ga ada yg error, maka masuk ke database
		}else{
			if (!empty($_FILES['foto'] ['name']) or !empty($_FILES['foto_kegiatan_panti'] ['name'])) {
				$i = $this->input;

				$config['upload_path']   = './assets/upload/image/';
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['max_size']      = '1000'; // KB  
				$this->load->library('upload', $config);
				// $this->upload->initialize($config);
				$this->upload->do_upload('foto');
				$file1 = $this->upload->data();
				$foto = $file1['file_name'];
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
					// $this->load->library('image_lib', $config);
					// $this->image_lib->resize();
				$this->upload->do_upload('foto_kegiatan_panti');
				$file2 = $this->upload->data();
				$foto_kegiatan_panti = $file2['file_name'];
					//upload
					$upload_data        		= array('uploads' =>$file2);
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/image/'.$file2['file_name']; 
					$config['new_image']     	= './assets/upload/image/thumbs/';
					$config['create_thumb']   	= TRUE;
					$config['quality']       	= "100%";
					$config['maintain_ratio']   = TRUE;
					$config['width']       		= 360; // Pixel
					$config['height']       	= 360; // Pixel
					$config['x_axis']       	= 0;
					$config['y_axis']       	= 0;
					$config['thumb_marker']   	= '';
					// $this->load->library('image_lib', $config);
					// $this->image_lib->resize();
					$data = array(	'nama_panti'				=> $i->post('nama_panti'),
								'norek_panti'				=> $i->post('norek_panti'),
								'bank_panti'				=> $i->post('bank_panti'),
								'namarek_panti'				=> $i->post('namarek_panti'),
								'alamat_panti'				=> $i->post('alamat_panti'),
								// 'foto'						=> $foto,
								'lat'						=> $i->post('lat'),
								'lng'						=> $i->post('lng'),
								'telp_panti'				=> $i->post('telp_panti'),
								'status'					=> $i->post('status'),
								'email'						=> $i->post('email'),
								'keterangan_panti'			=> $i->post('keterangan_panti'),
								'nama_kegiatan_panti'		=> $i->post('nama_kegiatan_panti'),
								// 'foto_kegiatan_panti'				=> $foto_kegiatan_panti,
								'deskripsi_kegiatan_panti'	=> $i->post('deskripsi_kegiatan_panti'));
			}else{
				$i = $this->input;
				$data = array(	'nama_panti'				=> $i->post('nama_panti'),
								'norek_panti'				=> $i->post('norek_panti'),
								'bank_panti'				=> $i->post('bank_panti'),
								'namarek_panti'				=> $i->post('namarek_panti'),
								'alamat_panti'				=> $i->post('alamat_panti'),
								// 'foto'						=> $foto,
								'lat'						=> $i->post('lat'),
								'lng'						=> $i->post('lng'),
								'telp_panti'				=> $i->post('telp_panti'),
								'status'					=> $i->post('status'),
								'email'						=> $i->post('email'),
								'keterangan_panti'			=> $i->post('keterangan_panti'),
								'nama_kegiatan_panti'		=> $i->post('nama_kegiatan_panti'),
								// 'foto_kegiatan_panti'				=> $foto_kegiatan_panti,
								'deskripsi_kegiatan_panti'	=> $i->post('deskripsi_kegiatan_panti'));
			}

			$this->panti_model->edit($data,$id_panti);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/panti'),'refresh');
		}
			//end masuk ke database
	}

	//halaman delete
	public function status($id_panti,$status){
	    if($status=="active"){
            $status_update="non active";
            $flash="Panti Telah Di Non Aktifkan";
	    }else{
	        $status_update="non active";
            $flash="Panti Telah Di Aktifkan";
	    }
		$data = array(	'status_panti' => $status_update);
		$this->panti_model->edit($data,$id_panti);
		$this->session->set_flashdata('sukses', $flash);
		redirect(base_url('admin/panti'),'refresh');

	}
	
	//halaman delete
	public function delete($id_panti){
		$data = array('id_panti'	=> $id_panti);
		$this->panti_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/panti'),'refresh');

	}
	
	


}

/* End of file User.php */
/* Location: ./application/controllers/admin/User.php */