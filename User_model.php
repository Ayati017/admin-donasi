<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//list data
	public function listing(){
		$this->db->select('*');
		$this->db->from('tb_donatur');
		$this->db->order_by('id_donatur', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	//detail
	public function detail($id_donatur){
		$this->db->select('*');
		$this->db->from('tb_donatur');
		$this->db->where('id_donatur', $id_donatur);
		$this->db->order_by('id_donatur', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	//edit
	public function edit($data){
		$this->db->where('id_donatur', $data['id_donatur']);
		$this->db->update('tb_donatur', $data);
	}

	//delete
	public function delete($data){
		$this->db->where('id_donatur', $data['id_donatur']);
		$this->db->delete('tb_donatur', $data);
	}

	//verifikasi
	public function aktif($data,$id_donatur){
		$this->db->where('id_donatur', $id_donatur);
		$this->db->update('tb_donatur', $data);
	}

	//verifikasi
	public function tidak($data,$id_donatur){
		$this->db->where('id_donatur', $id_donatur);
		$this->db->update('tb_donatur', $data);
	}

	//detail admin
	public function detailadmin($id_admin){
		$this->db->select('*');
		$this->db->from('tb_admin');
		$this->db->where('id_admin', $id_admin);
		$this->db->order_by('id_admin', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	//edit admin
	public function editadmin($data){
		$this->db->where('id_admin', $data['id_admin']);
		$this->db->update('tb_admin', $data);
	}

	//login
	public function login($username, $password_admin){
		$this->db->select('*');
		$this->db->from('tb_admin');
		$this->db->where(array(	'username' 			=> $username,
								'password_admin'	=> $password_admin));
		$this->db->order_by('id_admin', 'DESC');
		$query = $this->db->get();
		return $query->row();

	}



}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */