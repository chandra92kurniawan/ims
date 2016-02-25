<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dpa extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('username')==''){
            redirect('welcome','refresh');
        }
		$this->load->model(array('Mdpa','M_rekap','Mpassword'));
	}
	public function index()
	{
		$branch=$this->session->userdata('id_bank_branch');
		$menu['home']="#";
		$menu['Daftar Peserta Asuransi']="#";
		//$head['judul']="Data User";
		$head['menu']="Daftar Peserta Asuransi";
		$head['bc']=$menu;
		$data['periode']=$this->Mdpa->getPeriode();
		$data['branch']=$this->M_rekap->dropdownBranch();
		$data['subbranch']=$this->M_rekap->dropdownSubBranch($branch);
        $data['asuradur']=$this->Mdpa->dropdownAsurandur();
		$this->load->view('layout/page_header',$head);
		$this->load->view('dpa/page_index',$data);
		$this->load->view('layout/page_footer');
	}
	function getData(){
		$data['periode']=$this->input->post('periode');
		$data['branch']=$this->input->post('branch');
		$data['subbranch']=$this->input->post('subbranch');
		$data['customer']=$this->input->post('customer');
        $data['asuradur']=$this->input->post('asuradur');
		$this->load->view('dpa/page_data',$data);
	}
	public function ajax_list()
    {
    	$list = $this->Mdpa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            /*$column = array('BANK_SUBBRANCH','CUSTOMER','TGL_LAHIR','TGL_AKAD','TENOR','PRODUK','TGL_AKHIR','TOTALPOKOK',
    				'RATE','RP_TOT_PREMI','RP_PREMI_NETT','RP_PREMMI_BAYAR');*/
            $row = array();
            $row[] = "<small>".$person->BRANCH."</small>";
            $row[] = "<small>".$person->BANK_SUBBRANCH."</small>";
            $row[] = "<small>".$person->CUSTOMER."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_LAHIR))."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_AKAD))."</small>";
            $row[] = "<small>".$person->TENOR."</small>";
            $row[] = "<small>".$person->PRODUK."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_AKHIR))."</small>";
            $row[] = "<div class='pull-right'><small>".number_format($person->TOTALPOKOK,'0','','.')."</small></div>";
            $row[] = "<div class='pull-right'><small>".$person->RATE."</small>";
            $row[] = "<div class='pull-right'><small>".number_format($person->RP_TOT_PREMI,'0','','.')."</small></div>";
            $row[] = "<div class='pull-right'><small>".number_format($person->RP_PREMI_NETT,'0','','.')."</small></div>";
            $row[] = '<div class="pull-right"><small>'.number_format($person->RP_PREMI_BAYAR,'0','','.')."</small></div>";
            $row[] = '<div><small>'.$person->MITRA_BROKER.'</small></div>';
 
            //add html for action
            #$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            #      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mdpa->count_all(),
                        "recordsFiltered" => $this->Mdpa->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    
}

/* End of file Dpa.php */
/* Location: ./application/modules/kgb/controllers/Dpa.php */