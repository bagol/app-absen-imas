<?php

/**
 * Model untuk table kelas_siswa 
 */

 class MapelModel extends CI_Model{
     private $table = "tbl_mapel";

     /**
      * Function store
      * untuk menyimpan data mata pelajaran
      */

      function store($data){
          if(!$data) return false;
          return $this->db->insert($this->table,$data);
      }

      /**
       * function untuk mencari data mata pelajaran secara spesifik
       * sesuai dengan keriteria
       */
      function find($where){
          if(!$where) return false;
          $this->db->where($where);
          return $this->db->get($this->table);
      }

      /**
       * function get untuk mengambil semua data mata pelajaran
       */
      function get(){
            return $this->db->get($this->table);
      }

      /**
       * function update untuk memperbaharui data mata pelajaran sesuai keriteria
       */
      function update($data,$where){
          if(!$data || !$where) return false;
          $this->db->where($where);
          return $this->db->update($this->table,$data);
      }

      /**
       * function delete digunakan untuk mendelet mata pelajaran sesuai kertiteria
       */

      function delete($where){
          if(!$where) return false;
          $this->db->where($where);
          return $this->db->delete($this->table);
      }
 }