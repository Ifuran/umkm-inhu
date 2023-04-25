<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->model('m_user');
	}

	public function login($username, $password) {
		$cek = $this->ci->m_user->login($username, $password);
		if ($cek) {
			$username = $cek->username;
			$nama_nama = $cek->user_nama;	
			$this->ci->session->set_userdata('username', $username );
			$this->ci->session->set_userdata('user_nama', $user_nama );
			redirect('home');
		} else {
			$this->ci->session->set_flashdata('pesan','Username atau Password salah!');
			redirect('user/login');

		}
	}

	public function cek_login() {
		if ($this->ci->session->userdata('username') == '') {
			$this->ci->session->set_flashdata('pesan','Anda belum login, silahkan login dulu!');
			redirect('user/login');
		}
	}

	public function logout() {
		$this->ci->session->unset_userdata('username');
		$this->ci->session->unset_userdata('password');
		$this->ci->session->set_flashdata('pesan','Logout sukses!');
			redirect('user/login');
	}

	

}

/* End of file User_login.php */
/* Location: ./application/libraries/User_login.php */

 ?>