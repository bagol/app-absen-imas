<?php

/**
 * Model untuk table kelas_siswa 
 */

 class WaliKelasModel extends CI_Model{
     private $table = "tbl_wali_kelas";

     /**
      * Function store
      * untuk menyimpan data wali kelas
      */

      function store($data){
          if(!$data) return false;
          return $this->db->insert($this->table,$data);
      }

      /**
       * function untuk mencari data wali kelas secara spesifik
       * sesuai dengan keriteria
       */
      function find($where){
          if(!$where) return false;
          $this->db->where($where);
          return $this->db->get($this->table);
      }

      /**
       * function get untuk mengambil semua data wali kelas
       */
      function get(){
            $this->db->select('tbl_kelas_siswa.kode_kelas_siswa,tbl_kelas_siswa.tahun_ajaran,tbl_kelas_siswa.semester,tbl_kelas.nama_kelas,tbl_wali_kelas.nip,tbl_wali_kelas.nama_wali_kelas');
            $this->db->from($this->table);
            $this->db->join('tbl_kelas_siswa','tbl_wali_kelas.nip=tbl_kelas_siswa.kode_walikelas');
            $this->db->join('tbl_kelas','tbl_kelas_siswa.kode_kelas=tbl_kelas.kode_kelas');
            $this->db->where(['nip !=' => '']);
            return $this->db->get();
      }

      /**
       * function update untuk memperbaharui data wali kelas sesuai keriteria
       */
      function update($data,$where){
          if(!$data || !$where) return false;
          $this->db->where($where);
          return $this->db->update($this->table,$data);
      }

      /**
       * function delete digunakan untuk mendelet wali kelas sesuai kertiteria
       */

      function delete($where){
          if(!$where) return false;
          $this->db->where($where);
          return $this->db->delete($this->table);
      }
 }