<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('googlemaps');
		$this->load->model('m_umkm');
		$this->load->model('m_map');
		$this->load->model('m_dashboard');
	}
	
	public function index()
	{
		$data = array(
			'title' => 'SIG UMKM INHU',			
			'map'	=> $this->googlemaps->create_map(),	
			'kecamatan' => $this->m_map->kecamatan(),
			'umkm'  => $this->m_map->umkm(),
			'geojson'  => $this->m_map->geojson(),
			'jlh_users' => $this->m_dashboard->users(),
			'jlh_pelaku_usaha' => $this->m_dashboard->pelaku_usaha(),
			'jlh_umkm' => $this->m_dashboard->umkm(),
			'jlh_sektor' => $this->m_dashboard->sektor(),
			'jlh_kecamatan' => $this->m_dashboard->kecamatan(),
		);
		$this->load->view('template/v_head', $data, FALSE);		
		$this->load->view('v_index', $data, FALSE);
		$this->load->view('template/v_footer', $data, FALSE);
		
	}

	public function detail($id) {
		$data = array(
			'title' => 'Data UMKM',			
			'profile' => $this->m_umkm->profile($id),
			'kecamatan' => $this->m_umkm->kecamatan(),
			'map'	=> $this->googlemaps->create_map()	
		);						
		$this->load->view('template/v_head', $data, FALSE);		
		$this->load->view('v_detail', $data, FALSE);
		$this->load->view('template/v_footer', $data, FALSE);

	}	

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */