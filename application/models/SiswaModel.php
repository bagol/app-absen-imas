<?php

/**
 * Model untuk table siswa
 */

class SiswaModel extends CI_Model{
    private $table = "tbl_siswa";


    /**
     * function untuk menyimpan data siswa
     */
    function store($data){
        if(!$data) return false;
        return $this->db->insert($this->table,$data);
    }

    /**
     * function untuk mencari sesui ketentuan data siswa
     */
    function find($where){
        if(!$where) return false;
        $this->db->where($where);
        return $this->db->get($this->table);
    }

    /**
     * function untuk mengambil semua data dari table siswa
     */
    function get(){
        $sql = 'select siswa.*,kelas.nama_kelas from tbl_siswa siswa join tbl_kelas_siswa kelas_siswa on siswa.kelas_siswa=kelas_siswa.kode_kelas_siswa join tbl_kelas kelas on kelas_siswa.kode_kelas=kelas.kode_kelas';
        return $this->db->query($sql);
    }

    /**
     * function untuk memperbarui data siswa sesuai $id
     */
    function update($data,$where){
        if(!$data || !$where) return false;
        $this->db->where($where);
        return $this->db->update($this->table,$data);
    }

    /**
     * function untuk menghapus data siswa sesuai keriteria/ketentuan
     */
    function delete($where){
        if(!$where) return false;
        $this->db->where($where);
        return $this->db->delete($this->table);
    }
}