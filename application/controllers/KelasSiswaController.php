<?php 

class KelasSiswaController extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('role') !== 'admin'){
      redirect('Auth/cekSession');
    }
    $this->load->model('KelasSiswaModel');
  }

  function store(){
    if($this->KelasSiswaModel->find([
      'kode_kelas' => $this->input->post('ruang'),
      'tahun_ajaran' => $this->input->post('tahun')
    ])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'runag kelas sudah digunakan',
        'icon' => 'warning'
      ]);
      return;
    }
    $data = [
      'kode_kelas' => $this->input->post('ruang'),
      'kode_walikelas' => $this->input->post('wali'),
      'tahun_ajaran' => $this->input->post('tahun'),
      'semester' => $this->input->post('semester'),
    ];

    if ($this->KelasSiswaModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Berhasil Menambahkan kelas siswa',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menambahkan Kelas siswa',
        'icon' => 'warning'
      ]);
    }
  }

  function delete($kode) {
    if($this->KelasSiswaModel->delete(['kode_kelas_siswa' => $kode])){
      echo json_encode([
        'status' => 'success',
        'message' => 'Kelas siswa berhasil dihapus',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menghapus Kelas siswa',
        'icon' => 'warning'
      ]);
    }
  }

  function update($kode) {
    if($kode === ''){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Kode Kelas tidak boleh kosong',
        'icon' => 'warning'
      ]);
      return;
    }
    $data = [
      'kode_kelas' => $this->input->post('ruang'),
      'kode_walikelas' => $this->input->post('wali'),
      'tahun_ajaran' => $this->input->post('tahun'),
      'semester' => $this->input->post('semester'),
    ];
    $where = ['kode_kelas_siswa' => $kode];
    if($this->KelasSiswaModel->update($data,$where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Kelas Berhasil diperbaharui',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Kelas Siswa',
        'icon' => 'warning'
      ]);
    }

  }
}