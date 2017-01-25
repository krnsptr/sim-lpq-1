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
		$this->load->view('front-end/header');
		$this->load->view('front-end/daftar');
		$this->load->view('front-end/footer');
	}

	public function ipb($halaman = 1)
	{
		$this->load->view('front-end/header');
		if($halaman == 2) $this->load->view('front-end/daftar_ipb_2'); else $this->load->view('front-end/daftar_ipb_1');
		$this->load->view('front-end/footer');
	}

	public function umum()
	{
		$this->load->view('front-end/header');
		$this->load->view('front-end/daftar_umum');
		$this->load->view('front-end/footer');
	}
}
