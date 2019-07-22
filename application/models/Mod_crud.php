<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_crud extends CI_Model {

	public function get_limit($no,$tabel){
		$this->db->limit($no);
		return $this->db->get($tabel);
	}
	public function get($tabel){
		return $this->db->get($tabel);
	}
	public function get_where($table,$id){
		return $this->db->get_where($table,$id);
	}
	public function insert($table,$data){
		if ($this->db->insert($table, $data)) {
			return true;
		}else{
			return false;
		}
	}
	public function delete($table,$id){
		$this->db->where($id);
		return $this->db->delete($table);
	}
	public function edit($tabel,$data,$id){
		$this->db->where($id);
		return $this->db->update($tabel, $data);
	}

}

/* End of file Mod_crud.php */
/* Location: ./application/models/Mod_crud.php */