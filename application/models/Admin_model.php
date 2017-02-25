<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function santri() {
		$santri = $this->db->select('id_santri, s.id_anggota, nama_lengkap, jenis_kelamin, program, jenjang')->from('santri s')->join('anggota a', 'a.id_anggota = s.id_anggota')->get()->result();
		return $santri;
	}
	public function program_santri($id_santri) {
		$santri = $this->db->select('sudah_lulus, kbm_tahun, kbm_semester, jenjang, id_kelompok')->from('santri s')->where(array('id_santri' => $id_santri))->get()->row();
		return $santri;
	}
	public function pengajar($sudah_tes = FALSE) {
		$pengajar = $this->db->select('id_pengajar, p.id_anggota, nama_lengkap, jenis_kelamin, program, jenjang')->from('pengajar p')->join('anggota a', 'a.id_anggota = p.id_anggota');
		if($sudah_tes) $pengajar = $pengajar->where('jenjang > 0');
		$pengajar = $pengajar->get()->result();
		return $pengajar;
	}
	public function program_pengajar($id_pengajar) {
		$pengajar = $this->db->select('data1, data2, data3, jenjang')->from('pengajar p')->where(array('id_pengajar' => $id_pengajar))->get()->row();
		return $pengajar;
	}
	public function tambah_kelompok($id_jadwal, $jenjang) {
		$data['id_jadwal'] = $id_jadwal;
		$data['jenjang'] = $jenjang;
		$this->db->insert('kelompok', $data);
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}

	public function hapus_kelompok($id_jadwal) {
		$this->db->delete('kelompok', array('id_jadwal' => $id_jadwal));
		if($this->db->affected_rows() < 1) return FALSE;
		else return TRUE;
	}
}