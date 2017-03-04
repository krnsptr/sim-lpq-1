<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function santri() {
		$santri = $this->db->select('id_santri, s.id_anggota, nama_lengkap, jenis_kelamin, program, jenjang, id_kelompok')->from('santri s')->join('anggota a', 'a.id_anggota = s.id_anggota')->get()->result();
		return $santri;
	}
	public function program_santri($id_santri) {
		$santri = $this->db->select('sudah_lulus, kbm_tahun, kbm_semester, jenis_kelamin, program, jenjang, id_kelompok')->from('santri s')->join('anggota a', 'a.id_anggota = s.id_anggota')->where(array('s.id_santri' => $id_santri))->get()->row();
		$cari['jenis_kelamin'] = $santri->jenis_kelamin;
		$cari['program'] = $santri->program;
		$cari['jenjang'] = $santri->jenjang;
		$jadwal = $this->db->get_where('kelompok_view', $cari)->result();
		$santri->jadwal = $jadwal;
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

	public function presensi_kbm() {
		$presensi = $this->db->select("id_kelompok, jenis_kelamin, program, jenjang, hari, TIME_FORMAT(waktu, '%H:%i') AS waktu, nama_lengkap, nomor_hp")->get('kelompok_view')->result_array();

		foreach ($presensi as $i => $kelompok) {
			$santri = $this->db->select('nama_lengkap, nomor_hp, nomor_id')->from('anggota a')->join('santri s', 'a.id_anggota = s.id_anggota')->where(array('id_kelompok' => $kelompok['id_kelompok']))->get()->result_array();
			$presensi[$i]['santri'] = $santri;
		}
		return $presensi;
	}
}