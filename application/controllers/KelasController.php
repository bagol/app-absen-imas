<?php 

class KelasController extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('KelasModel');
    if($this->session->userdata('role') !== 'admin'){
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  function store() {
    $whereNama = ['nama_kelas' => $this->input->post('kelas')];
    if($this->KelasModel->find($whereNama)->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Kelas Suadah ada'
      ]);
      return;
    }
    $data = [
      'kode_kelas' => $this->input->post('kode'),
      'nama_kelas' => $this->input->post('kelas')
    ];
    if($this->KelasModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Kelas Berhasil ditambahkan'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Terjadi Kesalahan saat menambah data'
      ]);
    }
  }

  function update($kode_kelas) {
    $where = ['kode_kelas' => $kode_kelas];
    if(!$this->KelasModel->find($where)->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'kode kelas tidak diketahu'
      ]);
      return;
    }
    $whereNama = ['nama_kelas' => $this->input->post('kelas')];
    if($this->KelasModel->find($whereNama)->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Kelas Suadah ada'
      ]);
      return;
    }
    $data = ['nama_kelas' => $this->input->post('kelas')];
    if($this->KelasModel->update($data,$where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'data berhasil diperbaharui'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'data gagal diperbaharui'
      ]);
    }
  }

  function delete($kode_kelas) {
    if($this->KelasModel->delete(['kode_kelas' => $kode_kelas])){
      echo json_encode([
        'status' => 'success',
        'message' => 'berhasil dihapus'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'terjadi kesalahan'
      ]);
    }
  }
}