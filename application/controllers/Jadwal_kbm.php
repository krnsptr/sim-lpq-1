<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_kbm extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('header');
		$this->load->view('jadwal_kbm');
		$this->load->view('footer');
	}
}
