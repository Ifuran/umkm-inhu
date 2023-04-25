<?php 
	
function check_login() {
	$ci = get_instance();
	if (!$ci->session->userdata('nik')) {
		redirect('auth');
	}
}