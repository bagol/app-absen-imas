<?php 

class MapelController extends CI_Controller{
  function __construct(){
    parent::__construct();
    // if ($this->session->userdata('role') !== 'admin'){
    //   redirect('Auth/cekSession');
    // }
    $this->load->model('MapelModel');
  }

  function store(){
    $kode = $this->input->post('kode');
    $mapel = $this->input->post('mapel');
    if($this->MapelModel->find(['kode_mapel' => $kode])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'kode mapel bentrok'
      ]);
      return;
    }
    if($this->MapelModel->find(['nama_mapel' => $mapel])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Mapel Sudah Ada'
      ]);
      return;
    }
    if($kode === ''){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Kode Mapel tidak boleh kosong'
      ]);
      return;
    }
    $data = [
      'kode_mapel' => $kode,
      'nama_mapel' => $mapel
    ];
    if($this->MapelModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Mata Pelajaran Berhasil ditambahkan'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menambahkan data pelajaran'
      ]);
    }
  }

  function delete($kode){
    if($this->MapelModel->delete(['kode_mapel' => $kode])){
      echo json_encode([
        'status' => 'success',
        'message' => $kode
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal mengapus Mapel'
      ]);
    }
  }

  function update($kode){
    if(!$this->MapelModel->find(['kode_mapel' => $kode])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal mengupdate Mapel, Kode Mapel Tidak diketahui'
      ]);
      return;
    }
    $mapel = $this->input->post('mapel');
    if($this->MapelModel->find(['nama_mapel' => $mapel])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Mapel Sudah Ada'
      ]);
      return;
    }
    $data = ['nama_mapel' => $mapel];
    $where = ['kode_mapel' => $kode];
    if($this->MapelModel->update($data,$where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Mapel Berhsil diperbaharui'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Mapel'
      ]);
    }
  }
}