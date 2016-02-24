<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username')==''){
            redirect('welcome','refresh');
        }
		$this->load->model(array('m_rekap','mdpa','mpassword'));
	}
	public function index()
	{
		$branch=$this->session->userdata('id_bank_branch');
		$menu['home']="#";
		$menu['Rekap Peserta Asuransi']="#";
		//$head['judul']="Data User";
		$head['menu']="Rekap Peserta Asuransi";
		$head['bc']=$menu;
		$periode=$this->m_rekap->getPeriode();
		$p['']="- All -";
		foreach($periode as $periode){
			$p[$periode->PERIODE]=$periode->PERIODE;
		}
		$data['periode']=$p;
		$data['branch']=$this->m_rekap->dropdownBranch();
		$data['subbranch']=$this->m_rekap->dropdownSubBranch($branch);
		$data['asuradur']=$this->m_rekap->dropdownAsurandur();
		$this->load->view('layout/page_header',$head);
		$this->load->view('rekap/page_index',$data);
		$this->load->view('layout/page_footer');
	}
	function getSubBranch(){
		$branch=$this->input->post('branch');
		$data=$this->m_rekap->dropdownSubBranch($branch);
		echo form_dropdown('subbranch', $data, '',"class='form-control' id='subbranch'");
	}
	function getData(){
		$data['periode']=$this->input->post('periode');
		$data['branch']=$this->input->post('branch');
		$data['subbranch']=$this->input->post('subbranch');
		$data['customer']=$this->input->post('customer');
		$data['asuradur']=$this->input->post('asuradur');
		$this->load->view('rekap/page_data',$data);
	}
	public function ajax_list()
    {
        $list = $this->m_rekap->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $row = array();
            $row[] = "<small>".$person->BRANCH."</small>";
            $row[] = "<small>".$person->BANK_SUBBRANCH."</small>";
            $row[] = "<div class='pull-right'><small>".$person->JML_PESERTA."</small></div>";
            $row[] = "<div class='pull-right'><small>".number_format($person->TOTAL_PERTANGGUNGAN,'0','','.')."</small></div>";
            $row[] = "<div class='pull-right'><small>".number_format($person->TOTAL_PREMI_GROSS,'0','','.')."</small></div>";
            $row[] = "<div class='pull-right'><small>".number_format($person->TOTAL_PREMI_NET,'0','','.')."</small></div>";
            $row[] = '<div class="pull-right"><small>'.number_format($person->TOTAL_PREMI_BAYAR,'0','','.')."</small></div>";
            $row[] = '<small>'.$person->MITRA_BROKER.'</small>';
 
            //add html for action
            #$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            #      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_rekap->count_all(),
                        "recordsFiltered" => $this->m_rekap->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}

/* End of file Rekap.php */
/* Location: ./application/modules/kgb/controllers/Rekap.php */