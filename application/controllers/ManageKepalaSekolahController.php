<?php

class ManageKepalaSekolahController extends CI_Controller {
  function __construct(){
    parent::__construct();

    $this->load->model('KepalaSekolahModel');
  }

  function simpanKepsek(){
    $data = [
      'nuks' => $this->input->post('nip'),
      'nama_kepala_sekolah' => $this->input->post('nama'),
      'email_kepala_sekolah' => $this->input->post('email'),
      'foto' => $this->do_upload('foto'),
      'status' => 'aktif',
      'password' => password_hash($this->input->post('nip'),PASSWORD_BCRYPT,['const'=> 12])
    ];

    if($this->KepalaSekolahModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Kepala Sekolah Berhasil ditambahkan',
        'icon' => 'success'
      ]);
      return;
    }
    
    echo json_encode([
      'status' => 'fail',
      'message' => 'Gagal menambahkan Kepala Sekolah',
      'icon' => 'error'
    ]);
  }

  function editKepsek($nuks = null){
    if(!$nuks) redirect('Auth/cekSession');
    $where = ['nuks' => $nuks];
    $data = [
      'nama_kepala_sekolah' => $this->input->post('nama'),
      'email_kepala_sekolah' => $this->input->post('email'),
      'status' => $this->input->post('status'),
    ];
    
    if($_FILES['foto']['name'] != null){
      $data['foto'] = $this->do_upload('foto');
    }

    if($this->KepalaSekolahModel->update($data,$where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data Kepala Sekolah Berhasil diperbaharui',
        'icon' => 'success',
      ]);
      return;
    }

    echo json_encode([
      'status' => 'fail',
      'message' => 'Gagal memperbaharui Data Kepala Sekolah',
      'icon' => 'error',
    ]);
  }

  function deleteKepsek($nuks = null){
    if(!$nuks) redirect('Auth/cekSession');
    $where = ['nuks' => $nuks];
    if($this->KepalaSekolahModel->delete($where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data Kepala Sekolah Berhasil dihapus',
        'icon' => 'success'
      ]);
      return;
    }

    echo json_encode([
      'status' => 'fail',
      'message' => 'Gagal menghapus data Kepala Sekolah',
      'icon' => 'error'
    ]);
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