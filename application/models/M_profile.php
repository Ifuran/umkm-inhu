<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {

	public function profile($nik) {
		$this->db->where('nik', $nik);
		$this->db->select('*, tb_pengguna.id as id_pengguna, tb_pengguna.nama as user, tb_kecamatan.id as id_kecamatan, tb_kecamatan.nama as kecamatan');
		$this->db->from('tb_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_pengguna.asal_kec');		
		return $this->db->get()->row();
	}

	public function umkm($id) {		
		$this->db->select('*, tb_umkm.id as id_umkm, tb_sektor.id as id_sektor, tb_sektor.nama as sektor');
		$this->db->from('tb_umkm');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor', 'left');
		$this->db->where('id_pengguna', $id);
		$this->db->where('approve', 1);		
		$this->db->order_by("tb_umkm.id", "desc");
		return $this->db->get()->result();
	}

	public function usaha($id) {
		$this->db->select('*,tb_umkm.id as id_umkm, tb_umkm.tgl_dibuat as tgl_umkm, tb_pengguna.nama as user, tb_pengguna.tgl_dibuat as tgl_pengguna, tb_kecamatan.nama as kecamatan, tb_sektor.nama as sektor');
		$this->db->from('tb_umkm');
		$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_umkm.id_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_umkm.id_kec');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor');
		$this->db->where('tb_umkm.id', $id);
		return $this->db->get()->row();
	}

	public function editUmkm($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('tb_umkm', $data);
	}

	public function kecamatan() {
		$this->db->select('*');
		$this->db->from('tb_kecamatan');		
		return $this->db->get()->result();
	}

	public function edit($data) {
		$this->db->where('nik', $data['nik']);
		$this->db->update('tb_pengguna', $data);
	}

	public function sektor() {		
		$this->db->select('*');
		$this->db->from('tb_sektor');
		$this->db->join('tb_umkm', 'tb_sektor.id = tb_umkm.id_sektor');		
		return $this->db->get()->result();
	}

	public function geojson() {
		$this->db->select('*');
		$this->db->from('tb_peta');
		return $this->db->get()->result();
	}

}

/* End of file M_profile.php */
/* Location: ./application/models/M_profile.php */