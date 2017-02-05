<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        $this->load->model('guest_model');
        if(! $this->guest_model->pendaftaran_buka()) {
        	$this->session->set_flashdata('error','Pendaftaran sudah ditutup.<br />'.PHP_EOL);
        	redirect(site_url());
        };
        if($this->guest_model->cek_login()) {
        	$this->session->set_flashdata('error','Anda sudah login.<br />'.PHP_EOL);
        	redirect(site_url('user/dasbor'));
        };

    }

	public function index($proses = NULL)
	{
		if(is_null($proses)) {
			$data['error'] = $this->session->flashdata('error');
			$data['post'] = $this->session->userdata('post');
			$this->load->view('header');
			$this->load->view('daftar', $data);
			$this->load->view('footer');
		}
		else {
			if($this->guest_model->daftar()) {
				echo 'success';
				$this->session->unset_tempdata('post');
			}
			else {
				redirect(site_url('daftar'));
			}
		}
	}
}
