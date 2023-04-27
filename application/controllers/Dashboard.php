<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('m_dashboard');
		$this->load->library('googlemaps');
		check_login();
		$role_id = $this->session->userdata('role_id');
		if ($role_id != 1) {
			redirect('auth/blocked');
		}	
	}

	public function index()
	{	
		$data = array(
			'title' => 'Dashboard',
			'isi' => 'dashboard/v_index',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'users' => $this->m_dashboard->users(),
			'pelaku_usaha' => $this->m_dashboard->pelaku_usaha(),
			'umkm' => $this->m_dashboard->umkm(),
			'sektor' => $this->m_dashboard->sektor(),
			'kecamatan' => $this->m_dashboard->kecamatan(),
			'sektor_umkm' => $this->m_dashboard->sektor_umkm(),
			'kecamatan_umkm' => $this->m_dashboard->kecamatan_umkm(),
			'map'	=> $this->googlemaps->create_map()
		);			
		
		$this->load->view('template/v_wrapper', $data, FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */