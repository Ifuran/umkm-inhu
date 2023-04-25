<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function user() {
		$this->db->select('*');
		$this->db->from('tb_pengguna');
		$this->db->where('role_id NOT IN (1)');
		$this->db->order_by('id', 'desc');
		return $this->db->get()->result();
	}	

	public function profile($id) {
		$this->db->select('*, tb_pengguna.id as id_pengguna, tb_pengguna.nama as user, tb_kecamatan.nama as kecamatan');
		$this->db->from('tb_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_pengguna.asal_kec');
		$this->db->where('tb_pengguna.id', $id);
		return $this->db->get()->row();		
	}

	public function delete($data) {
		$this->db->where('id', $data['id']);
		$this->db->delete('tb_pengguna', $data);
	}

	public function registration($data) {
		$this->db->insert('tb_pengguna', $data);
	}

	public function edit($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('tb_pengguna', $data);
	}	

	public function kecamatan() {
		$this->db->select('*');
		$this->db->from('tb_kecamatan');
		return $this->db->get()->result();
	}

	public function deleteUmkm($data) {
		$this->db->where('id_pengguna', $data['id']);
		$this->db->delete('tb_umkm');
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */
?>