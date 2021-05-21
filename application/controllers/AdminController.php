<?php


class AdminController extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('role') !== 'admin'){
      redirect('login/admin');
    }
    
    $this->load->model('KelasModel');
    $this->load->model('WaliKelasModel');
    $this->load->model('KelasSiswaModel');
    $this->load->model('SiswaModel');
    $this->load->model('GuruModel');
    $this->load->model('MapelModel');
    $this->load->model('JadwalModel');
    $this->load->model('KepalaSekolahModel');
  }

  function index(){
    $data = [
      'jumlahSiswa' => $this->SiswaModel->get()->num_rows(),
      'jumlahGuru' => $this->GuruModel->get()->num_rows()
    ];
    $this->load->view('layout/newHeader');
    $this->load->view('admin/dashboard',$data);
    $this->load->view('layout/footer');
  }

  function masterWaliKelas ( ){
    $title = [
      'main' => 'Kelas' ,
      "title" => 'Data Umum',
      'subTitle' => 'Wali Kelas'
    ];
    $walikelas = $this->WaliKelasModel->find(['status != ' => '_blank']);
    if($walikelas->num_rows()){
      $data['wali_kelas'] = $walikelas->result_array();
    }else{
      $data['wali_kelas'] = 0;
    }
    $guru['guru'] = $this->GuruModel->get()->result_array();
    $this->load->view('layout/header',$title);
    $this->load->view('admin/master/daftar_wali_kelas',$data);
    $this->load->view('layout/footer');
    $this->load->view('admin/master/daftar_wali_kelas_modal',$guru);
  }

  function masterKelas(){
    $data['kelas'] = $this->KelasModel->get()->result_array();
    $title = [
      'main' => 'Kelas' ,
      "title" => 'Data Umum',
      'subTitle' => 'Ruang Kelas'
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('admin/master/kelas',$data);
    $this->load->view('layout/footer');
    $this->load->view('admin/master/kelas_modal');
  }

  function masterMapel() {
    $mapel = $this->MapelModel->get();
    $data['mapel'] = $mapel->result_array();
    if($mapel->num_rows()){
    }else{
      $data['mapel'] = 0;
    }
    $title = [
      'main' => 'Mapel',
      "title" => 'Data Umum',
      'subTitle' => 'Mata Pelajaran'
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('admin/master/mapel',$data);
    $this->load->view('layout/footer');
    $this->load->view('admin/master/mapel_modal');
  }

  function masterKelasSiswa() {
    // deklarasi data wali kelas
    $guru = $this->GuruModel->get()->result_array();
    $wali_kelas = $this->WaliKelasModel->get()->result_array();
    $modal['guru'] = $guru;
    $modal['wali_kelas'] = $wali_kelas;
    // deklaris data ruang kelas
    $kelas = $this->KelasModel->get()->result_array();
    $modal['kelas'] = $kelas;
    // deklarasi data kelas siswa
    $kelas_siswa = $this->KelasSiswaModel->get();
    if($kelas_siswa->num_rows()){
      $data['kelas_siswa'] = $kelas_siswa->result_array();
    }else{
      $data['kelas_siswa'] = 0;
    }
    $modal['kelas_siswa'] = $kelas_siswa->result_array();
    $title = [
      'main' => 'Kelas',
      "title" => 'Data Umum',
      'subTitle' => 'Kelas Siswa'
    ]; 
    $this->load->view('layout/header',$title);
    $this->load->view('admin/master/kelas_siswa',$data);
    $this->load->view('layout/footer');
    $this->load->view('admin/master/kelas_siswa_modal',$modal);
  }

  function jadwal() {
    $jadwal = $this->JadwalModel->get();
    if(!$jadwal->num_rows()){
      $data['jadwal'] = 0;
    }else{
      $data['jadwal'] = $jadwal->result_array();
    }

    $title = [
      'main' => 'Jadwal',
      "title" => 'Jadwal Mengajar',
      'subTitle' => 'Daftar Jadwal Mengajar',
      ''
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('admin/jadwal/jadwal_mengajar',$data);
    $this->load->view('layout/footer');
  }

  function tambahJadwal() {
    $title = [
      'main' => 'Jadwal',
      "title" => 'Jadwal Mengajar',
      'subTitle' => 'Tambah Jadwal Mengajar',
      ''
    ];
    $hari = ['Senin','Selasa','Rabu','Kamis',"Jumat","Sabtu"];
    $data['hari'] = $hari;
    $data['guru'] = $this->GuruModel->get()->result_array();
    $data['kelas'] = $this->KelasSiswaModel->get()->result_array();
    $data['mapel'] = $this->MapelModel->get()->result_array();
    $this->load->view('layout/header',$title);
    $this->load->view('admin/jadwal/tambah_jadwal',$data);
    $this->load->view('layout/footer');
  }

  function editJadwal($kode = null){
    if($kode == null){
      redirect("Auth/cekSession");
    }
    $title = [
      'main' => 'Jadwal',
      "title" => 'Jadwal Mengajar',
      'subTitle' => 'Edit Jadwal Mengajar',
      ''
    ];
    $hari = ['Senin','Selasa','Rabu','Kamis',"Jumat","Sabtu"];
    $data['hari'] = $hari;
    $data['guru'] = $this->GuruModel->get()->result_array();
    $data['kelas'] = $this->KelasSiswaModel->get()->result_array();
    $data['mapel'] = $this->MapelModel->get()->result_array();
    $data['jadwal'] = $this->JadwalModel->find(['kode_jadwal' => $kode])->result_array()[0];
    $this->load->view('layout/header',$title);
    $this->load->view('admin/jadwal/edit_Jadwal',$data);
    $this->load->view('layout/footer');
  }

  function daftarGuru() {
    $guru = $this->GuruModel->get();
    $data['guru'] = $guru->result_array();
    $title = [
      'main' => 'Guru',
      "title" => 'Data Guru',
      'subTitle' => 'Daftar Guru',
      ''
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('admin/guru/daftar_guru',$data);
    $this->load->view('layout/footer');
  }

  function tambahGuru() {
    $title = [
      'main' => 'Guru',
      "title" => 'Data Guru',
      'subTitle' => 'Tambah Guru',
      ''
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('admin/guru/tambah_guru');
    $this->load->view('layout/footer');
  }

  function editGuru($nip = null) {
    if($nip === null){
      redirect('Auth/cekSession');
    }
    $guru = $this->GuruModel->find(['nip' => $nip]);
    if(!$guru->num_rows()){
      redirect('AdminController/daftarGuru');
    }
    $data['guru'] = $guru->result_array()[0];
    $title = [
      'main' => 'Guru',
      "title" => 'Data Guru',
      'subTitle' => 'Edit Guru',
      ''
    ];

    $this->load->view('layout/header',$title);
    $this->load->view('admin/guru/edit_guru',$data);
    $this->load->view('layout/footer');
  }

  function tambahSiswa() {
    $title = [
      'main' => 'Siswa',
      "title" => 'Data Siswa',
      'subTitle' => 'Tambah Siswa',
      ''
    ];
    
    $kelas = $this->KelasSiswaModel->get()->result_array();
    $data['kelas'] = $kelas;
    $this->load->view('layout/header',$title);
    $this->load->view('admin/siswa/tambah_siswa',$data);
    $this->load->view('layout/footer');
  }

  function editSiswa($nis = null) {
    $title = [
      'main' => 'Siswa',
      "title" => 'Data Siswa',
      'subTitle' => 'Edit Siswa',
      
    ];
    if(!$nis){
      redirect('Auth/cekSession');
    }
    $where = ['nis' => $nis];
    $siswa = $this->SiswaModel->find($where)-> result_array();
    $kelas = $this->KelasSiswaModel->get()->result_array();
    $data['kelas'] = $kelas;
    $data['siswa'] = $siswa;
    $this->load->view('layout/header',$title);
    $this->load->view('admin/siswa/edit_siswa',$data);
    $this->load->view('layout/footer');
  }

  function importDataSiswa() {
    $title = [
      'main' => 'Siswa',
      "title" => 'Data Siswa',
      'subTitle' => 'Import Data Siswa',
    ];
    $data['kelas'] = $kelas = $this->KelasSiswaModel->get()->result_array();
    $this->load->view('layout/header',$title);
    $this->load->view('admin/siswa/import_siswa',$data);
    $this->load->view('layout/footer');
  }

  function daftarSiswa() {
    $title = [
      'main' => 'Siswa',
      "title" => 'Data Siswa',
      'subTitle' => 'Daftar Siswa',
      ''
    ];
    $siswa = $this->SiswaModel->get();
    if($siswa->num_rows()){
      $data['siswa'] = $siswa->result_array();
    }else{
      $data['siswa'] = 0;
    }
    $this->load->view('layout/header',$title);
    $this->load->view('admin/siswa/daftar_siswa',$data);
    $this->load->view('layout/footer');
  }

  function tambahKepsek() {
    $title = [
      'main' => 'Kepsek',
      "title" => 'Data Kepala sekolah',
      'subTitle' => 'Tambah Kepala sekolah',
    ];
    $this->load->view('layout/header',$title);
    $this->load->view('admin/kepala_sekolah/tambah_kepala_sekolah');
    $this->load->view('layout/footer');
  }

  function editKepsek($nuks = null){
    if(!$nuks) redirect($_SERVER['HTTP_REFERER']);

    $title = [
      'main' => 'Kepsek',
      "title" => 'Data Kepala sekolah',
      'subTitle' => 'Edit Kepala sekolah',
    ];
    $kepsek = $this->KepalaSekolahModel->find(['nuks' => $nuks])->result_array()[0];
    $data['kepsek'] = $kepsek;
    $this->load->view('layout/header',$title);
    $this->load->view('admin/kepala_sekolah/edit_kepala_sekolah',$data);
    $this->load->view('layout/footer');
  }

  function daftarKepsek() {
    $title = [
      'main' => 'Kepsek',
      "title" => 'Data Kepala sekolah',
      'subTitle' => 'dafatar Kepala sekolah',
      ''
    ];
    $kepalaSekolah = $this->KepalaSekolahModel->get();
    if($kepalaSekolah->num_rows()){
      $data['kepala_sekolah'] = $kepalaSekolah->result_array();
    }else{
      $data['kepala_sekolah'] = 0;
    }
    $this->load->view('layout/header',$title);
    $this->load->view('admin/kepala_sekolah/data_kepala_sekolah',$data);
    $this->load->view('layout/footer');
  }

  function rekapAbsen() {
    $title = [
      'main' => 'Kepsek',
      "title" => 'Data Kepala sekolah',
      'subTitle' => 'dafatar Kepala sekolah',
      ''
    ];
    $jadwal = $this->JadwalModel->getJadwalAktif()->result_array();
    $data['jadwal'] = $jadwal;
    $this->load->view('layout/header',$title);
    $this->load->view('guru/rekap_absen',$data);
    $this->load->view('layout/footer');
  }
}