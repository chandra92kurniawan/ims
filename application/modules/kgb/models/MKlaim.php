<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKlaim extends CI_Model {

	var $table = 'KGB_KLAIM';
    var $column = array('CUSTOMER','KCP','PRODUK','MITRA_BROKER','TIPE_KLAIM','KLAIM_BANK_DATE','KLAIM_DATE','LIMIT_DATE',
    				'TGL_BAYAR','JML_KLAIM','STATUS_KLAIM');
    var $order = array('id' => 'desc');
    
    private function _get_datatables_query()
    {
    	$this->db->from($this->table);
        /*if($this->input->post('periode')!=''){
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
        }*/
        if($this->input->post('range')!=''){
        	$date=explode('-', $this->input->post('range'));
        	$d_awal=trim($date[0]);
        	$d_akhir=trim($date[1]);
        	$this->db->where("KLAIM_DATE between TO_DATE('".$d_awal."','mm-dd-yyyy') AND TO_DATE('".$d_akhir."','mm-dd-yyyy')");
        }
        if($this->input->post('debitur')!=''){
        	$this->db->where("CUSTOMER like '%".$this->input->post('debitur')."%'");
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
        /*if($this->input->post('periode')!=''){
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
        }*/
        return $this->db->count_all_results();
    }
}

/* End of file MKlaim.php */
/* Location: ./application/modules/kgb/models/MKlaim.php */