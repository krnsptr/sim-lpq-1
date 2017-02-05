<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function validasi() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_message('required', '{field} wajib diisi.');

		return $this->form_validation->run();
	}

	public function login() {
		if($this->validasi()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result = $this->db->where(array('username' => $username));
			if($result->count_all_results('anggota') < 1) {
				$this->session->set_flashdata('error', 'Username tidak terdaftar.<br />'.PHP_EOL);
				return FALSE;
			}
			else {
				$pass = $result->get('anggota')->row()->password;
				$id_anggota = $result->get('anggota')->row()->id_anggota;
				if(password_verify($password, $pass)) {
					$this->session->set_userdata('id_anggota', $id_anggota);
					return TRUE;
				}
				else {
					$this->session->set_flashdata('error', 'Password tidak cocok.<br />'.PHP_EOL);
					return FALSE;
				}
			}
		}
		else {
			$this->session->set_flashdata('error', validation_errors());
			return FALSE;
		}
	}

	public function cek_login() {
		if($this->session->userdata('id_anggota')) return TRUE;
		else return FALSE;
	}
}