<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rekap extends CI_Model {
	var $table = 'KGB_REPORT_RECAP';
    var $column = array('ID_BANK_SUBBRANCH','BRANCH','BANK_SUBBRANCH','JML_PESERTA',
    				'TOTAL_PERTANGGUNGAN','TOTAL_PREMI_GROSS','TOTAL_PREMI_NET','TOTAL_PREMI_BAYAR','MITRA_BROKER');
    var $order = array('id' => 'desc');
	#datatable
    private function _get_datatables_query()
    {
    	$this->db->select('
    		KGB_REPORT_RECAP.ID_BANK_SUBBRANCH,KGB_REPORT_RECAP.BRANCH,KGB_REPORT_RECAP.BANK_SUBBRANCH,KGB_REPORT_RECAP.MITRA_BROKER,
    		"SUM"(JML_PESERTA) AS JML_PESERTA,
			SUM (TOTALPOKOK) AS TOTAL_PERTANGGUNGAN,
			"SUM"(RP_TOT_PREMI) as TOTAL_PREMI_GROSS,
			"SUM"(RP_PREMI_NETT) as TOTAL_PREMI_NET,
			"SUM"(RP_PREMI_BAYAR) as TOTAL_PREMI_BAYAR
    		');
    	$this->db->join('MST_BANK_BRANCH', 'MST_BANK_BRANCH.ID_BANK_BRANCH = KGB_REPORT_RECAP.ID_BANK_BRANCH');
        $this->db->join('MST_BANK_SUB_BRANCH', 'MST_BANK_SUB_BRANCH.ID_BANK_SUBBRANCH = KGB_REPORT_RECAP.ID_BANK_SUBBRANCH');
        $this->db->from($this->table);
        if($this->input->post('periode')!=''){
        	$this->db->where('KGB_REPORT_RECAP.PERIODE', $this->input->post('periode'));
        }
        if($this->input->post('branch')!=''){
        	$this->db->where('KGB_REPORT_RECAP.ID_BANK_BRANCH', $this->input->post('branch'));
        }
        if($this->input->post('subbranch')!=''){
        	$this->db->where('KGB_REPORT_RECAP.ID_BANK_SUBBRANCH', $this->input->post('subbranch'));
        }
        if($this->input->post('asuradur')!=''){
            $this->db->where('KGB_REPORT_RECAP.ID_MITRA_BROKER', $this->input->post('asuradur'));
        }
        $this->db->group_by('KGB_REPORT_RECAP.ID_BANK_SUBBRANCH,KGB_REPORT_RECAP.BRANCH,KGB_REPORT_RECAP.BANK_SUBBRANCH,KGB_REPORT_RECAP.MITRA_BROKER');
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
    	$this->db->select('
    		KGB_REPORT_RECAP.ID_BANK_SUBBRANCH,KGB_REPORT_RECAP.BRANCH,KGB_REPORT_RECAP.BANK_SUBBRANCH,KGB_REPORT_RECAP.MITRA_BROKER,
    		COUNT (*) AS JML_PESERTA,
			SUM (TOTALPOKOK) AS TOTAL_PERTANGGUNGAN,
			"SUM"(RP_TOT_PREMI) as TOTAL_PREMI_GROSS,
			"SUM"(RP_PREMI_NETT) as TOTAL_PREMI_NET,
			"SUM"(RP_PREMI_BAYAR) as TOTAL_PREMI_BAYAR
    		');
    	$this->db->join('MST_BANK_BRANCH', 'MST_BANK_BRANCH.ID_BANK_BRANCH = KGB_REPORT_RECAP.ID_BANK_BRANCH');
        $this->db->join('MST_BANK_SUB_BRANCH', 'MST_BANK_SUB_BRANCH.ID_BANK_SUBBRANCH = KGB_REPORT_RECAP.ID_BANK_SUBBRANCH');
        $this->db->from($this->table);
        if($this->input->post('periode')!=''){
        	$this->db->where('KGB_REPORT_RECAP.PERIODE', $this->input->post('periode'));
        }
        if($this->input->post('branch')!=''){
        	$this->db->where('KGB_REPORT_RECAP.ID_BANK_BRANCH', $this->input->post('branch'));
        }
        if($this->input->post('subbranch')!=''){
        	$this->db->where('KGB_REPORT_RECAP.ID_BANK_SUBBRANCH', $this->input->post('subbranch'));
        }
        if($this->input->post('asuradur')!=''){
            $this->db->where('KGB_REPORT_RECAP.ID_MITRA_BROKER', $this->input->post('asuradur'));
        }
        $this->db->group_by('KGB_REPORT_RECAP.ID_BANK_SUBBRANCH,KGB_REPORT_RECAP.BRANCH,KGB_REPORT_RECAP.BANK_SUBBRANCH,KGB_REPORT_RECAP.MITRA_BROKER');
        //$this->db->from($this->table);
        return $this->db->count_all_results();
    }
	#end datatable
	function getPeriode(){
		return $this->db->query("SELECT
									PERIODE,
									TAHUN,BULAN
								FROM
									KGB_REPORT_RECAP
								GROUP BY
									PERIODE,
									TAHUN,
									BULAN
								ORDER BY
									TAHUN DESC,BULAN desc")->result();
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
        $data=$this->db->get('KGB_REPORT_RECAP')->result();
        $asu['']="- All -";
        foreach($data as $data){
            $asu[$data->ID_MITRA_BROKER]=$data->MITRA_BROKER;
        }
        return $asu;
    }
}

/* End of file M_rekap.php */
/* Location: ./application/modules/kgb/models/M_rekap.php */