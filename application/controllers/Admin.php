<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != 'administrasi' || $_SERVER['PHP_AUTH_PW'] != 'b15m!LL4H') {
	      header('WWW-Authenticate: Basic realm="SIM LPQ"');
	      header('HTTP/1.0 401 Unauthorized');
	      die('Access Denied');
	    }
        $this->load->model('user_model');
        $this->load->model('admin_model');
        //$this->output->enable_profiler(TRUE);
    }

	//fungsi _view() nampilin header, halaman, dan footer sekaligus
	public function _view($halaman = 'beranda', $data = NULL) //nama fungsi pakai underscore di awal supaya fungsi ngga bisa diakses pake URL
	{
		$this->load->view('admin/header');
		$this->load->view('admin/'.$halaman, $data);
		$this->load->view('admin/footer');
	}

	public function index()
	{
		$this->load->view('admin/beranda');
	}

	public function dasbor()
	{
		$this->_view('dasbor');
	}
 	
	public function anggota()
	{
		$data['anggota'] = $this->user_model->anggota();
		$this->_view('anggota', $data);
	}

	public function santri()
	{
		$data['santri'] = $this->admin_model->santri();
		$this->_view('santri', $data);
	}

	public function pengajar()
	{
		$data['pengajar'] = $this->admin_model->pengajar();
		$this->_view('pengajar', $data);
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

	public function edit_akun() {
		if($this->user_model->edit_akun($this->input->post('id_anggota'))) echo 'success';
		else show_error(NULL, 403);
	}

	public function edit_password() {
		if($this->user_model->edit_password($this->input->post('id_anggota'), TRUE)) echo 'success';
		else show_error(NULL, 403);
	}

	public function program_santri() {
		$santri = $this->admin_model->program_santri($this->input->post('id_santri'));
		if($santri) echo json_encode($santri);
		else show_error(NULL, 403);
	}

	public function edit_program_santri() {
		if($this->user_model->edit_program(NULL, TRUE, 1)) echo 'success';
		else show_error($this->db->last_query(), 403);
	}

	public function program_pengajar() {
		$pengajar = $this->admin_model->program_pengajar($this->input->post('id_pengajar'));
		if($pengajar) echo json_encode($pengajar);
		else show_error(NULL, 403);
	}

	public function edit_program_pengajar() {
		if($this->user_model->edit_program(NULL, TRUE, 2)) echo 'success';
		else show_error($this->db->last_query(), 403);
	}
}
