<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_model extends CI_Model {

	public function get_produk_all()
	{
		$query = $this->db->get('tbl_buku');
		return $query->result_array();
	}
	
	public function get_produk_kategori($kategori)
	{
		if($kategori>0)
			{
				$this->db->where('kategori',$kategori);
			}
		$query = $this->db->get('tbl_buku');
		return $query->result_array();
	}
	
	public function get_kategori_all()
	{
		$query = $this->db->get('tbl_kategori');
		return $query->result_array();
	}
	
	public  function get_produk_id($id)
	{
		$this->db->select('tbl_buku.*,nama_kategori');
		$this->db->from('tbl_buku');
		$this->db->join('tbl_kategori', 'kategori=tbl_kategori.id','left');
   		$this->db->where('id_buku',$id);
        return $this->db->get();
    }	
	
	public function tambah_pelanggan($data)
	{
		$this->db->insert('tbl_user', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_order($data)
	{
		$this->db->insert('tbl_pinjam', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_detail_order($data)
	{
		$this->db->insert('tbl_detail_pinjam', $data);
	}
}
?>