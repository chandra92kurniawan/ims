<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_user','mpassword'));
	}
	public function index()
	{
		$menu['home']="#";
		$menu['user']="#";
		//$head['judul']="Data User";
		$head['menu']="User";
		$head['bc']=$menu;
        $role['']="- Pilih Role -";
        $role['1']="Broker";
        $role['2']="Bank";
        $role['3']="Insurance";
        $data['role']=$role;
            $this->db->where('TYPE', '1');
            $r=$this->db->get('ROLE')->result();
            foreach($r as $r){
                $rl[$r->ID]=$r->ROLE;
            }
            $data['rl']=$rl;
            $bnk=$this->db->get('MST_BANK')->result();
            $bank['']="- All -";
            foreach($bnk as $dt){
                $bank[$dt->ID_BANK]=$dt->NAME_BANK;
            }
            $data['bank']=$bank;
		$this->load->view('layout/page_header',$head);
		$this->load->view('page_index',$data);
		$this->load->view('layout/page_footer');
	}
	public function ajax_list()
    {
        $list = $this->m_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            if($person->ROLE==1){
                $b="BROKER";
            }elseif($person->ROLE==2){
                $b="BANK";
            }else{
                $b="INSURANCE";
            }
            $no++;
            $row = array();
            $row[] = $person->USERNAME;
            $row[] = $b;
            $row[] = $person->NO_HP;
            $row[] = $person->EMAIL;
            $row[] = '<a href="#" onclick="edit(\''.$person->USERNAME.'\')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" onclick="hapus(\''.$person->USERNAME.'\')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
            ';
            #$row[] = $person->dob;
 
            //add html for action
            #$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            #      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_user->count_all(),
                        "recordsFiltered" => $this->m_user->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function cekUser(){
    	$user=$this->input->post('username');
    	$this->db->where('USERNAME', $user);
    	$a=$this->db->get('USER')->num_rows();
    	echo $a;
    }
    public function add(){
        #$from=array('email'=>'chandra@passionit.co.id','name'=>'chandra');

        $send=$this->input->post('email');
        $subject="User Account";
        $msg="Username : <b>".$this->input->post('username')."</b><br>
                Password : <b>".$this->input->post('password1')."</b>";
        $this->mpassword->sendemail($send,$subject,$msg);
    	$password=$this->input->post('password1');
        $this->mpassword->sendemail();
        $pass=$this->mpassword->createPassword($this->input->post('password1'));
    	$data=array('USERNAME'=>$this->input->post('username'),
    				'JABATAN'=>$this->input->post('jabatan'),
    				'NO_HP'=>$this->input->post('no_hp'),
    				'EMAIL'=>$this->input->post('email'),
    				'PASSWORD'=>$pass['password'],
    				'SALT'=>$pass['salt'],
                    'ROLE'=>$this->input->post('role'),
                    'TYPE'=>$this->input->post('tipe'),
                    'JENIS'=>$this->input->post('bagian'),
                    'ID_BANK'=>$this->input->post('bank'),
                    'ID_BANK_BRANCH'=>$this->input->post('branch'),
                    'ID_BANK_SUBBRANCH'=>$this->input->post('subbranch'),
    				'CREATE_DATE'=>date('d-M-Y'));
    	$this->db->insert('USER', $data);
    	$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>User baru berhasil ditambahkan!</strong></div>');
    	redirect('users','refresh');
    }
    public function test2(){
        $from=array('email'=>'chakz790@gmail.com','name'=>'chandra');
        
        $send=$this->input->post('email');
        $subject="User Account";
        $msg="Username : <b>s</b><br>
                Password : <b>b</b>";
        $this->mpassword->sendemail($from,$send,$subject,$msg);
    }
    public function edit(){
        $username=$this->input->post('username');
        $data=array('JABATAN'=>$this->input->post('jabatan'),
                    'NO_HP'=>$this->input->post('no_hp'),
                    'EMAIL'=>$this->input->post('email'),
                    'ROLE'=>$this->input->post('role'),
                    'TYPE'=>$this->input->post('tipe'),
                    'JENIS'=>$this->input->post('bagian'),
                    'ID_BANK'=>$this->input->post('bank'),
                    'ID_BANK_BRANCH'=>$this->input->post('branch'),
                    'ID_BANK_SUBBRANCH'=>$this->input->post('subbranch'),
                    'UPDATE_DATE'=>date('d-M-Y'));
        $this->db->where('USERNAME', $username);
        $this->db->update('USER', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>User berhasil diubah!</strong></div>');
        redirect('users','refresh');
    }
    public function hapus($username){
        $this->db->where('USERNAME', $username);
        $this->db->delete('USER');
        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>User berhasil dihapus!</strong></div>');
        redirect('users','refresh');
    }
    public function test(){
    	$cek=$this->mpassword->confirmPassword('farid','chandra28');
    	if($cek){
    		echo "benar";
    	}else{
    		echo "salah";
    	}
    }
    public function getDtUser(){
        $username=$this->input->post('username');
        $data=$this->mpassword->getUserByUsername($username)->row();
        print_r(json_encode($data));
    }
    public function getAdded()
    {
        $role=$this->input->post('role');
        if($role==1){
            $this->db->where('TYPE', '1');
            $r=$this->db->get('ROLE')->result();
            foreach($r as $r){
                $rl[$r->ID]=$r->ROLE;
            }
            echo '<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Sebagai</label>
                <div class="col-sm-4">
                    '.form_dropdown('bagian', $rl, '',"class='form-control' id='bagian'").'
                </div>
              </div> ';
        }/*else if($role==2){
            $str='';
            $bnk=$this->db->get('MST_BANK')->result();
            $bank['']="- All -";
            foreach($bnk as $dt){
                $bank[$dt->ID_BANK]=$dt->NAME_BANK;
            }
            $str.='<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Bank</label>
                <div class="col-sm-4">
                    '.form_dropdown('bank', $bank, '',"class='form-control' id='bank'").'
                </div>
              </div> ';
            $str.='<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Branch</label>
                <div class="col-sm-4">
                    '.form_dropdown('branch', array(''=>'- All -'), '',"class='form-control' id='branch'").'
                </div>
              </div> ';
              $str.='<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Sub Branch</label>
                <div class="col-sm-4">
                    '.form_dropdown('subbranch', array(''=>'- All -'), '',"class='form-control' id='subbranch'").'
                </div>
              </div> ';
              echo $str;
        }*/
    }
    public function getBranch(){
        $bank=$this->input->post('bank');
        $this->db->where('ID_BANK', $bank);
        $branch=$this->db->get('MST_BANK_BRANCH')->result();
        $brc['']="- ALL -";
        foreach($branch as $v){
            $brc[$v->ID_BANK_BRANCH]=$v->NAME_BANK;
        }
        echo form_dropdown('branch', $brc, '',"class='form-control' id='branch'");
    }
    public function getTipe(){
        $role=$this->input->post('role');
        $tipe['KGB']="KGB";
        $tipe['KPR']="KPR";
        if($role==1 or $role==2){
            $tipe['ALL']="ALL";
        }
        echo form_dropdown('tipe', $tipe,'' ,'class="form-control" id="tipe"');
    }
    public function getSubBranch(){
        $branch=$this->input->post('branch');
        $this->db->where('ID_BANK_BRANCH', $branch);
        $data=$this->db->get('MST_BANK_SUB_BRANCH')->result();
        $b['']="- All -";
        foreach($data as $data)
        {
            $b[$data->ID_BANK_SUBBRANCH]=$data->NAME_BANK;
        }
        echo form_dropdown('subbranch', $b, '',"class='form-control' id='subbranch'");
    }
}

/* End of file Users.php */
/* Location: ./application/modules/users/controllers/Users.php */