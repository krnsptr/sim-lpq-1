<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	//fungsi _view() nampilin header, halaman, dan footer sekaligus
	public function _view($halaman = 'dasbor') //nama fungsi pakai underscore di awal supaya fungsi ngga bisa diakses pake URL
	{
		$this->load->view('header');
		$this->load->view('user/'.$halaman);
		$this->load->view('footer');
	}

	public function index()
	{
		redirect(base_url().'user/dasbor');
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
		else $this->_view('dasbor');
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
