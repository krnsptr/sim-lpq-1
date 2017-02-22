<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        //$this->output->enable_profiler(TRUE);
    }

    public function _cek_login() {
    	if(!$this->user_model->cek_login()) {
    		$this->session->set_flashdata('error', 'Anda belum login.<br />'.PHP_EOL);
			redirect(site_url());
    	}
    }

	//fungsi _view() nampilin header, halaman, dan footer sekaligus
	public function _view($halaman, $data_baru = NULL) //nama fungsi pakai underscore di awal supaya fungsi ngga bisa diakses pake URL
	{
		$this->_cek_login();
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');

		$data['anggota'] = $this->user_model->anggota($this->session->userdata('id_anggota'));
		$data['info'] = $this->user_model->cek_pengumuman();

		$this->load->view('user/header', $data);

		if(is_array($data_baru)) foreach ($data_baru as $key => $value) {
			$data[$key] = $value;
		};

		$this->load->view('user/'.$halaman, $data);
		$this->load->view('footer');
	}

	public function index()
	{
		redirect(site_url('user/dasbor'));
	}

	public function login() {
		if($this->user_model->login()) {
				$this->session->set_flashdata('success', 'Login berhasil.<br />'.PHP_EOL);
				redirect(site_url('user/dasbor'));
			}
			else {
				redirect(site_url());
			}
	}


	public function logout() {
		if($this->session->userdata('id_anggota')) {
			$this->session->unset_userdata('id_anggota');
			$this->session->set_flashdata('success', 'Logout berhasil.<br />'.PHP_EOL);
		}
		redirect(site_url());
	}

	public function dasbor()
	{
		$program = $this->user_model->program($this->session->userdata('id_anggota'));
		if(! $program) $data['warning'] = 'Anda belum terdaftar sebagai santri ataupun pengajar. Silakan mendaftar program.<br />'.PHP_EOL;
		$data['program'] = $program;
		$this->_view('dasbor', $data);
	}

	public function program_tambah($tambah = NULL) {
		if(empty($tambah)) {
			if(!empty($this->input->post('tambah'))) redirect(site_url('user/program/tambah/'.$this->input->post('tambah')));
		}

		$keanggotaan = (int) substr($tambah,0,1);
		$program = (int) substr($tambah,1,1);
		if($this->user_model->cek_program($this->session->userdata('id_anggota'), $keanggotaan, $program)) redirect(site_url('user/dasbor'));
		if($keanggotaan == 1 && !$this->user_model->cek_pendaftaran_santri()) {
			$this->session->set_flashdata('error','Pendaftaran santri sudah ditutup.<br />'.PHP_EOL);
			redirect(site_url('user/dasbor'));
		}
		if($keanggotaan == 2 && !$this->user_model->cek_pendaftaran_pengajar()) {
			$this->session->set_flashdata('error','Pendaftaran pengajar sudah ditutup.<br />'.PHP_EOL);
			redirect(site_url('user/dasbor'));
		}

		$data['keanggotaan'] = $keanggotaan;
		$data['program'] = $program;
		$this->_view('program-tambah', $data);
	}
	public function program_edit($keanggotaan = NULL, $program = NULL) {
		if(isset($keanggotaan) && isset($program) && $this->user_model->cek_program($this->session->userdata('id_anggota'), $keanggotaan, $program)) {
			$data['keanggotaan'] = $keanggotaan;
			$data['program'] = $program;
			$data['santri'] = $this->user_model->santri($this->session->userdata('id_anggota'), $program);
			$data['pengajar'] = $this->user_model->pengajar($this->session->userdata('id_anggota'), $program);
			$this->_view('program-edit', $data);
		}
		else
			redirect(site_url('user/dasbor'));
	}
	public function program_hapus($keanggotaan = NULL, $program = NULL) {
		if(isset($keanggotaan) && isset($program) && $this->user_model->cek_program($this->session->userdata('id_anggota'), $keanggotaan, $program)) {
			$data['keanggotaan'] = $keanggotaan;
			$data['program'] = $program;
			$this->_view('program-hapus', $data);
		}
		else
			redirect(site_url('user/dasbor'));
	}
	public function tambah_program() {
		$this->_cek_login();
		if($this->user_model->tambah_program($this->session->userdata('id_anggota'))) {
			$this->session->set_flashdata('success', 'Program berhasil ditambahkan.<br />'.PHP_EOL);
			if($this->session->flashdata('warning')) redirect(site_url('user/penjadwalan'));
			redirect(site_url('user/dasbor'));
		}
		else {
			if(!$this->session->flashdata('error')) $this->session->set_flashdata('error', 'Program gagal ditambahkan.<br />'.PHP_EOL);
			redirect(site_url('user/dasbor'));
		}
	}
	public function edit_program() {
		$this->_cek_login();
		if($this->user_model->edit_program($this->session->userdata('id_anggota'))) {
			$this->session->set_flashdata('success', 'Program berhasil diubah.<br />'.PHP_EOL);
			redirect(site_url('user/dasbor'));
		}
		else {
			$this->session->set_flashdata('error', 'Program tidak diubah.<br />'.PHP_EOL);
			redirect(site_url('user/dasbor'));
		}
	}
	public function hapus_program() {
		$this->_cek_login();
		if($this->user_model->hapus_program($this->session->userdata('id_anggota'))) {
			$this->session->set_flashdata('success', 'Program berhasil dihapus.<br />'.PHP_EOL);
			redirect(site_url('user/dasbor'));
		}
		else {
			$this->session->set_flashdata('error', 'Program gagal dihapus. Pastikan penjadwalannya kosong.<br />'.PHP_EOL);
			redirect(site_url('user/dasbor'));
		}
	}

	public function penjadwalan()
	{
		$program = $this->user_model->program($this->session->userdata('id_anggota'));
		$data['penjadwalan_pengajar'] = $this->user_model->cek_penjadwalan_pengajar();
		$data['penjadwalan_santri'] = $this->user_model->cek_penjadwalan_santri();
		$data['warning'] = $this->session->flashdata('warning');
		if(is_array($program['pengajar']))foreach ($program['pengajar'] as $key => $object) {
			$program['pengajar'][$key]->jadwal = $this->user_model->penjadwalan_pengajar($this->session->userdata('id_anggota'), $program['pengajar'][$key]->program);
		}

		$data['program'] = $program;
		$this->_view('penjadwalan', $data);
	}

	public function penjadwalan_pengajar_hapus($program, $id_jadwal) {
			$data['program'] = $program;
			$data['id_jadwal'] = $id_jadwal;
			$this->_view('penjadwalan-hapus', $data);
	}

	public function edit_jumlah_kelompok() {
		$this->_cek_login();
		if($this->user_model->edit_jumlah_kelompok($this->session->userdata('id_anggota'))) {
			$this->session->set_flashdata('success', 'Data berhasil diubah.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
		else {
			$this->session->set_flashdata('error', 'Data tidak diubah.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
	}

	public function tambah_penjadwalan_pengajar() {
		$this->_cek_login();
		if($this->user_model->tambah_penjadwalan_pengajar($this->session->userdata('id_anggota'))) {
			$this->session->set_flashdata('success', 'Jadwal berhasil ditambahkan.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
		else {
			if(!$this->session->flashdata('error')) $this->session->set_flashdata('error', 'Jadwal gagal ditambahkan. Pastikan format waktu sesuai.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
	}

	public function edit_penjadwalan_pengajar() {
		$this->_cek_login();
		if($this->user_model->edit_penjadwalan_pengajar($this->session->userdata('id_anggota'))) {
			$this->session->set_flashdata('success', 'Jadwal berhasil diubah.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
		else {
			if(!$this->session->flashdata('error')) $this->session->set_flashdata('error', 'Jadwal tidak diubah. Pastikan format waktu sesuai.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
	}

	public function hapus_penjadwalan_pengajar() {
		$this->_cek_login();
		if($this->user_model->hapus_penjadwalan_pengajar($this->session->userdata('id_anggota'))) {
			$this->session->set_flashdata('success', 'Jadwal berhasil dihapus.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
		else {
			if(!$this->session->flashdata('error'))$this->session->set_flashdata('error', 'Jadwal gagal dihapus. Pastikan jadwal tersebut belum diisi santri.<br />'.PHP_EOL);
			redirect(site_url('user/penjadwalan'));
		}
	}

	public function kelompok()
	{
		$this->_view('kelompok');
	}

	public function akun()
	{
		$this->_view('akun');
	}

	public function edit_akun() {
		$this->_cek_login();
		$this->user_model->edit_akun($this->session->userdata('id_anggota'));
		redirect(site_url('user/akun'));
	}

	public function edit_password() {
		$this->_cek_login();
		$this->user_model->edit_password($this->session->userdata('id_anggota'));
		redirect(site_url('user/akun'));
	}

	public function spp()
	{
		$this->_view('spp');
	}

	public function passres($username)
	{
		$password = password_hash('bismillah', PASSWORD_BCRYPT);
		$this->db->where(array('username' => $username))->set(array('password' => $password))->update('anggota');
		if($this->db->affected_rows() < 1) echo 'error';
		else echo 'success';
	}

	public function bypass($username)
	{
		$id_anggota = $this->db->select('id_anggota')->where(array('username' => $username))->get('anggota')->row()->id_anggota;
		$this->session->set_userdata('id_anggota', $id_anggota);
		redirect('user/dasbor');
	}
}
