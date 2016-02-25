<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chandra
 * Date: 2/25/16
 * Time: 8:58 PM
 */
class Mpolis extends CI_Model
{
    var $table = 'KGB_POLIS_REPORT';
    var $column = array('BRANCH','BANK_SUBBRANCH','CUSTOMER','PRODUK','TGL_AKAD','TENOR','TGL_AKHIR','RP_TOT_PREMI',
        'POLIS_INDUK','POLIS','TGL_POLIS','MITRA_BROKER','ID_STATUS');
    var $order = array('id' => 'desc');
    #datatable
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        if($this->input->post('periode')!=''){
            $this->db->where("to_char(TGL_POLIS,'Month-yyyy')", $this->input->post('periode'));
        }
        if($this->input->post('branch')!=''){
            $this->db->where('ID_BANK_BRANCH', $this->input->post('branch'));
        }
        if($this->input->post('subbranch')!=''){
            $this->db->where('ID_BANK_SUBBRANCH', $this->input->post('subbranch'));
        }
        if($this->input->post('customer')!=''){
            $this->db->where('CUSTOMER', $this->input->post('customer'));
        }
        if($this->input->post('asuradur')!=''){
            $this->db->where('ID_MITRA_BROKER', $this->input->post('asuradur'));
        }
        $i = 0;
        foreach ($this->column as $item)
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        if($this->input->post('periode')!=''){
            $this->db->where("to_char(TGL_POLIS,'Month-yyyy')", $this->input->post('periode'));
        }
        if($this->input->post('branch')!=''){
            $this->db->where('ID_BANK_BRANCH', $this->input->post('branch'));
        }
        if($this->input->post('subbranch')!=''){
            $this->db->where('ID_BANK_SUBBRANCH', $this->input->post('subbranch'));
        }
        if($this->input->post('customer')!=''){
            $this->db->where('CUSTOMER', $this->input->post('customer'));
        }
        return $this->db->count_all_results();
    }
    function getPeriode(){
        $periode=$this->db->query("SELECT to_char(TGL_POLIS,'Month-yyyy') as periode FROM KGB_POLIS_REPORT group by to_char(TGL_POLIS,'Month-yyyy')")->result();
        $p['']="- All -";
        foreach($periode as $pr){
            $p[$pr->PERIODE]=$pr->PERIODE;
        }
        return $p;
    }
    function dropdownBranch(){
        $role=$this->session->userdata('role');
        $branch=array();
        if($role==2){// role untuk bank
            $this->db->where('ID_BANK', $this->session->userdata('id_bank'));
            $this->db->order_by('NAME_BANK', 'Asc');
            $brc=$this->db->get('MST_BANK_BRANCH')->result();
            $branch['']="- All -";
            foreach($brc as $brc){
                $branch[$brc->ID_BANK_BRANCH]=$brc->NAME_BANK;
            }

        }else{
            $this->db->order_by('NAME_BANK', 'Asc');
            $brc=$this->db->get('MST_BANK_BRANCH')->result();
            $branch['']="- All -";
            foreach($brc as $brc){
                $branch[$brc->ID_BANK_BRANCH]=$brc->NAME_BANK;
            }
        }
        return $branch;
    }
    function dropdownSubBranch($branch=''){
        $role=$this->session->userdata('role');
        $sub=array();
        if($role==2 or $role==1){
            $this->db->where('ID_BANK_BRANCH', $branch);
            $this->db->order_by('NAME_BANK', 'Asc');
            $subb=$this->db->get('MST_BANK_SUB_BRANCH')->result();
            $sub['']="- All -";
            foreach($subb as $subb){
                $sub[$subb->ID_BANK_SUBBRANCH]=$subb->NAME_BANK;
            }
        }
        return $sub;
    }
    function dropdownAsurandur(){
        $this->db->select('ID_MITRA_BROKER,MITRA_BROKER');
        $this->db->group_by('ID_MITRA_BROKER,MITRA_BROKER');
        $data=$this->db->get('KGB_POLIS_REPORT')->result();
        $asu['']="- All -";
        foreach($data as $data){
            $asu[$data->ID_MITRA_BROKER]=$data->MITRA_BROKER;
        }
        return $asu;
    }
}