<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('googlemaps');			
		$this->load->model('m_user');
		check_login();		
	}

	public function index() {
		$role_id = $this->session->userdata('role_id');
		if ($role_id != 1) {
			redirect('auth/blocked');
		}		
		$data = array(
			'title' => 'Pengguna',
			'isi' => 'user/v_index',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'users' => $this->m_user->user(),
			'kecamatan' => $this->m_user->kecamatan(),
			'map'	=> $this->googlemaps->create_map()
		);		

		$this->form_validation->set_rules('role_id', 'Role Pengguna', 'required|trim', [
			'required'	=> '*Tidak boleh kosong!'			
		]);
		$this->form_validation->set_rules('is_active', 'Status Akun', 'required|trim', [
			'required'	=> '*Tidak boleh kosong!'			
		]);	
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required'	=> '*Tidak boleh kosong!'			
		]);		
		$this->form_validation->set_rules('nik', 'NIK', 'trim|numeric|required|is_unique[tb_pengguna.nik]|exact_length[16]', [
			'required'	=> '*Tidak boleh kosong!',
			'numeric'	=> '*Masukan angka!',
			'is_unique'	=> '*NIK sudah terdaftar!',
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
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]', [
			'required'	=> '*Tidak boleh kosong!',
			'matches'	=> '*Password harus sama',
			'min_length'=> '*Password terlalu pendek'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
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
			$email = $this->input->post('email');
			if ($email != "") {
				$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
					'required'	=> '*Tidak boleh kosong!',
					'valid_email'=> '*Email tidak valid!'			
				]);
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('template/v_wrapper', $data, FALSE);
				} else {
					$data = array(
						'nama' => strtoupper(htmlspecialchars($this->input->post('nama', true))),
						'nik' => htmlspecialchars($this->input->post('nik', true)),
						'no_kk' => htmlspecialchars($this->input->post('no_kk', true)),
						'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
						'email' => htmlspecialchars($this->input->post('email', true)),
						'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
						'email' => htmlspecialchars($this->input->post('email', true)), 
						'tempat_lahir' => strtoupper(htmlspecialchars($this->input->post('tempat_lahir', true))),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'jk' => $this->input->post('jk'),
						'asal_kec' => $this->input->post('asal_kec'),
						'asal_desa' => strtoupper(htmlspecialchars($this->input->post('asal_desa', true))),
						'role_id' => $this->input->post('role_id'),
						'is_active' => $this->input->post('is_active'),				
						'tgl_dibuat' => time(),
						'foto' => 'default.png'
					);
					$this->m_user->registration($data);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan data!</div>');	
					redirect('user');
				}				
			} else {
				$data = array(
					'nama' => strtoupper(htmlspecialchars($this->input->post('nama', true))),
					'nik' => htmlspecialchars($this->input->post('nik', true)),
					'no_kk' => htmlspecialchars($this->input->post('no_kk', true)),
					'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
					'email' => htmlspecialchars($this->input->post('email', true)),
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'email' => htmlspecialchars($this->input->post('email', true)), 
					'tempat_lahir' => strtoupper(htmlspecialchars($this->input->post('tempat_lahir', true))),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jk' => $this->input->post('jk'),
					'asal_kec' => $this->input->post('asal_kec'),
					'asal_desa' => strtoupper(htmlspecialchars($this->input->post('asal_desa', true))),
					'role_id' => $this->input->post('role_id'),
					'is_active' => $this->input->post('is_active'),								
					'tgl_dibuat' => time(),
					'foto' => 'default.png'
				);
				$this->m_user->registration($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan data!</div>');	
				redirect('user');
			}
		}	
	}	

	public function edit($id) {
		$role_id = $this->session->userdata('role_id');
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'title' => 'Ubah Data Pengguna',
			'isi' => 'user/v_edit',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'profile' => $this->m_user->profile($id),
			'kecamatan' => $this->m_user->kecamatan(),	
			'map'	=> $this->googlemaps->create_map()
		);

		$this->form_validation->set_rules('role_id', 'Role Pengguna', 'required|trim', [
			'required'	=> '*Tidak boleh kosong!'			
		]);
		$this->form_validation->set_rules('is_active', 'Status Akun', 'required|trim', [
			'required'	=> '*Tidak boleh kosong!'			
		]);
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
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email', [			
			'valid_email'=> '*Email tidak valid!'			
		]);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]', [
			'required'	=> '*Tidak boleh kosong!',
			'matches'	=> '*Password harus sama',
			'min_length'=> '*Password terlalu pendek'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
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
			$nik 	= $this->input->post('nik');
			$db_nik = $this->db->get_where('tb_pengguna', ['id' => $id])->row_array();

			if ($nik != $db_nik['nik']) {
				$this->form_validation->set_rules('nik', 'NIK', 'is_unique[tb_pengguna.nik]', [
					'is_unique' => '* NIK sudah terdaftar!'
				]);
				
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('template/v_wrapper', $data, FALSE);
				} else {
					$data = array(
						'id' => $id,
						'role_id' => $this->input->post('role_id'),
						'is_active' => $this->input->post('is_active'),				
						'nama' => strtoupper(htmlspecialchars($this->input->post('nama', true))),
						'nik' => htmlspecialchars($this->input->post('nik', true)),
						'no_kk' => htmlspecialchars($this->input->post('no_kk', true)),
						'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
						'email' => htmlspecialchars($this->input->post('email', true)),
						'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
						'tempat_lahir' => strtoupper(htmlspecialchars($this->input->post('tempat_lahir', true))),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'jk' => $this->input->post('jk'),
						'asal_kec' => $this->input->post('asal_kec'),
						'asal_desa' => strtoupper(htmlspecialchars($this->input->post('asal_desa', true)))
					);
					$this->m_user->edit($data);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengedit data!</div>');	
					redirect('user');
				}
			} else {
				$data = array(
					'id' => $id,
					'role_id' => $this->input->post('role_id'),
					'is_active' => $this->input->post('is_active'),				
					'nama' => strtoupper(htmlspecialchars($this->input->post('nama', true))),
					'nik' => htmlspecialchars($this->input->post('nik', true)),
					'no_kk' => htmlspecialchars($this->input->post('no_kk', true)),
					'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
					'email' => htmlspecialchars($this->input->post('email', true)),
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'tempat_lahir' => strtoupper(htmlspecialchars($this->input->post('tempat_lahir', true))),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jk' => $this->input->post('jk'),
					'asal_kec' => $this->input->post('asal_kec'),
					'asal_desa' => strtoupper(htmlspecialchars($this->input->post('asal_desa', true)))
				);
				$this->m_user->edit($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengedit data!</div>');	
				redirect('user');
			}						

		}
	}

	public function delete($id) {
		$role_id = $this->session->userdata('role_id');
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'id' => $id
		);		
		$this->m_user->delete($data);
		$this->m_user->deleteUmkm($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data!</div>');
		redirect('user');
	}

	public function detail($id) {
		$cek = $this->m_user->profile($id);
		if (!$cek || $cek->role_id == 1) {			
			redirect('auth/pageNotFound');
		}
		$data = array(
			'title' => 'Data Diri Pengguna',
			'isi' => 'user/v_detail',			
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array(),
			'profile' => $this->m_user->profile($id),
			'kecamatan' => $this->m_user->kecamatan(),	
			'map'	=> $this->googlemaps->create_map(),
			'umkm' => $this->m_user->umkm($id)
		);
		$this->load->view('template/v_wrapper', $data, FALSE);

	}
	public function updateProfile() {
		$role_id = $this->session->userdata('role_id');
		if ($role_id != 1) {
			redirect('auth/blocked');
		}
		$data = array(
			'title' => 'Nyoba Datepicker!',
			'user' => $this->db->get_where('tb_pengguna', ['nik' => $this->session->userdata('nik')])->row_array()	,
			'map'	=> $this->googlemaps->create_map()
		);
		$this->load->view('templates/v_header', $data);
		$this->load->view('user/updateProfile', $data);
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */