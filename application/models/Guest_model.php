<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest_model extends CI_Model {
	public function cek_login() {
		if($this->session->userdata('id_anggota')) return TRUE;
		else return FALSE;
	}

	public function pendaftaran_buka() {
		$pendaftaran_santri = $this->db->get_where('sistem', array('nama' => 'pendaftaran_santri'))->row()->isi;
		$pendaftaran_pengajar = $this->db->get_where('sistem', array('nama' => 'pendaftaran_pengajar'))->row()->isi;
		if($pendaftaran_santri || $pendaftaran_pengajar) return TRUE;
		else return FALSE;
	}

	public function validasi() {
		$this->form_validation->set_rules('username', 'Username', 'required|regex_match[/^[a-z0-9_]{4,16}+$/]|trim|is_unique[anggota.username]',array('regex_match' => 'Username hanya boleh mengandung huruf kecil, angka, dan underscore (4&ndash;16 karakter).'));
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[anggota.email]');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('nomor_id', 'Nomor Identitas', 'required|trim|is_unique[anggota.nomor_id]');
		$this->form_validation->set_rules('nomor_hp', 'Nomor HP', 'required|regex_match[/^08[0-9]{8,11}+$/]|is_unique[anggota.nomor_hp]');
		if(!empty($this->input->post('nomor_wa'))) $this->form_validation->set_rules('nomor_wa', 'Nomor WA', 'regex_match[/^08[0-9]{8,11}+$/]|trim');

		$this->form_validation->set_message('required', '{field} wajib diisi.');
		$this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
		$this->form_validation->set_message('valid_email', 'Format {field} salah.');
		$this->form_validation->set_message('regex_match', 'Format {field} salah. Contoh: 081234567890 (10&ndash;13 digit).');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');

		return $this->form_validation->run();
	}

	public function daftar() {
		if($this->validasi()) {
			$data = $this->input->post();
			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			$this->db->insert('anggota', $data);
			if($this->db->affected_rows()) return TRUE;
			else {
				$this->session->set_flashdata('error', 'Pendaftaran gagal.<br />'.PHP_EOL);
				return FALSE;
			}
		}
		else {
			$this->session->set_flashdata('error', validation_errors());
			$this->session->set_tempdata('post', $this->input->post(), 300);
			return FALSE;
		}
	}
}