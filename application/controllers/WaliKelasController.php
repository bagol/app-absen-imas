<?php

class WaliKelasController extends CI_Controller {
  function __construct(){
    parent::__construct();  
      if($this->session->userdata('role') !== 'wali_kelas'){
        redirect('Auth/cekSession');
      }
      $this->load->model('KelasSiswaModel');
      $this->load->model('JadwalModel');
      $this->load->model('AbsenModel');
      $this->load->model('SiswaModel');
  }

  function index(){
   
    $this->load->view('layout/newHeader');
    $this->load->view('wali_kelas/dashboard');
    $this->load->view('layout/footer');
  }

  function jadwalKelas($kodeKelas=null) {
    if(!$kodeKelas){
      redirect($_SERVER['HTTP_REFERER']);
    } 

    $where = ['kode_kelas_siswa' => $kodeKelas];
    $jadwal = $this->JadwalModel->find($where);
    if(!$jadwal->num_rows()){
      $data['jadwal'] = 0;
    }

    $data['jadwal'] = $jadwal->result_array();
    $title = [
      'main' => 'Jadwal',
      'title' => 'Jadwal Kelas',
      'subTitle' => 'jadwal Siswa'
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('wali_kelas/jadwal_kelas',$data);
    $this->load->view('layout/footer');

  }

  function absenSiswa($kodejadwal = null) {
    $title = [
      'main' => 'Absen',
      'title' => 'Rekap Absen',
      'subTitle' => 'Absen Perkelas'
    ];
    $data['kode_jadwal'] = $kodejadwal;
    $this->load->view('layout/header',$title);
    $this->load->view('wali_kelas/absen_siswa',$data);
    $this->load->view('layout/footer');
  }

  function siswaKelas($kodeKelas = null){
    if(!$kodeKelas){
      redirect('Auth/cekSession');
    }
    $siswa = $this->SiswaModel->find(['kelas_siswa' => $kodeKelas])->result_array();
    $dataSiswa = [];
    foreach ($siswa as $s) {
      array_push($dataSiswa,[
        'nis' => $s['nis'],
        'nama' => $s['nama_siswa'],
        'tempat_lahir' => $s['tempat_lahir_siswa'],
        'tanggal_lahir' => $s['tanggal_lahir_siswa'],
        'jenis_kelamin' => $s['jenis_kelamin_siswa'],
        'alamat' => $s['alamat'],
        'foto' => $s['foto'],
        'tahun_angkatan' => $s['tahun_angkatan']
      ]);
    }
    $title = [
      'main' => 'Siswa',
      'title' => 'Daftar Siswa',
      'subTitle' => 'kelas'
    ];
    $data['siswa'] = $dataSiswa;
    $this->load->view('layout/header',$title);
    $this->load->view('wali_kelas/siswa_perkelas',$data);
    $this->load->view('layout/footer');
  }

}