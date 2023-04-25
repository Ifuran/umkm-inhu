<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	public function umkm() {	
		$this->db->select('*');	
		$this->db->from('tb_umkm');
		$this->db->where('approve', 1);
		return $this->db->count_all_results();		
	}

	public function users() {
		return $this->db->count_all('tb_pengguna');
	}

	public function pelaku_usaha() {
		$this->db->select('*');
		$this->db->from('tb_pengguna');
		$this->db->where('role_id', 3);		
		return $this->db->count_all_results();
	}

	public function sektor() {
		return $this->db->count_all('tb_sektor');
	}

	public function kecamatan() {
		return $this->db->count_all('tb_kecamatan');
	}

	public function sektor_umkm() {		
    	$this->db->select('*, tb_sektor.nama as nama_sektor, count(tb_umkm.id) as total');
		$this->db->from('tb_umkm');
		$this->db->join('tb_sektor', 'tb_sektor.id = tb_umkm.id_sektor', 'left');
		$this->db->group_by('tb_umkm.id_sektor');
		return $this->db->get()->result();
	}

	public function kecamatan_umkm() {
		$this->db->select('*, tb_kecamatan.nama as nama_kecamatan, count(tb_kecamatan.id) as total');
		$this->db->from('tb_umkm');
		$this->db->join('tb_kecamatan', 'tb_kecamatan.id = tb_umkm.id_kec', 'left');
		$this->db->group_by('tb_umkm.id_kec');
		return $this->db->get()->result();
	}

}

/* End of file M_dashboard.php */
/* Location: ./application/models/M_dashboard.php */