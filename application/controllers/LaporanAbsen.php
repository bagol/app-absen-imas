<?php


class LaporanAbsen extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('KelasSiswaModel');
    $this->load->model('SiswaModel');
    $this->load->model('AbsenModel');
    $this->load->model('JadwalModel');
  }
  

  function getDataLaporan($kodeKelas) {
    $siswa = $this->SiswaModel->find(['kelas_siswa' => $kodeKelas])->result_array();
    $totalAbsen = [];
    foreach($siswa as $s){
      $absen = $this->getAbsenSiswaPerJadwal($kodeKelas,$s['nis']);
      array_push($totalAbsen,[
        'nis' => $s['nis'],
        'nama' => $s['nama_siswa'],
        'absen' => $absen,
        'persentase' => floor($this->totalPresentase($absen))
      ]);
    }

    
    echo json_encode($totalAbsen);
  }

  function getAbsenSiswaPerJadwal($kodeKelas,$nis) {
    $jadwal = $this->JadwalModel->find(['kode_kelas_siswa' => $kodeKelas])->result_array();
    $absen = [];
    foreach($jadwal as $j){
      $totalAbsen = $this->AbsenModel->getJumlahHadirSiswa($j['kode_jadwal'],$nis)->result_array()[0];
      $totalPertemuan = $this->AbsenModel->find(['kode_jadwal' => $j['kode_jadwal'],'nis'=>$nis]);
      array_push($absen,[
        'kode_jadwal' => $j['kode_jadwal'],
        'nama_mapel' => $j['nama_mapel'],
        'jumlah_hadir' => $totalAbsen['jumlah_hadir'],
        'total_pertemuan' => $totalPertemuan->num_rows()
      ]);
    }

    return $absen;
  }

  function totalPresentase($data){
    $totalHadir = 0;
    $totalPertemuan = 0;
    foreach($data as $d){
      $totalHadir += $d['jumlah_hadir'];
      $totalPertemuan += $d['total_pertemuan'];
    }

    return ($totalHadir / $totalPertemuan) * 100;
  }
}

