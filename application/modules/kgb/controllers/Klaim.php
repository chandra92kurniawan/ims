<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klaim extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mklaim');
	}
	public function index()
	{
		$menu['home']="#";
		$menu['Claim']="#";
		//$head['judul']="Data User";
		$head['menu']="Claim";
		$head['bc']=$menu;
		$this->load->view('layout/page_header',$head);
		$this->load->view('klaim/page_index');
		$this->load->view('layout/page_footer');
	}
	function getData(){
		$data['range']=$this->input->post('range');
		$data['debitur']=$this->input->post('debitur');
		$this->load->view('klaim/page_data',$data);
	}
	public function ajax_list()
    {
        //echo $this->input->post('range');
    	$list = $this->Mklaim->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $row = array();
            $row[] = "<small>".$person->CUSTOMER."</small>";
            $row[] = "<small>".$person->KCP."</small>";
            $row[] = "<small>".$person->PRODUK."</small>";
            $row[] = "<small>". $person->MITRA_BROKER ."</small>";
            $row[] = "<small>".$person->TIPE_KLAIM."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->KLAIM_BANK_DATE))."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->KLAIM_DATE))."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->LIMIT_DATE))."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_BAYAR))."</small>";
            $row[] = "<div class='pull-right'><small>".number_format($person->JML_KLAIM,'0','','.')."</small></div>";
            $row[] = "<small>".$person->STATUS_KLAIM."</small>";
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mklaim->count_all(),
                        "recordsFiltered" => $this->Mklaim->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}

/* End of file Klaim.php */
/* Location: ./application/modules/kgb/controllers/Klaim.php */