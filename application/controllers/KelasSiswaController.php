<?php 

class KelasSiswaController extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('role') !== 'admin'){
      redirect('Auth/cekSession');
    }
    $this->load->model('KelasSiswaModel');
    $this->load->model('GuruModel');
    $this->load->model('WaliKelasModel');
  }

  function store(){
    if($this->KelasSiswaModel->find([
      'tbl_kelas_siswa.kode_kelas' => $this->input->post('ruang'),
      'tahun_ajaran' => $this->input->post('tahun')
    ])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'runag kelas sudah digunakan',
        'icon' => 'warning'
      ]);
      return;
    }

    $calon_wali_kelas = $this->GuruModel->find(['nip' => $this->input->post('wali')])->result_array()[0];
    
    $jadi_wali_kelas = [
      'nip' => $calon_wali_kelas['nip'],
      'nama_wali_kelas' => $calon_wali_kelas['nama_guru'],
      'email_wali_kelas' => $calon_wali_kelas['email_guru'],
      'password' => password_hash($calon_wali_kelas['nip'],PASSWORD_BCRYPT,['const' => 12]),
      'foto' => $calon_wali_kelas['foto'],
      'status' => 'aktif'
    ];

    if(!$this->WaliKelasModel->find(['nip' => $jadi_wali_kelas['nip']])->num_rows()){
      if(!$this->WaliKelasModel->store($jadi_wali_kelas)){
        echo json_encode([
          'status' => 'fail',
          'message' => 'Terjadi kesalahan saat menambahkan wali kelas',
          'icon' => 'error'
        ]);
        return;
      }
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