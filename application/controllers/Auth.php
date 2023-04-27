<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('googlemaps');
		$this->load->model('m_auth');			
	}
	public function index() {	
		if ($this->session->userdata('nik')) {
			redirect('profile');
		}			
		$this->form_validation->set_rules('nik', 'NIK', 'numeric|required|exact_length[16]', [
			'required'	=> '*Tidak boleh kosong!',
			'numeric'	=> '*Masukan angka!',
			'exact_length'=> '*NIK harus 16 digit!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required', [
			'required'	=> '*Tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == FALSE) {			
			$data = array(
				'title' => 'Halaman Masuk',				
				'map'	=> $this->googlemaps->create_map(),							
			);		
			$this->load->view('auth/v_login', $data, FALSE);
		} else {
			$nik = $this->input->post('nik');
			$password = $this->input->post('password');			
			$user = $this->db->get_where('tb_pengguna', ['nik' => $nik])->row_array();

			if ($user) {
				if ($user['is_active'] == 1) {
					if (password_verify($password, $user['password'])) {
						$data = array(
							'id' => $user['id'],							
							'nik' => $user['nik'],
							'email' => $user['email'],
							'role_id' => $user['role_id']						
						);
						$this->session->set_userdata($data);
						if ($user['role_id'] == 1) {
							redirect('dashboard');
						} else {
							redirect('profile');
						}
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
						redirect('auth');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum diaktifkan!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIK tidak terdaftar!</div>');
				redirect('auth');
			}		
		}
	}	

	public function registration() {
		$data['kecamatan'] = $this->m_auth->kecamatan();
		if ($this->session->userdata('nik')) {
			redirect('profile');
		}
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required'	=> '*Tidak boleh kosong!'			
		]);		
		$this->form_validation->set_rules('nik', 'NIK', 'trim|numeric|required|exact_length[16]|is_unique[tb_pengguna.nik]', [
			'required'	=> '*Tidak boleh kosong!', 
			'numeric'	=> '*Masukan angka!',
			'exact_length'=> '*NIK harus 16 digit!',
			'is_unique'	=> '*NIK sudah terdaftar!'
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
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_pengguna.email]', [
			'required'	=> '*Tidak boleh kosong!',
			'valid_email'=> '*Email tidak valid!',
			'is_unique'	=> '*Email sudah terdaftar!'			
		]);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]', [
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
			$data['title'] = 'Halaman Pendaftaran';			
			$this->load->view('auth/v_registration', $data, FALSE);			
		} else {
			$data = array(
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'nik' => htmlspecialchars($this->input->post('nik', true)),
				'no_kk' => htmlspecialchars($this->input->post('no_kk', true)),
				'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),	
				'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jk' => $this->input->post('jk'),
				'asal_kec' => $this->input->post('asal_kec'),
				'asal_desa' => htmlspecialchars($this->input->post('asal_desa', true)),
				'foto' => 'default.png',	
				'role_id' => 2,
				'is_active' => 0,				
				'tgl_dibuat' => time()
			);		
			$token = base64_encode(random_bytes(32));			
			$user_token = array(
				'email' => $this->input->post('email', true),
				'token' => $token,
				'tgl_dibuat' => time()
			);

			$this->m_auth->registration($data);
			$this->db->insert('tb_token', $user_token);

			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mendaftar! Silahkan aktivasi melalui Email.</div>');
			redirect('auth');
		}		
	}	

	private function _sendEmail($token, $type) {
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'lemonaruh@gmail.com',
			'smtp_pass' => 'hysbuenwjkgwrrhk',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];		

		$this->load->library('email', $config);
		$this->email->from('lemonaruh@gmail.com', 'UMKM INHU');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Verifikasi Pendaftaran Akun');			
			$this->email->message('Klik link berikut untuk verifikasi akun Anda : '.base_url().'auth/verify?email='.$this->input->post('email').'&token='. urlencode($token));
		} else if($type == 'forgot') {
			$this->email->subject('Reset Password Akun');			
			$this->email->message('Klik link berikut untuk reset password akun Anda : '.base_url().'auth/resetpassword?email='.$this->input->post('email').'&token='. urlencode($token));
		}
		
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();die;
		}
	}

	public function verify() {
		$email = $this->input->get('email');		
		$token = $this->input->get('token');		

		$user = $this->db->get_where('tb_pengguna', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('tb_token', ['token' => $token])->row_array();	
			if ($user_token) {
				if (time() - $user_token['tgl_dibuat'] < (60*60*24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('tb_pengguna');

					$this->db->delete('tb_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil aktivasi! Silahkan login.</div>');
					redirect('auth');
				} else {
					$this->db->delete('tb_pengguna', ['email' => $email]);
					$this->db->delete('tb_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token expired!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal aktivasi akun! Token salah</div>');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal aktivasi akun! Email salah</div>');
			redirect('auth');
		}
	}

	public function resetPassword() {
		$email = $this->input->get('email');		
		$token = $this->input->get('token');		

		$user = $this->db->get_where('tb_pengguna', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('tb_token', ['token' => $token])->row_array();	
			if ($user_token) {
				if (time() - $user_token['tgl_dibuat'] < (60*60*24)) {
					$this->session->set_userdata('reset_email', $email);
					$this->changePassword();					
				} else {
					$this->db->delete('tb_pengguna', ['email' => $email]);
					$this->db->delete('tb_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token expired!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal reset password akun! Token salah</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal reset password akun! Email salah</div>');
			redirect('auth');
		}
	}

	public function logout() {
		$this->session->unset_userdata('nik');
		$this->session->unset_userdata('email');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil keluar!</div>');
		redirect('auth');
	}

	public function blocked() {
		$data['title'] = 'Akses Dilarang';		
		$this->load->view('template/v_blocked', $data);
	}

	public function forgotPassword() {
		$this->form_validation->set_rules('email', 'fieldlabel', 'trim|required|valid_email', [
			'required'	=> '*Tidak boleh kosong!',
			'valid_email'=> '*Email tidak valid!'			
		]);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Halaman Lupa Password';
			$this->load->view('templates/v_login_header', $data);
			$this->load->view('auth/v_forgotPassword');
			$this->load->view('templates/v_login_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('tb_pengguna', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = array(
					'email' => $this->input->post('email', true),
					'token' => $token,
					'tgl_dibuat' => time()
				);
				$this->db->insert('tb_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cek email untuk reset password!</div>');
				redirect('auth/forgotPassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar atau belum diaktivasi!</div>');
				redirect('auth/forgotPassword');
			}
		}
	}

	public function changePassword() {
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]', [
			'required'	=> '*Tidak boleh kosong!',
			'matches'	=> '*Password harus sama',
			'min_length'=> '*Password terlalu pendek'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]', [
			'matches'	=> '*Password harus sama dengan yang di atas'
		]);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Halaman Ubah Password';
			$this->load->view('templates/v_login_header', $data);
			$this->load->view('auth/v_changePassword');
			$this->load->view('templates/v_login_footer');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('tb_pengguna');

			$this->db->delete('tb_token', ['email' => $email]);

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Reset password berhasil!</div>');
			redirect('auth');
		}
		
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */