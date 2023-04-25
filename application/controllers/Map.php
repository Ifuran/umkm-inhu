<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('googlemaps');
		$this->load->model('m_map');
		check_login();
	}

	public function index()
	{	
		$data = array(
			'title' => 'Persebaran UMKM INHU',
			'user'	=> $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'map'	=> $this->googlemaps->create_map(),	
			'kecamatan' => $this->m_map->kecamatan(),
			'umkm'  => $this->m_map->umkm(),
			'geojson'  => $this->m_map->geojson(),									
			'isi' 	=> 'map/v_map'
		);		
		$this->load->view('template/v_wrapper', $data, FALSE);
	}	

	public function rute($id)
	{					
		$data = array(
			'title' => 'Rute Lokasi Usaha ',
			'user'	=> $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'map'	=> $this->googlemaps->create_map(),						
			'usaha'	=> $this->m_map->detail($id),		
			'geojson'  => $this->m_map->geojson(),
			'isi' 	=> 'map/v_rute'		
		);		
		$this->load->view('template/v_wrapper', $data, FALSE);
	}

	public function kecamatan($id)
	{			
		$data = array(
			'title'	=> 'Persebaran UMKM Kecamatan ',
			'user'	=> $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'map'	=> $this->googlemaps->create_map(),	
			'kecamatan' => $this->m_map->kecamatan(),
			'umkm'  => $this->m_map->umkm_kec($id),
			'kec_current' => $this->m_map->kec_current($id),
			'geojson'  => $this->m_map->geojson(),
			'isi' 	=> 'map/v_kecamatan' 
		);
		$this->load->view('template/v_wrapper', $data, FALSE);
	}

}

/* End of file Map.php */
/* Location: ./application/controllers/Map.php */