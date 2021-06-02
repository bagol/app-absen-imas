<?php

class DashboardKepalaSekolahController extends CI_Controller {
  function __construct(){
    parent::__construct();
    if($this->session->userdata('role') != 'kepala_sekolah'){
      redirect('Auth/cekSession');
    }
    $this->load->model('WaliKelasModel');
    $this->load->model('GuruModel');
    $this->load->model('KelasSiswaModel');
    $this->load->model('JadwalModel');
    $this->load->model('SiswaModel');
  }

  function index(){
    $this->load->view('layout/newHeader');
    $this->load->view('kepala_sekolah/dashboard');
    $this->load->view('layout/footer');
  }

  function dataWaliKelas(){
    $title = [
      'main' => 'Wali Kelas',
      'title' => 'Data Wali Kelas',
      'subTitle' => 'Daftar Wali Kelas'
    ];
    $waliKelas = $this->WaliKelasModel->get();
    if(!$waliKelas->num_rows()){
      $data['waliKelas'] = 0;
    }else{
      $data['waliKelas'] = $waliKelas->result_array();
    }
   
    $this->load->view('layout/header',$title);
    $this->load->view('kepala_sekolah/daftarWaliKelas',$data);
    $this->load->view('layout/footer');
  }

  function dataGuru(){
    $title = [
      'main' => 'Guru',
      'title' => 'Data Guru',
      'subTitle' => 'Daftar Guru'
    ];
    $data['guru'] = $this->GuruModel->get()->result_array();
    $this->load->view('layout/header',$title);
    $this->load->view('kepala_sekolah/daftarGuru',$data);
    $this->load->view('layout/footer');
  }

  function dataKelas(){
    $title = [
      'main' => 'Kelas',
      'title' => 'Data Kelas',
      'subTitle' => 'Daftar Kelas'
    ];
    $data['kelas'] = $this->KelasSiswaModel->get()->result_array();
    $this->load->view('layout/header',$title);
    $this->load->view('kepala_sekolah/daftarKelas',$data);
    $this->load->view('layout/footer');
  }

  function jadwalKelas($kelas) {
    $title = [
      'main' => 'Kelas',
      'title' => 'Data Kelas',
      'subTitle' => 'Jadwal Peljaran'
    ];
    $where = ['kode_kelas_siswa' => $kelas];
    $jadwal = $this->JadwalModel->find($where);
    if(!$jadwal->num_rows()){
      $data['jadwal'] = 0;
    }
    $data['jadwal'] = $jadwal->result_array();
    
    $this->load->view('layout/header',$title);
    $this->load->view('kepala_sekolah/jadwal_kelas',$data);
    $this->load->view('layout/footer');
  }

  function kelasSiswa($kode_kelas) {
    $title = [
      'main' => 'Kelas',
      'title' => 'Data Kelas',
      'subTitle' => 'Siswa PerKelas'
    ];
    $siswa = $this->SiswaModel->find(['kelas_siswa' => $kode_kelas])->result_array();
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
    $data['kelas'] = $this->KelasSiswaModel->find(['kode_kelas_siswa' => $kode_kelas])->result_array()[0];
    $data['siswa'] = $dataSiswa;
    $this->load->view('layout/header',$title);
    $this->load->view('kepala_sekolah/siswa_kelas',$data);
    $this->load->view('layout/footer');
  }

  function laporanPersentase($kodeKelas) {
    $data['kode_kelas'] = $kodeKelas;
    $kelas = $this->KelasSiswaModel->find(['kode_kelas_siswa' => $kodeKelas])->result_array();
    $data['kelas'] = $kelas;
    $title = [
      'main' => 'Kelas',
      'title' => 'Data Kelas',
      'subTitle' => 'Laporan Absen'
    ];
    $data['mapel'] = $this->JadwalModel->find(['kode_kelas_siswa' => $kodeKelas])->result_array();
    $this->load->view('layout/header',$title);
    $this->load->view('kepala_sekolah/laporanPersentase',$data);
    $this->load->view('layout/footer');
  }

  function cetakLaporanPersentase($kodeKelas) {
    $data['kode_kelas'] = $kodeKelas;

    $this->load->view('cetak/cetakKepsek',$data);
  }
}