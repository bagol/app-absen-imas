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
}