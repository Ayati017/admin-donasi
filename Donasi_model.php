<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donasi_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//list data
	public function listing($id_panti){
		$this->db->select('*,tb_donasi.status as status,tb_donasi.id_panti as id_panti ');
		$this->db->from('tb_donasi');
		$this->db->join('tb_donatur ', 'tb_donatur.id_donatur=tb_donasi.id_donatur');
		$this->db->join('tb_panti ', 'tb_panti.id_panti = tb_donasi.id_panti');
		$this->db->order_by('id_donasi', 'DESC');
		$akses_level = $this->session->userdata('akses_level');
		if($akses_level != "super admin"){
			$this->db->where('tb_donasi.id_panti', $id_panti);
		}
		$query = $this->db->get();
		return $query->result();
	}

	//detail
	public function detail($id_donasi){
		$this->db->select('*');
		$this->db->from('tb_donasi');
		$this->db->join('tb_donatur ', 'tb_donatur.id_donatur=tb_donasi.id_donatur');
		$this->db->where('id_donasi', $id_donasi);
		$this->db->order_by('id_donasi', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	//edit
	public function edit($data,$id_donasi){
		$this->db->where('id_donasi', $id_donasi);
		$this->db->update('tb_donasi', $data);
	}

	//delete
	public function delete($data){
		$this->db->where('id_donasi', $data['id_donasi']);
		$this->db->delete('tb_donasi', $data);
	}
	
	//verifikasi
	public function verifikasi($data,$id_donasi){
		$this->db->where('id_donasi', $id_donasi);
		$this->db->update('tb_donasi', $data);
	}
	
	//verifikasi
	public function unverifikasi($data,$id_donasi){
		$this->db->where('id_donasi', $id_donasi);
		$this->db->update('tb_donasi', $data);
	}
}

/* End of file Donasi_model.php */
/* Location: ./application/models/Donasi_model.php */