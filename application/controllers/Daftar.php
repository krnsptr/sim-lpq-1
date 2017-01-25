<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('header');
		$this->load->view('daftar');
		$this->load->view('footer');
	}

	public function ipb($halaman = 1)
	{
		$this->load->view('header');
		if($halaman == 2) $this->load->view('daftar_ipb_2'); else $this->load->view('daftar_ipb_1');
		$this->load->view('footer');
	}

	public function umum()
	{
		$this->load->view('header');
		$this->load->view('daftar_umum');
		$this->load->view('footer');
	}
}
