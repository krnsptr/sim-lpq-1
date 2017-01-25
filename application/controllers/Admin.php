<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	//fungsi _view() nampilin header, halaman, dan footer sekaligus
	public function _view($halaman = 'beranda') //nama fungsi pakai underscore di awal supaya fungsi ngga bisa diakses pake URL
	{
		$this->load->view('admin/header');
		$this->load->view('admin/'.$halaman);
		$this->load->view('admin/footer');
	}

	public function index()
	{
		$this->_view();
	}

	public function dasbor()
	{
		$this->_view('dasbor');
	}
 	
	public function anggota()
	{
		$this->_view('anggota');
	} 	

	public function santri()
	{
		$this->_view('santri');
	}

	public function pengajar()
	{
		$this->_view('pengajar');
	}

	public function kelompok()
	{
		$this->_view('kelompok');
	}

	public function spp()
	{
		$this->_view('spp');
	}

	public function download()
	{
		$this->_view('download');
	}
}
