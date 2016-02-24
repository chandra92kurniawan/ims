<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$menu['home']="#";
		$head['menu']="Home";
		$head['bc']=$menu;
		$this->load->view('layout/page_header',$head);
		$this->load->view('page_index');
		$this->load->view('layout/page_footer');
	}

}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */