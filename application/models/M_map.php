<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_map extends CI_Model {
	
	public function umkm() {
		$this->db->select('*,tb_umkm.id as id_umkm, tb_pengguna.nama as user, tb_kecamatan.nama as kecamatan, tb_sektor.nama as sektor');
		$this->db->from('tb_umkm');
		$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_umkm.id_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_umkm.id_kec');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor');
		return $this->db->get()->result();
	}	
	
	public function umkm_kec($id) {
		$this->db->select('*,tb_umkm.id as id_umkm, tb_pengguna.nama as user, tb_kecamatan.nama as kecamatan, tb_kecamatan.id as id_kecamatan, tb_sektor.nama as sektor');
		$this->db->from('tb_umkm');
		$this->db->where('tb_umkm.id_kec', $id);
		$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_umkm.id_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_umkm.id_kec');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor');
		return $this->db->get()->result();
	}

	public function umkm_sektor($id) {
		$this->db->select('*,tb_umkm.id as id_umkm, tb_pengguna.nama as user, tb_kecamatan.nama as kecamatan, tb_kecamatan.id as id_kecamatan, tb_sektor.nama as sektor');
		$this->db->from('tb_umkm');
		$this->db->where('tb_umkm.id_sektor', $id);
		$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_umkm.id_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_umkm.id_kec');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor');
		return $this->db->get()->result();
	}

	public function geojson() {
		$this->db->select('*');
		$this->db->from('tb_peta');
		return $this->db->get()->result();
	}

	public function kec_current($id) {
		$this->db->select('*');
		$this->db->from('tb_kecamatan');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	public function sektor_current($id) {
		$this->db->select('*');
		$this->db->from('tb_sektor');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	public function kecamatan() {
		$this->db->select('*');
		$this->db->from('tb_kecamatan');
		return $this->db->get()->result();
	}

	public function sektor() {
		$this->db->select('*');
		$this->db->from('tb_sektor');
		return $this->db->get()->result();
	}

	public function detail($id) {
		$this->db->select('*, tb_pengguna.id as id_pengguna, tb_umkm.id as id_umkm');
		$this->db->from('tb_umkm');
		$this->db->where('tb_umkm.id', $id);
		$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_umkm.id_pengguna');
		$this->db->group_by('tb_pengguna.id');
		return $this->db->get()->row();
	}
}

/* End of file M_map.php */
/* Location: ./application/models/M_map.php */