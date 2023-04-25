<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	
	public function registration($data) {
		$this->db->insert('tb_pengguna', $data);
	}

	public function kecamatan() {
		$this->db->select('*');
		$this->db->from('tb_kecamatan');
		return $this->db->get()->result();
	}	

}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */