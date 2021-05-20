<?php 

class DashboardSiswaController extends CI_Controller {
  function __construct() {
    parent::__construct();
    if ($this->session->userdata('role') != 'siswa'){
      redirect('Auth/cekSession');
    }
    $this->load->model('JadwalModel');
    $this->load->model('AbsenModel');
  }

  function index() {
    $this->load->view('layout/newHeader');
    $this->load->view('siswa/dashboard');
    $this->load->view('layout/footer');
  }

  function absen(){
    $title = [
      'main' => 'Absen',
      'title' => 'Siswa',
      'subTitle' => 'Absen'
    ];
    $where = ['kode_kelas_siswa' => $this->session->userdata('kelas')];
    $jadwal = $this->JadwalModel->find($where)->result_array();
    $data['jadwal'] = $jadwal;
    $this->load->view('layout/header',$title);
    $this->load->view('siswa/absen',$data);
    $this->load->view('layout/footer');
  }

  function rekapAbsen( $kodeJadwal = null ){
    
    if($kodeJadwal == null) {
      redirect($_SERVER['HTTP_REFERER']);
    }
    //$mapel = $this->uri->segment(4);
    $where = [
      'kode_jadwal' => $kodeJadwal,
      'nis' => $this->session->userdata('nis')
    ];
    $mapel = $this->JadwalModel->find(['kode_jadwal' => $kodeJadwal])->result_array()[0];
    $jumlahAbsen = $this->AbsenModel->find($where);
    $data = [
      'jumlah_absen' => $jumlahAbsen->num_rows(),
      'nama_mapel' => $mapel['nama_mapel'],
    ];
    // menghitung jumlah kehadiran
    $where['keterangan'] = 'H';
    $hadir = $this->AbsenModel->find($where)->num_rows();
    $data['hadir'] = $hadir;
    // menghitung jumlah Izin
    $where['keterangan'] = 'I';
    $izin = $this->AbsenModel->find($where)->num_rows();
    $data['izin'] = $izin;
    // menghitung jumlah Alpha
    $where['keterangan'] = 'A';
    $alpha = $this->AbsenModel->find($where)->num_rows();
    $data['alpha'] = $alpha;
    
    $title = [
      'main' => 'Absen',
      'title' => 'Rekap Absen',
      'subTitle' => 'Absen Siswa'
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('siswa/rekap',$data);
    $this->load->view('layout/footer');
  }

}