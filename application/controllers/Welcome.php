<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('GuruModel');
		$this->load->model('AdminModel');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->session->userdata('role') !== null){
			redirect('Auth/cekSession');
		}
		$this->load->view('login.php');
	}

	function generatePassword($string){
		echo json_encode(['hash' => password_hash($string,PASSWORD_BCRYPT,['const' => 12 ])]);
	}

	public function loginAdmin(){
		$this->load->view('loginAdmin');
	}

	public function test(){
		echo "MP-".date("Y").rand(0,10000);
	}
}
