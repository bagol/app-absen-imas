<?php

/**
 * Model untuk table kelas_siswa 
 */

 class JadwalModel extends CI_Model{
	private $table = "tbl_jadwal";

	/**
	* Function store
	* untuk menyimpan data jadwal
	*/

	function store($data){
		if(!$data) return false;
		return $this->db->insert($this->table,$data);
	}

	/**
	 * function untuk mencari data jadwal secara spesifik
	 * sesuai dengan keriteria
	 */
	function find($where){
		if(!$where) return false;
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tbl_mapel','tbl_mapel.kode_mapel=tbl_jadwal.kode_mapel');
		$this->db->where($where);
		return $this->db->get();
	}

	function getJadwalByNip($nip){
		$sql = "SELECT jadwal.*,kelas.nama_kelas,mapel.nama_mapel,guru.nama_guru from tbl_jadwal jadwal join tbl_kelas_siswa kelas_siswa on jadwal.kode_kelas_siswa = kelas_siswa.kode_kelas_siswa join tbl_mapel mapel on jadwal.kode_mapel=mapel.kode_mapel join tbl_kelas kelas on kelas_siswa.kode_kelas = kelas.kode_kelas join tbl_guru guru on jadwal.nip = guru.nip and guru.nip =".$nip.' and jadwal.status= 1';
		return $this->db->query($sql);
	}

	/**
	 * function get untuk mengambil semua data jadwal
	 */
	function get(){
		$sql = "SELECT jadwal.*,kelas.nama_kelas,mapel.nama_mapel,guru.nama_guru from tbl_jadwal jadwal join tbl_kelas_siswa kelas_siswa on jadwal.kode_kelas_siswa = kelas_siswa.kode_kelas_siswa join tbl_mapel mapel on jadwal.kode_mapel=mapel.kode_mapel join tbl_kelas kelas on kelas_siswa.kode_kelas = kelas.kode_kelas join tbl_guru guru on jadwal.nip = guru.nip";
		return $this->db->query($sql);
	}

	function getJadwalAktif(){
		$sql = "SELECT jadwal.*,kelas.nama_kelas,mapel.nama_mapel,guru.nama_guru from tbl_jadwal jadwal join tbl_kelas_siswa kelas_siswa on jadwal.kode_kelas_siswa = kelas_siswa.kode_kelas_siswa join tbl_mapel mapel on jadwal.kode_mapel=mapel.kode_mapel join tbl_kelas kelas on kelas_siswa.kode_kelas = kelas.kode_kelas join tbl_guru guru on jadwal.nip = guru.nip where jadwal.status = 1";
		return $this->db->query($sql);
	}

	function getPertemuan($kode){
		if(!$kode) return false;
		$sql = 'SELECT absen.pertemuan_ke,mapel.nama_mapel,absen.tanggal, jadwal.kode_jadwal from tbl_jadwal jadwal join tbl_mapel mapel on jadwal.kode_mapel=mapel.kode_mapel left join absen on jadwal.kode_jadwal=absen.kode_jadwal WHERE jadwal.kode_jadwal='.$kode.' ORDER BY absen.pertemuan_ke DESC LIMIT 1';
		return $this->db->query($sql);
	}

	function getAllPertemuan($kode) {
		$sql = 'SELECT DISTINCT absen.pertemuan_ke,mapel.nama_mapel,absen.tanggal, jadwal.kode_jadwal from tbl_jadwal jadwal join tbl_mapel mapel on jadwal.kode_mapel=mapel.kode_mapel left join absen on jadwal.kode_jadwal=absen.kode_jadwal WHERE jadwal.kode_jadwal='.$kode.' ORDER BY absen.pertemuan_ke ';
		return $this->db->query($sql);
	}

	function getTanggal($kode) {
		$sql = 'SELECT DISTINCT absen.tanggal,mapel.nama_mapel, jadwal.kode_jadwal from tbl_jadwal jadwal join tbl_mapel mapel on jadwal.kode_mapel=mapel.kode_mapel left join absen on jadwal.kode_jadwal=absen.kode_jadwal WHERE jadwal.kode_jadwal='.$kode.' ORDER BY absen.pertemuan_ke ';
		return $this->db->query($sql);
	}

	/**
	 * function update untuk memperbaharui data jadwal sesuai keriteria
	 */
	function update($data,$where){
		if(!$data || !$where) return false;
		$this->db->where($where);
		return $this->db->update($this->table,$data);
	}

	/**
	 * function delete digunakan untuk mendelet jadwal sesuai kertiteria
	 */

	function delete($where){
		if(!$where) return false;
		$this->db->where($where);
		return $this->db->delete($this->table);
	}
 }