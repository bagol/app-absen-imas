<?php

class Auth extends CI_Controller{
	function __construct(){
			parent::__construct();
	}

	function login() {
		$level = $this->input->post('level');
		$username = $this->input->post('username',true);
		$password = $this->input->post('password',true);
		if ( $level === '1') {
			// panggil model guru
			$this->load->model('GuruModel');
			// periksa user sebagai guru
			$guru = $this->GuruModel->find(['nip' => $username, 'status' => 'aktif']);
			// jika data ditemukan
			if($guru->num_rows()){
				$guru = $guru->result_array()[0];
				// priksa apakah password yang dimasukan uuser sama 
				if(password_verify($password,$guru['password'])){
					$guruSession = [
						'username' => $guru['nama_guru'],
						'email' => $guru['email_guru'],
						'foto' => $guru['foto'],
						'logged' => true,
						'role' => 'guru',
						'nip' => $guru['nip'],
					];
					$this->session->set_userdata($guruSession);
					echo json_encode([
						'status' => 'success',
						'message' => 'Login Success',
						'icon' => 'success',
						'data' => $guruSession
					]);
					return;
				}else{
					// jika password berbeda
					echo json_encode([
						'status' => 'fail',
						'message' => 'Password Salah',
						'icon' => 'error'
					]);
					return;
				}
			}else{
				// jika data tidak ditemukan
				echo json_encode([
					'status' => 'fail',
					'message' => 'NIP Tidak Diketahui',
					'icon' => 'error'
				]);
				return;
			}
		}else if ( $level === '2' ) {
			// panggil model siswa
			$this->load->model('SiswaModel');
			// periksa user sebagai siswa
			$siswa = $this->SiswaModel->find(['nis' => $username, 'status' => 'aktif']);
			// jika data ditemukan
			if($siswa->num_rows()){
				$siswa = $siswa->result_array()[0];
				// priksa apakah password yang dimasukan uuser sama 
				if(password_verify($password,$siswa['password'])){
					$siswaSession = [
						'username' => $siswa['nama_siswa'],
						'email' => isset($siswa['email_siswa'])?:$siswa['nis'],
						'nis' => $siswa['nis'],
						'foto' => $siswa['foto'],
						'logged' => true,
						'kelas' => $siswa['kelas_siswa'],
						'role' => 'siswa'
					];
					$this->session->set_userdata($siswaSession);
					echo json_encode([
						'status' => 'success',
						'message' => 'Login Success',
						'icon' => 'success',
						'data' => $siswaSession
					]);
					return;
				}else{
					// jika password berbeda
					echo json_encode([
						'status' => 'fail',
						'message' => 'Password Salah',
						'icon' => 'error'
					]);
					return;
				}
			}else{
				// jika data tidak ditemukan
				echo json_encode([
					'status' => 'fail',
					'message' => 'NISN Tidak Diketahui',
					'icon' => 'error'
				]);
				return;
			}
		}else if ( $level === '3' ) { 
			// panggil model kepsek
			$this->load->model('KepalaSekolahModel');
			$kepsek = $this->KepalaSekolahModel->find(['nuks' => $username, 'status' => 'aktif']);
			if($kepsek->num_rows()){
				$kepsek = $kepsek->result_array()[0];
				if(password_verify($password,$kepsek['password'])){
					$kepsekSession = [
						'username' => $kepsek['nama_kepala_sekolah'],
						'email' => $kepsek['email_kepala_sekolah'],
						'nip' => $kepsek['nuks'],
						'foto' => $kepsek['foto'],
						'logged' => true,
						'role' => 'kepala_sekolah'
					];
					$this->session->set_userdata($kepsekSession);
					echo json_encode([
						'status' => 'success',
						'message' => 'Login Success',
						'icon' => 'success',
						'data' => $kepsekSession
					]);
					return;
				}else{
					// jika password berbeda
					echo json_encode([
						'status' => 'fail',
						'message' => 'Password Salah',
						'icon' => 'error'
					]);
					return;
				}
			}else{
				// jika data tidak ditemukan
				echo json_encode([
					'status' => 'fail',
					'message' => 'NIP Tidak Diketahui',
					'icon' => 'error'
				]);
				return;
			}
		
		}else if ( $level === '4' ) { 
			// panggil model siswa
			$this->load->model('WaliKelasModel');
			// periksa user sebagai siswa
			$waliKelas = $this->WaliKelasModel->find(['nip' => $username, 'status' => 'aktif']);
			// jika data ditemukan
			if($waliKelas->num_rows()){
				$waliKelas = $waliKelas->result_array()[0];
				// priksa apakah password yang dimasukan uuser sama 
				if(password_verify($password,$waliKelas['password'])){
					$waliKelasSession = [
						'username' => $waliKelas['nama_wali_kelas'],
						'email' => $waliKelas['email_wali_kelas'],
						'nip' => $waliKelas['nip'],
						'foto' => $waliKelas['foto'],
						'logged' => true,
						'role' => 'wali_kelas'
					];
					$this->session->set_userdata($waliKelasSession);
					echo json_encode([
						'status' => 'success',
						'message' => 'Login Success',
						'icon' => 'success',
						'data' => $waliKelasSession
					]);
					return;
				}else{
					// jika password berbeda
					echo json_encode([
						'status' => 'fail',
						'message' => 'Password Salah',
						'icon' => 'error'
					]);
					return;
				}
			}else{
				// jika data tidak ditemukan
				echo json_encode([
					'status' => 'fail',
					'message' => 'NIP Tidak Diketahui',
					'icon' => 'error'
				]);
				return;
			}
		} 
	}

	function cekSession(){
		$role = $this->session->userdata('role');
		// jika login sebagai guru
		if($role === 'guru'){
			// alihkan ke controller guru
			redirect("GuruController");
		}
		// jika login sebagai siswa
		else if($role === 'siswa'){
			// alihkan ke Dashboard siswa
			redirect('DashboardSiswaController');
		}
		// jika login sebagai wali kelas
		else if($role === 'wali_kelas'){
			// alihkan ke controller wali kelas
			redirect('WaliKelasController');
		}
		// jika login sebagai kepala sekolah
		else if($role === 'kepala_sekolah'){
			// alihkan ke controller kepala sekolah
			redirect('DashboardKepalaSekolahController');
		}
		// jika login sebagai admin
		else if($role === 'admin'){
			// alihkan ke controller admin
			redirect('AdminController');
		}
		//jika level login tidak ditemukan kembalikan kehalaman login
		else{
			redirect('/');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$this->session->unset_userdata('role');
		redirect('/');
	}

	function logoutAdmin(){
		$this->session->sess_destroy();
		$this->session->unset_userdata('role');
		redirect('/login/admin');
	}
}