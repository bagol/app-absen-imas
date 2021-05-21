<?php 

class ManageGuruController extends CI_Controller {
  function __construct(){
    parent::__construct();
    if($this->session->userdata('role') !== 'admin') {
      redirect("Auth/cekSession");
    }
    $this->load->model('GuruModel');
  }

  function store(){
    if(!isset($_FILES['foto'])){
      $data['foto'] = 'default.png';
    }
    $data = [
      'nip' => $this->input->post('nip'),
      'nama_guru' => $this->input->post('nama'),
      'email_guru' => $this->input->post('email'),
      'password' => password_hash($this->input->post('nip'),PASSWORD_BCRYPT,['const' => 12 ]),
      'status' => 'aktif',
      'foto' => $this->do_upload('foto')
    ];
    if ($this->GuruModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Berhasil Menambahkan data Guru',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Berhasil Menambahkan data Guru',
        'icon' => 'error'
      ]);
    }
  }

  public function editGuru($nip){
    $data = [
      'nama_guru' => $this->input->post('nama'),
      'email_guru' => $this->input->post('email'),
      'status' => $this->input->post('status'),
    ];
    if(isset($_FILES['foto'])){
     $data['foto'] = $this->do_upload('foto');
    }
    $where = ['nip' => $nip];
    if($this->GuruModel->update($data,$where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data Guru Berhasil diperbaharui',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui data guru',
        'icon' => 'error'
      ]);
    }
  }

  public function deleteGuru($nip = null){
    if($nip === null){
      redirect("AdminController/daftarGuru");
    }
    $where = ['nip' => $nip];
    if($this->GuruModel->delete($where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data guru berhasil dihapus',
        'icon' => 'success',
      ]);
      return;
    }

    echo json_encode([
      'status' => 'fail',
      'message' => 'Gagal menghapus data guru',
      'icon' => 'error',
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