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
        //$this->output->enable_profiler(TRUE);
        if(! $this->guest_model->pendaftaran_buka()) {
        	$this->session->set_flashdata('error','Pendaftaran sudah ditutup.<br />'.PHP_EOL);
        	redirect(site_url());
        };
        if($this->guest_model->cek_login()) {
        	$this->session->set_flashdata('error','Anda sudah login.<br />'.PHP_EOL);
        	redirect(site_url('user/dasbor'));
        };

    }

    public function _cek_daftar() {
    	if(!$this->session->userdata('id_anggota_baru')) {
			redirect(site_url('daftar'));
    	}
    }

	public function index()
	{
		$data['error'] = $this->session->flashdata('error');
		$data['post'] = $this->session->userdata('post');
		$data['info'] = $this->db->select('isi')->where(array('nama' => 'pengumuman'))->get('sistem')->row()->isi;
		$this->load->view('header');
		$this->load->view('daftar', $data);
		$this->load->view('footer');
	}
	public function proses() {
		if($this->guest_model->daftar()) {
			$this->session->set_userdata('id_anggota', $this->db->insert_id());
			redirect(site_url('user/dasbor'));
		}
		else {
			redirect(site_url('daftar'));
		}
	}
}
