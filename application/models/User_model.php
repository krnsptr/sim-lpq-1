<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function validasi() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_message('required', '{field} wajib diisi.');

		return $this->form_validation->run();
	}

	public function validasi_akun($id_anggota) {
		$anggota = $this->db->get_where('anggota', array('id_anggota' => $id_anggota))->row();
		$un = $anggota->username;
		$em = $anggota->email;
		$ni = $anggota->nomor_id;
		$nh = $anggota->nomor_hp;
		$is_unique_username = (trim($this->input->post('username')) !== $un) ? '|is_unique[anggota.username]' : '';
		$is_unique_email = (trim($this->input->post('email')) !== $em) ? '|is_unique[anggota.email]' : '';
		$is_unique_nomor_id = (trim($this->input->post('nomor_id')) !== $ni) ? '|is_unique[anggota.nomor_id]' : '';
		$is_unique_nomor_hp = (trim($this->input->post('nomor_hp')) !== $nh) ? '|is_unique[anggota.nomor_hp]' : '';

		$this->form_validation->set_rules('username', 'Username', 'required|regex_match[/^[a-z0-9_]{4,16}+$/]|trim'.$is_unique_username,array('regex_match' => 'Username hanya boleh mengandung huruf kecil, angka, dan underscore (4&ndash;16 karakter).'));
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email'.$is_unique_email);
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('nomor_id', 'Nomor Identitas', 'required|trim'.$is_unique_nomor_id);
		$this->form_validation->set_rules('nomor_hp', 'Nomor HP', 'required|regex_match[/^08[0-9]{8,11}+$/]'.$is_unique_nomor_hp);
		if(!empty($this->input->post('nomor_wa'))) $this->form_validation->set_rules('nomor_wa', 'Nomor WA', 'regex_match[/^08[0-9]{8,11}+$/]|trim');

		$this->form_validation->set_message('required', '{field} wajib diisi.');
		$this->form_validation->set_message('valid_email', 'Format {field} salah.');
		$this->form_validation->set_message('regex_match', 'Format {field} salah. Contoh: 081234567890 (10&ndash;13 digit).');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');

		return $this->form_validation->run();
	}

	public function validasi_password($admin = FALSE) {
		if(!$admin) $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|min_length[6]');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]');
		$this->form_validation->set_message('required', '{field} wajib diisi.');
		$this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
		if(!$this->form_validation->run()) {
			$this->session->set_flashdata('error', validation_errors());
			return FALSE;
		}
		if($admin) return TRUE;
		$pw = $this->db->get_where('anggota', array('id_anggota' => $this->session->userdata('id_anggota')))->row()->password;
		if(password_verify($this->input->post('password_lama'), $pw)) return TRUE;
		else {
			$this->session->set_flashdata('error', 'Password Lama tidak cocok.<br />'.PHP_EOL);
			return FALSE;
		}
	}

	public function validasi_program ($keanggotaan, $program) {
		$keanggotaan = intval($keanggotaan);
		$program = intval($program);
		if($keanggotaan !== 1 && $keanggotaan !== 2) return FALSE;
		if($program < 0 || $program > 3) return FALSE;
		if($keanggotaan !== 1 && $program == 0) return FALSE;
		else return TRUE;
	}

	public function login() {
		if($this->validasi()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($this->db->where(array('username' => $username))->count_all_results('anggota') < 1) {
				$this->session->set_flashdata('error', 'Username tidak terdaftar.<br />'.PHP_EOL);
				return FALSE;
			}
			else {
				$anggota = $this->db->get_where('anggota', array('username' => $username))->row();
				$pw = $anggota->password;
				$id_anggota = $anggota->id_anggota;
				if(password_verify($password, $pw)) {
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

	public function cek_pengumuman() {
		return $this->db->select('isi')->where(array('nama' => 'pengumuman'))->get('sistem')->row()->isi;
	}

	public function cek_pendaftaran_santri() {
		return $this->db->select('isi')->where(array('nama' => 'pendaftaran_santri'))->get('sistem')->row()->isi;
	}

	public function cek_pendaftaran_pengajar() {
		return $this->db->select('isi')->where(array('nama' => 'pendaftaran_pengajar'))->get('sistem')->row()->isi;
	}

	public function cek_penjadwalan_santri() {
		return $this->db->select('isi')->where(array('nama' => 'penjadwalan_santri'))->get('sistem')->row()->isi;
	}

	public function cek_penjadwalan_pengajar() {
		return $this->db->select('isi')->where(array('nama' => 'penjadwalan_pengajar'))->get('sistem')->row()->isi;
	}

	public function cek_program($id_anggota, $keanggotaan, $program) {
		if(! $this->validasi_program($keanggotaan, $program)) return FALSE;
		if($keanggotaan == 1) $tabel = 'santri';
		else if($keanggotaan == 2) $tabel = 'pengajar';

		$cek = $this->db
				->where(array('id_anggota' => $id_anggota, 'program' => $program))
				->count_all_results($tabel);

		if($cek < 1) return FALSE;
		else return TRUE;
	}

	public function program($id_anggota) {

		$program_santri = $this->db->where(array('id_anggota' => $id_anggota))->count_all_results('santri');
		$program_pengajar = $this->db->where(array('id_anggota' => $id_anggota))->count_all_results('pengajar');

		if($program_santri || $program_pengajar) {
			$santri = $this->db->get_where('santri', array('id_anggota' => $id_anggota))->result();
			$pengajar = $this->db->get_where('pengajar', array('id_anggota' => $id_anggota))->result();

			$program['santri'] = $santri;
			$program['pengajar'] = $pengajar;

			return $program;
		}
		else return NULL;
	}

	public function santri($id_anggota, $program) {
		return 
		$this->db->where(array('id_anggota' => $id_anggota, 'program' => $program))->get('santri')->row();
	}

	public function pengajar($id_anggota, $program) {
		return 
		$this->db->where(array('id_anggota' => $id_anggota, 'program' => $program))->get('pengajar')->row();
	}

	public function tambah_program($id_anggota) {
		$keanggotaan = $this->input->post('keanggotaan');
		$program = $this->input->post('program');

		if(! $this->validasi_program($keanggotaan, $program)) return FALSE;

		$data['id_anggota'] = $id_anggota;
		$data['program'] = $program;

		if($keanggotaan == 1) {
			if(!$this->cek_pendaftaran_santri()) return FALSE;
			$tabel = 'santri';
			$data['sudah_lulus'] = (int) $this->input->post('sudah_lulus');
			$data['kbm_tahun'] = (empty($this->input->post('kbm_tahun'))) ? NULL : $this->input->post('kbm_tahun');
			$data['kbm_semester'] = (empty($this->input->post('kbm_semester'))) ? NULL : $this->input->post('kbm_semester');
		}
		else if($keanggotaan == 2) {
			if(!$this->cek_pendaftaran_pengajar()) return FALSE;
			$tabel = 'pengajar';
			if($program == 1) {
				$data['data1'] = (int) $this->input->post('pendaftaran');

				$memenuhi_syarat = $this->input->post('memenuhi_syarat');
				$string = '';
				for($i=0; $i<3; $i++) {
					if(isset($memenuhi_syarat[$i])) $string .= '1:'; else $string .= '0:';
				}
				$data['data2'] = $string;
				$data['data3'] = $this->input->post('alasan_mendaftar');
			}
			else if($program == 2) {
				if($this->input->post('enrollment_key') !== 'TF12_2017') {
					$this->session->set_flashdata('error','Enrollment Key tidak cocok.</br>'.PHP_EOL);
					return FALSE;
				}
			}
			else if($program == 3) {
				if($this->input->post('enrollment_key') !== '2017_BA12') {
					$this->session->set_flashdata('error','Enrollment Key tidak cocok.</br>'.PHP_EOL);
					return FALSE;
				}
			}
		}
		$this->db->insert($tabel, $data);
		if($this->db->affected_rows() < 1) return FALSE;
		else {
			if($keanggotaan == 2) $this->session->set_flashdata('warning','Silakan menambahkan alternatif jadwal mengajar.</br>'.PHP_EOL);
			return TRUE;
		}
	}
	public function edit_program ($id_anggota, $admin = FALSE, $keanggotaan = FALSE) {
		if(!$admin) {
			$keanggotaan = $this->input->post('keanggotaan');
			$program = $this->input->post('program');

			if(! $this->validasi_program($keanggotaan, $program)) return FALSE;

			$cari['id_anggota'] = $id_anggota;
			$cari['program'] = $program;	
		}
		
		if($keanggotaan == 1) {
			if($admin) {
				$cari['id_santri'] = $this->input->post('id_santri');
				$data['jenjang'] = (int) $this->input->post('jenjang');
			}
			$tabel = 'santri';
			$data['sudah_lulus'] = (int) $this->input->post('sudah_lulus');
			$data['kbm_tahun'] = (int) $this->input->post('kbm_tahun');
			$data['kbm_semester'] = (int) $this->input->post('kbm_semester');
		}
		else if($keanggotaan == 2) {
			$tabel = 'pengajar';
			if($admin) {
				$cari['id_pengajar'] = $this->input->post('id_pengajar');
				$data['jenjang'] = (int) $this->input->post('jenjang');
			}
			else if($program == 1) {
				$data['data1'] = (int) $this->input->post('pendaftaran');

				$memenuhi_syarat = $this->input->post('memenuhi_syarat');
				$string = '';
				for($i=0; $i<3; $i++) {
					if(isset($memenuhi_syarat[$i])) $string .= '1:'; else $string .= '0:';
				}
				$data['data2'] = $string;
				$data['data3'] = $this->input->post('alasan_mendaftar');
			}
			else return FALSE;
		}
		$this->db->where($cari)->update($tabel, $data);
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}
	public function hapus_program ($id_anggota) {
		$keanggotaan = (int) $this->input->post('keanggotaan');
		$program = (int) $this->input->post('program');

		if(! $this->validasi_program($keanggotaan, $program)) return FALSE;

		$data['id_anggota'] = $id_anggota;
		$data['program'] = $program;

		if($keanggotaan == 1) {
			$tabel = 'santri';
		}
		else if($keanggotaan == 2) {
			$tabel = 'pengajar';
		}
		$this->db->delete($tabel, $data);
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}

	public function penjadwalan_pengajar($id_anggota, $program) {
		$id_anggota = $id_anggota;
		$pengajar = $this->db->select('id_pengajar')->where(array('id_anggota' => $id_anggota, 'program' => $program))->get('pengajar')->row();
		if(!isset($pengajar->id_pengajar)) return NULL;
		$id_pengajar = $pengajar->id_pengajar;
		return $this->db->where(array('id_pengajar' => $id_pengajar))->order_by('id_jadwal ASC')->get('jadwal')->result();
	}

	public function edit_jumlah_kelompok($id_anggota) {
		$program = (int) $this->input->post('program');
		$jumlah_kelompok = (int) $this->input->post('jumlah_kelompok');

		if($program < 1|| $program > 3) return FALSE;
		if($jumlah_kelompok < 1) return FALSE;

		$data['id_anggota'] = $id_anggota;
		$data['program'] = $program;

		$this->db->where($data)->set(array('jumlah_kelompok' => $jumlah_kelompok))->update('pengajar');
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}

	public function tambah_penjadwalan_pengajar($id_anggota) {
		if(!$this->cek_penjadwalan_pengajar()) {
			$this->session->set_flashdata('error', 'Penjadwalan pengajar sudah ditutup.');
			return FALSE;
		}
		$program = (int) $this->input->post('program');
		$pengajar= $this->db->get_where('pengajar',array('id_anggota' => $id_anggota, 'program' => $program))->row();
		if(isset($pengajar->id_pengajar)) $id_pengajar = $pengajar->id_pengajar; else return FALSE;
		$data['id_pengajar'] = $id_pengajar;
		$data['hari'] = (int) $this->input->post('hari');
		if($data['hari']<1 || $data['hari']>7) return FALSE;
		$waktu = str_replace('.', ':', $this->input->post('waktu'));
		if(!preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $waktu)) return FALSE;
		$data['waktu'] = date_create($this->input->post('waktu'))->format('H:i:s');
		$this->db->insert('jadwal', $data);
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}

	public function edit_penjadwalan_pengajar($id_anggota) {
		if(!$this->cek_penjadwalan_pengajar()) {
			$this->session->set_flashdata('error', 'Penjadwalan pengajar sudah ditutup.');
			return FALSE;
		}
		$program = (int) $this->input->post('program');
		$pengajar= $this->db->get_where('pengajar',array('id_anggota' => $id_anggota, 'program' => $program))->row();
		if(isset($pengajar->id_pengajar)) $id_pengajar = $pengajar->id_pengajar; else return FALSE;
		$id_jadwal = (int) $this->input->post('id_jadwal');
		$data['hari'] = (int) $this->input->post('hari');
		if($data['hari']<1 || $data['hari']>7) return FALSE;
		$waktu = str_replace('.', ':', $this->input->post('waktu'));
		if(!preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $waktu)) return FALSE;
		$data['waktu'] = date_create($this->input->post('waktu'))->format('H:i:s');
		$this->db->where(array('id_jadwal' => $id_jadwal, 'id_pengajar' => $id_pengajar))->set($data)->update('jadwal');
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}

	public function hapus_penjadwalan_pengajar($id_anggota) {
		if(!$this->cek_penjadwalan_pengajar()) {
			$this->session->set_flashdata('error', 'Penjadwalan pengajar sudah ditutup.');
			return FALSE;
		}
		$program = (int) $this->input->post('program');
		$id_jadwal = (int) $this->input->post('id_jadwal');
		$pengajar= $this->db->get_where('pengajar',array('id_anggota' => $id_anggota, 'program' => $program))->row();
		if(isset($pengajar->id_pengajar)) $id_pengajar = $pengajar->id_pengajar; else return FALSE;
		$this->db->where(array('id_jadwal' => $id_jadwal, 'id_pengajar' => $id_pengajar))->delete('jadwal');
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}

	public function anggota($id_anggota = NULL) {
		if(empty($id_anggota)) return $this->db->get('anggota')->result();
		else return $this->db->get_where('anggota', array('id_anggota' => $id_anggota))->row();
	}

	public function edit_akun($id_anggota) {
		if(!$this->validasi_akun($id_anggota)) {
			$this->session->set_flashdata('error', validation_errors());
			return FALSE;
		}

		$data = $this->input->post();

		$this->db->where(array('id_anggota' => $id_anggota))->set($data)->update('anggota');
		if($this->db->affected_rows() < 1) {
			$this->session->set_flashdata('error', 'Data tidak diubah.');
			return FALSE;
		}

		else {
			$this->session->set_flashdata('success', 'Data berhasil diubah.');
			return TRUE;
		}
	}

	public function edit_password($id_anggota, $admin = FALSE) {
		if(!$this->validasi_password($admin)) return FALSE;
		$password_baru = password_hash($this->input->post('password_baru'), PASSWORD_BCRYPT);
		$this->db->where(array('id_anggota' => $id_anggota))->set(array('password' => $password_baru))->update('anggota');
		if($this->db->affected_rows() < 1) {
			$this->session->set_flashdata('error', 'Password tidak diubah.');
			return FALSE;
		}
		else {
			$this->session->set_flashdata('success', 'Password berhasil diubah.');
			return TRUE;
		}
	}
}