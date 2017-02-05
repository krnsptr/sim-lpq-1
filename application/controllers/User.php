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
    }

	//fungsi _view() nampilin header, halaman, dan footer sekaligus
	public function _view($halaman = 'dasbor') //nama fungsi pakai underscore di awal supaya fungsi ngga bisa diakses pake URL
	{
		if($this->user_model->cek_login()) {
			$this->load->view('header');
			$this->load->view('user/'.$halaman);
			$this->load->view('footer');
		}
		else {
			$this->session->set_flashdata('error', 'Anda belum login.<br />'.PHP_EOL);
			redirect(site_url());
		}
	}

	public function index()
	{
		redirect(site_url('user/dasbor'));
	}

	public function login() {
		if($this->user_model->login()) {
				echo 'success';
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
		$this->_view();
	}

	public function program($aksi = NULL)
	{
		if(strtolower($aksi) == 'tambah') $this->_view('program-tambah');
		else if(strtolower($aksi) == 'edit') $this->_view('program-edit');
		else if(strtolower($aksi) == 'hapus') $this->_view('program-hapus');
		else redirect(site_url('user/dasbor'));
	} 	

	public function penjadwalan($aksi = NULL)
	{
		if(strtolower($aksi) == 'hapus') $this->_view('penjadwalan-hapus');
		else $this->_view('penjadwalan');
	}

	public function kelompok()
	{
		$this->_view('kelompok');
	}

	public function akun()
	{
		$this->_view('akun');
	}

	public function spp()
	{
		$this->_view('spp');
	}
}
