<?php 

class AkunController extends CI_Controller {
  function __construct(){
    parent::__construct();
    if($this->session->userdata('role') === ''){
      redirect('Auth/cekSession');
    }
    $this->load->model('JadwalModel');
    $this->load->model('GuruModel');
    $this->load->model('AdminModel');
    $this->load->model('SiswaModel');
    $this->load->model('WaliKelasModel');
    $this->load->model('KelasSiswaModel');
    $this->load->model('KepalaSekolahModel');
  }
  
  function index () {
    $title = [
      'main' => "Pengaturan",
      'title' => "Akun",
      "subTitle" => "Profile"
    ];
    $role = $this->session->userdata('role');
    switch ($role) {
      case 'guru':
        $guru = $this->GuruModel->find(['nip' => $this->session->userdata('nip')])->result_array()[0];
        $data['akun'] = [
          'role' => 'guru',
          'nama' => $guru['nama_guru'],
          'email' => $guru['email_guru'],
          'kode' => $guru['nip'],
          'status' => $guru['status'],
          'foto' => $guru['foto'],
        ];
        break;
      case 'admin':
        $admin = $this->AdminModel->find(['kode_admin' => $this->session->userdata('kode_admin')])->result_array()[0];# code...
        $data['akun'] = [
          'role' => 'admin',
          'nama' => $admin['nama_admin'],
          'email' => $admin['email_admin'],
          'kode' => $admin['kode_admin'],
          'status' => $admin['status'] === '1' ? 'aktif' : 'non-aktif',
          'foto' => $admin['foto']
        ];
        break;
        case 'siswa':
          $siswa = $this->SiswaModel->find(['nis' => $this->session->userdata('nis')])->result_array()[0];
          $data['akun'] = [
            'role' => 'siswa',
            'nama' => $siswa['nama_siswa'],
            'email' => isset($siswa['email_siswa'])? '': 'blm ada',
            'kode' => $siswa['nis'],
            'status' => $siswa['status'],
            'foto' => $siswa['foto']
          ];
        break;
        case 'wali_kelas':
          $waliKelas = $this->WaliKelasModel->find(['nip' => $this->session->userdata('nip')])->result_array()[0];
          $data['akun'] = [
            'role' => 'wali kelas',
            'nama' => $waliKelas['nama_wali_kelas'],
            'email' => $waliKelas['email_wali_kelas'],
            'kode' => $waliKelas['nip'],
            'status' => $waliKelas['status'],
            'foto' => $waliKelas['foto']
          ];
        break;
        case 'kepala_sekolah':
          $kepsek = $this->KepalaSekolahModel->find(['nuks' => $this->session->userdata('nip')])->result_array()[0];
          $data['akun'] = [
            'role' => 'Kepala Sekolah',
            'nama' => $kepsek['nama_kepala_sekolah'],
            'email' => $kepsek['email_kepala_sekolah'],
            'kode' => $kepsek['nuks'],
            'status' => $kepsek['status'],
            'foto' => $kepsek['foto']
          ];
        break;
      default:
        # code...
        break;
    }
    
    $this->load->view('layout/header',$title);
    $this->load->view('akun/profile',$data);
    $this->load->view('layout/footer');
  }

  function gantiFoto($id) {
    $role = $this->session->userdata('role');
    $data['foto'] = $this->do_upload('foto');
    if($role === 'guru') {
      $where = ['nip' => $id];
      if($this->GuruModel->update($data,$where)){
        $this->session->set_userdata('foto',$data['foto']);
        echo json_encode([
          'status' => 'success',
          'message' => 'Foto Profile Berhasil diperbaharui',
          'icon' => 'success'
        ]);
        return;
      }

      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Foto Profile',
        'icon' => 'error'
      ]);
      return;
    }

    if($role === 'admin'){
      $where = ['kode_admin' => $id];
      if($this->AdminModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Foto Profile Berhasil diperbaharui',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Foto Profile',
        'icon' => 'error'
      ]);
      return;
    }

    if($role === 'siswa'){
      $where = ['nis' => $id];
      if($this->SiswaModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Foto Profile Berhasil diperbaharui',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Foto Profile',
        'icon' => 'error'
      ]);
      return;
    }

    if($role === 'wali_kelas'){
      $where = ['nip' => $id];
      if($this->WaliKelasModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Foto Profile Berhasil diperbaharui',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Foto Profile',
        'icon' => 'error'
      ]);
      return;
    }

    if($role === 'kepala_sekolah'){
      $where = ['nuks' => $id];
      if($this->KepalaSekolahModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Foto Profile Berhasil diperbaharui',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Foto Profile',
        'icon' => 'error'
      ]);
      return;
    }

  } //end ganti profile
  
  function gantiPassword ($kode){
    if(!$this->input->post('password')){
      echo json_encode([
        'status' => 'fail',
        'message' => 'Password tidak boleh kosong',
        'icon' => 'error'
      ]);
      return;
    }
    $role = $this->session->userdata('role');
    $data = ['password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT,['const' => 12])];
    if($role === 'guru'){
      $where = ['nip' => $kode];
      if($this->GuruModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Password diperbaharui, Silahkan Logout untuk memastikan',
          'icon' => 'success',
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Password',
        'icon' => 'error'
      ]);
      return;
    }
    
    if($role === 'admin'){
      $where = ['kode_admin' => $kode];
      if($this->AdminModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Password diperbaharui, Silahkan Login Kembali',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Password',
        'icon' => 'error'
      ]);
      return;
    }

    if($role === 'siswa'){
      $where = ['nis' => $kode];
      if($this->SiswaModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Password diperbaharui, Silahkan Login Kembali',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Password',
        'icon' => 'error'
      ]);
      return;
    }

    if($role === 'wali_kelas'){
      $where = ['nip' => $kode];
      if($this->WaliKelasModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Password diperbaharui, Silahkan Login Kembali',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Password',
        'icon' => 'error'
      ]);
      return;
    }

    if($role === 'kepala_sekolah'){
      $where = ['nuks' => $kode];
      if($this->KepalaSekolahModel->update($data,$where)){
        echo json_encode([
          'status' => 'success',
          'message' => 'Password diperbaharui, Silahkan Login Kembali',
          'icon' => 'success'
        ]);
        return;
      }
      echo json_encode([
        'status' => 'fail',
        'message' => 'Gagal Memperbaharui Password',
        'icon' => 'error'
      ]);
      return;
    }
  }

  public function do_upload($field)
  {
    $config['upload_path']          = './assets/images/profile/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['encrypt_name']         = true;
    $this->load->library('upload', $config);
    if ($this->upload->do_upload($field)){
      return $this->upload->data('file_name');
    }
    return false;
  }
}