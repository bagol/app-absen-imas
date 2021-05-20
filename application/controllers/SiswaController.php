<?php

class SiswaController extends CI_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('SiswaModel');
  }

  function store() {
    $data = [
      'nis' => $this->input->post('nisn'),
      'nama_siswa' => $this->input->post('nama_siswa'),
      'tempat_lahir_siswa' => $this->input->post('tempat_lahir'),
      'tanggal_lahir_siswa' => $this->input->post('tanggal_lahir'),
      'jenis_kelamin_siswa' => $this->input->post('jenis_kelamin'),
      'alamat' => $this->input->post('alamat'),
      'password' => password_hash($this->input->post('nisn'),PASSWORD_BCRYPT,['const'=>12]),
      'status' => $this->input->post('status'),
      'tahun_angkatan' => $this->input->post('tahun_angkatan'),
      'kelas_siswa' => $this->input->post('kelas'),
      'foto' => $this->do_upload('foto')
    ];
    
    if($this->SiswaModel->find(['nis' => $data['nis']])->num_rows() > 0) {
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal menambahkan Siswa, NIS telah terdaftar',
        'icon' => 'error',
        'data' => $data
      ]);
      return;
    }

    if($this->SiswaModel->store($data)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Siswa Berhasil ditambahkan',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal menambahkan Siswa',
        'icon' => 'error'
      ]);
    }
  }

  public function editSiswa($nis = null){
    $data = [
      'nama_siswa' => $this->input->post('nama_siswa'),
      'tanggal_lahir_siswa' => $this->input->post('tanggal_lahir'),
      'tempat_lahir_siswa' => $this->input->post('tempat_lahir'),
      'jenis_kelamin_siswa' => $this->input->post('jenis_kelamin'),
      'kelas_siswa' => $this->input->post('kelas'),
      'status' => $this->input->post('status'),
      'alamat' => $this->input->post('alamat'),
      'tahun_angkatan' => $this->input->post('tahun_angkatan')
    ];
    if(!$nis){
      redirect('Auth/cekSession');
    }
    if($_FILES['foto']['name'] !== ""){
      $data['foto'] = $this->do_upload('foto');
    }
    $where = ['nis' => $nis];
    if($this->SiswaModel->update($data,$where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Data siswa berhasil diperbaharui',
        'icon' => 'success'
      ]);
    }else{
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal memperbaharui data siswa',
        'icon' => 'error'
      ]);
    }
  }

  function importSiswa($kelas = null) {
    if($_FILES['siswa']['name'] === ''){
      echo json_encode([
        'status' => 'fail',
        'message' => 'File tidak boleh kosong',
        'icon' => 'warning'
      ]);
      return;
    }
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $namaFile = $this->import('siswa');
    $data = $reader->load("./assets/import/file/".$namaFile);
    // $data = $reader->load("./assets/import/file/test.xlsx");
    $data = $data->getActiveSheet();
    $success = [];
    $fail = [];
    for($i = 2; $i <= $data->getHighestDataRow(); $i++){
      $nis = $data->getCellByColumnAndRow(1,$i)->getValue();
      $nama = $data->getCellByColumnAndRow(2,$i)->getValue();
      $tempat_lahir = $data->getCellByColumnAndRow(3,$i)->getValue();
      $tanggal_lahir = $data->getCellByColumnAndRow(4,$i)->getValue();
      $jenis_kelamin = $data->getCellByColumnAndRow(5,$i)->getValue();
      $alamat = $data->getCellByColumnAndRow(6,$i)->getValue();
      $tahun_angkatan = $data->getCellByColumnAndRow(7,$i)->getValue();
      $password = password_hash($nis,PASSWORD_BCRYPT,['const' => 12]);
      $status = 'aktif';
      $kelas_siswa = $kelas;
      $foto = 'default.png';
      $result = [
        'nis' => $nis,
        'nama_siswa' => $nama,
        'tempat_lahir_siswa' => $tempat_lahir,
        'tanggal_lahir_siswa' => $tanggal_lahir,
        'jenis_kelamin_siswa' => $jenis_kelamin,
        'alamat' => $alamat,
        'tahun_angkatan' => $tahun_angkatan,
        'password' => $password,
        'status' => $alamat,
        'foto' => $foto,
        'kelas_siswa' => $kelas_siswa
      ];

      if($this->SiswaModel->find(['nis' => $nis])->num_rows()){
        $result['error'] = 'data sudah ada';
        array_push($fail,$result);
        continue;
      }

      if($result['nis'] === null){
        $result['error'] = 'NIS tidak boleh kosong';
        array_push($fail,$result);
        continue;
      }

      if($this->SiswaModel->store($result)){
        array_push($success,$result);
      }
    }
    echo json_encode([
      'status' => 'success',
      'message' => 'test',
      'dataSuccess' => $success,
      'dataFail' => $fail,
      'dataRow' => $data->getHighestDataRow() - 1,
      'successRow' => count($success),
      'failRow' => count($fail)
    ]);
  }

  public function deleteSiswa($nis){
    $where = ['nis' => $nis];
    if($this->SiswaModel->delete($where)){
      echo json_encode([
        'status' => 'success',
        'message' => 'Siswa Berhasi dihapus',
        'icon'=> 'success'
      ]);
    }else{
      json_encode([
        'status' => 'fail',
        'message' => 'Gagal Menghapus siswa',
        'icon'=> 'error'
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

  public function import($field)
  {
    $config['upload_path']          = './assets/import/file/';
    $config['allowed_types']        = 'xlsx';
    $config['encrypt_name']         = true;
    $this->load->library('upload', $config);
    if ($this->upload->do_upload($field)){
      return $this->upload->data('file_name');
    }

    return false;
  }
}
