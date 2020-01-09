<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panti_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//list data
	public function listing($id_panti){
		$this->db->select('*');
		$this->db->from('tb_panti');
		$this->db->order_by('id_panti', 'DESC');
		$akses_level = $this->session->userdata('akses_level');
		if($akses_level != "super admin"){
			$this->db->where('id_panti', $id_panti);
		}
		$query = $this->db->get();
		return $query->result();
	}

	//detail
	public function detail($id_panti){
		$this->db->select('*');
		$this->db->from('tb_panti');
		$this->db->where('id_panti', $id_panti);
		$this->db->order_by('id_panti', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	//tambah
	public function tambah($data){
		$this->db->insert('tb_panti', $data);
	}
	
	//tambah
	public function tambah_admin($data){
		$this->db->insert('tb_admin', $data);
	}

	//edit
	public function edit($data,$id_panti){
		$this->db->where('id_panti', $id_panti);
		$this->db->update('tb_panti', $data);
	}

	//delete
	public function delete($data){
		$this->db->where('id_panti', $data['id_panti']);
		$this->db->delete('tb_panti', $data);
	}
	


}