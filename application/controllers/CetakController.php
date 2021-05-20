<?php 


class CetakController extends CI_Controller {
  function __construct(){
    parent::__construct();
  }

  function cetak($kode_mapel) {
    $data['mapel'] = $kode_mapel;
    $this->load->view('cetak/cetak',$data);
  }
}