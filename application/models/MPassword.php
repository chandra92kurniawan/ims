<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPassword extends CI_Model {

	function createPassword($str_password){
		$satu=random_string('alnum', 5);
    	$dua=do_hash($satu);
    	$salt=$dua.".".$satu;
    	$password=do_hash($str_password,'md5');
    	$passFinal=do_hash($salt.$password);
    	return array('salt'=>$salt,'password'=>$passFinal);
	}
	function getBranch($branch){
		$this->db->where('ID_BANK_BRANCH', $branch);
		return $this->db->get('MST_BANK_BRANCH')->row()->NAME_BANK;
	}
	function getSubBranch($subbranch){
		$this->db->where('ID_BANK_SUBBRANCH', $subbranch);
		return $this->db->get('MST_BANK_SUB_BRANCH')->row()->NAME_BANK;
	}
	function confirmPassword($username,$str_password){
		$user=$this->getUserByUsername($username);
		if($user->num_rows()==0){
			return false;
		}else{
			$data=$user->row();
			$s=explode('.', $data->SALT);
			$satu=$s[1];
			$dua=do_hash($satu);
			$salt=$dua.".".$satu;
			$password=do_hash($str_password,'md5');
			$passFinal=do_hash($salt.$password);
			if($passFinal===$data->PASSWORD){
				return true;
			}else{
				return false;
			}
		}
	}
	function getUserByUsername($username){
		$this->db->where('USERNAME', $username);
		return $this->db->get('USER');
	}
	public function sendemail($send='',$subject='',$msg=''){
		//$from = array('email'=>'','name'=>'');
	  #print_r($from['name']);die();
	  $config = Array( 
	  'useragent'=>'Codeigniter',
	  'mailtype'=>'html',
	  'charset'=>'utf-8',
	  'wordwrap'=>true,	
	  'protocol' => 'smtp', 
	  'smtp_host' => 'ssl://smtp.googlemail.com', 
	  'smtp_port' => 465, 
	  'smtp_user' => 'Helpdesk@sib-brokers.net', 
	  'smtp_pass' => 'tolong', ); 

	  $this->load->library('email', $config); 
	  $this->email->set_newline("\r\n");
	  $this->email->from('Helpdesk@sib-brokers.net', 'SIB');
	  $this->email->to($send);
	  $this->email->subject($subject); 
	  $this->email->message($msg);
	  if (!$this->email->send()) {
	    show_error($this->email->print_debugger()); }
	  else {
	    echo 'Your e-mail has been sent!';
	  }
	}  
}

/* End of file MPassword.php */
/* Location: ./application/models/MPassword.php */
