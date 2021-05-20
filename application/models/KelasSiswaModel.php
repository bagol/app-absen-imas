<?php

/**
 * Model untuk table kelas_siswa 
 */

 class KelasSiswaModel extends CI_Model{
     private $table = "tbl_kelas_siswa";

     /**
      * Function store
      * untuk menyimpan data kelas siswa
      */

      function store($data){
          if(!$data) return false;
          return $this->db->insert($this->table,$data);
      }

      /**
       * function untuk mencari data kelas siswa secara spesifik
       * sesuai dengan keriteria
       */
      function find($where){
          if(!$where) return false;
          $this->db->select('*');
          $this->db->from($this->table);
          $this->db->join('tbl_kelas','tbl_kelas.kode_kelas=tbl_kelas_siswa.kode_kelas');
          $this->db->where($where);
          return $this->db->get();
      }

      /**
       * function get untuk mengambil semua data kelas siswa
       */
      function get(){
        $sql = "select count(siswa.nis) as siswa_per_kelas,kelas.*,kelas_siswa.*,wali_kelas.nama_wali_kelas from tbl_kelas_siswa kelas_siswa left join tbl_siswa siswa on kelas_siswa.kode_kelas_siswa = siswa.kelas_siswa join tbl_kelas kelas on kelas_siswa.kode_kelas = kelas.kode_kelas join tbl_wali_kelas wali_kelas on kelas_siswa.kode_walikelas=wali_kelas.nip where tahun_ajaran != '' group by kelas_siswa.kode_kelas_siswa";
        return $this->db->query($sql);
      }

      /**
       * function update untuk memperbaharui data kelas siswa sesuai keriteria
       */
      function update($data,$where){
        if(!$data || !$where) return false;
        $this->db->where($where);
        return $this->db->update($this->table,$data);
      }

      /**
       * function delete digunakan untuk mendelet kelas siswa sesuai kertiteria
       */

      function delete($where){
          if(!$where) return false;
          $this->db->where($where);
          return $this->db->delete($this->table);
      }
 }