<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mpassword');
	}
	public function index(){
		$username=$this->session->userdata('username');
		if($username!=''){
			redirect('users');
		}else{
			redirect('welcome/login','refresh');
		}
	}
	public function login()
	{
		$this->load->view('login/page_index');
	}
	public function verfikasi(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		if($_POST['g-recaptcha-response']!=''){
			$data=$this->mpassword->confirmPassword($username,$password);
			if($data){
				$dt=$this->mpassword->getUserByUsername($username)->row();
				$sess=array('username'=>$dt->USERNAME,
							'jabatan'=>$dt->JABATAN,
							'no_hp'=>$dt->NO_HP,
							'email'=>$dt->EMAIL);
				$this->session->set_userdata( $sess );
				redirect('users');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Username dan Password salah</strong></div>');
				redirect('welcome/login','refresh');
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Harap isi reCaptcha</strong></div>');
			redirect('welcome/login','refresh');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('welcome','refresh');
	}
}
