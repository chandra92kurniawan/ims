<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restitusi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mrestitusi');
    }
	public function index()
	{
		$menu['home']="#";
		$menu['Restitusi']="#";
		//$head['judul']="Data User";
		$head['menu']="Restitusi";
		$head['bc']=$menu;
		$this->load->view('layout/page_header',$head);
		$this->load->view('restitusi/page_index');
		$this->load->view('layout/page_footer');
	}
	function getData(){
		$data['range']=$this->input->post('range');
		$data['debitur']=$this->input->post('debitur');
		$this->load->view('restitusi/page_data',$data);
	}
	public function ajax_list()
    {
    	$list = $this->mrestitusi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            /*$column = array('BANK_SUBBRANCH','CUSTOMER','TGL_LAHIR','TGL_AKAD','TENOR','PRODUK','TGL_AKHIR','TOTALPOKOK',
    				'RATE','RP_TOT_PREMI','RP_PREMI_NETT','RP_PREMMI_BAYAR');*/
            $row = array();
            $row[] = "<small>".$person->CUSTOMER."</small>";
            $row[] = "<small>".$person->KCP."</small>";
            $row[] = "<small>".$person->PRODUK."</small>";
            $row[] = "<small>". $person->MITRA_BROKER ."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_AKAD))."</small>";
            $row[] = "<small>".$person->TENOR."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_AKHIR))."</small>";
            $row[] = "<div class='pull-right'><small>".number_format($person->TOTALPOKOK,'0','','.')."</small></div>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_RESTITUSI))."</small>";
            $row[] = "<small>".$person->LIMIT_DATE."</small>";
            $row[] = "<small>".$person->TGL_PELUNASAN."</small>";
            $row[] = "<div class='pull-right'><small>".number_format($person->JML_PELUNASAN,'0','','.')."</small></div>";
            $row[] = "<small>".$person->STATUS_RESTITUSI."</small>";
            
            
            //add html for action
            #$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            #      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->mrestitusi->count_all(),
                        "recordsFiltered" => $this->mrestitusi->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}

/* End of file Restitusi.php */
/* Location: ./application/modules/kgb/controllers/Restitusi.php */