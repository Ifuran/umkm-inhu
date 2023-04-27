<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('m_profile');
		$this->load->library('googlemaps');
		check_login();	
	}

	public function index()
	{	
		$id = $this->session->userdata('id');	
		$data = array(
			'title' => 'Profile Saya',
			'isi' => 'profile/v_index',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'map'	=> $this->googlemaps->create_map(),
			'umkm' => $this->m_profile->umkm($id)
		);
		
		$this->load->view('template/v_wrapper', $data, FALSE);
	}

	public function edit() {
		$nik = $this->session->userdata('nik');			
		$data = array(
			'title' => 'Ubah Profile',
			'isi' => 'profile/v_edit',			
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $nik])->row_array(),
			'profile' => $this->m_profile->profile($nik),
			'kecamatan' => $this->m_profile->kecamatan(),
			'map'	=> $this->googlemaps->create_map()
		);		
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required'	=> '*Tidak boleh kosong!'			
		]);		
		$this->form_validation->set_rules('nik', 'NIK', 'trim|numeric|required|exact_length[16]', [
			'required'	=> '*Tidak boleh kosong!',
			'numeric'	=> '*Masukan angka!',			
			'exact_length'=> '*NIK harus 16 digit!'
		]);
		$this->form_validation->set_rules('no_kk', 'No.KK', 'trim|numeric|required|exact_length[16]', [
			'required'	=> '*Tidak boleh kosong!',
			'numeric'	=> '*Masukan angka!',			
			'exact_length'=> '*No.KK harus 16 digit!'
		]);
		$this->form_validation->set_rules('no_telp', 'No.Telp', 'trim|numeric|required|min_length[11]', [
			'required'	=> '*Tidak boleh kosong!',
			'numeric'	=> '*Masukan angka!',
			'min_length'=> '*Minimal 11 digit!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required'	=> '*Tidak boleh kosong!',
			'valid_email'=> '*Email tidak valid!'			
		]);		
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required', [
			'required'	=> '*Tidak boleh kosong!'			
		]);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required', [
			'required'	=> '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required', [
			'required'	=> '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('asal_kec', 'Kecamatan', 'trim|required', [
			'required'	=> '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('asal_desa', 'Alamat Lengkap', 'trim|required', [
			'required'	=> '*Tidak boleh kosong!'
		]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/v_wrapper', $data, FALSE);
			
		} else {			
			$data = array(				
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'nik' => htmlspecialchars($this->input->post('nik', true)),
				'no_kk' => htmlspecialchars($this->input->post('no_kk', true)),
				'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),				
				'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jk' => $this->input->post('jk'),
				'asal_kec' => $this->input->post('asal_kec'),
				'asal_desa' => htmlspecialchars($this->input->post('asal_desa', true))
			);
			$foto = $_FILES['foto']['name'];			
			if ($foto) {
				$config['upload_path'] = './template/img/profile';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '5000';				

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {

					$db_foto = $this->m_profile->profile($nik);
					$foto_lama = $db_foto->foto;
					if ($foto_lama != 'default.png') {
						unlink(FCPATH . 'template/img/profile/' . $foto_lama);
					}

					$foto_baru = $this->upload->data('file_name');
					$this->db->set('foto', $foto_baru);
				} else {
					echo $this->upload->display_errors();
				}

			}
			$this->m_profile->edit($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengedit data!</div>');	
			redirect('profile');
		}						
	}

	public function changePassword() {
		$nik = $this->session->userdata('nik');		
		$data = array(
			'title' => 'Ubah Password Saya',
			'isi' => 'profile/v_changePassword',			
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'profile' => $this->m_profile->profile($nik),
			'kecamatan' => $this->m_profile->kecamatan(),
			'map'	=> $this->googlemaps->create_map()
		);

		$this->form_validation->set_rules('current_password', 'Password saat ini', 'trim|required', [
			'required' => '*Tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('password1', 'Passowrd Baru', 'trim|required|matches[password2]|min_length[5]', [
			'required' => '*Tidak boleh kosong!',
			'matches' => '*Password baru harus sama dengan password yang diulang!',
			'min_length' => '*Minimal 5 digit!'
		]);
		$this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|matches[password1]', [
			'required' => '*Tidak boleh kosong!',
			'matches' => '*Password baru harus sama dengan password yang diulang!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/v_wrapper', $data, FALSE);
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');	
				redirect('profile/changePassword');
			} else {
				if ($new_password == $current_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak boleh sama dengan yang lama!</div>');	
					redirect('profile/changePassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('nik', $nik);
					$this->db->update('tb_pengguna');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah password!</div>');	
					redirect('profile');
				}
			}
		}
	}

	public function editUsaha($id) {

		// tambahin hak akses
		$data = array(
			'title' => 'Ubah Data UMKM',
			'isi' => 'profile/v_editUsaha',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'profile' => $this->m_profile->profile($id),			
			'kecamatan' => $this->m_profile->kecamatan(),
			'sektor' => $this->m_profile->sektor(),
			'usaha'	=> $this->m_profile->usaha($id),
			'map'	=> $this->googlemaps->create_map(),
			'geojson'  => $this->m_profile->geojson(),		
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
				'id' => $id,				
				'id_kec' => $this->input->post('id_kec'),
				'umkm_desa' => htmlspecialchars($this->input->post('umkm_desa', true)),
				'bidang' => htmlspecialchars($this->input->post('bidang', true)),
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
					$db_gambar = $this->m_profile->usaha($id);
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
			$this->m_profile->editUmkm($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil merubah data!</div>');	
			redirect('umkm');
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */