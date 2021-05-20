<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controller guru berfungsi mengontrol aktifitas gurus
 */

class GuruController extends CI_Controller{
  // function contructor GuruController
  function __construct(){
    parent::__construct();
    if($this->session->userdata('role') != 'guru'){
      redirect('Auth/cekSession');
    }
    $this->load->model('JadwalModel');
    $this->load->model('AbsenModel');
  }

  // index Guru Controller
  function index(){
    $this->load->view('layout/newHeader');
    $this->load->view('guru/index');
    $this->load->view('layout/footer');
  }

  // absensi
  function absen($kode = null){
    if($kode === null){
      redirect('Auth/cekSession');
    }
    $title = [
      'main' => 'Absen',
      'title' => 'Data Absensi',
      'subTitle' => 'daftar pertemuan'
    ];
    $siswa = $this->AbsenModel->getSiswaByJadwal($kode);
    $pertemuan = $this->JadwalModel->getPertemuan($kode);
    if(!$pertemuan->num_rows()){
      redirect($_SERVER['HTTP_REFERER']);
    }
    $data['siswa'] = $siswa->result_array();
    $data['pertemuan'] = $pertemuan->result_array()[0];
    
    $this->load->view('layout/header',$title);
    $this->load->view('guru/absen',$data);
    $this->load->view('layout/footer');
    $this->load->view('guru/absen_footer');
  }

  function rekapAbsen(){
    $title = [
      'main' => 'Absen',
      'title' => 'Data Absensi',
      'subTitle' => 'Rekap Absen'
    ];

    $jadwal = $this->JadwalModel->getJadwalByNip($this->session->userdata('nip'))->result_array();
    $data['jadwal'] = $jadwal;
    $this->load->view('layout/header',$title);
    $this->load->view('guru/rekap_absen',$data);
    $this->load->view('layout/footer');
  }

  function dataAbsen(){
    $title = [
      'main' => 'Absen',
      'title' => 'Data Absensi',
      'subTitle' => 'Data Absen'
    ];
  }

  function jadwalMengajar(){
    $title = [
      'main' => 'Jadwal',
      'title' => 'Jadwal',
      'subTitle' => 'Mengajar'
    ];
    $jadwal = $this->JadwalModel->getJadwalByNip($this->session->userdata('nip'))->result_array();
    $data['jadwal'] = $jadwal;
    $this->load->view('layout/header',$title);
    $this->load->view('guru/jadwal_mengajar',$data);
    $this->load->view('layout/footer');
  } 
}