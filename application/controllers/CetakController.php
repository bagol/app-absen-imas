<?php 


class CetakController extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('JadwalModel');
    $this->load->model('KelasSiswaModel');
    $this->load->model('WaliKelasModel');
    $this->load->model('GuruModel');
  }

  function cetak($kode_jadwal) {
    $jadwal = $this->JadwalModel->find(['kode_jadwal' => $kode_jadwal])->result_array()[0];
    $kelas = $this->KelasSiswaModel->find(['kode_kelas_siswa' => $jadwal['kode_kelas_siswa']])->result_array()[0];
    $wali_kelas = $this->WaliKelasModel->find(['nip' => $kelas['kode_walikelas']])->result_array()[0];
    $guru = $this->GuruModel->find(['nip' => $jadwal['nip']])->result_array()[0];
    $data = [
      'mapel' => $kode_jadwal,
      'jadwal' => $jadwal,
      'kelas' => $kelas,
      'wali_kelas' => $wali_kelas,
      'guru' => $guru
    ];

    $this->load->view('cetak/cetak',$data);
  }
}