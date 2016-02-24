<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdpa extends CI_Model {
	var $table = 'KGB_REPORT';
    var $column = array('BRANCH','BANK_SUBBRANCH','CUSTOMER','TGL_LAHIR','TGL_AKAD','TENOR','PRODUK','TGL_AKHIR','TOTALPOKOK',
    				'RATE','RP_TOT_PREMI','RP_PREMI_NETT','RP_PREMI_BAYAR','MITRA_BROKER');
    var $order = array('id' => 'desc');
	#datatable
    private function _get_datatables_query()
    {
    	$this->db->from($this->table);
        if($this->input->post('periode')!=''){
        	$this->db->where("to_char(TGL_AKAD,'Month-yyyy')", $this->input->post('periode'));
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
        	$this->db->where("to_char(TGL_AKAD,'Month-yyyy')", $this->input->post('periode'));
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
    #end
	function getPeriode(){
		$periode=$this->db->query("SELECT to_char(TGL_AKAD,'Month-yyyy') as periode FROM KGB_REPORT group by to_char(TGL_AKAD,'Month-yyyy')")->result();
		$p['']="- All -";
		foreach($periode as $pr){
			$p[$pr->PERIODE]=$pr->PERIODE;
		}
		return $p;
	}
    function dropdownAsurandur(){
        $this->db->select('ID_MITRA_BROKER,MITRA_BROKER');
        $this->db->group_by('ID_MITRA_BROKER,MITRA_BROKER');
        $data=$this->db->get('KGB_REPORT')->result();
        $asu['']="- All -";
        foreach($data as $data){
            $asu[$data->ID_MITRA_BROKER]=$data->MITRA_BROKER;
        }
        return $asu;
    }
}

/* End of file Mdpa.php */
/* Location: ./application/modules/kgb/models/Mdpa.php */