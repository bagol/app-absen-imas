<?php

class JadwalController extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('JadwalModel');
  }

  function store(){
    $data = [
      'kode_mapel' => $this->input->post('mapel'),
      'kode_kelas_siswa' => $this->input->post('kelas'),
      'hari' => $this->input->post('hari'),
      'jam_ke' => $this->input->post('jam_ke'),
      'waktu' => $this->input->post('waktu'),
      'nip' => $this->input->post('guru'),
      'status' => 1
    ];
    if($this->JadwalModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Jadwal Berhasil ditambahkan',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menambahkan Kelas',
        'icon' => 'error'
      ]);
    }
  }

  function updateJadwal($kode = null) {
    if($kode == null){
      redirect('Auth/cekSession');
    }
    $data = [
      'kode_kelas_siswa' => $this->input->post('kelas'),
      'kode_mapel' => $this->input->post('mapel'),
      'hari' => $this->input->post('hari'),
      'jam_ke' => $this->input->post('jam_ke'),
      'nip' => $this->input->post('guru'),
      'waktu' => $this->input->post('waktu'),
    ];
    $where = ['kode_mapel' => $kode];
    if($this->JadwalModel->update($data,$where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'jadwal berhasil diperbaharuui',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui jadwal',
        'icon' => 'error'
      ]);
    }
  }

  function deleteJadwal($kode = null) {
    if($kode == null){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Kode Jadwal tidak boleh kosong',
        'icon' => 'error'
      ]);
      return;
    }

    $where = ['kode_jadwal' => $kode];
    if($this->JadwalModel->delete($where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data Jadwal Berhasil dihapus',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal menghapus Kelas',
        'icon' => 'error'
      ]);
    }
  }
}