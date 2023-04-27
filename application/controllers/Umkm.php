<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umkm extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('googlemaps');
		$this->load->model('m_umkm');
		
	}	

	public function index()
	{
		check_login();
		$data = array(
			'title' => 'UMKM INHU',
			'isi' 	=> 'umkm/v_list',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'umkm'	=> $this->m_umkm->list(),
			'users' => $this->m_umkm->users(),
			'kecamatan' => $this->m_umkm->kecamatan(),
			'sektor' => $this->m_umkm->sektor(),
			'map'	=> $this->googlemaps->create_map(),
			'geojson'  => $this->m_umkm->geojson()											
		);	

		$this->form_validation->set_rules('id_pengguna', 'Nama', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('id_kec', 'Kecamatan', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('umkm_desa', 'Alamat usaha', 'required|trim', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('bidang', 'Bidang usaha', 'required|trim', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('id_sektor', 'Sektor', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('no_hp', 'No Telepon', 'required|numeric|min_length[11]|trim', [
			'required' => '*Tidak boleh kosong!',
			'numeric' => '*Masukan angka!',
			'min_length'=> '*Minimal 11 digit!'
		]);
		$this->form_validation->set_rules('umkm_lat', 'Latitude', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('umkm_lon', 'Longitude', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);		

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/v_wrapper', $data, FALSE);		
		} else {
			$data = array(
				'id_pengguna' => $this->input->post('id_pengguna'),
				'id_kec' => $this->input->post('id_kec'),
				'umkm_desa' => strtoupper(htmlspecialchars($this->input->post('umkm_desa', true))),
				'bidang' => strtoupper(htmlspecialchars($this->input->post('bidang', true))),
				'id_sektor' => $this->input->post('id_sektor'),
				'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
				'tgl_dibuat' => time(),
				'umkm_lat' => htmlspecialchars($this->input->post('umkm_lat', true)),
				'umkm_lon' => htmlspecialchars($this->input->post('umkm_lon', true)),
				'approve' => 1
			);
			$gambar = $_FILES['gambar']['name'];
			if ($gambar) {
				$config['upload_path'] = './template/img/umkm';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';				

				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar');
				$gambar_baru = $this->upload->data('file_name');
				$this->db->set('gambar', $gambar_baru);
				
			} else {
				$data['gambar'] = 'umkm.jpg';
			}
			$this->m_umkm->addUmkm($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan data!</div>');	
			redirect('umkm');
		}	
	}

	public function edit($id) {
		$role_id = $this->session->userdata('role_id');	
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'title' => 'Ubah Data UMKM',
			'isi' => 'umkm/v_edit',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'profile' => $this->m_umkm->profile($id),
			'users' => $this->m_umkm->users(),
			'kecamatan' => $this->m_umkm->kecamatan(),
			'sektor' => $this->m_umkm->sektor(),
			'map'	=> $this->googlemaps->create_map(),
			'geojson'  => $this->m_umkm->geojson()		
		);
		$this->form_validation->set_rules('id_pengguna', 'Nama', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('id_kec', 'Kecamatan', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('umkm_desa', 'Alamat usaha', 'required|trim', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('bidang', 'Bidang usaha', 'required|trim', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('id_sektor', 'Sektor', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('no_hp', 'No Telepon', 'required|numeric|min_length[11]', [
			'required' => '*Tidak boleh kosong!',
			'numeric' => '*Masukan angka!',
			'min_length'=> '*Minimal 11 digit!'
		]);
		$this->form_validation->set_rules('umkm_lat', 'Latitude', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('umkm_lon', 'Longitude', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/v_wrapper', $data, FALSE);
		} else {
			$data = array(
				'id' => $id,
				'id_pengguna' => $this->input->post('id_pengguna'),
				'id_kec' => $this->input->post('id_kec'),
				'umkm_desa' => strtoupper(htmlspecialchars($this->input->post('umkm_desa', true))),
				'bidang' => strtoupper(htmlspecialchars($this->input->post('bidang', true))),
				'id_sektor' => $this->input->post('id_sektor'),
				'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
				'umkm_lat' => htmlspecialchars($this->input->post('umkm_lat', true)),
				'umkm_lon' => htmlspecialchars($this->input->post('umkm_lon', true)),	
			);
			$gambar = $_FILES['gambar']['name'];			

			if ($gambar) {
				$config['upload_path'] = './template/img/umkm';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';				

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('gambar')) {
					$db_gambar = $this->m_umkm->profile($id);
					$gambar_lama = $db_gambar->gambar;
					if ($gambar_lama != 'default.jpg') {
						unlink(FCPATH . 'template/img/umkm/' . $gambar_lama);
					}

					$gambar_baru = $this->upload->data('file_name');
					$this->db->set('gambar', $gambar_baru);
				} else {
					echo $this->upload->display_errors();
				}

			}
			$this->m_umkm->editUmkm($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil merubah data!</div>');	
			redirect('umkm');
		}

	}

	public function delete($id) {
		$role_id = $this->session->userdata('role_id');	
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$db_gambar = $this->m_umkm->profile($id);
		$gambar_lama = $db_gambar->gambar;
		if ($gambar_lama != 'umkm.jpg') {
			unlink(FCPATH . 'template/img/umkm/' . $gambar_lama);
		}
		$this->m_umkm->deleteUmkm($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data!</div>');
		redirect('umkm');
	}

	public function registration() {
		check_login();
		$id = $this->session->userdata('id');	
		$data = array(
			'title' => 'Pendaftaran UMKM',
			'isi' 	=> 'umkm/v_registration',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'umkm'	=> $this->m_umkm->list(),
			'users' => $this->m_umkm->users(),
			'kecamatan' => $this->m_umkm->kecamatan(),
			'sektor' => $this->m_umkm->sektor(),
			'map'	=> $this->googlemaps->create_map(),
			'geojson'  => $this->m_umkm->geojson()																				
		);				
		$this->form_validation->set_rules('id_kec', 'Kecamatan', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('umkm_desa', 'Alamat usaha', 'required|trim', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('bidang', 'Bidang usaha', 'required|trim', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('id_sektor', 'Sektor', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('no_hp', 'No Telepon', 'required|numeric|min_length[11]', [
			'required' => '*Tidak boleh kosong!',
			'numeric' => '*Masukan angka!',
			'min_length'=> '*Minimal 11 digit!'
		]);
		$this->form_validation->set_rules('umkm_lat', 'Latitude', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('umkm_lon', 'Longitude', 'required', [
			'required' => '*Tidak boleh kosong!'
		]);		

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/v_wrapper', $data, FALSE);		
		} else {
			$data = array(
				'id_pengguna' => $id,
				'id_kec' => $this->input->post('id_kec'),
				'umkm_desa' => htmlspecialchars($this->input->post('umkm_desa', true)),
				'bidang' => htmlspecialchars($this->input->post('bidang', true)),
				'id_sektor' => $this->input->post('id_sektor'),
				'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
				'tgl_dibuat' => time(),
				'umkm_lat' => htmlspecialchars($this->input->post('umkm_lat', true)),
				'umkm_lon' => htmlspecialchars($this->input->post('umkm_lon', true)),
				'approve' => 0
			);
			$gambar = $_FILES['gambar']['name'];
			if ($gambar) {
				$config['upload_path'] = './template/img/umkm';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';				

				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar');
				$gambar_baru = $this->upload->data('file_name');
				$this->db->set('gambar', $gambar_baru);
				
			} else {
				$data['gambar'] = 'umkm.jpg';
			}
			$this->m_umkm->addUmkm($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mendaftarkan usaha! Silahkan tunggu konfirmasi admin</div>');	
			redirect('umkm');
		}
	}

	public function verifikasi() {
		$role_id = $this->session->userdata('role_id');	
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'title' => 'Verifikasi UMKM',
			'isi' => 'umkm/v_verifikasi',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'umkm' => $this->m_umkm->verifikasi_umkm(),
			'users' => $this->m_umkm->users(),
			'kecamatan' => $this->m_umkm->kecamatan(),
			'sektor' => $this->m_umkm->sektor(),
			'map'	=> $this->googlemaps->create_map()
		);
		$this->load->view('template/v_wrapper', $data, FALSE);
	}

	public function tolakUsaha($id) {
		$role_id = $this->session->userdata('role_id');	
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$db_gambar = $this->m_umkm->profile($id);
		$gambar_lama = $db_gambar->gambar;
		if ($gambar_lama != 'default.jpg') {
			unlink(FCPATH . 'template/img/umkm/' . $gambar_lama);
		}
		$this->m_umkm->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menolak pendaftaran usaha!</div>');
		redirect('umkm/verifikasi');
	}

	public function setujuiUsaha($id) {
		// $user = $this->session->userdata('id');
		$user = $this->m_umkm->profile($id);
		$role_id = $this->session->userdata('role_id');	
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'id' => $id,
			'approve' => 1
		);
		$this->m_umkm->editUmkm($data);
		$this->db->set('role_id', 3);
		$this->db->where('id', $user->id_pengguna);
		$this->db->update('tb_pengguna');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menyetujui pendaftaran usaha!</div>');
		redirect('umkm/verifikasi');

	}

	public function detail($id) {
		$data = array(
			'title' => 'Data Usaha',
			'isi' => 'umkm/v_detail',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'profile' => $this->m_umkm->profile($id),
			'kecamatan' => $this->m_umkm->kecamatan(),
			'map'	=> $this->googlemaps->create_map()	
		);
		$this->load->view('template/v_wrapper', $data, FALSE);
	}	

	public function sektor() {
		$role_id = $this->session->userdata('role_id');	
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'title' => 'Kategori Sektor',
			'isi' => 'umkm/v_sektor',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'sektor' => $this->m_umkm->sektor(),
			'map'	=> $this->googlemaps->create_map()
		);

		$this->form_validation->set_rules('nama', 'Nama Sektor', 'trim|required', [
			'required' => '*Tidak boleh kosong!'
		]);	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/v_wrapper', $data, FALSE);
		} else {
			$data = array('nama' => htmlspecialchars($this->input->post('nama', true)));
			$this->m_umkm->addSektor($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambah data!</div>');
			redirect('umkm/sektor');
		}

	}

	public function deleteSektor($id) {
		$role_id = $this->session->userdata('role_id');	
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'id' => $id
		);
		$this->m_umkm->deleteSektor($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data!</div>');
		redirect('umkm/sektor');
	}

}

/* End of file umkm.php */
/* Location: ./application/controllers/umkm.php */