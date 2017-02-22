<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('guest_model');
		if($this->guest_model->cek_login()) {
        	redirect(site_url('user/dasbor'));
        };
        
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$this->load->view('header');
		$this->load->view('beranda', $data);
		$this->load->view('footer');
	}
}
