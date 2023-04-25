<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {

	public function profile($nik) {
		$this->db->where('nik', $nik);
		$this->db->select('*, tb_pengguna.id as id_pengguna, tb_pengguna.nama as user, tb_kecamatan.id as id_kecamatan, tb_kecamatan.nama as kecamatan');
		$this->db->from('tb_pengguna');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_pengguna.asal_kec');
		$this->db->group_by('tb_kecamatan.id');
		return $this->db->get()->row();
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

}

/* End of file M_profile.php */
/* Location: ./application/models/M_profile.php */