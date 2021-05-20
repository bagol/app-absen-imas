<?php

class ManageWaliKelasController extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('WaliKelasModel');
  }

  function store() {
    if($_FILES['foto']['name'] === ''){
      $data['foto'] = 'default.png';
    }
    $data = [
      'nip' => $this->input->post('nip'),
      'nama_wali_kelas' => $this->input->post('nama'),
      'email_wali_kelas' => $this->input->post('email'),
      'foto' => $this->do_upload('foto'),
      'status' => 'aktif'
    ];
    if($this->WaliKelasModel->find(['nip' => $data['nip']])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'NIP Wali Kelas Sudah terdaftar',
        'icon' => 'error'
      ]);
      return;
    }

    if($this->WaliKelasModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data Wali Kelas berhasil disimpan',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal menyimpan data, Terjadi Kesalahan',
        'icon' => 'error'
      ]);
    }
  }

  function update($nip = null) {
    $data = [
      'nama_wali_kelas' => $this->input->post('nama'),
      'email_wali_kelas' => $this->input->post('email')
    ];
    if($_FILES['foto']['name'] !== ''){
      $data['foto'] = $this->do_upload('foto');
    }
    if($this->WaliKelasModel->update($data,['nip' => $nip])){
      echo json_encode([
        'status' => 'success',
        'message' => 'data berhasil diubah',
        'icon' => 'success'
      ]);
      return;
    }
    echo json_encode([
      'status' => 'fail',
      'message' => 'Gagal memperbaharui data',
      'icon' => 'error'
    ]);
  }

  function deleteWali($nip = null){
    if($nip === null){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menghapus data NIP tidak boleh kosong',
        'icon' => 'error',
      ]);
      return;
    }

    if(!$this->WaliKelasModel->find(['nip' => $nip])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menghapus data NIP tidak ditemukan',
        'icon' => 'error',
      ]);
      return;
    }

    if($this->WaliKelasModel->delete(['nip' => $nip])){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data Berhasil dihapus',
        'icon' => 'success',
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menghapus data terjadin kesalahan',
        'icon' => 'error',
      ]);
    }
  }

  public function do_upload($field)
  {
    $config['upload_path']          = './assets/images/profile/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['encrypt_name']         = true;
    $this->load->library('upload', $config);
    if ($this->upload->do_upload($field)){
      return $this->upload->data('file_name');
    }
    return 'default.png';
  }
}