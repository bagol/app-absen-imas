<?php

class KepalaSekolahModel extends CI_Model {
  private $table =  'tbl_kepala_sekolah';

  function store ($data= null){
    if(!$data) return false;
    return $this->db->insert($this->table,$data);
  }

  function get() {
    return $this->db->get($this->table);
  }

  function find($where = null) {
    if(!$where) return false;
    $this->db->where($where);
    return $this->db->get($this->table);
  }

  function update($data = null,$where = null) {
    if(!$data || !$where) return false;
    $this->db->where($where);
    return $this->db->update($this->table,$data);
  }

  function delete($where = null) {
    if(!$where) return false;
    $this->db->where($where);
    return $this->db->delete($this->table);
  }
}