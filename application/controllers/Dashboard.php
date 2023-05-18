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
			'jlh_users' => $this->m_dashboard->users(),
			'jlh_pelaku_usaha' => $this->m_dashboard->pelaku_usaha(),
			'jlh_umkm' => $this->m_dashboard->umkm(),
			'jlh_sektor' => $this->m_dashboard->sektor(),
			'jlh_kecamatan' => $this->m_dashboard->kecamatan(),
			'sektor' => $this->m_dashboard->sektor_umkm(),
			'kecamatan' => $this->m_dashboard->kecamatan_umkm(),
			'map'	=> $this->googlemaps->create_map()
		);			
		
		$this->load->view('template/v_wrapper', $data, FALSE);
	}

	public function print() {		
		$data = array(
			'title' => 'Cetak Laporan',
			'umkm' => $this->m_dashboard->list(),			
			'kecamatan' => $this->m_dashboard->kecamatan_umkm(),
			'map'	=> $this->googlemaps->create_map(),
			'jlh_pelaku_usaha' => $this->m_dashboard->pelaku_usaha(),
			'jlh_umkm' => $this->m_dashboard->umkm(),
			'jlh_sektor' => $this->m_dashboard->sektor(),
			'jlh_kecamatan' => $this->m_dashboard->kecamatan()

		);
		$this->load->view('dashboard/v_cetakLaporan', $data, FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */