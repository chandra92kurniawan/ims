<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chandra
 * Date: 2/25/16
 * Time: 8:57 PM
 */
class Polis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mpolis','Mpassword'));
    }
    public function index(){
        $branch=$this->session->userdata('id_bank_branch');
        $menu['home']="#";
        $menu['Polis']="#";
        //$head['judul']="Data User";
        $head['menu']="Polis";
        $head['bc']=$menu;
        $data['periode']=$this->Mpolis->getPeriode();
        $data['branch']=$this->Mpolis->dropdownBranch();
        $data['subbranch']=$this->Mpolis->dropdownSubBranch($branch);
        $data['asuradur']=$this->Mpolis->dropdownAsurandur();
        $this->load->view('layout/page_header',$head);
        $this->load->view('polis/page_index',$data);
        $this->load->view('layout/page_footer');
    }
    function getData(){
        $data['periode']=$this->input->post('periode');
        $data['branch']=$this->input->post('branch');
        $data['subbranch']=$this->input->post('subbranch');
        $data['customer']=$this->input->post('customer');
        $data['asuradur']=$this->input->post('asuradur');
        $this->load->view('polis/page_data',$data);
    }
    public function ajax_list()
    {
        $list = $this->Mpolis->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            /*$column = array('BANK_SUBBRANCH','CUSTOMER','TGL_LAHIR','TGL_AKAD','TENOR','PRODUK','TGL_AKHIR','TOTALPOKOK',
    				'RATE','RP_TOT_PREMI','RP_PREMI_NETT','RP_PREMMI_BAYAR');*/
            $row = array();
            $row[] = "<small>".$person->BRANCH."</small>";
            $row[] = "<small>".$person->BANK_SUBBRANCH."</small>";
            $row[] = "<small>".$person->CUSTOMER."</small>";
            $row[] = "<small>".$person->PRODUK."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_AKAD))."</small>";
            $row[] = "<small>".$person->TENOR."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_AKHIR))."</small>";
            $row[] = "<div class='pull-right'><small>".number_format($person->RP_TOT_PREMI,'0','','.')."</small></div>";
            $row[] = "<small>".$person->POLIS_INDUK."</small>";
            $row[] = "<small>".$person->POLIS."</small>";
            $row[] = "<small>".date('d/m/Y',strtotime($person->TGL_POLIS))."</small>";
            $row[] = "<small>".$person->MITRA_BROKER."</small>";
            $row[] = "<small>".$person->ID_STATUS."</small>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mpolis->count_all(),
            "recordsFiltered" => $this->Mpolis->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}