<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_umkm extends CI_Model {
	public function list() {
		$this->db->select('*,tb_umkm.id as id_umkm, tb_pengguna.nama as user,tb_kecamatan.id as id_kecamatan, tb_kecamatan.nama as kecamatan, tb_sektor.id as id_sektor, tb_sektor.nama as sektor');
		$this->db->from('tb_umkm');
		$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_umkm.id_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_umkm.id_kec');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor');
		$this->db->where('tb_umkm.approve', 1);
		$this->db->order_by("tb_umkm.id", "desc");
		return $this->db->get()->result();
	}

	public function profile($id) {
		$this->db->select('*,tb_umkm.id as id_umkm, tb_umkm.tgl_dibuat as tgl_umkm, tb_pengguna.nama as user, tb_pengguna.tgl_dibuat as tgl_pengguna, tb_kecamatan.nama as kecamatan, tb_sektor.nama as sektor');
		$this->db->from('tb_umkm');
		$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_umkm.id_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_umkm.id_kec');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor');
		$this->db->where('tb_umkm.id', $id);
		return $this->db->get()->row();
	}
	
	public function addUmkm($data) {
		$this->db->insert('tb_umkm', $data);
	}

	public function editUmkm($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('tb_umkm', $data);
	}

	public function deleteUmkm($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_umkm');		
	}

	public function detail($umkm_id) {
		$this->db->select('*');
		$this->db->from('tb_umkm');
		$this->db->where('umkm_id', $umkm_id);
		return $this->db->get()->row();	
	}	
	
	public function delete($data) {
		$this->db->where('umkm_id', $data['umkm_id']);
		$this->db->delete('tb_umkm', $data);
	}	

	public function users() {
		$this->db->select('*');
		$this->db->from('tb_pengguna');
		$this->db->where('role_id NOT IN (1)');
		return $this->db->get()->result();
	}

	public function kecamatan() {
		$this->db->select('*');
		$this->db->from('tb_kecamatan');		
		return $this->db->get()->result();
	}
	
	public function umkm() {		
		return $this->db->count_all('tb_umkm');		
	}
	
	public function user() {		
		return $this->db->count_all('tb_user');		
	}

	// fungsi seputar kategori sektor

	public function sektor() {		
		$this->db->select('tb_sektor.*, count(tb_umkm.id_sektor) as jumlah_umkm');
		$this->db->from('tb_sektor');
		$this->db->join('tb_umkm', 'tb_sektor.id = tb_umkm.id_sektor', 'left');
		$this->db->group_by('tb_sektor.id');
		$this->db->order_by('tb_sektor.id', 'desc');
		return $this->db->get()->result();
	}

	public function addSektor($data) {
		$this->db->insert('tb_sektor', $data);
	}

	public function deleteSektor($data) {
		$this->db->where('id', $data['id']);
		$this->db->delete('tb_sektor', $data);
	}
}

/* End of file M_umkm.php */
/* Location: ./application/models/M_umkm.php */