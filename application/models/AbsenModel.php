<?php

/**
 * Model untuk table kelas_siswa 
 */

 class AbsenModel extends CI_Model{
     private $table = "absen";

     /**
      * Function store
      * untuk menyimpan data Absen
      */

      function store($data){
          if(!$data) return false;
          return $this->db->insert($this->table,$data);
      }


      function getSiswaByJadwal($kode){
          if(!$kode) return false;
          $sql = 'SELECT siswa.nama_siswa,siswa.nis from tbl_jadwal jadwal join tbl_siswa siswa on jadwal.kode_kelas_siswa=siswa.kelas_siswa and jadwal.kode_jadwal='.$kode.' order by siswa.nama_siswa';
          return $this->db->query($sql);
      }

      /**
       * function untuk mencari data Absen secara spesifik
       * sesuai dengan keriteria
       */
      function find($where){
          if(!$where) return false;
          $this->db->where($where);
          return $this->db->get($this->table);
      }

      /**
       * function get untuk mengambil semua data Absen
       */
      function get(){
            return $this->db->get($this->table);
      }

      /**
       * function update untuk memperbaharui data Absen sesuai keriteria
       */
      function update($data,$where){
          if(!$data || !$where) return false;
          $this->db->where($where);
          return $this->db->update($this->table,$data);
      }

      /**
       * function delete digunakan untuk mendelet Absen sesuai kertiteria
       */

      function delete($where){
          if(!$where) return false;
          $this->db->where($where);
          return $this->db->delete($this->table);
      }

      function getJumlahHadirSiswa($kodeJadawl,$nis) {
        $sql = "SELECT count(*) as jumlah_hadir FROM `absen` WHERE nis = '$nis' and kode_jadwal= '$kodeJadawl' and keterangan = 'H'";  
        return $this->db->query($sql);
      }

      function getTotalPertemuan($kodeJadawl) {
          $this->db->select('pertemuan_ke');
          $this->db->order_by('pertemuan_ke', 'DESC');
          $this->db->where(['kode_jadwal' => $kodeJadawl]);
          return $this->db->get($this->table);
      }
 }