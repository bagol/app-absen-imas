<?php

class AbsenController extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('AbsenModel');
    $this->load->model('JadwalModel');
  }

  function store () {
    if(!$this->input->post('tanggal')){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Tanggal tidak boleh kosong',
        'icon' => 'warning'
      ]);
      return;
    }
    $data = [];
    $no = 0 ;
    foreach($this->input->post('nis') as $absen){
      array_push($data,[
        'kode_jadwal' => $this->input->post('kode_jadwal'),
        'tanggal' => $this->input->post('tanggal'),
        'keterangan' => $this->input->post('opsi')[$no],
        'pertemuan_ke' => $this->input->post('pertemuan'),
        'nis' => $absen
      ]);
      $no++;
    }
    $success = 0;
    $fail = 0;
    // priksa apakah tanggal yang diinput sudah diabsen jioka sudah kembalikan pesan error
    if($this->AbsenModel->find([
        'tanggal' => $this->input->post('tanggal'),
        'kode_jadwal' => $this->input->post('kode_jadwal')
      ])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Tanggal ini sudah diabsen',
        'icon' => 'error'
      ]);
      return;
    }
    // priksa apakah pertemuan yang diinput sudah diabsen jika sudah kembalikan pesan error
    if($this->AbsenModel->find([
      'pertemuan_ke' => $this->input->post('pertemuan'),
      'kode_jadwal' => $this->input->post('kode_jadwal')
      ])->num_rows()){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Pertemuan ini sudah diabsen',
        'icon' => 'error'
      ]);
      return;
    }

    foreach($data as $d){
      if($this->AbsenModel->store($d)){
        $success++;
      }else{
        $fail++;
      }
    }

    echo json_encode([
      'status' => 'success',
      'success' => $success,
      'fial' => $fail,
      'message' => 'Absen berhasil disimpan',
      'icon' => 'success'
    ]);

  }

  function getAbsen ($kode) {
    $dataSiswa = $this->AbsenModel->getSiswaByJadwal($kode);
    $siswa = [];
    foreach($dataSiswa->result_array() as $s){
      $absenSiswa = $this->AbsenBook( $s['nis'] , $kode);
      array_push($siswa,[
        'nama' => $s['nama_siswa'],
        'nis' => $s['nis'],
        'absen' => $absenSiswa['absen'],
        'totalAbsen' => $absenSiswa['totalAbsen']
      ]);
    }
    $pertemuan = $this->JadwalModel->getAllPertemuan($kode);
    echo json_encode([
      'status' => 'success',
      'data' => $siswa,
      'pertemuan' => $pertemuan->result_array()
    ]);
  }

  function AbsenBook($nis,$kode) {
    $absen = [];
    $hadir = 0;
    $alpha = 0;
    $izin = 0;
    $sakit = 0;
    $data = $this->AbsenModel->find(['nis' => $nis,'kode_jadwal' => $kode]);
    if($data->num_rows()){
      $data = $data->result_array();
      foreach ($data as $d) {
        array_push($absen,['ket' => $d['keterangan']]);
        if($d['keterangan'] === 'H'){
          $hadir++;
        }
        else if($d['keterangan'] === 'A'){
          $alpha++;
        }
        else if($d['keterangan'] === 'I') {
          $izin++;
        }
        else if($d['keterangan'] === 'S') {
          $sakit++;
        }
      }
    }
    $return = [
      'absen' => $absen,
      'totalAbsen' => [
        'hadir' => $hadir,
        'alpha' => $alpha,
        'izin' => $izin,
        'sakit' => $sakit
      ]
    ];
    return $return;
  }
}